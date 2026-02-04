import defaultTheme from 'tailwindcss/defaultTheme';
import forms from '@tailwindcss/forms';

/** @type {import('tailwindcss').Config} */
export default {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
    ],

    // 👇 ADD THIS SECTION TO FORCE YOUR COLORS TO STAY 👇
    safelist: [
        'bg-green-500',
        'bg-red-500',
        'bg-blue-600',
        'bg-gray-200',
        'translate-x-5',
        'translate-x-0',
    ],

    theme: {
        extend: {
            fontFamily: {
                sans: ['Figtree', ...defaultTheme.fontFamily.sans],
            },
        },
    },

    plugins: [forms],
};