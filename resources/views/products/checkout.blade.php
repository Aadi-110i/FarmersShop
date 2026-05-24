<x-app-layout>
    <x-slot name="header">
        Secure <span class="text-gold italic">Provisions</span>
    </x-slot>

    <div class="container mx-auto px-4 py-12">
        <a href="{{ route('products.show', $product) }}" class="inline-flex items-center gap-2 text-forest/40 hover:text-forest font-bold text-[10px] uppercase tracking-[0.2em] mb-12 transition-colors group">
            <svg class="w-4 h-4 transition-transform group-hover:-translate-x-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path></svg>
            Back to Provision
        </a>

        <div class="max-w-4xl mx-auto">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-12">
                <!-- Order Summary -->
                <div class="bg-forest rounded-[3rem] p-12 text-cream relative overflow-hidden h-fit">
                    <h2 class="text-[10px] font-black uppercase tracking-[0.4em] mb-12 opacity-40">Provision Summary</h2>
                    
                    <div class="flex items-center gap-6 mb-12 pb-12 border-b border-cream/10">
                        @php
                            $image_map = [
                                'grainop' => '/images/products/grainop.png',
                                'grain' => '/images/products/grain.png',
                                'mustard' => '/images/products/mustard.png',
                                'cotton' => '/images/products/cotton.png',
                                'sprayer' => '/images/products/sprayer.png',
                                'seeder' => '/images/products/seeder.png',
                                'rake' => '/images/products/rake.png',
                                'pickaxe' => '/images/products/pickaxe.png',
                                'spade' => '/images/products/sprayer.png',
                            ];

                            $name = strtolower($product->name);
                            $imgSrc = null;
                            foreach ($image_map as $key => $url) {
                                if (str_contains($name, $key)) {
                                    $imgSrc = $url;
                                    break;
                                }
                            }

                            if (!$imgSrc) {
                                $imgSrc = str_starts_with($product->image_url, '/')
                                    ? asset($product->image_url)
                                    : $product->image_url;
                            }
                        @endphp
                        <div class="w-24 h-24 rounded-2xl overflow-hidden border border-cream/20">
                            <img src="{{ $imgSrc }}" class="w-full h-full object-cover" alt="{{ $product->name }}">
                        </div>
                        <div>
                            <p class="font-heading text-2xl text-gold">{{ $product->name }}</p>
                            <p class="text-[10px] uppercase tracking-widest opacity-60 mt-1">{{ $product->category }}</p>
                        </div>
                    </div>

                    <div class="space-y-6 mb-12">
                        <div class="flex justify-between text-[10px] font-bold uppercase tracking-widest">
                            <span class="opacity-40">Unit Price</span>
                            <span>₹{{ number_format($product->price, 2) }}</span>
                        </div>
                        <div class="flex justify-between text-[10px] font-bold uppercase tracking-widest">
                            <span class="opacity-40">Taxes (IGST)</span>
                            <span>₹0.00</span>
                        </div>
                        <div class="flex justify-between text-2xl font-heading mt-6 pt-6 border-t border-cream/10">
                            <span>Total</span>
                            <span class="text-gold">₹{{ number_format($product->price, 2) }}</span>
                        </div>
                    </div>

                    <p class="text-[9px] font-bold uppercase tracking-[0.2em] opacity-30 italic leading-relaxed">
                        * All transactions are encrypted and secured through our local estate ledger.
                    </p>
                </div>

                <!-- Payment Form -->
                <div class="pt-6">
                    <h1 class="font-heading text-4xl text-forest mb-8">Acquisition <span class="text-gold italic">Ledger</span></h1>
                    
                    <form action="{{ route('products.buy', $product) }}" method="POST" class="space-y-8">
                        @csrf
                        <input type="hidden" name="quantity" value="1">
                        
                        <div>
                            <p class="text-[9px] font-black uppercase tracking-[0.3em] text-forest/30 mb-6">Settlement Method</p>
                            
                            <div class="grid grid-cols-1 gap-4">
                                <label class="relative block group cursor-pointer">
                                    <input type="radio" name="payment_method" value="razorpay" class="peer sr-only" checked>
                                    <div class="p-6 rounded-3xl border border-forest/5 bg-forest/5 group-hover:bg-forest/10 transition-all peer-checked:border-gold peer-checked:bg-forest peer-checked:text-cream">
                                        <div class="flex items-center justify-between">
                                            <div class="flex items-center gap-4">
                                                <div class="w-10 h-10 rounded-full bg-gold/10 flex items-center justify-center group-peer-checked:bg-gold/20">
                                                    <svg class="w-5 h-5 text-gold" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z"></path></svg>
                                                </div>
                                                <span class="text-[10px] font-black uppercase tracking-widest">Buy Online (Razorpay)</span>
                                            </div>
                                            <div class="w-4 h-4 rounded-full border-2 border-forest/10 peer-checked:border-gold flex items-center justify-center">
                                                <div class="w-2 h-2 rounded-full bg-gold opacity-0 peer-checked:opacity-100 transition-opacity"></div>
                                            </div>
                                        </div>
                                    </div>
                                </label>

                                <label class="relative block group cursor-pointer">
                                    <input type="radio" name="payment_method" value="Harvest Link" class="peer sr-only">
                                    <div class="p-6 rounded-3xl border border-forest/5 bg-forest/5 group-hover:bg-forest/10 transition-all peer-checked:border-gold peer-checked:bg-forest peer-checked:text-cream">
                                        <div class="flex items-center justify-between">
                                            <div class="flex items-center gap-4">
                                                <div class="w-10 h-10 rounded-full bg-gold/10 flex items-center justify-center">
                                                    <svg class="w-5 h-5 text-gold" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
                                                </div>
                                                <span class="text-[10px] font-black uppercase tracking-widest">Harvest Link (COD)</span>
                                            </div>
                                        </div>
                                    </div>
                                </label>
                            </div>
                        </div>

                        <div class="pt-8">
                            <button type="submit" class="w-full bg-forest text-gold px-12 py-6 rounded-full hover:bg-gold hover:text-forest transition-all shadow-2xl flex items-center justify-center gap-4 group/btn">
                                <span class="text-xs font-bold uppercase tracking-[0.3em]">Confirm Settlement</span>
                                <svg class="w-5 h-5 group-hover/btn:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"></path>
                                </svg>
                            </button>
                        </div>
                    </form>

                    <!-- Premium Glassmorphic Modal Overlay -->
                    <div id="payment-modal" class="fixed inset-0 z-50 flex items-center justify-center p-4 bg-forest/80 backdrop-blur-xl opacity-0 pointer-events-none transition-opacity duration-300">
                        <!-- Modal Card -->
                        <div class="bg-forest border border-gold/30 rounded-[3rem] p-10 max-w-md w-full relative overflow-hidden shadow-2xl transform scale-95 opacity-0 transition-all duration-300" id="modal-card">
                            <!-- Decorative Glow -->
                            <div class="absolute -top-12 -right-12 w-48 h-48 bg-gold/10 rounded-full blur-3xl pointer-events-none"></div>
                            
                            <!-- View 1: Failure / Choice Dialog -->
                            <div id="modal-view-choice" class="space-y-8">
                                <div class="text-center">
                                    <div class="w-16 h-16 bg-gold/10 rounded-full flex items-center justify-center mx-auto mb-6 border border-gold/20">
                                        <svg class="w-8 h-8 text-gold" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path>
                                        </svg>
                                    </div>
                                    <h3 class="font-heading text-3xl text-cream">Settlement <span class="text-gold italic">Interrupted</span></h3>
                                    <p class="text-xs text-cream/60 mt-4 leading-relaxed" id="payment-error-desc">
                                        The Razorpay checkout process was cancelled or encountered a validation issue.
                                    </p>
                                </div>

                                <div class="space-y-4 pt-4">
                                    <button type="button" id="btn-simulate" class="w-full bg-gold text-forest py-5 rounded-full font-bold text-xs uppercase tracking-[0.2em] hover:scale-[1.02] transition-transform shadow-lg shadow-black/20 flex items-center justify-center gap-3">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"></path></svg>
                                        Simulate Settlement (Test Mode)
                                    </button>
                                    
                                    <button type="button" id="btn-retry" class="w-full bg-white/5 border border-white/10 text-cream py-5 rounded-full font-bold text-xs uppercase tracking-[0.2em] hover:bg-white/10 transition-colors flex items-center justify-center gap-3">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 1121.253 8H18"></path></svg>
                                        Retry Payment
                                    </button>

                                    <button type="button" id="btn-cancel-modal" class="w-full text-cream/40 hover:text-cream py-3 font-bold text-[10px] uppercase tracking-[0.2em] transition-colors">
                                        Choose Another Method
                                    </button>
                                </div>
                            </div>

                            <!-- View 2: Simulated Ledger Processing -->
                            <div id="modal-view-processing" class="hidden space-y-8">
                                <div class="text-center">
                                    <h3 class="font-heading text-3xl text-cream">Terra Ledger <span class="text-gold italic">Processing</span></h3>
                                    <p class="text-[10px] text-gold uppercase tracking-[0.3em] font-black mt-2">Cryptographic Settlement</p>
                                </div>

                                <!-- Handshake Logs Terminal -->
                                <div class="bg-black/30 rounded-2xl p-6 font-mono text-[10px] text-cream/80 space-y-3 border border-white/5 min-h-[120px]">
                                    <div id="log-line-1" class="opacity-0 transition-opacity duration-300">&gt; Establishing handshake with Terra Network...</div>
                                    <div id="log-line-2" class="opacity-0 transition-opacity duration-300">&gt; Reserving product allocation in inventory...</div>
                                    <div id="log-line-3" class="opacity-0 transition-opacity duration-300">&gt; Recording secure estate ledger entry...</div>
                                    <div id="log-line-4" class="opacity-0 transition-opacity duration-300 text-gold font-bold">&gt; Cryptographic signature verified. OK.</div>
                                </div>

                                <!-- Spinner / Success checkmark -->
                                <div class="flex justify-center py-4">
                                    <div class="relative w-16 h-16" id="sim-graphic-container">
                                        <!-- Custom Golden Spinner -->
                                        <div class="w-16 h-16 border-4 border-gold/10 border-t-gold rounded-full animate-spin" id="sim-spinner"></div>
                                        
                                        <!-- Animated Checkmark (hidden initially) -->
                                        <div class="absolute inset-0 flex items-center justify-center hidden" id="sim-checkmark">
                                            <svg class="w-16 h-16 text-gold animate-bounce" fill="none" viewBox="0 0 52 52">
                                                <circle class="checkmark__circle" cx="26" cy="26" r="25" fill="none" stroke="currentColor" stroke-width="4" stroke-dasharray="157" stroke-dashoffset="157" style="animation: stroke 0.6s cubic-bezier(0.65, 0, 0.45, 1) forwards; transform-origin: center;"></circle>
                                                <path class="checkmark__check" fill="none" d="M14.1 27.2l7.1 7.2 16.7-16.8" stroke="currentColor" stroke-width="4" stroke-linecap="round" stroke-linejoin="round" stroke-dasharray="48" stroke-dashoffset="48" style="animation: stroke 0.3s cubic-bezier(0.65, 0, 0.45, 1) 0.6s forwards;"></path>
                                            </svg>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <style>
                    @keyframes stroke {
                        100% {
                            stroke-dashoffset: 0;
                        }
                    }
                    </style>

                    <script src="https://checkout.razorpay.com/v1/checkout.js"></script>
                    <script>
                    document.addEventListener('DOMContentLoaded', function() {
                        const form = document.querySelector('form[action="{{ route('products.buy', $product) }}"]');
                        if (!form) return;

                        const modal = document.getElementById('payment-modal');
                        const card = document.getElementById('modal-card');
                        const errorDesc = document.getElementById('payment-error-desc');
                        const btnSimulate = document.getElementById('btn-simulate');
                        const btnRetry = document.getElementById('btn-retry');
                        const btnCancelModal = document.getElementById('btn-cancel-modal');
                        
                        const choiceView = document.getElementById('modal-view-choice');
                        const processingView = document.getElementById('modal-view-processing');
                        const spinner = document.getElementById('sim-spinner');
                        const checkmark = document.getElementById('sim-checkmark');

                        function showModal(errorMsg) {
                            // Ensure views are reset when showing modal
                            choiceView.classList.remove('hidden');
                            processingView.classList.add('hidden');
                            spinner.classList.remove('hidden');
                            checkmark.classList.add('hidden');

                            // Reset logs
                            document.getElementById('log-line-1').classList.add('opacity-0');
                            document.getElementById('log-line-2').classList.add('opacity-0');
                            document.getElementById('log-line-3').classList.add('opacity-0');
                            document.getElementById('log-line-4').classList.add('opacity-0');

                            if (errorMsg) {
                                errorDesc.textContent = "The Razorpay checkout process was interrupted (" + errorMsg + "). For testing or seamless evaluation, you can simulate a successful settlement below.";
                            }
                            modal.classList.remove('opacity-0', 'pointer-events-none');
                            setTimeout(() => {
                                card.classList.remove('scale-95', 'opacity-0');
                            }, 50);
                        }

                        function hideModal() {
                            card.classList.add('scale-95', 'opacity-0');
                            setTimeout(() => {
                                modal.classList.add('opacity-0', 'pointer-events-none');
                            }, 300);
                        }

                        function triggerSimulation() {
                            choiceView.classList.add('hidden');
                            processingView.classList.remove('hidden');

                            const log1 = document.getElementById('log-line-1');
                            const log2 = document.getElementById('log-line-2');
                            const log3 = document.getElementById('log-line-3');
                            const log4 = document.getElementById('log-line-4');

                            setTimeout(() => { log1.classList.remove('opacity-0'); }, 300);
                            setTimeout(() => { log2.classList.remove('opacity-0'); }, 1000);
                            setTimeout(() => { log3.classList.remove('opacity-0'); }, 1700);
                            setTimeout(() => { 
                                log4.classList.remove('opacity-0');
                                spinner.classList.add('hidden');
                                checkmark.classList.remove('hidden');
                            }, 2400);

                            setTimeout(() => {
                                const paymentRadio = form.querySelector('input[name="payment_method"]:checked');
                                const paymentId = document.createElement('input');
                                paymentId.type = 'hidden';
                                paymentId.name = 'razorpay_payment_id';
                                paymentId.value = 'pay_simulated_' + Math.random().toString(36).substr(2, 9);
                                form.appendChild(paymentId);
                                
                                if (paymentRadio) {
                                    paymentRadio.value = 'Buy Online (Simulated)';
                                }
                                form.submit();
                            }, 3700);
                        }

                        let lastRzpInstance = null;

                        function openRazorpay() {
                            const paymentRadio = form.querySelector('input[name="payment_method"]:checked');
                            const options = {
                                "key": "{{ env('RAZORPAY_KEY', 'rzp_test_StMI9YVHUqMplm') }}",
                                "amount": {{ $product->price * 100 }},
                                "currency": "INR",
                                "name": "TerraMarket",
                                "description": "Acquisition Settlement - {{ $product->name }}",
                                "image": "/images/logo.png",
                                "handler": function (response) {
                                    const paymentId = document.createElement('input');
                                    paymentId.type = 'hidden';
                                    paymentId.name = 'razorpay_payment_id';
                                    paymentId.value = response.razorpay_payment_id;
                                    form.appendChild(paymentId);
                                    if (paymentRadio) {
                                        paymentRadio.value = 'Buy Online (Razorpay)';
                                    }
                                    form.submit();
                                },
                                "prefill": {
                                    "name": "{{ auth()->user()->name }}",
                                    "email": "{{ auth()->user()->email }}"
                                },
                                "theme": {
                                    "color": "#1C3F2B"
                                },
                                "modal": {
                                    "ondismiss": function() {
                                        showModal("Cancelled by user");
                                    }
                                }
                            };

                            lastRzpInstance = new Razorpay(options);
                            lastRzpInstance.on('payment.failed', function (response){
                                showModal(response.error.description);
                            });
                            lastRzpInstance.open();
                        }

                        form.addEventListener('submit', function(e) {
                            const paymentRadio = form.querySelector('input[name="payment_method"]:checked');
                            const paymentMethod = paymentRadio ? paymentRadio.value : '';
                            
                            if (paymentMethod === 'razorpay') {
                                e.preventDefault();
                                openRazorpay();
                            }
                        });

                        btnSimulate.addEventListener('click', triggerSimulation);
                        btnRetry.addEventListener('click', function() {
                            hideModal();
                            setTimeout(openRazorpay, 350);
                        });
                        btnCancelModal.addEventListener('click', hideModal);
                    });
                    </script>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
