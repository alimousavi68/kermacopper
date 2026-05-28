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
              DEFAULT: 'var(--color-copper)',
              light: 'var(--color-copper-light)',
              dark: 'var(--color-copper-dark)',
          },
          navy: {
              DEFAULT: 'var(--color-navy)',
              light: 'var(--color-navy-light)',
              dark: 'var(--color-navy-dark)',
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
