<script>
import { mapGetters } from 'vuex'

export default {
  middleware: 'auth',

  data: () => ({
    model: {
      event_id: '',
      email: ''
    },
    tryToSubmit: false
  }),

  computed: {
    ...mapGetters('event', ['event'])
  },

  mounted() {
    this.model.event_id = this.$route.params.id
    this.$store.dispatch('event/show', this.$route.params.id)
  },

  methods: {
    async onSubmit() {
      this.tryToSubmit = true

      try {
        await this.$store.dispatch('invitation/store', this.model)
      } catch (e) {
        const {
          data: { errors }
        } = e

        this.tryToSubmit = false
        this.$refs.formInvitation.setErrors(errors)
      }
    }
  }
}
</script>

<template>
  <div class="page">
    <ValidationObserver
      ref="formInvitation"
      v-slot="{ handleSubmit }"
      class="container"
    >
      <h3>Event Name</h3>
      <br>
      <code>
        {{ JSON.stringify(event, undefined, 2) }}
      </code>

      <div><br></div>

      <h3>Send Invitations</h3>
      <br>
      <form
        class="card"
        autocomplete="off"
        @submit.prevent="handleSubmit(onSubmit)"
      >
        <div class="card-body">
          <BaseInput
            v-model="model.email"
            name="Email"
            rules="required|email"
            :label="true"
          />

          <button class="btn btn-blue btn-block btn-md">
            Send Invitations
          </button>
        </div>
      </form>
    </ValidationObserver>
  </div>
</template>
