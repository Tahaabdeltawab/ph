<template>
  <card :title="$t('location')">
    <form ref="locationFormRef" @submit.stop.prevent="handleSubmit">
    <b-alert v-model="showDismissibleAlert" variant="success" dismissible>{{$t('Updated successfully')}}</b-alert>

      <!-- City -->
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

      <!-- Area -->
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

      <!-- Submit Button -->
      <div class="mb-3 row">
        <div class="col-md-9 ms-md-auto">
          <v-button type="success">
            {{ $t('update') }}
          </v-button>
        </div>
      </div>
    </form>
  </card>
</template>

<script>
import { mapGetters } from "vuex";

export default {
  scrollToTop: false,
  data: () => ({
    cityState: null,
    areaState: null,
    showDismissibleAlert: false,
  }),
  metaInfo () {
    return { title: this.$t('settings') }
  },

  computed: mapGetters({
    cities: "location/cities",
    areas: "location/areas",
    user: "auth/user",
    locale: "lang/locale",
  }),
  async created() {
    // commented because already called from locationModal in navbarq2 which is present in all pages
    // await this.fetchCities();
    // await this.fetchCityAreas();
  },
  methods: {
    // async fetchCities() {
    //   await this.$store.dispatch("location/fetchCities");
    // },
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
    },


     checkFormValidity() {
        const valid = this.$refs.locationFormRef.checkValidity()
        console.log('valid')
        console.log(valid)

        this.cityState = valid
        this.areaState = valid
        return valid
      },
      async handleSubmit() {
        // Exit when the form isn't valid
        if (!this.checkFormValidity()) {
          return
        }
        
        await this.updateUserLocation();
        // Hide the modal manually
        this.$nextTick(() => {
          this.showDismissibleAlert = true;
        })
      }
  },
}
</script>
