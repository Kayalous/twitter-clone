module.exports = {
  purge: [
    './resources/views/**/*.blade.php',
    './resources/css/**/*.css',
  ],
  theme: {
    extend: {}
  },
    variants: {
        backgroundColor: ['responsive', 'hover', 'focus', 'active', 'group-hover'],
        backgroundOpacity: ['responsive', 'hover', 'focus', 'active', 'group-hover'],
    },
  plugins: [
    require('@tailwindcss/custom-forms')
  ]
}
