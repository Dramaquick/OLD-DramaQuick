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
                '75': '18.75rem',
                '100': '25rem',
            },
            padding: {
                '45': '11.25rem',
                '50': '12.5rem',
                '90': '22.5rem',
                '100': '25rem',
                '110': '27.5rem',
                '11.25': '2.8125rem',
                '3.5': '0.875rem',
                '10': '2.5rem',
                '20': '5rem',
                '0.75': '2.5rem',
                '5': '1.25rem',
            },
            height: {
                '156': '39rem',
                '12': '3rem',
                '14.5': '3.625rem',
                '7.2': '1.8rem',
                '17': '4.25rem',
                '12': '3rem',
                '7': '1.75rem',
                '80': '20rem',
                '9.6': '2.4rem',
                '200': '50rem',
                '184': '46rem',
                '25%': '25%',
            },
            borderRadius: {
                '2.5xl': '1.25rem',
                '2.5l': '0.625rem',
                '30%': '30%',
                '50%': '50%',
                '10px': '10px',
                '62px': '62px',
            },
            width: {
                '144': '36rem',
                '142': '35.5rem',
                '120': '30rem',
                '7.2': '1.8rem',
                '12': '3rem',
                '7': '1.75rem',
                '140': '35rem',
                '9.6': '2.4rem',
                '14': '3.5rem',
                '20': '5rem',
                '25%': '25%',
            },
            colors: {
                'whitegray': '#666666',
                'vert-drama': '#34FFAD',
                'vert-pale': '#DEEEE7',
                'white-gray': '#cdd4d1',
            },
            borderWidth: {
                DEFAULT: '1px',
                '0': '0',
                '2': '2px',
                '3': '3px',
                '4': '4px',
                '6': '6px',
                '8': '8px',
            },
              backgroundSize: {
                '5.6': '1.4rem',
            },
            boxShadow: {
                '3xl': '0 35px 60px -15px rgba(0, 0, 0, 0.3)',
                '2px': '0 0 0 2px #00E589',
              },
        },
    },

    plugins: [require('@tailwindcss/forms')],
};
