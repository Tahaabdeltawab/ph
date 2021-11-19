<template>
    <!-- topics -->
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
                    <a v-b-modal.addTopicModal class="btn btn-dark add-product-modal-btn" href="javascript:void(0)" >{{ $t('Add Topic') }}</a>
                    <add-topic-modal :year="year" />
                  </h3>
                  </div>
                </div>
                <div class="card-body no-padding">
                  <div class="row">
                    <div v-for="topic in topics" :key="topic.id" class="col-lg-12">
                      <div class="restaurent-product-list">
                        <div class="restaurent-product-detail">
                          <div class="restaurent-product-left">
                            <div class="restaurent-product-title-box">
                              <div class="restaurent-product-box">
                                <div class="restaurent-product-title">
                                  <h6 class="mb-2">
                                    <p class="text-light-black fw-600" >{{topic.title}}</p>
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
    <!-- topics -->
</template>

<script>
import { mapGetters } from 'vuex'
import AddTopicModal from '~/components/Admin/Topics/AddTopicModal.vue'
  export default {
  computed: mapGetters({
    locale: 'lang/locale',
    topics: 'student/topics'
  }),
  components: { AddTopicModal },
    props: ['year_id'],
  }
</script>

<style scoped>

</style>