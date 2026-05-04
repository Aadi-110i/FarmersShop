import * as THREE from 'three';
import { EffectComposer } from 'three/addons/postprocessing/EffectComposer.js';
import { RenderPass } from 'three/addons/postprocessing/RenderPass.js';
import { GlitchPass } from 'three/addons/postprocessing/GlitchPass.js';
import { ShaderPass } from 'three/addons/postprocessing/ShaderPass.js';
import { GammaCorrectionShader } from 'three/addons/shaders/GammaCorrectionShader.js';

// --- Initialization ---
const canvas = document.querySelector('#bg');
const scene = new THREE.Scene();
const camera = new THREE.PerspectiveCamera(75, window.innerWidth / window.innerHeight, 0.1, 1000);
const renderer = new THREE.WebGLRenderer({
  canvas: canvas,
  antialias: true,
  alpha: true
});

renderer.setSize(window.innerWidth, window.innerHeight);
renderer.setPixelRatio(Math.min(window.devicePixelRatio, 2));
renderer.outputColorSpace = THREE.SRGBColorSpace;

camera.position.z = 15;

// --- Loading Manager ---
// --- Loading Manager ---
const loadingOverlay = document.getElementById('loading-overlay');
const loadingText = document.getElementById('loading-text');
const loadingBar = document.getElementById('loading-bar');
const enterBtn = document.getElementById('enter-btn');
const mainContent = document.getElementById('main-content');
const barContainer = document.getElementById('loading-bar-container');

let isEntered = false;

const manager = new THREE.LoadingManager();
manager.onProgress = (url, itemsLoaded, itemsTotal) => {
  const progress = (itemsLoaded / itemsTotal) * 100;
  loadingBar.style.width = progress + '%';
  loadingText.innerText = `Sowing the seeds... ${Math.round(progress)}%`;
};

manager.onLoad = () => {
  // Assets are loaded, show the Enter button
  loadingText.innerText = "HARVEST READY";
  barContainer.style.opacity = '0';
  setTimeout(() => {
    barContainer.classList.add('hidden');
    enterBtn.classList.remove('hidden');
    setTimeout(() => enterBtn.classList.add('visible'), 50);
  }, 500);
};

enterBtn.addEventListener('click', () => {
  isEntered = true;
  loadingOverlay.classList.add('hidden');
  
  // Reveal the actual website content
  setTimeout(() => {
    mainContent.classList.remove('hidden');
    setTimeout(() => mainContent.classList.add('visible'), 100);
  }, 500);
});

// --- Textures ---
const textureLoader = new THREE.TextureLoader(manager);
const imageTexture = textureLoader.load('/moqshss4.png');
imageTexture.mapping = THREE.EquirectangularReflectionMapping;

scene.background = imageTexture;
scene.environment = imageTexture;

// --- Geometry & Mesh ---
// Removed center objects as per request

// --- Lights ---
// Removed lights as there are no objects to light

// --- Mouse Interaction ---
const mouse = new THREE.Vector2();
const targetCameraRotation = new THREE.Euler();

window.addEventListener('mousemove', (event) => {
  mouse.x = (event.clientX / window.innerWidth) * 2 - 1;
  mouse.y = -(event.clientY / window.innerHeight) * 2 + 1;
});

// --- Post-Processing ---
const composer = new EffectComposer(renderer);
const renderPass = new RenderPass(scene, camera);
composer.addPass(renderPass);

// Custom Brightness/Contrast Shader to address "lighter" and "low contrast" issues
const BrightnessContrastShader = {
  uniforms: {
    'tDiffuse': { value: null },
    'brightness': { value: -0.1 }, // Slightly darker
    'contrast': { value: 1.2 }     // Reduced contrast
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

// Adjust Renderer Exposure for darker look
renderer.toneMapping = THREE.ACESFilmicToneMapping;
renderer.toneMappingExposure = 0.8;

// --- Animation Loop ---
const clock = new THREE.Clock();

function animate() {
  const elapsedTime = clock.getElapsedTime();

  // Mouse interactivity: rotate camera horizontally to look around the environment
  targetCameraRotation.y = -mouse.x * Math.PI; 
  targetCameraRotation.x = 0; 

  camera.rotation.y += (targetCameraRotation.y - camera.rotation.y) * 0.05;
  camera.rotation.x = 0; 

  // Zoom-in effect when user enters
  if (isEntered) {
    camera.fov -= (camera.fov - 60) * 0.02; // Zoom in slightly
    camera.updateProjectionMatrix();
  }

  composer.render();
  requestAnimationFrame(animate);
}

animate();

// --- Handle Resize ---
window.addEventListener('resize', () => {
  camera.aspect = window.innerWidth / window.innerHeight;
  camera.updateProjectionMatrix();
  renderer.setSize(window.innerWidth, window.innerHeight);
  composer.setSize(window.innerWidth, window.innerHeight);
});
