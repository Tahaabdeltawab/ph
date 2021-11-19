<template>
  <b-modal id="addUniversityModal"  ref="addUniversityModalRef">
    <!-- header -->
    <template #modal-header>
      <h5>{{ $t('Add University') }}</h5>
    </template>
    <!-- header -->
     <!-- body -->
    <template #default>
      <form @submit.prevent="addUniversity" @keydown="form.onKeydown($event)" enctype="multipart/form-data">

      <b-form-group :label="$t('University Code')" label-for="code" :class="{ 'is-invalid': form.errors.has('code') }">
        <input type="text" v-model="form.code" name="code" class="form-control" required>
        <has-error :form="form" field="code" />
      </b-form-group>

      <b-form-group :label="$t('University Title')" label-for="title" :class="{ 'is-invalid': form.errors.has('title') }">
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
  data: () => ({
     form: new Form({
      code: '',
      title: '',
    
    }),
  }),
  methods: {
    async addUniversity() {
      await this.$store.dispatch("student/addUniversity", {form: this.form});
      this.$nextTick(() => {
        this.$bvModal.hide('addUniversityModal');
      })
      this.emptyForm();
    },
    emptyForm () {
       this.form.keys().forEach(key => {
        this.form[key] = '';
      });
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