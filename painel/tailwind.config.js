/** @type {import('tailwindcss').Config} */
export default {
  content: [
    "./index.html",
    "./src/**/*.{js,ts,jsx,tsx}",
  ],
  theme: {
    extend: {
      'colors': {
        'aurora': "#FFF6E6",
        'creme': "#FFE8BF",
        'laranja': "#FFA919",
        'azul': {
          'escuro': "#00061A",
          'medio': "#002080",
          'claro': "#0091FF",
        }
      }
    },
    fontFamily: {
      'averta': ['Averta', 'sans-serif'],
    },
    backgroundImage: {
      "login": "url(https://blogger.googleusercontent.com/img/b/R29vZ2xl/AVvXsEiNMQ_uFov02kHtojFe5HDG8thj5c7LX6ahL2Zps5zEdUYpF6blND0UloZCbAJ0ObN0ppclrjaAR2jaEFnPl9PKwaI0lRdvFu-LdMv8rwZ1ppmqCQ2JJv3-QieM0a5kVSI1XLRcSJz5dnMf/w4096-h2304-c/anime-scenery-bubbles-45-4K.jpg)"
    }
  },
  plugins: [],
}