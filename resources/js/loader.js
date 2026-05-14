import * as THREE from 'three';
import { EffectComposer } from 'three/examples/jsm/postprocessing/EffectComposer.js';
import { RenderPass } from 'three/examples/jsm/postprocessing/RenderPass.js';
import { ShaderPass } from 'three/examples/jsm/postprocessing/ShaderPass.js';
import { GammaCorrectionShader } from 'three/examples/jsm/shaders/GammaCorrectionShader.js';

function setup3DScene(canvas, options = {}) {
    const scene = new THREE.Scene();
    const camera = new THREE.PerspectiveCamera(75, canvas.clientWidth / canvas.clientHeight, 0.1, 1000);
    const renderer = new THREE.WebGLRenderer({
        canvas: canvas,
        antialias: true,
        alpha: true
    });

    renderer.setSize(canvas.clientWidth, canvas.clientHeight);
    renderer.setPixelRatio(Math.min(window.devicePixelRatio, 2));
    renderer.outputColorSpace = THREE.SRGBColorSpace;

    camera.position.z = 15;

    // --- Textures ---
    const manager = options.manager || new THREE.LoadingManager();
    const textureLoader = new THREE.TextureLoader(manager);
    const imageTexture = textureLoader.load('https://images.unsplash.com/photo-1500382017468-9049fed747ef?auto=format&fit=crop&q=80&w=2048');
    imageTexture.mapping = THREE.EquirectangularReflectionMapping;

    scene.background = imageTexture;
    scene.environment = imageTexture;

    // --- Interaction ---
    const mouse = new THREE.Vector2();
    const targetCameraRotation = new THREE.Euler();

    const onMouseMove = (event) => {
        const rect = canvas.getBoundingClientRect();
        mouse.x = ((event.clientX - rect.left) / rect.width) * 2 - 1;
        mouse.y = -((event.clientY - rect.top) / rect.height) * 2 + 1;
    };

    window.addEventListener('mousemove', onMouseMove);

    // --- Post-Processing ---
    const composer = new EffectComposer(renderer);
    const renderPass = new RenderPass(scene, camera);
    composer.addPass(renderPass);

    const BrightnessContrastShader = {
        uniforms: {
            'tDiffuse': { value: null },
            'brightness': { value: -0.1 },
            'contrast': { value: 1.2 }
        },
        vertexShader: `
            varying vec2 vUv;
            void main() {
                vUv = uv;
                gl_Position = projectionMatrix * modelViewMatrix * vec4(position, 1.0);
            }
        `,
        fragmentShader: `
            uniform sampler2D tDiffuse;
            uniform float brightness;
            uniform float contrast;
            varying vec2 vUv;
            void main() {
                vec4 texel = texture2D(tDiffuse, vUv);
                vec3 color = texel.rgb + brightness;
                color = (color - 0.5) * contrast + 0.5;
                gl_FragColor = vec4(clamp(color, 0.0, 1.0), texel.a);
            }
        `
    };

    const bcPass = new ShaderPass(BrightnessContrastShader);
    composer.addPass(bcPass);

    const gammaPass = new ShaderPass(GammaCorrectionShader);
    composer.addPass(gammaPass);

    renderer.toneMapping = THREE.ACESFilmicToneMapping;
    renderer.toneMappingExposure = 0.8;

    const clock = new THREE.Clock();
    let animationId;
    let isEntered = false;

    function animate() {
        animationId = requestAnimationFrame(animate);
        
        targetCameraRotation.y = -mouse.x * Math.PI; 
        targetCameraRotation.x = 0; 

        camera.rotation.y += (targetCameraRotation.y - camera.rotation.y) * 0.05;
        camera.rotation.x = 0; 

        if (isEntered && options.zoomOnEnter) {
            camera.fov -= (camera.fov - 60) * 0.02;
            camera.updateProjectionMatrix();
        }

        composer.render();
    }

    animate();

    const onResize = () => {
        const width = canvas.clientWidth;
        const height = canvas.clientHeight;
        camera.aspect = width / height;
        camera.updateProjectionMatrix();
        renderer.setSize(width, height);
        composer.setSize(width, height);
    };

    window.addEventListener('resize', onResize);

    return {
        dispose: () => {
            cancelAnimationFrame(animationId);
            window.removeEventListener('mousemove', onMouseMove);
            window.removeEventListener('resize', onResize);
            renderer.dispose();
            scene.clear();
        },
        setEntered: (val) => { isEntered = val; },
        canvas: canvas
    };
}

export function initLoader() {
    const loaderCanvas = document.querySelector('#bg');
    const sceneryCanvas = document.querySelector('#scenery-bg');

    if (loaderCanvas) {
        const loadingOverlay = document.getElementById('loading-overlay');
        const loadingText = document.getElementById('loading-text');
        const loadingBar = document.getElementById('loading-bar');
        const enterBtn = document.getElementById('enter-btn');
        const barContainer = document.getElementById('loading-bar-container');

        const manager = new THREE.LoadingManager();
        manager.onProgress = (url, itemsLoaded, itemsTotal) => {
            const progress = (itemsLoaded / itemsTotal) * 100;
            if (loadingBar) loadingBar.style.width = progress + '%';
            if (loadingText) loadingText.innerText = `Sowing the seeds... ${Math.round(progress)}%`;
        };

        const loader = setup3DScene(loaderCanvas, { 
            manager, 
            zoomOnEnter: true 
        });

        manager.onLoad = () => {
            if (loadingText) loadingText.innerText = "HARVEST READY";
            if (barContainer) {
                barContainer.style.opacity = '0';
                setTimeout(() => {
                    barContainer.classList.add('hidden');
                    if (enterBtn) {
                        enterBtn.classList.remove('hidden');
                        setTimeout(() => enterBtn.classList.add('visible'), 50);
                    }
                }, 500);
            }
        };

        if (enterBtn) {
            enterBtn.addEventListener('click', () => {
                loader.setEntered(true);
                if (loadingOverlay) {
                    loadingOverlay.style.opacity = '0';
                    setTimeout(() => {
                        loadingOverlay.classList.add('hidden');
                    }, 1000);
                }
                if (loaderCanvas) {
                    loaderCanvas.style.transition = 'opacity 1s ease-out';
                    loaderCanvas.style.opacity = '0';
                    setTimeout(() => {
                        loaderCanvas.classList.add('hidden');
                        loader.dispose();
                    }, 1000);
                }
                document.body.classList.remove('loading');
            });
        }
    }

    if (sceneryCanvas) {
        setup3DScene(sceneryCanvas);
    }
}
