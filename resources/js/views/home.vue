<script>
import { mapGetters } from 'vuex'

export default {
  middleware: 'auth',

  computed: {
    ...mapGetters('auth', ['user']),
    ...mapGetters('event', ['events'])
  },

  mounted() {
    this.$store.dispatch('event/index')
  }
}
</script>

<template>
  <div v-if="user.is_admin">
    This is admin
    <ul>
      <li
        v-for="event in events"
        :key="event.id"
      >
        <RouterLink :to="{ name: 'events', params: { id: event.id } }">
          {{ event.name }}
        </RouterLink>
      </li>
    </ul>
  </div>
  <div v-else>
    This is User
  </div>
</template>
