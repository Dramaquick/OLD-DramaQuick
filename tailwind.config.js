const defaultTheme = require('tailwindcss/defaultTheme');

/** @type {import('tailwindcss').Config} */
module.exports = {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
        './resources/js/**/*.svelte',
        './resources/js/**/*.js',
    ],

    corePlugins: {
        outline: false
    },

    theme: {
        extend: {
            fontFamily: {
                sans: ['Poppins', ...defaultTheme.fontFamily.sans],
            },
            spacing: {
                '128': '32rem',
                '144': '36rem',
                '160': '40rem',
                '176': '44rem',
                '11.25': '2.8125rem',
            },
            padding: {
                '45': '11.25rem',
                '50': '12.5rem',
                '90': '22.5rem',
                '100': '25rem',
                '110': '27.5rem',
                '11.25': '2.8125rem',
            },
            height: {
                '156': '39rem',
                '12': '3rem',
            },
            borderRadius: {
                '2.5xl': '1.25rem',
            },
            width: {
                '144': '36rem',
                '120': '30rem',
            },
            colors: {
                'whitegray': '#666666',
                'vert-drama': '#34FFAD',
            }
        },
    },

    plugins: [require('@tailwindcss/forms')],
};
