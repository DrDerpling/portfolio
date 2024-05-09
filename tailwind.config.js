/** @type {import('tailwindcss').Config} */
export default {
    content: [
        "./app/Modules/**/resources/views/**/*.blade.php",
        "./app/Modules/**/*.php",
    ],
    theme: {
        extend: {
            colors: {
                // Background colors for dark and light themes
                background: {
                    dark: {
                        sidebar: '#21242d',
                        main: '#282c35',
                        secondarySidebar: '#1a1d26',
                    },
                    light: {
                        sidebar: '#f0f4f9', // Adjusted to pure white
                        main: '#FFFFFF', // Slightly lighter than before
                        secondarySidebar: '#e4eaf1', // Very light gray
                    }
                },

                // Text colors for dark and light themes
                text: {
                    dark: {
                        inactiveNav: '#8c8e97',
                        activeGroupNav: '#BABBC0',
                        activeNav: '#1fd5ea',
                        codeLine: '#3b3f4a',
                        main: '#FFFFFF',
                    },
                    light: {
                        inactiveNav: '#172940', // More muted dark gray
                        activeGroupNav: '#2E3E53', // Darker gray
                        activeNav: '#3399FF', // Bright blue, matching primary color
                        codeLine: '#afb3b8', // Light gray for code lines
                        main: '#333333', // Dark gray for primary text
                    }
                },
            },
            fontFamily: {
                'sans': ['Roboto', 'sans-serif']
            }
        },
    },
    plugins: [
        require('@tailwindcss/typography'),
    ],
}
