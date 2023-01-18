/** @type {import('tailwindcss').Config} */
module.exports = {
  content: [
    // './resources/**/*.blade.php',
    './src/**/*.ts',
    './src/**/*.vue',
    "./src/**/*.{vue,js,ts,jsx,tsx,php}",
    './templates/**/*.html',
    './parts/**/*.html',
  ],
  theme: {
    extend: {},
  },
  plugins: [],
}