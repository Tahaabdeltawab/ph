<template>
<a class="lbl-search">
    <!-- {{}} -->
    <input 
    ref="searchInputRef" 
    v-model.trim="query" 
    @input="search" 
    @blur="blurred"
    @focus="isFocused = true"
    class="txt-search" 
    :class="{ 'border-0' : fetched }" 
    id="sys_txt_search" 
    type="search" 
    :placeholder="$t('Search')"
    >
    <div v-if="isFocused" id="results">
        <div class="coupon_results">
            <router-link v-for="place in places" :key="place.id" :to="{ name: 'place', params: { id: place.id } }" data-name="search">
                <div class='coupon_item'>
                    <div class='img'>
                        <img :src="place.image">
                    </div>
                    <div class='item_detail'>
                        <h5>{{locale == 'ar' ? place.name_ar : place.name_en}}</h5>
                        <p v-if="(locale == 'ar' && place.description_ar) || (locale == 'en' && place.description_en)">
                            {{locale == 'ar' ? 
                            (place.description_ar.length > 40 ? place.description_ar.substring(0,40)+".." : place.description_ar) :
                            (place.description_en.length > 40 ? place.description_en.substring(0,40)+".." : place.description_en) }}
                        </p>
                    </div>
                </div>
            </router-link>
        </div>
    </div>
</a>


</template>

<script>
import axios from 'axios';
import { mapGetters } from 'vuex'

export default {
  data() {
      return {
          query: '',
          places: [],
          fetched: false,
          isFocused: false,
      }
  },
    computed: mapGetters({
    locale: 'lang/locale',
  }),
    watch:{
    $route (to, from){
       this.reset();
    }
    } ,
  methods: {
    blurred(e){
        if(!(e && e.relatedTarget && e.relatedTarget.dataset.name === 'search'))
        this.reset(e);
    },
    reset(){
        this.fetched = false;
        this.isFocused = false;
    },
    async search (e) {
        if(!this.query.length){
            this.fetched = false;
            this.places = [];
            return;
        }
        if (e.code == 'Space')
        return;

        const { data } = await axios.get('/api/search?keyword=' + this.query);
        this.places = data.data;
        this.fetched = true;
    }
  }
}

</script>
<style scoped>
    .lbl-search{
        width: 30%;
    }

    @media screen and (max-device-width:  480px), screen and (max-width:  480px) {
        .alert-w{background: green}

        .lbl-search
        {
            width: 50%;
            margin: 0px 7px 0px 0;
        }
    }
    .lbl-search {
        position: relative;
        display: block;
    }

    .txt-search {
        padding: 5px 40px 4px 10px;
        margin: 0;
        width: 100%;
        background: #ffffff;
        border: 1px solid #999;
        color: #101010;
        font-size: 1.076923076923077em;
        border-radius: 5px;
        -moz-border-radius: 5px;
        -webkit-border-radius: 5px;
        box-sizing: border-box;
        -moz-box-sizing: border-box;
        -webkit-box-sizing: border-box;
        transition: all 0.3s;
        -o-transition: all 0.3s;
        -ms-transition: all 0.3s;
        -moz-transition: all 0.3s;
    }

    .txt-search:focus {
        background: #FFFFFF;
    }

    /* search results */
    div#results{
        position: absolute;
        width: 100%;
        background-color: #fff;
        border-radius: 0 0 28px 28px;
        top: 0;
        box-shadow: 0 7px 10px rgb(170 170 170 / 8%);
        margin-top: 40px;
    }

    div#results .coupon_results{
        overflow-y: auto;
        width: 100%;
        height: 100%;
        position: relative !important;
        max-height: 400px;
        border-radius: 0 0 28px 28px;
    }

    div#results .coupon_item{
    display: flex;
    text-align: right;
    direction: rtl;
    padding: 10px 20px;
    align-items: center;
    cursor: pointer;
}
    .border-0{
        border-radius: 28px 28px 0 0!important;
    }

    div#results .coupon_item:hover {
        background-color: #e7f1f8;
    }

    div#results .coupon_item img {
        max-width: 40px;
        width: 40px;
        height: 40px;
        border-radius: 50px;
        -o-object-fit: cover;
        object-fit: cover;
        box-shadow: 0 2px 10px rgb(170 170 170 / 8%), 2px 0 10px rgb(170 170 170 / 8%), -2px 0 10px rgb(170 170 170 / 8%), 0 -2px 10px rgb(170 170 170 / 8%);
    }

    div#results .coupon_item .item_detail{
        color: #0C0D0D;
        padding-right: 20px;
    }

    div#results .coupon_item .item_detail h5{
        font-size: 15px;
        font-weight: 700;
        margin-bottom: 3px;
    }
    div#results .coupon_item .item_detail h5{
        font-size: 16px;
        margin-bottom: 0;
        padding-right: 10px;
    }

</style>