import defaultTheme from 'tailwindcss/defaultTheme';
import forms from '@tailwindcss/forms';
import typography from '@tailwindcss/typography';

/** @type {import('tailwindcss').Config} */
export default {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
        './resources/**/*.js',
        './resources/**/*.vue',
    ],

    theme: {
        extend: {
            colors: {
                // Cores espirituais da casa
                oxossi: {
                    light: '#4CAF50',
                    DEFAULT: '#2E7D32',
                    dark: '#1B5E20',
                },
                ogum: {
                    light: '#E53935',
                    DEFAULT: '#C62828',
                    dark: '#B71C1C',
                },
                gold: {
                    DEFAULT: '#D4AF37',
                    light: '#F4D365',
                },
            },
            fontFamily: {
                sans: ['Inter', 'Montserrat', ...defaultTheme.fontFamily.sans],
                body: ['Open Sans', 'Lato', ...defaultTheme.fontFamily.sans],
            },
            boxShadow: {
                'soft': '0 4px 12px rgba(0, 0, 0, 0.08)',
                'medium': '0 4px 16px rgba(0, 0, 0, 0.12)',
                'strong': '0 8px 24px rgba(0, 0, 0, 0.16)',
            },
        },
    },

    plugins: [forms, typography],
};
