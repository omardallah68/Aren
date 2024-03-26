import defaultTheme from 'tailwindcss/defaultTheme';
import forms from '@tailwindcss/forms';
import typography from '@tailwindcss/typography';

/** @type {import('tailwindcss').Config} */
export default {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './vendor/laravel/jetstream/**/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
        './resources/js/**/*.vue',
    ],

    theme: {
        extend: {
            fontFamily: {
                sans: ['Figtree', ...defaultTheme.fontFamily.sans],
            },
            keyframes: {
                wave: {
                    '0%': { transform: 'rotate(-2deg)' },
                    '50%': { transform: 'rotate(2deg)' },
                    '100%': { transform: 'rotate(-2deg)' },
                },
            },
            animation: {
                'waving': 'wave 5s ease-in-out infinite',
                'wavi': 'wave 3s ease-in-out infinite',
            },
        },
    },

    plugins: [forms, typography],
};
