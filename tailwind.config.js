const defaultTheme = require('tailwindcss/defaultTheme');

/** @type {import('tailwindcss').Config} */
module.exports = {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
    ],
  daisyui: {
    themes: [
      {
        mytheme: {
        
"primary": "#1dd323",
        
"secondary": "#efb1cd",
        
"accent": "#bc0783",
        
"neutral": "#2E2932",
        
"base-100": "#F9FAFB",
        
"info": "#73C3D9",
        
"success": "#28BD5F",
        
"warning": "#F9D42F",
        
"error": "#F35386",
        },
      },
    ],
  },
  plugins: [require('@tailwindcss/forms'), require("daisyui")],
}