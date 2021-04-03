<script>
import { mapGetters } from 'vuex'

export default {
  layout: 'welcome',

  meta: {
    title: 'HuntBazaar'
  },

  computed: {
    ...mapGetters('auth', ['user'])
  }
}
</script>

<template>
  <div :class="$style.page">
    <div :class="$style.page_content">
      <h1 :class="$style.page_title">
        HuntBazaar
      </h1>
      <RouterLink
        v-if="!user"
        :to="{ name: 'login' }"
        class="btn btn-blue btn-block"
      >
        Masuk
      </RouterLink>
      <RouterLink
        v-else
        :to="{ name: 'home' }"
        class="btn btn-blue btn-block"
      >
        Home
      </RouterLink>
    </div>
  </div>
</template>

<style lang="scss" module>
.page {
  background-color: var(--background-color);
  margin: 0px auto;
  width: 100%;
  height: 100%;
  display: flex;
  align-items: center;

  &_content {
    margin: 0px auto;
    width: 100%;
    max-width: 300px;
    transition: max-width 0.5s ease 0s;
  }

  &_title {
    color: #fff;
    font-size: 2.6rem;
    font-weight: 600;
    text-align: center;
    margin-bottom: 1rem;
  }
}
</style>
