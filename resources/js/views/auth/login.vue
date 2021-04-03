<script>
export default {
  meta: {
    title: 'Masuk'
  },

  middleware: 'guest',

  data: () => ({
    model: {
      email: '',
      password: ''
    },
    tryingToLogIn: false
  }),

  methods: {
    async onSubmit() {
      // loading
      this.tryingToLogIn = true

      await this.$store.dispatch('auth/csrfCookie')

      try {
        await this.$store.dispatch('auth/login', this.model)
      } catch (e) {
        const {
          data: { errors }
        } = e

        this.tryingToLogIn = false
        this.$refs.formLogin.setErrors(errors)
      }

      await this.$store.dispatch('auth/fetchUser')
    }
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
      <form
        class="card"
        autocomplete="off"
        @submit.prevent="handleSubmit(onSubmit)"
      >
        <div :class="$style.card_header">
          <h3 :class="$style.card_title">
            Masuk ke HuntBazaar
          </h3>
        </div>
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
.card_header {
  display: flex;
  align-items: center;
  min-height: 3rem;
  padding: 1rem;
  font-size: 0.8rem;
  border-bottom: 1px solid rgba(0, 0, 0, 0.08);
  color: rgba(73, 73, 73, 0.505);
}

.card_title {
  flex: 1 1 0%;
  color: var(--color-text-title);
  font-size: 1.1rem;
  display: flex;
  align-items: center;
  justify-content: center;
}
</style>
