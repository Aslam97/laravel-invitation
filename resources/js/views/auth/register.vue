<script>
import { mapGetters } from 'vuex'

export default {
  middleware: 'guest',

  data: () => ({
    model: {
      code: '',
      name: '',
      bod: '',
      gender: '',
      favorite_designer: []
    },
    tryToJoin: false,
    genders: [
      { id: 1, label: 'Male', value: 'M' },
      { id: 2, label: 'Female', value: 'F' }
    ],
    designers: [
      { id: 1, label: 'Bagutta' },
      { id: 2, label: 'Balenciaga' },
      { id: 3, label: 'Balmain x Giuseppe Zanotti' }
    ],
    currentCountDown: '',
    expired: false,
    showDOM: false
  }),

  computed: {
    ...mapGetters('invitation', ['invitation']),
    ...mapGetters('event', ['event']),

    countDownDate() {
      return new Date(this.event.expired_at).getTime()
    }
  },

  watch: {
    invitation(value) {
      if (value.registration_code) {
        this.$router.push({
          name: 'invitation.success',
          params: { id: value.id }
        })
      }
    }
  },

  async mounted() {
    const { query } = this.$route

    if (!query || (query && !query.invitationCode)) {
      this.$router.push('/404')
    }

    this.showDOM = true
    this.model.code = query.invitationCode

    await this.$store.dispatch('invitation/validate', {
      code: query.invitationCode
    })

    await this.$store.dispatch('event/show', this.invitation.event_id)

    this.startCountDown()
  },

  methods: {
    async onSubmit() {
      this.tryToJoin = true

      try {
        const { message, data } = await this.$store.dispatch(
          'invitation/join',
          this.model
        )

        this.$notify({
          title: 'Success',
          type: 'success',
          message
        })

        this.$router.push(
          this.$route.query.redirectFrom || {
            name: 'invitation.success',
            params: { id: data.id }
          }
        )
      } catch (e) {
        const {
          data: { errors }
        } = e

        this.tryToJoin = false
        this.$refs.formJoin.setErrors(errors)
      }
    },

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
  <div
    v-show="showDOM"
    class="page"
  >
    <ValidationObserver
      ref="formJoin"
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
              value-format="yyyy-MM-dd"
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
            <label class="form-label">
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

          <ValidationProvider
            v-slot="{ errors }"
            tag="div"
            name="Favorite Designer"
            class="form-group"
            rules="required"
          >
            <label class="form-label">
              Favorite Designer
            </label>
            <ElSelect
              v-model="model.favorite_designer"
              :class="['w-100', { 'is-invalid': errors[0] }]"
              placeholder=""
              multiple
            >
              <ElOption
                v-for="designer in designers"
                :key="designer.id"
                :label="designer.label"
                :value="designer.label"
              />
            </ElSelect>
            <span class="invalid-feedback">{{ errors[0] }}</span>
          </ValidationProvider>

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
