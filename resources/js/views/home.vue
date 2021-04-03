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
  },

  methods: {
    async logout() {
      await this.$store.dispatch('auth/logout')
      this.$router.push({ name: 'login' })
    }
  }
}
</script>

<template>
  <div class="page">
    <div class="container">
      <h3>List Events</h3>
      <br>

      <div class="card">
        <div class="card-body">
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
      </div>

      <br>
      <a
        href="#"
        class="btn btn-blue btn-block btn-md"
        @click.prevent="logout"
      >
        Logout
      </a>
    </div>
  </div>
</template>
