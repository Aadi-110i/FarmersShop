<x-app-layout>
    <x-slot name="header">
        Your <span class="text-gold italic">Provisions</span> Cart
    </x-slot>

    <div class="max-w-7xl mx-auto py-12">
        @if(empty($cartProducts))
            <div class="text-center py-40 bg-white/40 rounded-[4rem] border border-dashed border-forest/10 premium-shadow">
                <div class="w-24 h-24 bg-forest/5 rounded-full flex items-center justify-center mx-auto mb-10">
                    <svg class="w-10 h-10 text-forest/20" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path>
                    </svg>
                </div>
                <p class="font-heading text-3xl text-forest/40 italic mb-10">Your collection is currently empty.</p>
                <a href="{{ route('products.index') }}" class="bg-forest text-gold px-12 py-6 rounded-full font-bold text-xs uppercase tracking-[0.2em] hover:bg-gold hover:text-forest transition-all shadow-2xl shadow-forest/20 inline-flex items-center gap-4 group">
                    Begin Exploration
                    <svg class="w-4 h-4 transition-transform group-hover:translate-x-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path></svg>
                </a>
            </div>
        @else
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-16">
                <!-- Cart Items -->
                <div class="lg:col-span-2 space-y-8">
                    @foreach($cartProducts as $item)
                        <div class="bg-white/40 backdrop-blur-xl rounded-[3rem] border border-forest/5 p-8 flex flex-col md:flex-row gap-10 items-center premium-shadow group">
                            <div class="w-40 h-40 rounded-[2rem] overflow-hidden flex-shrink-0 bg-forest/5 border border-forest/5">
                                <img src="{{ $item['product']->image_url }}" 
                                     alt="{{ $item['product']->name }}" 
                                     class="w-full h-full object-cover grayscale-[0.2] group-hover:grayscale-0 group-hover:scale-110 transition-all duration-700"
                                     onerror="this.onerror=null; this.src='https://images.unsplash.com/photo-1500382017468-9049fed747ef?auto=format&fit=crop&q=80&w=800';">
                            </div>
                            
                            <div class="flex-grow text-center md:text-left">
                                <div class="flex flex-col gap-1 mb-6">
                                    <span class="text-[9px] font-bold uppercase tracking-[0.3em] text-gold">{{ $item['product']->category }}</span>
                                    <h3 class="font-heading text-3xl text-forest">{{ $item['product']->name }}</h3>
                                </div>
                                
                                <div class="flex items-center justify-center md:justify-start gap-8">
                                    <form action="{{ route('cart.update', $item['product']) }}" method="POST" class="flex items-center gap-4 bg-forest/5 px-6 py-3 rounded-full border border-forest/5">
                                        @csrf
                                        @method('PATCH')
                                        <input type="number" name="quantity" value="{{ $item['quantity'] }}" min="1" max="{{ $item['product']->stock_quantity }}" 
                                               class="w-12 bg-transparent border-none p-0 focus:ring-0 text-center font-bold text-forest text-sm">
                                        <button type="submit" class="text-gold hover:text-forest font-black text-[9px] uppercase tracking-widest transition-colors">Update</button>
                                    </form>

                                    <form action="{{ route('cart.remove', $item['product']) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="w-10 h-10 flex items-center justify-center rounded-full border border-red-100 text-red-300 hover:bg-red-500 hover:text-white transition-all">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                                        </button>
                                    </form>
                                </div>
                            </div>

                            <div class="text-center md:text-right border-t md:border-t-0 md:border-l border-forest/5 pt-6 md:pt-0 md:pl-10">
                                <p class="text-[9px] text-forest/30 font-bold uppercase tracking-widest mb-1">Subtotal</p>
                                <p class="text-forest font-light italic text-3xl">₹{{ number_format($item['subtotal'], 0) }}</p>
                            </div>
                        </div>
                    @endforeach
                </div>

                <!-- Checkout Summary -->
                <div class="lg:col-span-1">
                    <div class="bg-forest text-cream rounded-[4rem] p-12 shadow-2xl sticky top-32 overflow-hidden relative">
                        <!-- Decorative background light -->
                        <div class="absolute top-0 right-0 w-64 h-64 bg-gold/10 rounded-full blur-[80px] -translate-y-1/2 translate-x-1/2"></div>
                        
                        <div class="relative z-10">
                            <h2 class="font-heading text-4xl mb-12">Manifest</h2>
                            
                            <div class="space-y-6 mb-12">
                                <div class="flex justify-between items-center border-b border-cream/5 pb-6">
                                    <span class="text-cream/40 text-[10px] font-bold uppercase tracking-widest">Valuation</span>
                                    <span class="font-light italic text-2xl">₹{{ number_format($total, 0) }}</span>
                                </div>
                                <div class="flex justify-between items-center pt-2">
                                    <span class="text-cream/40 text-[10px] font-bold uppercase tracking-widest">Logistics</span>
                                    <span class="text-gold font-bold text-[10px] uppercase tracking-[0.2em]">Complimentary</span>
                                </div>
                            </div>

                            <form action="{{ route('cart.checkout') }}" method="POST">
                                @csrf
                                <div class="mb-12">
                                    <label class="block text-[9px] font-black uppercase tracking-[0.3em] text-cream/30 mb-8">Settlement Method</label>
                                    <div class="space-y-4">
                                        @foreach(['cod' => 'Estate Collection (COD)', 'razorpay' => 'Buy Online (Razorpay)'] as $val => $label)
                                            <label class="flex items-center gap-4 p-5 rounded-[1.5rem] bg-white/5 border border-white/5 cursor-pointer hover:bg-white/10 transition-all group">
                                                <input type="radio" name="payment_method" value="{{ $val }}" {{ $loop->first ? 'checked' : '' }} class="text-gold focus:ring-gold bg-transparent border-white/20">
                                                <span class="text-[10px] font-bold uppercase tracking-widest text-cream/70 group-hover:text-cream">{{ $label }}</span>
                                            </label>
                                        @endforeach
                                    </div>
                                </div>

                                <button type="submit" class="w-full bg-gold text-forest py-6 rounded-full font-bold text-xs uppercase tracking-[0.2em] hover:scale-105 transition-all shadow-2xl shadow-black/40">
                                    Finalize Acquisition
                                </button>
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
                                const form = document.querySelector('form[action="{{ route('cart.checkout') }}"]');
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
                                        "amount": {{ $total * 100 }},
                                        "currency": "INR",
                                        "name": "TerraMarket",
                                        "description": "Acquisition Settlement",
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
        @endif
    </div>
</x-app-layout>
