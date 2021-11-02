<template>
  <div>
    <section class="ex-collection section-padding">
      <div class="container">
        <div class="row">
          <div class="col-12">
            <div class="section-header-left">
              <h3 class="text-light-black header-title title">
                {{user ? $t('Popular in')+ " " + (locale == 'ar' ? user.area_name_ar : user.area_name_en) : $t('Popular')}}
                <span v-if="user" class="fs-14">
                  <a v-b-modal.locationModal href="javascript:void(0)">{{$t('Change city')}}</a>
                </span>
              </h3>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-12">
            <div class="row">
              <div v-for="popular in populars" :key="popular.id" class="col-lg-4 col-md-6 col-sm-6 popular">
                <router-link :to="{ name: 'place', params: { id: popular.id } }">
                  <div class="product-box">
                    <div class="product-img">
                      <img :src="popular.image" class="img-fluid full-width" alt="product-img" />
                      <div class="overlay">
                        <div class="product-tags">
                          <h6><span class="type-tag">{{locale == 'ar' ? popular.name_ar : popular.name_en}}</span></h6>
                        </div>
                      </div>
                    </div>
                  </div>
                </router-link>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
  </div>
</template>

<script>
import { mapGetters } from "vuex";

export default {
  props: ['populars'],
  computed: {
    ...mapGetters({
      user: "auth/user",
      locale: "lang/locale",
    }),
  },
};
</script>

<style scoped>
.popular {
  margin-bottom: 40px;
}
.popular .product-box,
.popular .product-img,
.popular .product-img img {
  height: 100%;
}
.popular .product-img img {
  border-radius: 5px;
}
.popular .overlay span.type-tag {
  bottom: 0;
  color: white;
  background: rgba(0, 0, 0, .7);
  border-radius: 10px 0px 5px 0px;
  padding: 10px 20px;
}
</style>