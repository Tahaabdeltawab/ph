<template>
  <div class="row justify-content-center profile-page">
    <div class="col-md-3 mb-3">
      <card :title="$t('settings')" class="settings-card">
        <ul class="nav flex-column nav-pills">
          <li v-for="tab in tabs" :key="tab.route" class="nav-item">
            <router-link :to="{ name: tab.route }" class="nav-link" active-class="active">
                <b-icon :icon="tab.icon" fixed-width font-scale="1.5"></b-icon>
              {{ tab.name }}
            </router-link>
          </li>
        </ul>
      </card>
    </div>

    <div class="col-md-7">
      <transition name="fade" mode="out-in">
        <router-view />
      </transition>
    </div>
  </div>
</template>

<script>
export default {
  middleware: 'auth',

  computed: {
    tabs () {
      return [
        {
          icon: 'person-fill',
          name: this.$t('profile'),
          route: 'settings.profile'
        },
        {
          icon: 'map-fill',
          name: this.$t('Location'),
          route: 'settings.location'
        },
        {
          icon: 'lock-fill',
          name: this.$t('password'),
          route: 'settings.password'
        }
      ]
    }
  }
}
</script>

<style>
.settings-card .card-body {
  padding: 0;
}
 .profile-page {
    margin-top: 10%;
    margin-bottom: 10%;
  }
</style>
