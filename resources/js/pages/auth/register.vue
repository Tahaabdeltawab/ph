<template>
  <div class="row">
    <div class="registration-img m-auto p-relative col-lg-7" style="width:56.4%; height:400px;">
      <img :src="asset('images/registration/travel-image@2x.png')" class="full-width full-height">
      <div class="center">
      <img :src="asset('images/registration/white-logo.svg')">
      <p class="mt-2 mr-2 text-custom-white">{{$t('Creating account')}}</p>
      </div>

    </div>
    <div class="col-lg-7 m-auto">
      <card v-if="mustVerifyEmail" :title="$t('register')">
        <div class="alert alert-success" role="alert">
          {{ $t('verify_email_address') }}
        </div>
      </card>
      <card v-else >
        <form @submit.prevent="register" @keydown="form.onKeydown($event)" class="registration-form">
          <!-- Name -->
          <div class="mb-3 row">
            <label class="pull-md-1 col-md-3 col-form-label text-md-end"><img :src="asset('images/registration/user.svg')" alt="username">  {{ $t('name') }}</label>
            <div class="col-md-10 m-auto">
              <input v-model="form.username" :class="{ 'is-invalid': form.errors.has('username') }" class="form-control" type="text" name="username" required>
              <has-error :form="form" field="username" />
            </div>
          </div>

          <!-- Email -->
          <div class="mb-3 row">
            <label class="pull-md-1 col-md-3 col-form-label text-md-end"><img :src="asset('images/registration/user.svg')" alt="email">  {{ $t('email') }}</label>
            <div class="col-md-10 m-auto">
              <input v-model="form.email" :class="{ 'is-invalid': form.errors.has('email') }" class="form-control" type="email" name="email" required>
              <has-error :form="form" field="email" />
            </div>
          </div>

          <!-- Phone -->
          <div class="mb-3 row">
            <label class="pull-md-1 col-md-3 col-form-label text-md-end"><img :src="asset('images/registration/phone.svg')" alt="phone">  {{ $t('Phone') }}</label>
            <div class="col-md-10 m-auto">
              <input v-model="form.phone" :class="{ 'is-invalid': form.errors.has('phone') }" class="form-control p-relative" name="phone" required>
              <!-- <span class="mobile-prefix">{{mobilePrefix}}</span> -->
              <has-error :form="form" field="phone" />
            </div>
          </div>

          <!-- Password -->
          <div class="mb-3 row">
            <label class="pull-md-1 col-md-3 col-form-label text-md-end"><img :src="asset('images/registration/lock.svg')" alt="password">  {{ $t('password') }}</label>
            <div class="col-md-10 m-auto">
              <input v-model="form.password" :class="{ 'is-invalid': form.errors.has('password') }" class="form-control" type="password" name="password" required>
              <has-error :form="form" field="password" />
            </div>
          </div>

          <!-- Password Confirmation -->
          <div class="mb-3 row">
            <label class="pull-md-1 col-md-3 col-form-label text-md-end"><img :src="asset('images/registration/lock.svg')" alt="password confirmation">  {{ $t('confirm_password') }}</label>
            <div class="col-md-10 m-auto">
              <input v-model="form.password_confirmation" :class="{ 'is-invalid': form.errors.has('password_confirmation') }" class="form-control" type="password" name="password_confirmation" required>
              <has-error :form="form" field="password_confirmation" />
            </div>
          </div>
          <!-- Login -->
          <div class="mb-3 row">
            <div class="pull-md-1 col-md-3" />
            <div class="col-md-10 m-auto d-flex">
              <router-link :to="{ name: 'login' }" class="small mr-auto my-auto">
                {{ $t('Already have an account? Login') }}
              </router-link>
            </div>
          </div>

          <div class="mb-3 row">
            <div class="col-md-12 d-flex">
              <!-- Submit Button -->
              <v-button type="submit" :loading="form.busy" class="btn-brand m-auto col-sm-12">
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
    mustVerifyEmail: false,
    // mobilePrefix: '+964',
  }),

  methods: {
    async register () {
      // Register the user.
      // let purePhone = this.form.phone;
      // this.form.phone = this.mobilePrefix + purePhone;
      const { data } = await this.form.post('/api/register')
      if (data.error == 1) {
        // this.form.phone = purePhone;
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
  .center {
    position:absolute; 
    top: 50%; 
    left: 50%; 
    transform: translate(-50%, -50%);
  }
  .registration-forms .form-control{
    background: #EBEEF3;
    border-radius: 8px;
  }
  .mobile-prefix {
    position: absolute;
    top: 9px;
    left: 30px;
    border-right: 2px solid #7E8FAD;
    color: #7E8FAD;
    padding-right: 3px;
  }
  
  </style>