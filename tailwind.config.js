import preset from "./vendor/filament/support/tailwind.config.preset";

export default {
    presets: [preset],
    content: [
        "./app/Filament/**/*.php",
        "./resources/**/*.blade.php",
        "./resources/views/filament/**/*.blade.php",
        "./vendor/filament/**/*.blade.php",
    ],
    theme: {
        extend: {
            fontFamily: {
                sans: ["Manrope", "sans-serif"], // Default sans-serif dengan Manrope
                manrope: ["Manrope", "sans-serif"], // Variabel kustom untuk Manrope
            },
            colors: {
                primary: '#00457F',
                'primary-light': '#0068A6', // Warna primary yang lebih terang
                'primary-dark': '#003351', // Warna primary yang lebih gelap
                'primary-lighter': '#5A8CC9', // Warna primary lebih terang
                'primary-darker': '#002638', // Warna primary lebih gelap
            },
        },
    },
};
