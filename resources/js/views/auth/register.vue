<script>
export default {
  middleware: 'auth',

  mounted() {
    const { query } = this.$route.query
    console.log(query)
  }
}
</script>

<template>
  <div>
    this is register
  </div>
</template>

<style lang="scss" module></style>
