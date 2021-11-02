<template>
  <div class="mb-3 row">
    <div class="col-md-12 d-flex">
      <button class="btn m-auto round btn-google" @click="social_login">
        <img :src="asset('q/assets/img/svg/login/google.svg')" alt="btn google">{{$t('Continue with Google')}}
      </button>
    </div>
  </div>
</template>

<script>
import Cookies from 'js-cookie'

export default {
  name: 'LoginWithGoogle',

  computed: {
    googleAuth: () => window.config.googleAuth,
    url: () => '/api/oauth/google'
  },

  mounted () {
    window.addEventListener('message', this.onMessage, false)
  },

  beforeDestroy () {
    window.removeEventListener('message', this.onMessage)
  },

  methods: {
    async social_login () {
      const newWindow = openWindow('', this.$t('login'))

      const url = await this.$store.dispatch('auth/fetchOauthUrl', {
        provider: 'google'
      })

      newWindow.location.href = url
    },

    /**
     * @param {MessageEvent} e
     */
    onMessage (e) {
      if (e.origin !== window.origin || !e.data.token) {
        return
      }

      this.$store.dispatch('auth/saveToken', {
        token: e.data.token
      })

      this.redirect();
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

/**
 * @param  {Object} options
 * @return {Window}
 */
function openWindow (url, title, options = {}) {
  if (typeof url === 'object') {
    options = url
    url = ''
  }

  options = { url, title, width: 600, height: 720, ...options }

  const dualScreenLeft = window.screenLeft !== undefined ? window.screenLeft : window.screen.left
  const dualScreenTop = window.screenTop !== undefined ? window.screenTop : window.screen.top
  const width = window.innerWidth || document.documentElement.clientWidth || window.screen.width
  const height = window.innerHeight || document.documentElement.clientHeight || window.screen.height

  options.left = ((width / 2) - (options.width / 2)) + dualScreenLeft
  options.top = ((height / 2) - (options.height / 2)) + dualScreenTop

  const optionsStr = Object.keys(options).reduce((acc, key) => {
    acc.push(`${key}=${options[key]}`)
    return acc
  }, []).join(',')

  const newWindow = window.open(url, title, optionsStr)

  if (window.focus) {
    newWindow.focus()
  }

  return newWindow
}
</script>
