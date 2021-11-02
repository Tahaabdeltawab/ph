<template>
    <!-- products -->
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
                    <a v-if="myPlace" v-b-modal.addProductModal class="btn btn-dark add-product-modal-btn" href="javascript:void(0)" >{{ $t('Add Product') }}</a>
                    <add-product-modal :place_id="place_id" />
                  </h3>
                  </div>
                </div>
                <div class="card-body no-padding">
                  <div class="row">
                    <div v-for="product in infos" :key="product.id" class="col-lg-12">
                      <div class="restaurent-product-list">
                        <div class="restaurent-product-detail">
                          <div class="restaurent-product-img">
                            <img :src="product.image" class="img-fluid" :alt="locale == 'ar' ? product.name_ar : product.name_en" />
                          </div>
                          <div class="restaurent-product-left">
                            <div class="restaurent-product-title-box">
                              <div class="restaurent-product-box">
                                <div class="restaurent-product-title">
                                  <h6 class="mb-2" data-toggle="modal" data-target="#restaurent-popup">
                                    <p class="text-light-black fw-600" >{{ locale == 'ar' ? product.name_ar : product.name_en }}</p>
                                  </h6>
                                </div>
                              </div>
                            </div>
                            <div class="restaurent-product-caption-box">
                              <span class="text-light-white">{{locale == 'ar' ? product.description_ar : product.description_en}}</span>
                            </div>
                            <div class="restaurent-tags-price">
                              <div class="restaurent-product-price">
                                <h6 class="text-success fw-600 no-margin">
                                  {{ product.price }}
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
    <!-- products -->
</template>

<script>
import { mapGetters } from 'vuex'
import AddProductModal from '~/components/place/AddProductModal.vue'
  export default {
      computed: mapGetters({
    locale: 'lang/locale',
  }),
  components: { AddProductModal },
    props: ['infos', 'title', 'myPlace', 'place_id'],
  }
</script>

<style scoped>

</style>