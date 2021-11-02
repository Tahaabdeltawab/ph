<template>
  <b-modal id="locationModal" @ok="handleOk"  ref="locationModalRef">
    <!-- header -->
    <template #modal-header>
      <h5>{{ $t('Location') }}</h5>
    </template>
    <!-- header -->

    <!-- body -->
    <template #default>
      <form ref="locationModalFormRef" @submit.stop.prevent="handleSubmit">
         <b-form-group
          :label="$t('Governorate')"
          label-for="city_id"
          :invalid-feedback="$t('Governorate is required')"
          :state="cityState"
        >
        <select v-model="user.city_id" @change="fetchCityAreas" name="city_id" class="form-control" required>
          <option v-for="city in cities" :key="city.id" :value="city.id">
            {{ locale == 'ar' ? city.name_ar : city.name_en }}
          </option>
        </select>
      </b-form-group>
      <b-form-group
          :label="$t('City')"
          label-for="area_id"
          :invalid-feedback="$t('City is required')"
          :state="areaState"
        >
        <select v-model="user.area_id" name="area_id" class="form-control" required>
          <option v-for="area in areas" :key="area.id" :value="area.id">
            {{ locale == 'ar' ? area.name_ar : area.name_en }}
          </option>
        </select>
      </b-form-group>
      </form>
    </template>
    <!-- body -->

    <!-- footer -->
    <template #modal-footer="{ ok }">
      <b-button size="sm" variant="success" @click="ok();"> {{$t('OK')}} </b-button>
      <!-- <b-button size="sm" variant="danger" @click="cancel()">{{
        $t('Cancel')
      }}</b-button> -->
    </template>
    <!-- footer -->
  </b-modal>
</template>

<script>
import { mapGetters } from "vuex";
import { loadMessages } from "~/plugins/i18n";

export default {
  data: () => ({
    cityState: null,
    areaState: null,
  }),
  computed: mapGetters({
    cities: "location/cities",
    areas: "location/areas",
    user: "auth/user",
    locale: "lang/locale",
  }),
  async created() {
    await this.fetchCities();
    await this.fetchCityAreas();
  },
  methods: {
    async fetchCities() {
      await this.$store.dispatch("location/fetchCities");
    },
    async fetchCityAreas() {
      await this.$store.dispatch("location/fetchCityAreas", {
        city_id: this.user.city_id,
      });
    },
    async updateUserLocation() {
      await this.$store.dispatch("auth/updateUserLocation", {
        city_id: this.user.city_id,
        area_id: this.user.area_id,
      });
      // to get only this field to save memory, db time, vue rendering time 
      // const needs = "Slider,all_category,popular_section,subcategory";
      const needs = "popular_section"; 
      await this.$store.dispatch('home/fetchHome', {area_id: this.user.area_id, needs: needs})
    },

     checkFormValidity() {
        const valid = this.$refs.locationModalFormRef.checkValidity()
        this.cityState = valid
        this.areaState = valid
        return valid
      },
      handleOk(bvModalEvt) {
        // Prevent modal from closing
        bvModalEvt.preventDefault()
        // Trigger submit handler
        this.handleSubmit()
      },
      handleSubmit() {
        // Exit when the form isn't valid
        if (!this.checkFormValidity()) {
          return
        }
        
        this.updateUserLocation();
        // Hide the modal manually
        this.$nextTick(() => {
          this.$bvModal.hide('locationModal')
        })
      }
  },
};
</script>
<style>
.modal-backdrop {
  opacity: 0.5 !important;
}
.modal-footer {
  justify-content: flex-start !important;
}
.modal-footer > :not(:last-child) {
  margin-left: 0.25rem !important;
}
</style>