import defaultTheme from 'tailwindcss/defaultTheme';
import forms from '@tailwindcss/forms';

/** @type {import('tailwindcss').Config} */
export default {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
    ],

    theme: {
        extend: {
            colors: {
                forest: '#1C3F2B',
                sage: '#E4EBE5',
                earth: '#8C6A53',
                sunlight: '#FDF9EC',
                gold: '#D4AF37',
                cream: '#F5F5DC',
                emerald: '#065f46',
            },
            fontFamily: {
                sans: ['DM Sans', ...defaultTheme.fontFamily.sans],
                heading: ['Fraunces', 'serif'],
            },
        },
    },

    plugins: [forms],
};
