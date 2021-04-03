<script>
export default {
  middleware: 'guest',

  data: () => ({
    model: {
      email: ''
    }
  }),

  mounted() {
    const { query } = this.$route

    if (!query || (query && !query.code)) {
      this.$router.push('/404')
    }

    this.$store.dispatch('invitation/validate', { code: query.code })
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

<style lang="scss" module></style>
