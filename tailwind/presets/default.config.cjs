/** @type {import('tailwindcss').Config} */
const typography = require('@tailwindcss/typography')
const aspectRatio = require('@tailwindcss/aspect-ratio')
const forms = require('@tailwindcss/forms')
const defaultTheme = require('tailwindcss/defaultTheme')

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
      'post2col': '1000px',
      ...defaultTheme.screens,
    },
    extend: {
      colors: {
        black: '#010409',
        /* Primary */
        "primary": "var(--primary)",   // Primary color
        'primary-focus': "var(--primary-focus)", // Primary color when focused
        'primary-content': "var(--primary-content)", // Foreground content color to use on primary color
        /* Secondary */
        'secondary': "var(--secondary)", // Secondary color
        'secondary-focus': "var(--secondary-focus)", // Secondary color when focused
        'secondary-content': "var(--secondary-content)", // Foreground content color to use on secondary color
        /* Neutral */
        'neutral': "var(--neutral)", // Neutral color
        'neutral-focus': "var(--neutral-focus)", // Neutral color when focused
        'neutral-content': "var(--neutral-content)", // Will be a readable tone of neutral if not specified
        /* Base */
        'base-100': "var(--base-100)", // Base color of page, used for blank backgrounds
        'base-200': "var(--base-200)", // Base color, a little darker
        'base-300': "var(--base-300)", // Base color, even darker
        'base-content': "var(--base-content)", // Foreground content color to use on base color
        /* Error */
        'error': "var(--error)", // Foreground content color to use on base color
        'error-content': "var(--error-content)" // Foreground content color to use on base color
      },
    }
  },
  plugins: [forms, aspectRatio, typography],
};
