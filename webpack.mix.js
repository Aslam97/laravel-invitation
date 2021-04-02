const mix = require('laravel-mix')
require('laravel-mix-vue-css-modules')
require('laravel-mix-eslint')

mix
  .js('resources/js/app.js', 'public/js')
  .options({ terser: { extractComments: false } })
  .vueCssModules({
    oneOf: true,
    preProcessor: { scss: true }
  })
  .eslint({ fix: true })

mix.inProduction() ? mix.version() : mix.sourceMaps(true, 'source-map')
