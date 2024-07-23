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
  },
  plugins: [],
}