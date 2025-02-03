<template>
  <Head title="Create Certificate" />
  <AdminLayout :setting="props.setting" :user="props.user">
    <div class="container-xxl flex-grow-1 container-p-y">
      <h4 class="fw-bold py-3 mb-4">
        <span class="text-muted fw-light">Home /</span> Certificates / Create
      </h4>
      <div class="row">
        <div class="col-xl">
          <div class="card mb-4">
            <div
              class="card-header d-flex justify-content-between align-items-center"
            >
              <h5 class="mb-0">Create Certificate</h5>
              <small class="text-muted float-end">Manage certificates</small>
            </div>
            <div class="card-body">
              <form @submit.prevent="submit">
                <div class="row">
                  <!-- Certificate Code -->
                  <div class="col-md-4">
                    <div class="mb-3">
                      <label for="certificate_code" class="form-label"
                        >Certificate Code</label
                      >
                      <input
                        type="text"
                        class="form-control"
                        id="certificate_code"
                        v-model="form.certificate_code"
                      />
                      <!-- Display error for certificate_code -->
                      <div
                        v-if="errors.certificate_code"
                        class="text-danger mt-2"
                      >
                        {{ errors.certificate_code }}
                      </div>
                    </div>
                  </div>

                  <!-- Certificate Name -->
                  <div class="col-md-4">
                    <div class="mb-3">
                      <label for="certificate_name" class="form-label"
                        >Certificate Name</label
                      >
                      <input
                        type="text"
                        class="form-control"
                        id="certificate_name"
                        v-model="form.certificate_name"
                      />
                      <!-- Display error for certificate_name -->
                      <div
                        v-if="errors.certificate_name"
                        class="text-danger mt-2"
                      >
                        {{ errors.certificate_name }}
                      </div>
                    </div>
                  </div>

                  <!-- Issue Date -->
                  <div class="col-md-4">
                    <div class="mb-3">
                      <label for="issue_date" class="form-label"
                        >Issue Date</label
                      >
                      <input
                        type="date"
                        class="form-control"
                        id="issue_date"
                        v-model="form.issue_date"
                      />
                      <!-- Display error for issue_date -->
                      <div v-if="errors.issue_date" class="text-danger mt-2">
                        {{ errors.issue_date }}
                      </div>
                    </div>
                  </div>
                </div>

                <div class="row">
                  <!-- For Who -->
                  <div class="col-md-4">
                    <div class="mb-3">
                      <label for="for_who" class="form-label">For Who</label>
                      <input
                        type="text"
                        class="form-control"
                        id="for_who"
                        v-model="form.for_who"
                      />
                      <!-- Display error for for_who -->
                      <div v-if="errors.for_who" class="text-danger mt-2">
                        {{ errors.for_who }}
                      </div>
                    </div>
                  </div>

                  <!-- Training -->
                  <div class="col-md-4">
                    <div class="mb-3">
                      <label for="training_id" class="form-label"
                        >Training</label
                      >
                      <select
                        class="form-select"
                        id="training_id"
                        v-model="form.training_id"
                      >
                        <option value="" disabled selected>
                          -- Select Training --
                        </option>
                        <option
                          v-for="training in trainings"
                          :key="training.id"
                          :value="training.id"
                        >
                          {{ training.name }}
                        </option>
                      </select>
                      <!-- Display error for training_id -->
                      <div v-if="errors.training_id" class="text-danger mt-2">
                        {{ errors.training_id }}
                      </div>
                    </div>
                  </div>
                  <!-- Upload File or Image -->
                  <div class="col-md-4">
                    <div class="mb-3">
                      <label for="certificate_file" class="form-label"
                        >Upload File/Image</label
                      >
                      <input
                        type="file"
                        class="form-control"
                        id="certificate_file"
                        @change="handleFileUpload"
                      />
                      <!-- Display error for certificate_file -->
                      <div
                        v-if="errors.certificate_file"
                        class="text-danger mt-2"
                      >
                        {{ errors.certificate_file }}
                      </div>
                    </div>
                  </div>
                </div>

                <div class="d-flex justify-content-end gap-3 mt-4">
                  <button type="submit" class="btn btn-primary">
                    <i class="bx bx-save"></i> Save Certificate
                  </button>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </AdminLayout>
</template>
  
  <script setup>
import AdminLayout from "@/Layouts/AdminLayout.vue";
import { Head } from "@inertiajs/vue3";
import { useForm } from "@inertiajs/vue3";
import { useToast } from "vue-toastification";
import { ref } from "vue";

const props = defineProps({
  trainings: {
    type: Object,
    required: true,
  },
  setting:{
    type:Object, 
    required:true, 
  },
  user:{
    type:Object, 
    required:true, 
  },
});

const toast = useToast();

const form = useForm({
  certificate_code: "",
  certificate_name: "",
  issue_date: "",
  for_who: "",
  training_id: "",
  certificate_file: null, 
});

const handleFileUpload = (event) => {
  form.certificate_file = event.target.files[0];
};
const errors = ref({});

const submit = () => {
  form.post(route("certificate.store"), {
    preserveScroll: true,
    onSuccess: () => {
      toast.success("Certificate Created Successfully");
      form.reset();
      errors.value = {}; 
    },
    onError: (err) => {
      console.log(err); 
      errors.value = err 
      toast.error("Error: " + (err.response?.data?.message || 'An error occurred while processing your request.'));
    },
  });
};

</script>
  
  <style scoped>
</style>
  