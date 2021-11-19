<template>
  <div class="pl-social-media">
    <ul>
      <li v-if="place.phone">
        <a @click="$bvToast.show(`phone-toast-${place.id}`)" class="rect-tag phone" href="javascript:void(0)">
          <img :src="asset('q/assets/img/svg/phone.svg')">
          <span>{{$t('Call Us')}}</span>
        </a>
          <b-toast class="phone-toast" :id="'phone-toast-' + place.id" :title="$t('Phone')" static no-auto-hide>
            <a :href="`tel:${place.phone}`" class="text-light-white">{{ place.phone }}
            </a>
          </b-toast>
      </li>
          <li>
        <a class="rect-tag fav" href="javascript:void(0)" @click="fav(place.id)">
          <img :src="asset(`q/assets/img/svg/${place.isFavorite ? 'favorite_yellow.svg' : 'favorite.svg'}`)" alt="Favorite" />
        </a>
      </li>
      <li v-if="place.Latitude && place.Longitude">
        <a class="rect-tag map" target="_blank" :href="`https://maps.google.com/?q=${place.Latitude},${place.Longitude}`">
          <img :src="asset('q/assets/img/svg/google-maps.svg')">
        </a>
      </li>
      <li v-if="place.Facebook">
        <a class="rect-tag facebook" target="_blank" :href="place.Facebook">
          <img :src="asset('q/assets/img/svg/facebook.svg')">
        </a>
      </li>
      <li v-if="place.Twitter">
        <a class="rect-tag twitter" target="_blank" :href="place.Twitter">
          <img :src="asset('q/assets/img/svg/twitter.svg')">
        </a>
      </li>
      <li v-if="place.Instagram">
        <a class="rect-tag instagram" target="_blank" :href="place.Instagram">
          <b-icon icon="instagram" fixed-width font-scale="1.5"></b-icon>
        </a>
      </li>
    </ul>
  </div>
</template>

<script>
import { mapGetters } from "vuex";

  export default {
    props: ['place', 'favMethod'],
    
    computed: mapGetters({
      routeName: "general/routeName",
    }),

    methods: {
      fav(id){
        this.routeName == 'favorites'
        ? this.toggleFavFavoritePlace(id)
        : (this.routeName == 'category' 
        ? this.toggleFavCategoryPlace(id) 
        : this.toggleFav(id))
      },
      async toggleFav(id) {
        await this.$store.dispatch("place/toggleFav", {id});
      },
      async toggleFavCategoryPlace(id) {
        await this.$store.dispatch("place/toggleFavCategoryPlace", {id});
      },
      async toggleFavFavoritePlace(id) {
        await this.$store.dispatch("place/toggleFavFavoritePlace", {id});
      },
  },
  }
</script>

<style>

.phone-toast .toast {
  opacity: 1;
  display: inline-block;
  position: absolute;
  left: 0;
  z-index: 10;
}
.pl-social-media {
  display: block;
  align-items: center;
  padding-top: 20px;
}

.pl-social-media ul {
  display: flex;
  flex-wrap: wrap;
  justify-content: center;
}

.pl-social-media ul li {
  margin-left: 15px;
  transition: 0.3s;
}
.pl-social-media ul li>a i {
  font-size: 18px;
}
.pl-social-media ul li img {
  height: 20px;
}

.pl-social-media ul li:first-child {
  margin-right: 0;
}
.pl-social-media ul li:hover {
  transition: 0.3s;
}

.pl-social-media ul li:hover a {
  transition: 0.3s;
}
.rect-tag {
  height: 36px;
  width: 36px;
  border-radius: 10%;
  font-size: 16px;
  display: flex;
  align-items: center;
  justify-content: center;
  cursor: pointer;
  box-shadow: 0 0 0 1px rgb(67 41 163 / 10%), 0 1px 5px 0 rgb(67 41 163 / 10%);
}
.rect-tag.phone {
  color: white;
  background: black;
  width: auto;
  padding: 10px;
  border-radius: 5%;
}
.rect-tag.phone img {
  height: 17px;
  margin: 3px;
}
.rect-tag.phone span {
  margin: 3px;
}
.rect-tag.twitter img {
  height: 17px;
}
.rect-tag.instagram * {
  color: #f029ad;
}
</style>