<template>
  <b-modal id="addProductModal"  ref="addProductModalRef">
    <!-- header -->
    <template #modal-header>
      <h5>{{ $t('Add Product') }}</h5>
    </template>
    <!-- header -->
     <!-- body -->
    <template #default>
      <form @submit.prevent="addPlaceProduct" @keydown="form.onKeydown($event)" enctype="multipart/form-data">

      <b-form-group :label="$t('Product Name ar')" label-for="name_ar" :class="{ 'is-invalid': form.errors.has('name_ar') }">
        <input type="text" v-model="form.name_ar" name="name_ar" class="form-control" required>
        <has-error :form="form" field="name_ar" />
      </b-form-group>
      
      <b-form-group :label="$t('Product Name en')" label-for="name_en" :class="{ 'is-invalid': form.errors.has('name_en') }">
         <input type="text" v-model="form.name_en" name="name_en" class="form-control" required>
          <has-error :form="form" field="name_en" />
      </b-form-group>

      <b-form-group :label="$t('Product Description ar')" label-for="description_ar" :class="{ 'is-invalid': form.errors.has('description_ar') }">
        <input type="text" v-model="form.description_ar" name="description_ar" class="form-control" required>
        <has-error :form="form" field="description_ar" />
      </b-form-group>
      
      <b-form-group :label="$t('Product Description en')" label-for="description_en" :class="{ 'is-invalid': form.errors.has('description_en') }">
         <input type="text" v-model="form.description_en" name="description_en" class="form-control" required>
          <has-error :form="form" field="description_en" />
      </b-form-group>

      <b-form-group :label="$t('Product Price')" label-for="price" :class="{ 'is-invalid': form.errors.has('price') }">
         <input type="number" v-model="form.price" name="price" class="form-control" required>
          <has-error :form="form" field="price" />
      </b-form-group>

      <b-form-group :label="$t('Product Image')" label-for="image" :class="{ 'is-invalid': form.errors.has('image') }">
         <input type="file" ref="image" @change="catchFile" name="image" class="form-control" required>
          <has-error :form="form" field="image" />
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
      name_ar: '',
      name_en: '',
      description_ar: '',
      description_en: '',
      price: '',
      image: '',
    }),
  }),
  mounted () {
    this.$root.$on('bv::modal::show', (bvEvent, modalId) => {
      if(modalId == 'addProductModal'){
        this.fillForm();
      }
    })
  },

  methods: {
    async addPlaceProduct() {
      await this.$store.dispatch("place/addPlaceProduct", {form: this.form});
      this.$nextTick(() => {
        this.$bvModal.hide('addProductModal');
      })
      this.emptyForm();
    },
    catchFile(){
      this.form.image = this.$refs.image.files[0];
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