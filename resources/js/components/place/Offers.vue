<template>
    <!-- offers -->
    <div class="container">
      <div class="row">
        <div class="col-xl-12 col-lg-12">
          <div class="row">
            <div class="col-lg-12 restaurent-meal-head mb-md-40">
              <div class="card">
                <div class="card-header">
                  <div class="section-header-left">
                   <h3 class="text-light-black header-title title">
                    {{ title }}
                    <a v-if="myPlace" v-b-modal.addOfferModal class="btn btn-dark add-offer-modal-btn" href="javascript:void(0)" >{{ $t('Add Offer') }}</a>
                    <add-offer-modal :place_id="place_id" />
                  </h3>
                  </div>
                </div>
                <div class="card-body no-padding">
                  <div class="row">
                    <div v-for="offer in infos" :key="offer.id" class="col-lg-12">
                      <div class="restaurent-product-list">
                        <div class="restaurent-product-detail">
                          <div class="restaurent-product-left">
                            <div class="restaurent-product-title-box">
                              <div class="restaurent-product-box">
                                <div class="restaurent-product-title">
                                  <h6 class="mb-2" data-toggle="modal" data-target="#restaurent-popup">
                                    <p class="text-light-black fw-600">{{ locale == 'ar' ? offer.title_ar : offer.title_en }}</p>
                                  </h6>
                                </div>
                              </div>
                            </div>
                            <div class="restaurent-offer-caption-box">
                              <h6 class="text-light-white offer-code">
                                {{ offer.code }}
                              </h6>
                              <h6 class="fw-600 no-margin offer-price">
                                {{ offer.present }}% {{$t('discount')}}
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
    <!-- offers -->
</template>

<script>
import { mapGetters } from 'vuex'
import AddOfferModal from '~/components/place/AddOfferModal.vue'
  export default {
  components: { AddOfferModal },
    computed: mapGetters({
    locale: 'lang/locale',
  }),
    props: ['infos', 'title', 'myPlace', 'place_id'],
  }
</script>

<style scoped>
</style>