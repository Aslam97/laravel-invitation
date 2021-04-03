<script>
import { mapGetters } from 'vuex'

export default {
  middleware: 'guest',

  data: () => ({
    model: {
      email: ''
    }
  }),

  computed: {
    ...mapGetters('invitation', ['invitation']),
    ...mapGetters('event', ['event'])
  },

  async mounted() {
    const { query } = this.$route

    if (!query || (query && !query.invitationCode)) {
      this.$router.push('/404')
    }

    await this.$store.dispatch('invitation/validate', {
      code: query.invitationCode
    })

    await this.$store.dispatch('event/show', this.invitation.event_id)
  }
}
</script>

<template>
  <div class="page">
    <ValidationObserver
      ref="formLogin"
      v-slot="{ handleSubmit }"
      tag="div"
      class="container"
    >
      <h3 :class="$style.event_name">
        {{ event.name }}
      </h3>
      <br>
      <form
        class="card"
        autocomplete="off"
        @submit.prevent="handleSubmit(onSubmit)"
      >
        <div class="card-body login">
          <BaseInput
            v-model="model.email"
            rules="required|email"
            name="Alamat Email"
            placeholder="kamu@contoh.com"
            :label="true"
            vid="email"
          />

          <BaseInput
            v-model="model.password"
            rules="required"
            type="password"
            name="Password"
            :label="true"
          />

          <button class="btn btn-blue btn-block btn-md">
            Masuk
          </button>
        </div>
      </form>
    </ValidationObserver>
  </div>
</template>

<style lang="scss" module>
.event_name {
  text-align: center;
}
</style>
