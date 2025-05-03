import defaultTheme from 'tailwindcss/defaultTheme';
import forms from '@tailwindcss/forms';
import daisyui from 'daisyui';  // Agregar esta línea

/** @type {import('tailwindcss').Config} */
export default {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php', // Asegúrate de que las vistas Blade estén incluidas
        './resources/js/**/*.js', // Asegúrate de incluir tus archivos JS para que Tailwind los procese
        './resources/css/**/*.css', // Asegúrate de incluir tus archivos CSS para que Tailwind los procese
    ],

    theme: {
        extend: {
            fontFamily: {
                sans: ['Figtree', ...defaultTheme.fontFamily.sans],
            },
        },
    },

    plugins: [forms, daisyui], // Agrega daisyui aquí
};
