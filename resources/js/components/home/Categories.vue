<template>
  <!-- Explore collection -->
  <section class="ex-collection section-padding">
    <div class="container">
      <div class="row">
        <div class="col-12">
          <div class="section-header-left">
            <h3 class="text-light-black header-title title">
              {{$t('Categories')}}
              <span v-if="$parent.$options.name == 'welcome'" class="fs-14"><router-link :to="{name: 'categories'}">{{$t('See all')}}</router-link></span>
            </h3>
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-12">
          <div class="row">
            <div v-for="category in categories" :key="category.id" class="col-6 col-lg-4 category wow animate__animated animate__fadeInUp">
              <router-link :to="{ name: 'category', params: { id: category.id } }">
                <div class="product-box">
                  <div class="product-img">
                    <img :src="category.image" class="img-fluid full-width" alt="product-img" />
                    <div class="overlay">
                      <div class="product-tags">
                        <h6><span class="type-tag">{{locale == 'ar' ? category.name_ar : category.name_en}}</span></h6>
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
  <!-- Explore collection -->
</template>

<script>
import { mapGetters } from 'vuex'

  export default {
    props: ["categories"],
    computed: mapGetters({
      locale: 'lang/locale',
    }),
  };
</script>

<style scoped>
.category {
  margin-bottom: 40px;
}
.category .product-box,
.category .product-img,
.category .product-img img {
  height: 100%;
}
.category .product-img img {
  border-radius: 5px;
}
.category .overlay span.type-tag {
  top: 0;
  color: white;
  background: rgba(0, 0, 0, .7);
  border-radius: 0 10px 0px 5px;
  padding: 10px 20px;
}
</style>