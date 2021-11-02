<template>
 
      <!-- about us -->
         <div class="container">
          <div class="row">
            <div class="col-xl-12 col-lg-12">
              <div class="row">
                <div class="col-lg-12 restaurent-meal-head mb-md-40">
                  <div class="card">
                    <div class="card-header">
                      <div class="section-header-left">
                        <h3 class="text-light-black header-title">
                          {{ title }}
                        </h3>
                      </div>
                    </div>
                    <div class="card-body no-padding">
                      <div class="row">
                        <div v-if="infos.length" class="col-lg-12">
                          <div class="restaurent-product-list">
                            <div class="restaurent-product-detail">
                              <div class="restaurent-product-left">
                                <div class="restaurent-product-title-box">
                                  <div class="restaurent-product-box">
                                    <div class="restaurent-product-title">
                                      <h6 v-for="info in infos" :key="info.id" class="mb-2">
                                        <p class="text-light-black fw-600"> 
                                          <!-- details for place, description for info pages(privacy, agreement) -->
                                         {{ (locale == 'ar' ? info.details_ar : info.details_en) || (locale == 'ar' ? info.description_ar : info.description_en) }}
                                        </p>
                                      </h6>
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
        </div>
      <!-- about us -->
</template>

<script>
import { mapGetters } from 'vuex'
  export default {
      computed: mapGetters({
    locale: 'lang/locale',
  }),
    props: ['infos', 'title'],
  }
</script>

<style scoped>

</style>