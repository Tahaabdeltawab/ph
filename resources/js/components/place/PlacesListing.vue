<template>
  <!-- places -->
  <section class="section-padding restaurent-meals bg-light-theme">
    <div class="container">
      <div class="row">
        <div class="col-xl-12 col-lg-12">
          <div class="row">
            <div class="col-lg-12 restaurent-meal-head mb-md-40">
              <div class="card">
                <div class="card-body no-padding">
                  <div class="row">
                    <div v-for="place in places" :key="place.id" class="col-lg-12 wow animate__animated animate__fadeIn">
                      <div class="restaurent-product-list">
                        <div class="restaurent-product-detail bg-white">
                          <router-link :to="{ name: 'place', params: { id: place.id } }">
                            <div class="restaurent-product-img">
                              <img :src="place.image" class="img-fluid" :alt="locale == 'ar' ? place.name_ar : place.name_en" />
                            </div>
                          </router-link>
                          <div class="restaurent-product-left">
                            <router-link :to="{ name: 'place', params: { id: place.id } }">
                              <div class="restaurent-product-title-box">
                                <div class="restaurent-product-box">
                                  <div class="restaurent-product-title">
                                    <h6 class="mb-2 text-light-black fw-600">{{ locale == 'ar' ? place.name_ar : place.name_en }}</h6>
                                  </div>
                                </div>
                              </div>
                              <div class="restaurent-product-caption-box">
                                <span class="text-light-white">{{locale == 'ar' ? place.description_ar : place.description_en}}</span>
                              </div>
                              </router-link>
                              <div class="restaurent-tags-price">
                                <div class="restaurent-product-price">
                                  <icons :place="place" />
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
        </div>
      </div>
    </div>
  </section>
  <!-- places -->
</template>

<script>
import Icons from '~/components/place/Icons.vue';
import { mapGetters } from 'vuex'
  export default {
      computed: mapGetters({
    locale: 'lang/locale',
  }),
  components: { Icons },
    props: ['places'],
  }
</script>

<style scoped>
.restaurent-product-caption-box,
.restaurent-tags-price {
  margin-right: 15px;
}
</style>