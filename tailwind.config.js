/** @type {import('tailwindcss').Config} */

module.exports = {
    content: [
        './resources/**/*.blade.php',
        './resources/**/*.js',
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
    ],
    presets: [require('./tailwind/presets/default.config.cjs')],
};
