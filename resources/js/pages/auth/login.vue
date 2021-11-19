<template>
  <div class="row login-page">
    <div class="col-lg-7 m-auto">
      <div class="logo p-relative">
         <img :src="asset('uploads/Logo.png')" class="img-fluid footer-logo" alt="app logo" />
      </div>
      <card>
        <form @submit.prevent="login" @keydown="form.onKeydown($event)" class="login-form">
          <!-- Email -->
          <div class="mb-3 row">
            <label class="col-md-3 col-form-label text-md-end"><img :src="asset('images/registration/phone.svg')" alt="username">  {{ $t('Phone') }}</label>
            <div class="col-md-7">
              <input v-model="form.phone" :class="{ 'is-invalid': form.errors.has('phone') }" class="form-control round p-relative" type="text" name="phone" required>
              <!-- <span class="mobile-prefix">{{mobilePrefix}}</span> -->
              <has-error :form="form" field="phone" />
            </div>
          </div>

          <!-- Password -->
          <div class="mb-3 row">
            <label class="col-md-3 col-form-label text-md-end"><img :src="asset('images/registration/lock.svg')" alt="password">  {{ $t('password') }}</label>
            <div class="col-md-7">
              <input v-model="form.password" :class="{ 'is-invalid': form.errors.has('password') }" class="form-control round" type="password" name="password" required>
              <has-error :form="form" field="password" />
            </div>
          </div>

          <!-- Remember Me -->
          <div class="mb-3 row">
            <div class="col-md-3" />
            <div class="col-md-7 d-flex">
              <!-- <checkbox v-model="remember" name="remember">
                {{ $t('remember_me') }}
              </checkbox> -->

              <router-link :to="{ name: 'password.request' }" class="small ms-auto my-auto text-brand">
                {{ $t('forgot_password') }}
              </router-link>
            </div>
          </div>

          <div class="mb-3 row">
            <div class="col-md-12 d-flex">
              <!-- Submit Button -->
              <v-button :loading="form.busy" class="btn-brand m-auto w-30 round">
                {{ $t('login') }}
              </v-button>
            </div>
          </div>
        </form>

          <div class="mb-3 row">
            <div class="col-md-12 d-flex">
              <router-link :to="{name: 'welcome'}" class="btn btn-brand-layout m-auto w-30 round">
                {{ $t('Not now') }}
              </router-link>
            </div>
          </div>
          <div class="mb-3 row">
            <div class="col-md-12 d-flex">
                <router-link :to="{ name: 'register' }" class="m-auto my-auto">{{ $t("Dont have an account?") }} <span class="text-brand">{{ $t("register now") }}</span></router-link>
            </div>
          </div>
          <div class="mb-3 row">
            <div class="col-md-12 d-flex">
                <p class="m-auto my-auto">{{ $t("OR Register by") }}</p>
            </div>
          </div>
          <!-- Facebook -->
          <login-with-facebook />
          <!-- Google -->
          <login-with-google />
      </card>
    </div>
  </div>
</template>

<script>
import Form from 'vform'
import Cookies from 'js-cookie'
import LoginWithFacebook from '~/components/SocialLogin/LoginWithFacebook.vue'
import LoginWithGoogle from '~/components/SocialLogin/LoginWithGoogle.vue'

export default {
  components: {
    LoginWithFacebook,
    LoginWithGoogle
  },

  middleware: 'guest',

  metaInfo () {
    return { title: this.$t('login') }
  },

  data: () => ({
    form: new Form({
      phone: '',
      password: ''
    }),
    remember: true,
    // mobilePrefix: '+964',
  }),

  methods: {
    async login () {
      // Submit the form.
      // let purePhone = this.form.phone;
      // this.form.phone = this.mobilePrefix + purePhone;
      const { data } = await this.form.post('/api/app_login')
      if(data.error == 1){
        // this.form.phone = purePhone;
        return alert(data.message);
      }
      const user = data.data;
      // Save the token.
      this.$store.dispatch('auth/saveToken', {
        token: user.token,
        remember: this.remember
      })

      // Fetch the user.
      await this.$store.dispatch('auth/fetchUser', {user: user})

      // Redirect home.
      this.redirect()
    },

    redirect () {
      const intendedUrl = Cookies.get('intended_url')

      if (intendedUrl) {
        Cookies.remove('intended_url')
        this.$router.push({ path: intendedUrl })
      } else {
        this.$router.push({ name: 'welcome' })
      }
    }
  }
}
</script>

<style>
  .login-page {
    margin-top: 5%;
    margin-bottom: 5%;
  }
  .form-check-label {
    margin-right: 15px;
  }
  .round.btn-facebook,.round.btn-google {
    padding: 6px 25px;
  }
  .round.btn-facebook img,.round.btn-google img {
    margin-left: 15px;
  }
  div.logo {
    height: 200px;
  }
  div.logo img {
    position:absolute; 
    top: 50%; 
    left: 50%; 
    transform: translate(-50%, -50%);
  }
  .card {
    border: none;
  }

  .login-form .form-control{
    background: #EBEEF3;
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