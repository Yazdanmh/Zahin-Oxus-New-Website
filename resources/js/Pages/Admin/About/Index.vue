<template>
  <Head title="About" />
  <AdminLayout :setting="props.setting" :user="props.user" :permissions="props.permissions">
    <div class="container-xxl flex-grow-1 container-p-y">
      <h4 class="fw-bold py-3 mb-4">
        <span class="text-muted fw-light">Home /</span> About
      </h4>
      <div class="row">
        <div class="col-xl">
          <div class="card mb-4">
            <div class="card-header d-flex justify-content-between align-items-center">
              <h5 class="mb-0">About</h5>
              <small class="text-muted float-end">Manage About Section</small>
            </div>
            <div class="card-body">
              <form @submit.prevent="submit">
                <div class="card-body">
                  <!-- First Image Preview -->
                  <div class="d-flex align-items-start align-items-sm-center gap-4">
                    <img
                      :src="imagePreviewOne || '/storage/' + (props.about?.image_one || '')"
                      alt="Image One"
                      class="d-block rounded"
                      style="width: 150px; height: 150px; object-fit: contain"
                    />
                    <div v-if="hasPermission('site_data.edit')" class="button-wrapper">
                      <label for="upload-one" class="btn btn-primary me-2 mb-4">
                        <span class="d-none d-sm-block">Upload Image One</span>
                        <i class="bx bx-upload d-block d-sm-none"></i>
                        <input
                          type="file"
                          id="upload-one"
                          hidden
                          accept="image/png, image/jpeg, image/gif"
                          @change="handleImageOneUpload"
                        />
                      </label>
                      <p class="text-muted mb-0">
                        Allowed JPG, GIF, or PNG. Max size of 1MB 511 X 388. <br>
                        <span class="text-warning">Recommended dimensions: 511 x 338 pixels.</span><br>
                        <span v-if="errors.image_one" class="text-danger mt-2">
                          {{ errors.image_one }}
                        </span>
                      </p>
                    </div>
                  </div>

                  <!-- Second Image Preview -->
                  <div class="d-flex align-items-start align-items-sm-center gap-4 mt-3">
                    <img
                      :src="imagePreviewTwo || '/storage/' + (props.about?.image_two || '')"
                      alt="Image Two"
                      class="d-block rounded"
                      style="width: 150px; height: 150px; object-fit: contain; border-radius:10px;"
                    />
                    <div v-if="hasPermission('site_data.edit')" class="button-wrapper">
                      <label for="upload-two" class="btn btn-primary me-2 mb-4">
                        <span class="d-none d-sm-block">Upload Image Two</span>
                        <i class="bx bx-upload d-block d-sm-none"></i>
                        <input
                          type="file"
                          id="upload-two"
                          hidden
                          accept="image/png, image/jpeg, image/gif"
                          @change="handleImageTwoUpload"
                        />
                      </label>
                      <p class="text-muted mb-0">
                        Allowed JPG, GIF, or PNG. Max size of 1MB 357 X 228. <br>
                        <span class="text-warning">Recommended dimensions: 357 x 228 pixels.</span> <br>
                        <span v-if="errors.image_two" class="text-danger mt-2">
                          {{ errors.image_two }}
                        </span>
                      </p>
                    </div>
                  </div>
                </div>

                <!-- Form Fields -->
                <div class="row">
                  <div class="col-md-4">
                    <div class="mb-3">
                      <label for="title" class="form-label">Title</label>
                      <input
                        type="text"
                        class="form-control"
                        id="title"
                        v-model="form.title"
                      />
                      <span v-if="errors.title" class="text-danger mt-2">
                          {{ errors.title }}
                        </span>
                    </div>
                  </div>
                  <div class="col-md-8">
                    <div class="mb-3">
                      <label for="features" class="form-label">Features (Comma Separated)</label>
                      <input
                        class="form-control"
                        type="text"
                        id="features"
                        v-model="form.features"
                      />
                      <span v-if="errors.features" class="text-danger mt-2">
                          {{ errors.features }}
                        </span>
                    </div>
                  </div>
                  <div class="col-md-12">
                    <div class="mb-3">
                      <label for="description" class="form-label">Description</label>
                      <textarea
                        class="form-control"
                        id="description"
                        v-model="form.description"
                        rows="5"
                      ></textarea>
                      <span v-if="errors.description" class="text-danger mt-2">
                          {{ errors.description }}
                        </span>
                    </div>
                  </div>
                </div>

                <button v-if="hasPermission('site_data.edit')" type="submit" class="btn btn-primary">
                  Update About
                </button>
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
  about: {
    type: Object,
    required: true,
  },
  setting: {
    type: Object,
    required: true,
  },
  user: {
    type: Object,
    required: true,
  },
  permissions: {
    type: Array,
    required: true,
  }
});

const toast = useToast();
const errors = ref({});

// Use optional chaining (?.) and provide fallback/default values
const form = useForm({
  title: props.about?.title || "", // Default to empty string if undefined
  description: props.about?.description || "", // Default to empty string if undefined
  features: props.about?.features || "", // Default to empty string if undefined
  image_one: null,
  image_two: null,
});

const imagePreviewOne = ref(null);
const imagePreviewTwo = ref(null);

// Handle image upload and preview
const handleImageOneUpload = (event) => {
  const file = event.target.files[0];
  if (file) {
    form.image_one = file;
    const reader = new FileReader();
    reader.onload = (e) => {
      imagePreviewOne.value = e.target.result;
    };
    reader.readAsDataURL(file);
  }
};

const handleImageTwoUpload = (event) => {
  const file = event.target.files[0];
  if (file) {
    form.image_two = file;
    const reader = new FileReader();
    reader.onload = (e) => {
      imagePreviewTwo.value = e.target.result;
    };
    reader.readAsDataURL(file);
  }
};

// Submit form
const submit = () => {
  if (!form.image_one) delete form.image_one;
  if (!form.image_two) delete form.image_two;
  form.post(route("about.update"), {
    preserveScroll: true,
    onSuccess: () => {
      toast.success("About Section Updated Successfully");
    },
    onError: (err) => {
      errors.value = err;
      toast.error("Error occurred while processing the form!");
    }
  });
};

// Check if user has permission
const hasPermission = (permission) => {
  return props.permissions.includes(permission);
};
</script>


<style scoped></style>
