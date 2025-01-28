<template>
    <Head title="Create Gallery" />
    <AdminLayout>
      <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="fw-bold py-3 mb-4">
          <span class="text-muted fw-light">Home /</span> Gallery / Create
        </h4>
        <div class="row">
          <div class="col-xl">
            <div class="card mb-4">
              <div class="card-header d-flex justify-content-between align-items-center">
                <h5 class="mb-0">Create Gallery</h5>
                <small class="text-muted float-end">Add a new Image</small>
              </div>
              <div class="card-body">
                <form @submit.prevent="submit">
                  <div class="card-body">
                    <div class="d-flex align-items-start align-items-sm-center gap-4">
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
                        <label for="title" class="form-label">Title</label>
                        <input
                          type="text"
                          class="form-control"
                          id="title"
                          v-model="form.title"
                          placeholder="Enter the title"
                        />
                        <div v-if="errors.title" class="text-danger mt-2">
                          {{ errors.title }}
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
                      <i class="bx bx-save"></i> Add Image
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
  
  const form = useForm({
    title: "",
    image: null,
  });
  
  const errors = ref({});
  const imagePreview = ref(null);
  
  const handleImageUpload = (event) => {
    const file = event.target.files[0];
    if (file) {
      if (file.size > 1048576) {
        toast.error("File size exceeds the 1MB limit.");
        return;
      }
      if (!file.type.startsWith("image/")) {
        toast.error("Invalid file type. Only images are allowed.");
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
    errors.value.image = null; // Clear image-related errors
  };
  
  const cancel = () => {
    window.history.back();
  };
  
  const validateForm = () => {
    errors.value = {};
    if (!form.title) {
      errors.value.title = "Title is required";
    }
    return Object.keys(errors.value).length === 0;
  };
  
  const submit = () => {
    if (!validateForm()) {
      return;
    }
    form.post(route("galleries.store"), {
      preserveScroll: true,
      onSuccess: () => {
        toast.success("Gallery Image Added Successfully");
      },
      onError: (err) => {
        if (err.response?.data?.errors) {
          errors.value = err.response.data.errors;
        } else {
          toast.error("An error occurred: " + (err.message || "Unknown error"));
        }
      },
    });
  };
  </script>
  
  <style scoped>
  </style>
  