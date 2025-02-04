<template>
  <AdminLayout>
    <div class="container-xxl flex-grow-1 container-p-y">
      <h4 class="fw-bold py-3 mb-4">
        <span class="text-muted fw-light">Settings/</span> Edit
      </h4>

      <div class="row">
        <div class="container">
          <h1>Edit Website Settings</h1>
          <form @submit.prevent="submit">
            <div class="form-group mb-3">
              <label for="websiteName">Website Name</label>
              <input
                type="text"
                id="websiteName"
                class="form-control"
                v-model="form.website_name"
                placeholder="Enter website name"
                required
              />
              <div v-if="errors.website_name" class="text-danger">
                {{ errors.website_name }}
              </div>
            </div>

            <div class="form-group mb-3">
              <label for="websiteLogo">Website Logo</label>
              <div class="mb-2">
                <img
                  :src="imagePreview || '/storage/' + props.settings.site_logo"
                  alt="Website Logo"
                  class="img-thumbnail"
                  style="max-width: 200px"
                />
              </div>
              <!-- Hidden file input -->
              <input
                type="file"
                id="websiteLogo"
                class="form-control d-none"
                @change="handleImageUpload"
                accept="image/*"
                ref="fileInput"
              />
              <button
                type="button"
                class="btn btn-secondary"
                @click="triggerFileInput"
              >
                Upload New Logo
              </button>
              
              <div v-if="errors.logo" class="text-danger">
                {{ errors.logo }}
              </div>
            </div>

            <button type="submit" class="btn btn-primary">
              Update Settings
            </button>
          </form>
        </div>
      </div>
    </div>
  </AdminLayout>
</template>

<script setup>
import AdminLayout from "@/Layouts/AdminLayout.vue";
import { ref } from "vue";
import { useForm } from "@inertiajs/vue3";

const props = defineProps({
  settings: {
    type: Object,
    required: true,
  },
});

const form = useForm({
  website_name: props.settings.site_name,
  logo: null,
});

const errors = ref({});
const imagePreview = ref(null);
const fileInput = ref(null);

// Trigger file input click
const triggerFileInput = () => {
  fileInput.value.click();
};

// Handle image upload and preview
const handleImageUpload = (event) => {
  const file = event.target.files[0];
  if (file) {
    form.logo = file;
    const reader = new FileReader();
    reader.onload = (e) => {
      imagePreview.value = e.target.result;
    };
    reader.readAsDataURL(file);
  }
};

const submit = () => {
  if (!form.logo) {
    delete form.logo;
  }

  form.post(route("settings.update"), {
    preserveScroll: true,
  });
};
</script>
