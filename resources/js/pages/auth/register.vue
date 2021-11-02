<template>
  <div class="row register-page">
    <div class="col-lg-7 m-auto">
      <card v-if="mustVerifyEmail" :title="$t('register')">
        <div class="alert alert-success" role="alert">
          {{ $t('verify_email_address') }}
        </div>
      </card>
      <card v-else :title="$t('register')">
        <form @submit.prevent="register" @keydown="form.onKeydown($event)">
          <!-- Name -->
          <div class="mb-3 row">
            <label class="col-md-3 col-form-label text-md-end"><img :src="asset('images/registration/user.svg')" alt="username">  {{ $t('name') }}</label>
            <div class="col-md-7">
              <input v-model="form.username" :class="{ 'is-invalid': form.errors.has('username') }" class="form-control" type="text" name="username" required>
              <has-error :form="form" field="username" />
            </div>
          </div>

          <!-- Email -->
          <div class="mb-3 row">
            <label class="col-md-3 col-form-label text-md-end"><img :src="asset('images/registration/user.svg')" alt="email">  {{ $t('email') }}</label>
            <div class="col-md-7">
              <input v-model="form.email" :class="{ 'is-invalid': form.errors.has('email') }" class="form-control" type="email" name="email" required>
              <has-error :form="form" field="email" />
            </div>
          </div>

          <!-- Phone -->
          <div class="mb-3 row">
            <label class="col-md-3 col-form-label text-md-end"><img :src="asset('images/registration/phone.svg')" alt="phone">  {{ $t('Phone') }}</label>
            <div class="col-md-7">
              <input v-model="form.phone" :class="{ 'is-invalid': form.errors.has('phone') }" class="form-control" name="phone" required>
              <has-error :form="form" field="phone" />
            </div>
          </div>

          <!-- Password -->
          <div class="mb-3 row">
            <label class="col-md-3 col-form-label text-md-end"><img :src="asset('images/registration/lock.svg')" alt="password">  {{ $t('password') }}</label>
            <div class="col-md-7">
              <input v-model="form.password" :class="{ 'is-invalid': form.errors.has('password') }" class="form-control" type="password" name="password" required>
              <has-error :form="form" field="password" />
            </div>
          </div>

          <!-- Password Confirmation -->
          <div class="mb-3 row">
            <label class="col-md-3 col-form-label text-md-end"><img :src="asset('images/registration/lock.svg')" alt="password confirmation">  {{ $t('confirm_password') }}</label>
            <div class="col-md-7">
              <input v-model="form.password_confirmation" :class="{ 'is-invalid': form.errors.has('password_confirmation') }" class="form-control" type="password" name="password_confirmation" required>
              <has-error :form="form" field="password_confirmation" />
            </div>
          </div>
          <!-- Login -->
          <div class="mb-3 row">
            <div class="col-md-3" />
            <div class="col-md-7 d-flex">
              <router-link :to="{ name: 'login' }" class="small mr-auto my-auto">
                {{ $t('Already have an account? Login') }}
              </router-link>
            </div>
          </div>

          <div class="mb-3 row">
            <div class="col-md-12 d-flex">
              <!-- Submit Button -->
              <v-button type="submit" :loading="form.busy" class="btn-brand m-auto w-4">
                {{ $t('register your account') }}
              </v-button>
            </div>
          </div>
        </form>
      </card>
    </div>
  </div>
</template>

<script>
import Form from 'vform'

export default {
  components: {},

  middleware: 'guest',

  metaInfo () {
    return { title: this.$t('register') }
  },

  data: () => ({
    form: new Form({
      username: '',
      email: '',
      phone: '',
      password: '',
      password_confirmation: ''
    }),
    mustVerifyEmail: false
  }),

  methods: {
    async register () {
      // Register the user.
      const { data } = await this.form.post('/api/registration')
      if (data.error == 1) {
        return alert(data.message)
      }
      const user = data.data;
      // Must verify email fist.
      // if (data.status) {
      //   this.mustVerifyEmail = true
      // } else {
        // Log in the user.
        // const { data: { token } } = await this.form.post('/api/app_login')
        const token = user.token;
        // Save the token.
        this.$store.dispatch('auth/saveToken', { token })

        // Update the user.
        await this.$store.dispatch('auth/updateUser', { user: user })

        // Redirect home.
        this.$router.push({ name: 'welcome' })
      // }
    }
  }
}
</script>
<style scoped>
.register-page {
    margin-top: 5%;
    margin-bottom: 5%;
  }
  </style>