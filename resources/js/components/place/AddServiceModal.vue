<template>
  <b-modal id="addServiceModal"  ref="addServiceModalRef">
    <!-- header -->
    <template #modal-header>
      <h5>{{ $t('Add Service') }}</h5>
    </template>
    <!-- header -->
     <!-- body -->
    <template #default>
      <!-- <form ref="addServiceModalFormRef" @submit.stop.prevent="handleSubmit"> -->
      <form @submit.prevent="addPlaceService" @keydown="form.onKeydown($event)">
      <!-- <alert-success :form="form" :message="$t('info_updated')" /> -->

      <b-form-group :label="$t('Service Name ar')" label-for="details_ar" :class="{ 'is-invalid': form.errors.has('details_ar') }">
        <input type="text" v-model="form.details_ar" name="details_ar" class="form-control" required>
        <has-error :form="form" field="details_ar" />
      </b-form-group>
      
      <b-form-group :label="$t('Service Name en')" label-for="details_en" :class="{ 'is-invalid': form.errors.has('details_en') }">
         <input type="text" v-model="form.details_en" name="details_en" class="form-control" required>
          <has-error :form="form" field="details_en" />
      </b-form-group>
      
      <!-- Submit Button -->
      <div class="mb-3 row">
        <div class="col-md-9 ms-md-auto">
          <v-button :loading="form.busy" type="success">
            {{ $t('Add') }}
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
  props: ['place_id'],
  data: () => ({
     form: new Form({
      place_id: '',
      details_ar: '',
      details_en: '',
    }),
  }),
  mounted () {
    this.$root.$on('bv::modal::show', (bvEvent, modalId) => {
      if(modalId == 'addServiceModal'){
        this.fillForm();
      }
    })
  },

  methods: {
    async addPlaceService() {
      await this.$store.dispatch("place/addPlaceService", {form: this.form});
      this.$nextTick(() => {
        this.$bvModal.hide('addServiceModal');
      })
      this.emptyForm();
    },
    fillForm () {
      this.form['place_id'] = this.place_id
    },
    emptyForm () {
       this.form.keys().forEach(key => {
        this.form[key] = '';
      });
      this.fillForm();
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