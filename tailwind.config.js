const themeColors = {
    primary: {
        lighter: "var(--color-theme-lighter)",
        DEFAULT: "var(--color-theme)",
        darker: "var(--color-theme-darker)",
        darkest: "var(--color-theme-darkest)",
    },
    secondary: {
        DEFAULT: "var(--color-alt)",
        'bottom-bar': "var(--color-alt-bottom-bar)",
    },
    text: {
        primary: {
            lighter: "var(--color-text-lighter)",
            DEFAULT: "var(--color-text)",
            darker: "var(--color-text-darker)",
            darkest: "var(--color-text-darkest)",
            content: "var(--color-text-content)"
        },
        secondary: {
            DEFAULT: "var(--color-text-alt)",
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
