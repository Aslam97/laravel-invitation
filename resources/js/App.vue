<script>
const requireContext = require.context('@layouts', false, /.*\.vue$/)
const layouts = requireContext
  .keys()
  .map(file => [file.replace(/(^.\/)|(\.vue$)/g, ''), requireContext(file)])
  .reduce((components, [name, component]) => {
    components[name] = component.default || component
    return components
  }, {})

export default {
  el: '#app',

  data: () => ({
    layout: null,
    defaultLayout: 'default'
  }),

  meta() {
    const appName = 'HuntStreet'
    return {
      title: appName,
      titleTemplate: `%s - ${appName}`
    }
  },

  methods: {
    setLayout(layout) {
      if (!layout || !layouts[layout]) {
        layout = this.defaultLayout
      }
      this.layout = layouts[layout]
    }
  }
}
</script>

<template>
  <transition
    name="page"
    mode="out-in"
  >
    <component
      :is="layout"
      v-if="layout"
    />
  </transition>
</template>

<style>
@import url('https://fonts.googleapis.com/css?family=Montserrat&display=swap');
@import '~nprogress/nprogress.css';

:root {
  --color-text-title: #000;
  --color-text-default: #494949;
}

html {
  font-size: 16px;
  font-family: 'Montserrat', sans-serif;
  font-weight: 400;
  line-height: 1.4;
  -webkit-text-size-adjust: 100%;
  text-size-adjust: 100%;
  -ms-text-size-adjust: 100%;
  -webkit-text-size-adjust: 100%;
  -webkit-tap-highlight-color: transparent;
  overflow-x: hidden;
}

* {
  box-sizing: border-box;
  margin: 0;
  padding: 0;
}

body {
  -moz-osx-font-smoothing: grayscale;
  -webkit-font-smoothing: antialiased;
  background-color: #f6f6f6;
  color: var(--color-text-default);
}

body,
html {
  height: 100%;
  width: 100%;
}

.fade-enter-active,
.fade-leave-active {
  transition: opacity 0.5s;
}

.fade-enter,
.fade-leave-to {
  opacity: 0;
}
</style>
