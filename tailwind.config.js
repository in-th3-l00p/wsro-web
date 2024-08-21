/** @type {import('tailwindcss').Config} */
export default {
    content: [
        "./resources/**/*.blade.php",
        "./resources/**/*.js",
    ],
    theme: {
        extend: {
            colors: {
                "rose-900": "#74102F"
            },
            screens: {
                "xs": "480px",
            }
        },
    },
    plugins: [],
}

