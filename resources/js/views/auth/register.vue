<script>
import { mapGetters } from 'vuex'

export default {
  middleware: 'guest',

  data: () => ({
    model: {
      name: '',
      bod: '',
      gender: '',
      favorite_designer: []
    },
    genders: [
      { id: 1, label: 'Male', value: 'M' },
      { id: 2, label: 'Female', value: 'F' }
    ],
    currentCountDown: '',
    expired: false
  }),

  computed: {
    ...mapGetters('invitation', ['invitation']),
    ...mapGetters('event', ['event']),

    countDownDate() {
      return new Date(this.event.expired_at).getTime()
    }
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

    this.startCountDown()
  },

  methods: {
    startCountDown() {
      let timer = setInterval(() => {
        const now = new Date().getTime()
        const distance = this.countDownDate - now

        const days = Math.floor(distance / (1000 * 60 * 60 * 24))
        const hours = Math.floor(
          (distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60)
        )
        const minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60))
        const seconds = Math.floor((distance % (1000 * 60)) / 1000)

        this.currentCountDown =
          days + 'd ' + hours + 'h ' + minutes + 'm ' + seconds + 's '

        // If the count down is over, write some text
        if (distance < 0) {
          clearInterval(timer)
          this.expired = true
        }
      }, 1000)
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
      <h3 :class="$style.event_name">
        {{ event.name }}
      </h3>
      <h4 :class="$style.event_name">
        {{ currentCountDown }}
      </h4>
      <br>
      <form
        class="card"
        autocomplete="off"
        @submit.prevent="handleSubmit(onSubmit)"
      >
        <div class="card-body login">
          <BaseInput
            v-model="invitation.email"
            rules="required|email"
            :disabled="true"
            name="Alamat Email"
            placeholder="kamu@contoh.com"
            :label="true"
            vid="email"
          />

          <BaseInput
            v-model="model.name"
            rules="required"
            type="text"
            name="Name"
            :label="true"
            vid="name"
          />

          <ValidationProvider
            v-slot="{ errors }"
            tag="div"
            name="Birth of Date"
            class="form-group"
            rules="required"
          >
            <label class="form-label">
              Birth of Date
            </label>
            <ElDatePicker
              v-model="model.bod"
              type="date"
              placeholder=""
              format="dd MMM yyyy"
              value="yyyy-MM-dd"
              :class="['w-100', { 'is-invalid': errors[0] }]"
            />
            <span class="invalid-feedback">{{ errors[0] }}</span>
          </ValidationProvider>

          <ValidationProvider
            v-slot="{ errors }"
            tag="div"
            name="Gender"
            class="form-group"
            rules="required"
          >
            <label
              for="Nama stan"
              class="form-label"
            >
              Gender
            </label>
            <ElSelect
              v-model="model.gender"
              :class="['w-100', { 'is-invalid': errors[0] }]"
              placeholder=""
            >
              <ElOption
                v-for="gender in genders"
                :key="gender.id"
                :label="gender.label"
                :value="gender.value"
              />
            </ElSelect>
            <span class="invalid-feedback">{{ errors[0] }}</span>
          </ValidationProvider>

          <BaseInput
            v-model="model.password"
            rules="required"
            type="password"
            name="Password"
            :label="true"
          />

          <button class="btn btn-blue btn-block btn-md">
            Join
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
