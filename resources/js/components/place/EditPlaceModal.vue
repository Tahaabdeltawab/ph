<template>
  <b-modal id="editPlaceModal"  ref="editPlaceModalRef">
    <!-- header -->
    <template #modal-header>
      <h5>{{ $t('Edit Place') }}</h5>
    </template>
    <!-- header -->
     <!-- body -->
    <template #default>
      <!-- <form ref="editPlaceModalFormRef" @submit.stop.prevent="handleSubmit"> -->
      <form @submit.prevent="updatePlaceDetails" @keydown="form.onKeydown($event)">
      <!-- <alert-success :form="form" :message="$t('info_updated')" /> -->

      <b-form-group :label="$t('Name ar')" label-for="name_ar" :class="{ 'is-invalid': form.errors.has('name_ar') }">
        <input type="text" v-model="form.name_ar" name="name_ar" class="form-control" required>
        <has-error :form="form" field="name_ar" />
      </b-form-group>
      
      <b-form-group :label="$t('Name en')" label-for="name_en" :class="{ 'is-invalid': form.errors.has('name_en') }">
         <input type="text" v-model="form.name_en" name="name_en" class="form-control" required>
          <has-error :form="form" field="name_en" />
      </b-form-group>
      
      <b-form-group :label="$t('Description ar')" label-for="description_ar" :class="{ 'is-invalid': form.errors.has('description_ar') }">
         <input type="text" v-model="form.description_ar" name="description_ar" class="form-control">
          <has-error :form="form" field="description_ar" />
      </b-form-group>
      
      <b-form-group :label="$t('Description en')" label-for="description_en" :class="{ 'is-invalid': form.errors.has('description_en') }">
         <input type="text" v-model="form.description_en" name="description_en" class="form-control">
          <has-error :form="form" field="description_en" />
      </b-form-group>
      
      <b-form-group :label="$t('Phone')" label-for="phone" :class="{ 'is-invalid': form.errors.has('phone') }">
         <input type="text" v-model="form.phone" name="phone" class="form-control" required>
          <has-error :form="form" field="phone" />
      </b-form-group>
      
      <b-form-group :label="$t('Facebook')" label-for="Facebook" :class="{ 'is-invalid': form.errors.has('Facebook') }">
         <input type="text" v-model="form.Facebook" name="Facebook" class="form-control">
          <has-error :form="form" field="Facebook" />
      </b-form-group>
      
      <b-form-group :label="$t('Twitter')" label-for="Twitter" :class="{ 'is-invalid': form.errors.has('Twitter') }">
         <input type="text" v-model="form.Twitter" name="Twitter" class="form-control">
          <has-error :form="form" field="Twitter" />
      </b-form-group>

      <!-- Submit Button -->
      <div class="mb-3 row">
        <div class="col-md-9 ms-md-auto">
          <v-button :loading="form.busy" type="success">
            {{ $t('update') }}
          </v-button>
        </div>
      </div>

      </form>
    </template>
    <!-- body -->

    <!-- footer -->
    <template #modal-footer="{  }">
      <span></span>
      <!-- <b-button size="sm" variant="success" @click="ok();"> {{$t('OK')}} </b-button> -->
      <!-- <b-button size="sm" variant="danger" @click="cancel()">{{
        $t('Cancel')
      }}</b-button> -->
    </template>
    <!-- footer -->
  </b-modal>
</template>

<script>
import Form from 'vform'

export default {
  props: ['place'],
  data: () => ({
     form: new Form({
      place_id: '',
      name_ar: '',
      name_en: '',
      description_ar: '',
      description_en: '',
      phone: '',
      Facebook: '',
      Twitter: '',
    }),
  }),
  mounted () {
    /* to refresh the form content on every show, use the coming event */
    // this.$root.$on('bv::modal::show', (bvEvent, modalId) => {
      // if(modalId == 'editPlaceModal'){
        this.fillForm();
      // }
    // })
  },

  methods: {
    async updatePlaceDetails() {
      await this.$store.dispatch("place/updatePlaceDetails", {form: this.form});
      this.$nextTick(() => {
        this.$bvModal.hide('editPlaceModal')
      })
    },
    fillForm () {
    // Fill the form with place data.
    this.place['place_id'] = this.place['id']; // because the vuex place details id key is "id" while the update request requires "place_id"
    this.form.keys().forEach(key => {
      this.form[key] = this.place[key]
    })
  },
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