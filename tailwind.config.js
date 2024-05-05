/** @type {import('tailwindcss').Config} */
export default {
    content: [
        "./app/Modules/**/resources/views/**/*.blade.php",
        "./app/Modules/**/*.php",
        ],
        theme: {
            extend: {
                colors: {
                    'dark-navy': '#21242d',
                    'cool-gray-500': '#8c8e97',
                    'cool-gray-400': '#BABBC0',
                    'deep-gray': '#282c35',
                    'charcoal': '#1a1d26',
                    'slate': '#3b3f4a',
                    'bright-cyan': '#1fd5ea',
                },
                fontFamily: {
                    'sans': ['Roboto', 'sans-serif'] // Make sure 'Roboto' is the first in the list
                }
            },
    },
    plugins: [],
    }
