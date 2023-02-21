/** @type {import('tailwindcss').Config} */
const typography = require('@tailwindcss/typography')
const aspectRatio = require('@tailwindcss/aspect-ratio')
const forms = require('@tailwindcss/forms')
module.exports = {
    content: [
        "./resources/**/*.blade.php",
        "./resources/**/*.js",
        "./resources/**/*.vue",
    ],
    theme: {
        extend: {},
    },
    plugins: [
        typography,
        aspectRatio,
        forms,
    ],
}
