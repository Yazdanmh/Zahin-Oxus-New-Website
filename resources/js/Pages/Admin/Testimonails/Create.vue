<template>
  <Head title="Create Testimonial" />
  <AdminLayout :setting="props.setting" :user="props.user" :permissions="props.permissions">
    <div class="container-xxl flex-grow-1 container-p-y">
      <h4 class="fw-bold py-3 mb-4">
        <span class="text-muted fw-light">Home /</span> Testimonial / Create
      </h4>
      <div class="row">
        <div class="col-xl">
          <div class="card mb-4">
            <div
              class="card-header d-flex justify-content-between align-items-center"
            >
              <h5 class="mb-0">Create Testimonial</h5>
              <small class="text-muted float-end">Add a new Testimonial</small>
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
                      alt="Testimonial Image Preview"
                      class="d-block rounded"
                      style="width: 300px; height: 100px; object-fit: cover"
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
                          accept="image/png, image/jpeg, image/gif"
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
                        Allowed JPG, GIF, or PNG. Max size of 1MB. <br>
                        <span class="text-warning">Recommended dimensions: 100 x 100 pixels.</span>
                        <br>
                        <span v-if="errors.image" class="text-danger mt-2">
                          {{ errors.image }}
                        </span>
                      </p>
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
                        placeholder="Enter testimonial name"
                      />
                      <div v-if="errors.name" class="text-danger mt-2">
                        {{ errors.name }}
                      </div>
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
                      <div v-if="errors.position" class="text-danger mt-2">
                        {{ errors.position }}
                      </div>
                    </div>
                  </div>

                  <div class="col-md-4">
                    <div class="mb-3">
                      <label for="stars" class="form-label">Stars</label>
                      <input
                        type="number"
                        class="form-control"
                        id="stars"
                        v-model="form.stars"
                        placeholder="Enter number of stars"
                      />
                      <div v-if="errors.stars" class="text-danger mt-2">
                        {{ errors.stars }}
                      </div>
                    </div>
                  </div>
                  <div class="col-md-12">
                    <div class="mb-3">
                      <label for="message" class="form-label"> Message </label>
                      <textarea
                        class="form-control"
                        id="message"
                        rows="3"
                        v-model="form.message"
                        placeholder="Enter testimonial message"
                      ></textarea>
                      <div v-if="errors.message" class="text-danger mt-2">
                        {{ errors.message }}
                      </div>
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
                    <i class="bx bx-save"></i> Add Testimonial
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
import { ref } from "vue";
import { useForm } from "@inertiajs/vue3";
import { useToast } from "vue-toastification";

const props = defineProps({
  setting: {
    type: Object,
    required: true,
  },
  user: {
    type: Object,
    required: true,
  },
  permissions:{
    type:Array, 
    required:true, 
  }
});
const toast = useToast();

const form = useForm({
  name: "",
  position: "",
  message: "",
  stars: "",
  image: null,
});

const errors = ref({});
const imagePreview = ref(null);

const handleImageUpload = (event) => {
  const file = event.target.files[0];
  if (file) {
    if (file.size > 1048576) {
      // 1MB in bytes
      toast.error("File size exceeds the 1MB limit.");
      return;
    }
    form.image = file;
    const reader = new FileReader();
    reader.onload = (e) => {
      imagePreview.value = e.target.result;
    };
    reader.readAsDataURL(file);
  }
};

const resetImage = () => {
  form.image = null;
  imagePreview.value = null;
};

const cancel = () => {
  window.history.back(); // Navigate to the previous page
};

const validateForm = () => {
  errors.value = {}; // Reset errors
  if (!form.name) {
    errors.value.name = "Name is required";
  }
  if (!form.message) {
    errors.value.message = "Message is required";
  }
  if (!form.stars) {
    errors.value.stars = "Stars are required";
  }
  if (!form.position) {
    errors.value.position = "Position is required";
  }
  return Object.keys(errors.value).length === 0;
};

const submit = () => {
  if (!validateForm()) {
    return;
  }
  form.post(route("testimonails.store"), {
    preserveScroll: true,
    onSuccess: () => {
      toast.success("Testimonial Created Successfully");
    },
    onError: (err) => {
      errors.value = err;
      toast.error("Error occured while processing the form!");
    },
  });
};
</script>
  
  <style scoped>
</style>
  