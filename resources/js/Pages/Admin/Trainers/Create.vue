<template>
  <Head title="Create Trainer" />
  <AdminLayout :setting="props.setting" :user="props.user" :permissions="props.permissions">
    <div class="container-xxl flex-grow-1 container-p-y">
      <h4 class="fw-bold py-3 mb-4">
        <span class="text-muted fw-light">Home /</span> Trainers / Create
      </h4>
      <div class="row">
        <div class="col-xl">
          <div class="card mb-4">
            <div
              class="card-header d-flex justify-content-between align-items-center"
            >
              <h5 class="mb-0">Create Trainer</h5>
              <small class="text-muted float-end">Add a new trainer</small>
            </div>
            <div class="card-body">
              <form @submit.prevent="submit">
                <div class="card-body">
                  <div
                    class="d-flex align-items-start align-items-sm-center gap-4"
                  >
                    <img
                      v-if="imagePreview"
                      :src="imagePreview"
                      alt="Trainer Image Preview"
                      class="d-block rounded"
                      style="width: 100px; height: 100px; object-fit: cover"
                      id="uploadedImage"
                    />
                    <div class="button-wrapper">
                      <label for="upload" class="btn btn-primary me-2 mb-4">
                        <span class="d-none d-sm-block">Upload Image</span>
                        <i class="bx bx-upload d-block d-sm-none"></i>
                        <input
                          type="file"
                          id="upload"
                          hidden
                          accept="image/png, image/jpeg"
                          @change="handleImageUpload"
                        />
                      </label>

                      <button
                        type="button"
                        class="btn btn-outline-secondary mb-4"
                        @click="resetImage"
                      >
                        <i class="bx bx-reset d-block d-sm-none"></i>
                        <span class="d-none d-sm-block">Reset</span>
                      </button>
                      <p class="text-muted mb-0">
                        Allowed formats: JPG, PNG. Max size: 1MB. <br />
                        <span class="text-warning"
                          >Recommended dimensions: 400 x 400 pixels.</span
                        >
                      </p>
                      <small v-if="errors.image" class="text-danger">{{
                        errors.image
                      }}</small>
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-md-4">
                    <div class="mb-3">
                      <label for="name" class="form-label">Name</label>
                      <input
                        type="text"
                        class="form-control"
                        id="name"
                        v-model="form.name"
                        placeholder="Enter trainer's name"
                      />
                      <small v-if="errors.name" class="text-danger">{{
                        errors.name
                      }}</small>
                    </div>
                  </div>
                  <div class="col-md-4">
                    <div class="mb-3">
                      <label for="position" class="form-label">Position</label>
                      <input
                        type="text"
                        class="form-control"
                        id="position"
                        v-model="form.position"
                        placeholder="Enter position"
                      />
                      <small v-if="errors.position" class="text-danger">{{
                        errors.position
                      }}</small>
                    </div>
                  </div>
                  <!-- Toggle for show_on_home -->
                  <div class="col-md-2 d-flex align-items-center">
                    <div class="form-check form-switch mb-2">
                      <input
                        class="form-check-input"
                        type="checkbox"
                        id="flexSwitchCheckChecked"
                        v-model="form.show_on_home"
                      />
                      <label
                        class="form-check-label"
                        for="flexSwitchCheckChecked"
                      >
                        Show On Home
                      </label>
                    </div>
                  </div>

                  <div class="col-md-4">
                    <div class="mb-3">
                      <label for="email" class="form-label">Email</label>
                      <input
                        type="email"
                        class="form-control"
                        id="email"
                        v-model="form.email"
                        placeholder="Enter email"
                      />
                      <small v-if="errors.email" class="text-danger">{{
                        errors.email
                      }}</small>
                    </div>
                  </div>
                  <div class="col-md-4">
                    <div class="mb-3">
                      <label for="phone" class="form-label">Phone</label>
                      <input
                        type="text"
                        class="form-control"
                        id="phone"
                        v-model="form.phone"
                        placeholder="Enter phone number"
                      />
                      <small v-if="errors.phone" class="text-danger">{{
                        errors.phone
                      }}</small>
                    </div>
                  </div>
                  <div class="col-md-4">
                    <div class="mb-3">
                      <label for="name" class="form-label">Service</label>
                      <div class="position-relative">
                        <select class="form-select" v-model="form.service_id">
                          <option value="" disabled>
                            -- Select Service --
                          </option>
                          <option
                            v-for="service in props.services"
                            :key="service.id"
                            :value="service.id"
                          >
                            {{ service.title }}
                          </option>
                        </select>
                      </div>

                      <div v-if="errors.service_id" class="text-danger mt-2">
                        {{ errors.service_id }}
                      </div>
                    </div>
                  </div>
                  <div class="col-md-12">
                    <div class="mb-3">
                      <label for="skills" class="form-label">Skills</label>
                      <input
                        type="text"
                        class="form-control"
                        id="skills"
                        v-model="form.skills"
                        placeholder='Example: {"Consulting": 75, "Management": 90}'
                      />
                      <small v-if="errors.skills" class="text-danger">{{
                        errors.skills
                      }}</small>
                    </div>
                  </div>
                  <div class="col-md-12">
                    <div class="mb-3">
                      <label for="description" class="form-label"
                        >Description</label
                      >
                      <TextEditor
                        id="description"
                        v-model="form.description"
                        rows="5"
                      ></TextEditor>
                      <small v-if="errors.description" class="text-danger">{{
                        errors.description
                      }}</small>
                    </div>
                  </div>
                </div>
                <div class="d-flex justify-content-end gap-3 mt-4">
                  <button
                    type="button"
                    class="btn btn-outline-secondary"
                    @click="cancel"
                  >
                    Cancel
                  </button>
                  <button type="submit" class="btn btn-primary">
                    <i class="bx bx-save"></i> Add Trainer
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
import { Head, useForm } from "@inertiajs/vue3";
import { ref } from "vue";
import { useToast } from "vue-toastification";
import TextEditor from "@/Components/Admin/TextEditor.vue";

const toast = useToast();
const props = defineProps({
  setting: {
    type: Object,
    required: true,
  },
  user: {
    type: Object,
    required: true,
  },
  services: {
    type: Object,
    required: true,
  },
  permissions:{
    type:Array, 
    required:true, 
  }
});

const form = useForm({
  name: "",
  position: "",
  email: "",
  phone: "",
  image: null,
  description: "",
  skills: "",
  service_id: "",
  show_on_home: false,  
});


const imagePreview = ref(null);

const handleImageUpload = (event) => {
  const file = event.target.files[0];
  if (file) {
    form.image = file;
    const reader = new FileReader();
    reader.onload = (e) => {
      imagePreview.value = e.target.result;
    };
    reader.readAsDataURL(file);
  }
};
const errors = ref({});
const resetImage = () => {
  form.image = null;
  imagePreview.value = null;
};

const cancel = () => {
  window.history.back();
};

const submit = () => {
  console.log(form);  // Debugging line to check the form data

  form.post(route("trainers.store"), {
    preserveScroll: true,
    onSuccess: () => {
      toast.success("Trainer Created Successfully");
      form.reset();
      resetImage();
    },
    onError: (err) => {
      errors.value = err;
      toast.error("Error occurred while processing the form!");
    },
  });
};

</script>
  
  <style scoped>
</style>
  