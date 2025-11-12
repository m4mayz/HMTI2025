// tailwind.config.js

/** @type {import('tailwindcss').Config} */
module.exports = {
    content: ["./*.php", "./**/*.php", "./assets/**/*.js"],

    theme: {
        extend: {
            colors: {
                primary: "#2851cb",
                "primary-dark": "#162b6c",
                secondary: "#c9cc2e",
                "secondary-dark": "#b0b32e",
                "dark-bg": "#222",
            },
            fontFamily: {
                body: ['"Darker Grotesque"', "sans-serif"],
                title: ['"Cormorant Garamond"', "serif"],
            },
        },
    },

    plugins: [require("daisyui"), require("@tailwindcss/line-clamp")],

    daisyui: {
        themes: [
            {
                hmti: {
                    primary: "#2851cb",
                    secondary: "#c9cc2e",
                    accent: "#162b6c",
                    neutral: "#222",
                    "base-100": "#ffffff",
                    info: "#2851cb",
                    success: "#36d399",
                    warning: "#fbbd23",
                    error: "#f87272",
                },
            },
        ],
        base: true,
        styled: true,
        utils: true,
    },
};
