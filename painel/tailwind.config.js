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
        'laranja': {
            'claro': "#FFA919",
            'medio': "#ca6533",
        },
        "verde": "#00A86B",
        "roxo": "#9866fe",
        'azul': {
          'placeholder': "#102b40",
          'fallback': "#393939",
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