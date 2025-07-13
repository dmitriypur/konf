/** @type {import('tailwindcss').Config} */
export default {
    content: [
        './resources/**/*.blade.php',
        './resources/**/*.js',
        './storage/framework/views/*.php',
    ],
    theme: {
        extend: {
            fontFamily: {
                'primary': ['Montserrat', 'Arial', 'system-ui', 'sans-serif'],
                'secondary': ['SoyuzGrotesk', 'Arial', 'system-ui', 'sans-serif'],
            },
        },
    },
    plugins: [],
    future: {
        hoverOnlyWhenSupported: true,
    },
}
