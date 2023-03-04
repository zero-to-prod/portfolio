/** @type {import('tailwindcss').Config} */
const typography = require('@tailwindcss/typography')
const aspectRatio = require('@tailwindcss/aspect-ratio')
const forms = require('@tailwindcss/forms')
const defaultTheme = require('tailwindcss/defaultTheme')

/** @type {import('tailwindcss').Config} */
module.exports = {
    content: [
        './resources/**/*.blade.php',
        './resources/**/*.js',
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
    ],
    theme: {
        fontFamily: {
            'sans':  ['Roboto', 'sans-serif'],
        },
        screens: {
            '2col': '490px',
            '3col': '870px',
            '4col': '1142px',
            '5col': '1978px',
            '6col': '2302px',
            ...defaultTheme.screens,
        }
    },
    plugins: [forms, aspectRatio, typography],
};
