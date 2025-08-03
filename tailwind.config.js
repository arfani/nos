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
                sans: ['Open Sauce One', ...defaultTheme.fontFamily.sans],
            },
        },
    },

    plugins: [
        forms,
        require('daisyui'),
        require('@tailwindcss/typography'),
    ],
    darkMode: 'selector',


    daisyui: {
        themes: [
            {
                nord: {
                    ...require("daisyui/src/theming/themes")["nord"],
                    primary: "#086B35",
                    primaryContent: 'fff'
                }
            },
            'coffee',
            {
                coffee: {
                    ...require('daisyui/src/theming/themes')["coffee"],
                    primary: '#555',
                    secondary: '#fff',
                    'base-content': '#fff',
                }
            }
        ],
        // darkTheme: 'coffee'
    },

    darkMode: 'selector'
};
