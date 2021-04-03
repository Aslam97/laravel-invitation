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
    this.initEvent()
  },

  methods: {
    async onSubmit() {
      this.tryToSubmit = true

      try {
        const { message } = await this.$store.dispatch(
          'invitation/store',
          this.model
        )

        this.model.email = ''
        this.$refs.formInvitation.reset()

        this.$notify({
          title: 'Success',
          type: 'success',
          message
        })

        this.initEvent()
      } catch (e) {
        const {
          data: { errors }
        } = e

        this.tryToSubmit = false
        this.$refs.formInvitation.setErrors(errors)
      }
    },

    initEvent() {
      this.$store.dispatch('event/show', this.$route.params.id)
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
      <h3>Event</h3>
      <br>
      <ul>
        <li>Name: {{ event.name }}</li>
        <li>Expired: {{ event.expired_at }}</li>
      </ul>

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
            vid="email"
          />

          <button class="btn btn-blue btn-block btn-md">
            Send Invitations
          </button>
        </div>
      </form>
      <br>

      <h3>Invitations</h3>
      <br>
      <ul v-if="event.invitations.length">
        <li
          v-for="invitation in event.invitations"
          :key="invitation.id"
        >
          <div>Email: {{ invitation.email }}</div>
          <div>
            Status: {{ invitation.registration_code ? 'Success' : 'Pending' }}
          </div>
        </li>
      </ul>
      <div v-else>
        No Result
      </div>
    </ValidationObserver>
  </div>
</template>
