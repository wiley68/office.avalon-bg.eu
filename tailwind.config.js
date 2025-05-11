import defaultTheme from 'tailwindcss/defaultTheme'
import forms from '@tailwindcss/forms'
import typography from '@tailwindcss/typography'

/** @type {import('tailwindcss').Config} */
export default {
  content: [
    './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
    './vendor/laravel/jetstream/**/*.blade.php',
    './storage/framework/views/*.php',
    './resources/views/**/*.blade.php',
    './resources/js/**/*.vue',
  ],

  theme: {
    extend: {
      fontFamily: {
        sans: ['"Exo 2"', ...defaultTheme.fontFamily.sans],
      },
      colors: {
        customGray: {
          50: '#f7f8fa',
          900: '#27282e',
          800: '#3d3e43',
        },
        customBlue: {
          600: '#087cfa',
        },
      },
    },
  },

  plugins: [forms, typography, require('tailwind-scrollbar')],
}
