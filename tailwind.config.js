const themeColors = {
    primary: {
        lighter: "var(--color-theme-lighter)",
        DEFAULT: "var(--color-theme)",
        darker: "var(--color-theme-darker)",
        darkest: "var(--color-theme-darkest)"
    },
    secondary: {
        DEFAULT: "var(--color-alt)",
    },
    text: {
        primary: {
            lighter: "var(--color-text-lighter)",
            DEFAULT: "var(--color-text)",
            darker: "var(--color-text-darker)",
            darkest: "var(--color-text-darkest)"
        },
        secondary: {
            DEFAULT: "var(--color-text-alt)"
        },
    },
};

export default {
    content: [
        "./app/Modules/**/resources/views/**/*.blade.php",
        "./app/Modules/**/*.php"
    ],
    theme: {
        extend: {
            textColor: {
                primary: themeColors.text.primary,
                secondary: themeColors.text.secondary
            },
            backgroundColor: {
                primary: themeColors.primary,
                secondary: themeColors.secondary
            },
            borderColor: {
                primary: themeColors.text.primary,
                secondary: themeColors.text.secondary
            },
            colors: {
                primary: themeColors.primary,
                secondary: themeColors.secondary,
                darkest: themeColors.primary.darkest,
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







const oldLight = {
    text: {
        inactiveNav: '#172940', // More muted dark gray
        activeGroupNav: '#2E3E53', // Darker gray
        activeNav: '#3399FF', // Bright blue, matching primary color
        codeLine: '#afb3b8', // Light gray for code lines
        main: '#333333', // Dark gray for primary text
    },
    theme: {
        sidebar: '#f0f4f9', // Adjusted to pure white
        main: '#FFFFFF', // Slightly lighter than before
        secondarySidebar: '#e4eaf1', // Very light gray
    }
}

const oldDark = {
    text: {
        inactiveNav: '#8c8e97',
        activeGroupNav: '#BABBC0',
        activeNav: '#1fd5ea',
        codeLine: '#3b3f4a',
        main: '#FFFFFF',
    },
    theme: {
        sidebar: '#21242d',
        main: '#282c35',
        secondarySidebar: '#1a1d26',
    },
}
