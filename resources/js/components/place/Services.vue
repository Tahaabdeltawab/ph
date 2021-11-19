<template>
  <!-- services -->
  <div class="container">
    <div class="row">
      <div class="col-xl-12 col-lg-12 mb-0">
        <div class="row">
          <div class="col-lg-12 restaurent-meal-head mb-md-40">
            <div class="card">
              <div class="card-header">
                <div class="section-header-left">
                  <h3 class="text-light-black header-title title">
                    {{ title }}
                    <a v-if="myPlace" v-b-modal.addServiceModal class="btn btn-dark add-service-modal-btn" href="javascript:void(0)" >{{ $t('Add Service') }}</a>
                    <add-service-modal :place_id="place_id" />
                  </h3>
                </div>
              </div>
              <div class="card-body no-padding bg-white">
                <div class="row">
                  <div v-for="(service, index) in infos" :key="service.id" class="col-lg-12">
                    <div class="restaurent-product-list">
                      <div class="restaurent-product-detail">
                        <div class="restaurent-product-left p-3">
                          <div class="restaurent-product-title-box">
                            <div class="restaurent-product-box">
                              <div class="restaurent-product-title">
                                <h6 class="mb-0" data-toggle="modal" data-target="#restaurent-popup">
                                  <p class="text-light-black fw-600">{{ index + 1 }}- {{ locale == 'ar' ? service.details_ar : service.details_en }}</p>
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
  <!-- services -->
</template>

<script>
import { mapGetters } from 'vuex'
import AddServiceModal from '~/components/place/AddServiceModal.vue'
  export default {
      computed: mapGetters({
    locale: 'lang/locale',
  }),
  components: { AddServiceModal },
    props: ['infos', 'title', 'myPlace', 'place_id'],
  }
</script>

<style scoped>

</style>