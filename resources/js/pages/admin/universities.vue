<template>
    <!-- universities -->
    <div class="container">
      <div class="row">
        <div class="col-xl-12 col-lg-12">
          <div class="row">
            <div class="col-lg-12 restaurent-meal-head mb-md-40">
              <div class="card">
                <div class="card-header">
                  <div class="section-header-left">
                    <h3 class="text-light-black header-title title">
                    <a v-b-modal.addUniversityModal class="btn btn-dark add-product-modal-btn" href="javascript:void(0)" >{{ $t('Add University') }}</a>
                    <add-university-modal />
                  </h3>
                  </div>
                </div>
                <div class="card-body no-padding">
                  <div class="row">
                    <div v-for="university in universities" :key="university.id" class="col-lg-12">
                     <div class="restaurent-product-list">
                        <div class="restaurent-product-detail">
                          <!-- <div class="restaurent-product-img">
                            <img :src="university.image" class="img-fluid" :alt="locale == 'ar' ? university.name_ar : university.name_en" />
                          </div> -->
                          <div class="restaurent-product-left">
                            <div class="restaurent-product-title-box">
                              <div class="restaurent-product-box">
                                <div class="restaurent-product-title">
                                  <h6 class="mb-2" data-toggle="modal" data-target="#restaurent-popup">
                                    <p class="text-light-black fw-600" >{{university.title}}</p>
                                  </h6>
                                </div>
                              </div>
                            </div>
                            <div class="restaurent-product-caption-box">
                              <span class="text-light-white">{{'university.description_ar'}}</span>
                            </div>
                            <div class="restaurent-tags-price">
                              <div class="restaurent-product-price title full-width">
                                <h6 class="text-success fw-600 no-margin">
                                  {{ 'university.price' }}
                                </h6>
                                  <span class="ml-3">{{'university.created_at'}}</span>
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
    <!-- universities -->
</template>

<script>
import { mapGetters } from 'vuex'
import AddUniversityModal from '~/components/Admin/universities/AddUniversityModal.vue'
  export default {
  middleware: 'auth',
  computed: mapGetters({
    locale: 'lang/locale',
    universities: 'student/universities'
  }),
  metaInfo () {
  return { title: this.$t('universities') }
  },
   created() {
     this.fetchUniversities()
    },
  methods: {
    async fetchUniversities(){
      await this.$store.dispatch('student/fetchUniversities')
    }
  },
  components: { AddUniversityModal },
  }
</script>

<style scoped>

</style>