<template>
  <!-- notifications -->
  <section class="section-padding restaurent-meals">
    <div class="container">
      <div class="row">
        <div class="col-xl-12 col-lg-12">
          <div class="row">
            <div class="col-lg-12 restaurent-meal-head mb-md-40">
              <div class="card">
                <div class="card-body no-padding">
                  <div class="row">
                    <div v-for="notification in notifications" :key="notification.id" class="col-lg-12">
                      <div class="restaurent-product-list">
                        <div class="restaurent-product-detail bg-white">
                          <div class="restaurent-product-left">
                            <div class="restaurent-product-title-box">
                              <div class="restaurent-product-box">
                                <div class="restaurent-product-title">
                                  <h6 class="mb-2 text-light-black fw-600">{{ notification.title_ar }}</h6>
                                </div>
                              </div>
                            </div>
                            <div class="restaurent-product-caption-box">
                              <span class="text-light-white">{{notification.body_ar}}</span>
                            </div>
                          </div>
                        </div>
                        <div v-if="notification.image" class="notification-img">
                          <img :src="notification.image" class="img-fluid" :alt="notification.title_ar" />
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
  <!-- notifications -->
</template>

<script>
import { mapGetters } from 'vuex'
  export default {
  middleware: 'auth',
  computed: mapGetters({
    locale: 'lang/locale',
    notifications: 'auth/notifications'
  }),
   created() {
     this.fetchNotifications()
    },
  methods: {
    async fetchNotifications(){
      await this.$store.dispatch('auth/fetchNotifications')
    }
  },
  }
</script>

<style scoped>
.restaurent-product-caption-box,
.restaurent-tags-price {
  margin-right: 15px;
}
.restaurent-product-detail {
  height: auto;
}
</style>