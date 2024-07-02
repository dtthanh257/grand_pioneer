/** @type {import('tailwindcss').Config} */
module.exports = {
  content: ["./index.html", "./src/**/*.{vue,js,ts,jsx,tsx}"],
  theme: {
    extend: {
      colors: {
        "blue-color": "#15395a",
        "yellow-color": "#e4b587",
        "white-color": "#ffffff",
      },
    },
    maxHeight: {
      "screen-menu": "calc(100vh - 3.5rem)",
      modal: "calc(100vh - 160px)",
    },
  },
  plugins: [],
};
