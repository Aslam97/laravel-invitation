<script>
export default {
  meta: {
    title: '404',
    meta: [{ name: 'description', content: '404' }]
  },

  props: {
    resource: {
      type: String,
      default: ''
    }
  }
}
</script>

<template>
  <div class="page">
    <div class="contianer">
      <h1 :class="$style.title">
        404
        <template v-if="resource">
          {{ resource }}
        </template>
        Not Found
      </h1>
    </div>
  </div>
</template>

<style lang="scss" module>
.title {
  text-align: center;
}
</style>
