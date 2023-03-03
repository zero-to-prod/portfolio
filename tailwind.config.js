/** @type {import('tailwindcss').Config} */
const typography = require('@tailwindcss/typography')
const aspectRatio = require('@tailwindcss/aspect-ratio')
const forms = require('@tailwindcss/forms')

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
        }
    },
    plugins: [forms, aspectRatio, typography],
};
