<template>
  <Head title="Edit News" />
  <AdminLayout :setting="props.setting" :user="props.user" :permissions="props.permissions">
    <div class="container-xxl flex-grow-1 container-p-y">
      <h4 class="fw-bold py-3 mb-4">
        <span class="text-muted fw-light">Home /</span> News / Edit
      </h4>
      <div class="row">
        <div class="col-xl">
          <div class="card mb-4">
            <div
              class="card-header d-flex justify-content-between align-items-center"
            >
              <h5 class="mb-0">Edit News</h5>
              <small class="text-muted float-end">Edit existing news</small>
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
                      alt="News Image Preview"
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
                        Allowed JPG, GIF, or PNG. Max size of 1MB. <br />
                        <span class="text-warning"
                          >Recommended dimensions: 900 x 643 pixels.</span
                        ><br>
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
                      <label for="title" class="form-label">Title</label>
                      <input
                        type="text"
                        class="form-control"
                        id="title"
                        v-model="form.title"
                        placeholder="Enter the news title"
                      />
                      <div v-if="errors.title" class="text-danger mt-2">
                        {{ errors.title }}
                      </div>
                    </div>
                  </div>

                  <div class="col-md-4">
                    <div class="mb-3">
                      <label for="tags" class="form-label"
                        >Tags (Comma Separated)</label
                      >
                      <input
                        type="text"
                        class="form-control"
                        id="tags"
                        v-model="form.tags"
                        placeholder="Business, "
                      />
                      <div v-if="errors.tags" class="text-danger mt-2">
                        {{ errors.tags }}
                      </div>
                    </div>
                  </div>
                  <!-- Toggle for is_published -->
                  <div class="col-md-2 d-flex align-items-center">
                    <div class="form-check form-switch mb-2">
                      <input
                        class="form-check-input"
                        type="checkbox"
                        id="flexSwitchCheckChecked"
                        v-model="form.is_published"
                      />
                      <label
                        class="form-check-label"
                        for="flexSwitchCheckChecked"
                      >
                        Published
                      </label>
                    </div>
                  </div>

                  <div class="col-md-12">
                    <div class="mb-3">
                      <!-- Bind the description to the TextEditor -->
                      <TextEditor v-model="form.description" />
                      <div v-if="errors.description" class="text-danger mt-2">
                        {{ errors.description }}
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
                    <i class="bx bx-save"></i> Save Changes
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
import { Head, useForm, usePage } from "@inertiajs/vue3";
import { ref } from "vue";
import { useToast } from "vue-toastification";
import TextEditor from "@/Components/Admin/TextEditor.vue";

const toast = useToast();

const props = defineProps({
  news: {
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
  permissions:{
    type:Array, 
    required:true, 
  }
});

// Initialize the form with the current values from the news object
const form = useForm({
  title: props.news.title || "",
  description: props.news.content || "",
  tags: props.news.tags || "",
  image: null, // Image will be handled separately
  is_published:
    props.news.is_published === 1 || props.news.is_published === true, // Convert to boolean
});

// Track any validation errors
const errors = ref({});

// Initialize image preview
const imagePreview = ref(
  props.news.image ? `/storage/${props.news.image}` : null
);

// Handle image upload
const handleImageUpload = (event) => {
  const file = event.target.files[0];
  if (file) {
    if (file.size > 1048576) {
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

// Reset the image
const resetImage = () => {
  form.image = null;
  imagePreview.value = null;
};

// Cancel the edit and go back
const cancel = () => {
  window.history.back();
};

// Handle form submission
const submit = () => {
  form.post(route("news.update", props.news.id), {
    preserveScroll: true,
    onSuccess: () => {
      toast.success("News updated successfully");
    },
    onError: (err) => {
      errors.value = err; 
      toast.error('Error occurred while processing the form!');
    },
  });
};
</script>
  
  <style scoped>
</style>
  