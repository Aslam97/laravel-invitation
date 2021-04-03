<script>
import { mapGetters } from 'vuex'

export default {
  computed: {
    ...mapGetters('invitation', ['invitation'])
  },

  mounted() {
    this.$store.dispatch('invitation/show', this.$route.params.id)
  }
}
</script>

<template>
  <div class="page">
    <div class="container">
      <h3 :class="$style.center">
        Registration code:
        <span :class="$style.code">{{ invitation.registration_code }}</span>
      </h3>
    </div>
  </div>
</template>

<style lang="scss" module>
.center {
  text-align: center;
}

.code {
  padding: 0.5rem;
  background-color: var(--color-error);
  color: #fff;
}
</style>
