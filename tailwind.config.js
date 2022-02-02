const colors = require("tailwindcss/colors");

module.exports = {
  content: [
    './**/*.{php,html}'],
  theme: {
    colors: {
      tcc:{
        darkBlue: '#161F3E',
        orange: '#FF914D',
        emerald: '#4BC493',
        darkEmerald: '#2ba876',
        darkGray: '#404B66',
        lightGray:'#838B9C'
      },
      inherit: colors.inherit,
      current: colors.current,
      transparent: colors.transparent,
      black: colors.black,
      white: colors.white,
      slate: colors.slate,
      gray: colors.gray,
      zinc: colors.zinc,
      neutral: colors.neutral,
      stone: colors.stone,
      red: colors.red,
      orange: colors.orange,
      amber: colors.amber,
      yellow: colors.yellow,
      lime: colors.lime,
      green: colors.green,
      emerald: colors.emerald,
      teal: colors.teal,
      cyan: colors.cyan,
      sky: colors.sky,
      blue: colors.blue,
      indigo: colors.indigo,
      violet: colors.violet,
      purple: colors.purple,
      fuchsia: colors.fuchsia,
      pink: colors.pink,
      rose: colors.rose
    },
    extend: {},
  },
  plugins: [],
}
