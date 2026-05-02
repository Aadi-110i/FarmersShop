<x-app-layout>
    <x-slot name="header">
        List New Product
    </x-slot>

    <div class="max-w-3xl">
        <div class="bg-white p-10 rounded-[2.5rem] border border-[var(--sage-green)] shadow-xl shadow-[var(--forest-green)]/5">
            <form method="POST" action="{{ route('products.store') }}">
                @csrf

                <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                    <!-- Name -->
                    <div class="md:col-span-2">
                        <x-input-label for="name" :value="__('Product Name')" class="text-xs font-bold uppercase tracking-wider text-gray-500" />
                        <x-text-input id="name" class="block mt-1 w-full bg-[var(--sage-green)]/20 border-[var(--sage-green)] focus:ring-[var(--forest-green)] focus:border-[var(--forest-green)] rounded-2xl" type="text" name="name" :value="old('name')" required autofocus />
                        <x-input-error :messages="$errors->get('name')" class="mt-2" />
                    </div>

                    <!-- Category -->
                    <div>
                        <x-input-label for="category" :value="__('Category')" class="text-xs font-bold uppercase tracking-wider text-gray-500" />
                        <select id="category" name="category" class="block mt-1 w-full bg-[var(--sage-green)]/20 border-[var(--sage-green)] focus:ring-[var(--forest-green)] focus:border-[var(--forest-green)] rounded-2xl py-2.5 text-sm font-medium">
                            <option value="seeds">Seeds</option>
                            <option value="fertilizers">Fertilizers</option>
                            <option value="tools">Tools</option>
                        </select>
                        <x-input-error :messages="$errors->get('category')" class="mt-2" />
                    </div>

                    <!-- Price -->
                    <div>
                        <x-input-label for="price" :value="__('Price ($)')" class="text-xs font-bold uppercase tracking-wider text-gray-500" />
                        <x-text-input id="price" class="block mt-1 w-full bg-[var(--sage-green)]/20 border-[var(--sage-green)] focus:ring-[var(--forest-green)] focus:border-[var(--forest-green)] rounded-2xl" type="number" step="0.01" name="price" :value="old('price')" required />
                        <x-input-error :messages="$errors->get('price')" class="mt-2" />
                    </div>

                    <!-- Stock -->
                    <div>
                        <x-input-label for="stock_quantity" :value="__('Stock Quantity')" class="text-xs font-bold uppercase tracking-wider text-gray-500" />
                        <x-text-input id="stock_quantity" class="block mt-1 w-full bg-[var(--sage-green)]/20 border-[var(--sage-green)] focus:ring-[var(--forest-green)] focus:border-[var(--forest-green)] rounded-2xl" type="number" name="stock_quantity" :value="old('stock_quantity')" required />
                        <x-input-error :messages="$errors->get('stock_quantity')" class="mt-2" />
                    </div>

                    <!-- Description -->
                    <div class="md:col-span-2">
                        <x-input-label for="description" :value="__('Detailed Description')" class="text-xs font-bold uppercase tracking-wider text-gray-500" />
                        <textarea id="description" name="description" rows="4" class="block mt-1 w-full bg-[var(--sage-green)]/20 border-[var(--sage-green)] focus:ring-[var(--forest-green)] focus:border-[var(--forest-green)] rounded-2xl text-sm">{{ old('description') }}</textarea>
                        <x-input-error :messages="$errors->get('description')" class="mt-2" />
                    </div>
                </div>

                <div class="mt-10 flex justify-end">
                    <x-primary-button>
                        {{ __('List Product') }}
                    </x-primary-button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
