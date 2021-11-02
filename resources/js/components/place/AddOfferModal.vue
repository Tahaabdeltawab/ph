<template>
  <b-modal id="addOfferModal"  ref="addOfferModalRef">
    <!-- header -->
    <template #modal-header>
      <h5>{{ $t("Add Offer") }}</h5>
    </template>
    <!-- header -->
     <!-- body -->
    <template #default>
      <form @submit.prevent="addPlaceOffer" @keydown="form.onKeydown($event)" enctype="multipart/form-data">

      <b-form-group :label="$t('Offer Name ar')" label-for="title_ar" :class="{ 'is-invalid': form.errors.has('title_ar') }">
        <input type="text" v-model="form.title_ar" name="title_ar" class="form-control" required>
        <has-error :form="form" field="title_ar" />
      </b-form-group>
      
      <b-form-group :label="$t('Offer Name en')" label-for="title_en" :class="{ 'is-invalid': form.errors.has('title_en') }">
         <input type="text" v-model="form.title_en" name="title_en" class="form-control" required>
          <has-error :form="form" field="title_en" />
      </b-form-group>

      <b-form-group :label="$t('Offer Code')" label-for="code" :class="{ 'is-invalid': form.errors.has('code') }">
         <input type="text" v-model="form.code" name="code" class="form-control" required>
          <has-error :form="form" field="code" />
      </b-form-group>

      <b-form-group :label="$t('Offer Percent')" label-for="present" :class="{ 'is-invalid': form.errors.has('present') }">
         <input type="number" v-model="form.present" name="present" class="form-control" required>
          <has-error :form="form" field="present" />
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
      title_ar: '',
      title_en: '',
      code: '',
      present: '',
    }),
  }),
  mounted () {
    this.$root.$on('bv::modal::show', (bvEvent, modalId) => {
      if(modalId == 'addOfferModal'){
        this.fillForm();
      }
    })
  },

  methods: {
    async addPlaceOffer() {
      await this.$store.dispatch("place/addPlaceOffer", {form: this.form});
      this.$nextTick(() => {
        this.$bvModal.hide('addOfferModal');
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