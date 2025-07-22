module.exports = {
  content: ["./resources/**/*.blade.php", "./resources/**/*.js"], // adjust as needed
  theme: {
    extend: {
      keyframes: {
        slideLTR: {
          '0%, 100%': { transform: 'translateX(0)' },
          '50%': { transform: 'translateX(10px)' },
        },
        slideRTL: {
          '0%, 100%': { transform: 'translateX(0)' },
          '50%': { transform: 'translateX(-10px)' },
        },
        pulseGlow: {
          '0%, 100%': { boxShadow: '0 0 0 rgba(255,165,0,0)' },
          '50%': { boxShadow: '0 0 12px 4px rgba(255,165,0,0.7)' },
        },
      },
      animation: {
        slideLTR: 'slideLTR 1.5s infinite ease-in-out',
        slideRTL: 'slideRTL 1.5s infinite ease-in-out',
        pulseGlow: 'pulseGlow 1.5s infinite',
      },
    },
  },
  plugins: [],
}
