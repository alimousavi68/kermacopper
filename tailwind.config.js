/** @type {import('tailwindcss').Config} */
module.exports = {
  content: [
    './**/*.php',
    './assets/js/**/*.js',
    './etudes/**/*.html'
  ],
  theme: {
    extend: {
      fontFamily: {
          sans: ['PeydaWebVF', 'sans-serif'],
          peyda: ['PeydaWebVF', 'sans-serif'],
      },
      colors: {
          copper: {
              DEFAULT: '#C8682F',
              light: '#E28652',
              dark: '#A65120',
          },
          navy: {
              DEFAULT: '#1A2235',
              light: '#242F48',
              dark: '#0F1522',
          }
      },
      animation: {
          'float': 'float 6s ease-in-out infinite',
          'pulse-slow': 'pulse 4s cubic-bezier(0.4, 0, 0.6, 1) infinite',
      },
      keyframes: {
          float: {
              '0%, 100%': { transform: 'translateY(0)' },
              '50%': { transform: 'translateY(-15px)' },
          }
      }
    },
  },
  plugins: [],
}
