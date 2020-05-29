module.exports = {
  purge: [
    './resources/views/**/*.blade.php',
    './resources/css/**/*.css',
    './resources/js/**/*.vue',
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
