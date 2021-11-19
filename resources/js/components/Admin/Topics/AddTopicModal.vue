<template>
  <b-modal id="addTopicModal"  ref="addTopicModalRef">
    <!-- header -->
    <template #modal-header>
      <h5>{{ $t('Add Topic') }}</h5>
    </template>
    <!-- header -->
     <!-- body -->
    <template #default>
      <form @submit.prevent="addTopic" @keydown="form.onKeydown($event)" enctype="multipart/form-data">

      <b-form-group :label="$t('Topic Title')" label-for="title" :class="{ 'is-invalid': form.errors.has('title') }">
        <input type="text" v-model="form.title" name="title" class="form-control" required>
        <has-error :form="form" field="title" />
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
  props: ['year_id'],
  data: () => ({
     form: new Form({
      year_id: '',
      title: '',
    
    }),
  }),
  mounted () {
    this.$root.$on('bv::modal::show', (bvEvent, modalId) => {
      if(modalId == 'addTopicModal'){
        this.fillForm();
      }
    })
  },

  methods: {
    async addTopic() {
      await this.$store.dispatch("student/addTopic", {form: this.form});
      this.$nextTick(() => {
        this.$bvModal.hide('addTopicModal');
      })
      this.emptyForm();
    },
    fillForm () {
      this.form['year_id'] = this.year_id
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