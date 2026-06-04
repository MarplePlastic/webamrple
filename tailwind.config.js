/** @type {import('tailwindcss').Config} */
module.exports = {
  content: [
    "./**/*.php",
    "./assets/js/**/*.js",
    "!./node_modules/**/*",
    "!./vendor/**/*",
  ],
  theme: {
    container: {
      center: true,
      padding: "1.25rem",
      screens: {
        "2xl": "1200px",
      },
    },
    extend: {
      colors: {
        // Paleta de marca Marple — azul industrial + acento turquesa "food-grade"
        brand: {
          50: "#eff8fb",
          100: "#d6edf4",
          200: "#b0dbe9",
          300: "#7ac0d8",
          400: "#3d9dbf",
          500: "#2381a4",
          600: "#1c6889",
          700: "#1b5470",
          800: "#1d465c",
          900: "#1c3b4e",
          950: "#0e2533",
        },
        accent: {
          400: "#34d399",
          500: "#10b981",
          600: "#059669",
        },
      },
      fontFamily: {
        sans: ["Inter", "ui-sans-serif", "system-ui", "sans-serif"],
        display: ["'Plus Jakarta Sans'", "Inter", "sans-serif"],
      },
      boxShadow: {
        card: "0 1px 2px rgba(16,37,51,.06), 0 12px 30px -12px rgba(16,37,51,.18)",
        "card-hover": "0 1px 2px rgba(16,37,51,.08), 0 24px 50px -16px rgba(16,37,51,.28)",
      },
      keyframes: {
        "fade-up": {
          "0%": { opacity: "0", transform: "translateY(24px)" },
          "100%": { opacity: "1", transform: "translateY(0)" },
        },
        float: {
          "0%, 100%": { transform: "translateY(0)" },
          "50%": { transform: "translateY(-12px)" },
        },
        marquee: {
          "0%": { transform: "translateX(0)" },
          "100%": { transform: "translateX(-50%)" },
        },
      },
      animation: {
        "fade-up": "fade-up .7s cubic-bezier(.22,1,.36,1) both",
        float: "float 6s ease-in-out infinite",
        marquee: "marquee 30s linear infinite",
      },
    },
  },
  plugins: [],
};
