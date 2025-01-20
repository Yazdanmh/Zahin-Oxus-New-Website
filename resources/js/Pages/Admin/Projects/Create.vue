<template>
  <Head title="Create Project" />
  <AdminLayout>
    <div class="container-xxl flex-grow-1 container-p-y">
      <h4 class="fw-bold py-3 mb-4">
        <span class="text-muted fw-light">Home /</span> Project / Create
      </h4>
      <div class="row">
        <div class="col-xl">
          <div class="card mb-4">
            <div
              class="card-header d-flex justify-content-between align-items-center"
            >
              <h5 class="mb-0">Create Project</h5>
              <small class="text-muted float-end">Add a new Project</small>
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
                      alt="Project Image Preview"
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
                        Allowed JPG, GIF, or PNG. Max size of 1MB.
                      </p>
                    </div>
                  </div>
                  <div v-if="errors.image" class="text-danger mt-2">
                    {{ errors.image }}
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
                        placeholder="Enter project name"
                      />
                      <div v-if="errors.name" class="text-danger mt-2">
                        {{ errors.name }}
                      </div>
                    </div>
                  </div>
                  <div class="col-md-4">
                    <div class="mb-3">
                      <label for="category_id" class="form-label"
                        >Category</label
                      >
                      <select
                        id="category_id"
                        class="form-select"
                        v-model="form.category_id"
                      >
                        <option>Select Category</option>
                        <option
                          v-for="category in categories"
                          :key="category.id"
                          :value="category.id"
                        >
                          {{ category.title }}
                        </option>
                      </select>

                      <div v-if="errors.category_id" class="text-danger mt-2">
                        {{ errors.category_id }}
                      </div>
                    </div>
                  </div>
                  <div class="col-md-4 d-flex align-items-center">
                    <Link
                      :href="route('categories.index')"
                      class="btn btn-link btn-sm"
                     
                    >
                      <i class="bx bx-cog"></i> Manage Categories
                    </Link>
                  </div>
                  <div class="col-md-12">
                    <div class="mb-3">
                      <label for="description" class="form-label"
                        >Description</label
                      >
                      <textarea
                        class="form-control"
                        id="description"
                        rows="3"
                        v-model="form.description"
                        placeholder="Enter project description"
                      ></textarea>
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
                    <i class="bx bx-save"></i> Add Project
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
import { Head, useForm, Link } from "@inertiajs/vue3";
import { ref } from "vue";
import { useToast } from "vue-toastification";

const toast = useToast();

const props = defineProps({
  categories: {
    type: Array,
    required: true,
  },
});

const form = useForm({
  name: "",
  description: "",
  category_id: null,
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
  if (!form.description) {
    errors.value.description = "Description is required";
  }
  if (!form.category_id) {
    errors.value.category_id = "Category is required";
  }
  return Object.keys(errors.value).length === 0;
};

const submit = () => {
  if (!validateForm()) {
    return;
  }
  form.post(route("projects.store"), {
    preserveScroll: true,
    onSuccess: () => {
      toast.success("Project Created Successfully");
    },
    onError: (err) => {
      if (err.response && err.response.data && err.response.data.errors) {
        errors.value = err.response.data.errors; // Set the errors to be displayed
      } else {
        toast.error("An error occurred: " + (err.message || "Unknown error"));
      }
    },
  });
};
</script>
  
  <style scoped>
</style>
  