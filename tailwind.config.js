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
            fontFamily: {
                sans: ['Poppins', 'Nunito', ...defaultTheme.fontFamily.sans],
            },
            colors: {
                medina: {
                    50: '#f0f9fd',
                    100: '#e0f2fa',
                    200: '#bae6f6',
                    300: '#7dd0f0',
                    400: '#4CBBE4', // Primary Brand Color
                    500: '#26a8d6',
                    600: '#158ab6',
                    700: '#136e93',
                    800: '#145c7a',
                    900: '#164d66',
                    DEFAULT: '#4CBBE4',
                },
                'medina-gray': {
                    DEFAULT: '#8C8C8C',
                    50: '#f9fafb',
                    100: '#f3f4f6',
                    200: '#e5e7eb',
                    300: '#d1d5db',
                    400: '#9ca3af',
                    500: '#8C8C8C', // Secondary Brand Color
                    600: '#6b7280',
                    700: '#4b5563',
                    800: '#374151',
                    900: '#1f2937',
                },
                status: {
                    pending: '#ea580c',
                    'pending-bg': '#ffedd5',
                    process: '#2563eb',
                    'process-bg': '#dbeafe',
                    success: '#059669',
                    'success-bg': '#d1fae5',
                },
            },
            borderRadius: {
                xl: '0.75rem',
                '2xl': '1rem',
            },
        },
    },

    plugins: [forms],
};
