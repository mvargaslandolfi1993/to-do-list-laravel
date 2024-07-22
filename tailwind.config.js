/** @type {import('tailwindcss').Config} */
const primeui = require("tailwindcss-primeui");

export default {
    content: [
        "./resources/**/*.blade.php",
        "./resources/**/*.js",
        "./resources/**/*.vue",
    ],
    plugins: [primeui],
};
