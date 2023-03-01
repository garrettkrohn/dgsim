/** @type {import('tailwindcss').Config} */
module.exports = {
  content: [
    "./index.html",
    "./src/**/*.{js,ts,jsx,tsx}",
  ],
  theme: {
    extend: {
      colors: {
        dgblack: '#1E1E1E',
        dgprimary: '#78290F',
        dgsecondary: '#15616D',
        dgtertiary: '#FF7D00',
        dgbackground: '#001524',
        dgsoftwhite: '#D9D9D9'
      },
      fontFamily: {
        main: ['Montserrat']
      }
    },
  },
  plugins: [],
}