<template>
    <Head :title="`Edit Service - ${service.title}`" />
    <AdminLayout>
      <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="fw-bold py-3 mb-4">
          <span class="text-muted fw-light">Home /</span> Services / Edit Service
        </h4>
  
        <div class="row">
          <div class="col-md-12">
            <div class="card mb-4">
              <div class="card-header">
                <h5 class="mb-0">Edit Service</h5>
              </div>
              <div class="card-body">
                <form @submit.prevent="submitForm">
                  <div class="row">
                    <div class="col-md-4">
                      <div class="mb-3">
                        <label for="subtitle" class="form-label">Service Subtitle</label>
                        <input
                          type="text"
                          id="subtitle"
                          class="form-control"
                          v-model="form.subtitle"
                          placeholder="Enter service subtitle"
                        />
                        <div v-if="form.errors.subtitle" class="text-danger mt-2">
                          {{ form.errors.subtitle }}
                        </div>
                      </div>
                    </div>
                    <div class="col-md-8">
                      <div class="mb-3">
                        <label for="title" class="form-label">Service Title</label>
                        <input
                          type="text"
                          id="title"
                          class="form-control"
                          v-model="form.title"
                          placeholder="Enter service title"
                        />
                        <div v-if="form.errors.title" class="text-danger mt-2">
                          {{ form.errors.title }}
                        </div>
                      </div>
                    </div>
                  </div>
  
                  <div class="mb-3">
                    <label for="description" class="form-label">Description</label>
                    <textarea
                      id="description"
                      class="form-control"
                      v-model="form.description"
                      placeholder="Enter service description"
                      rows="4"
                    ></textarea>
                    <div v-if="form.errors.description" class="text-danger mt-2">
                      {{ form.errors.description }}
                    </div>
                  </div>
  
                  <div class="mb-3">
                    <label for="icon" class="form-label">Service Icon</label>
                    <div class="d-flex align-items-center">
                      <input
                        type="text"
                        id="icon"
                        class="form-control me-2"
                        v-model="form.icon"
                        placeholder="Enter icon class (e.g., bx bx-heart)"
                      />
                      <span v-if="form.icon" :class="form.icon" class="icon-preview me-2"></span>
                      <a href="https://boxicons.com/" target="_blank" class="btn btn-primary btn-sm ms-2">
                        View All Icons
                      </a>
                    </div>
                    <div v-if="form.errors.icon" class="text-danger mt-2">
                      {{ form.errors.icon }}
                    </div>
                  </div>
  
                  <div class="mb-3">
                    <label for="image" class="form-label">Service Image</label>
                    <div class="d-flex align-items-center">
                      <input
                        type="file"
                        id="image"
                        class="form-control me-2 form-control-sm"
                        accept="image/*"
                        @change="handleImageUpload"
                      />
                      <div
                        v-if="imagePreview || service.image"
                        class="image-preview-container ms-2"
                      >
                        <img
                          :src="imagePreview || (service.image ? `/storage/${service.image}` : '/images/placeholder.png')"
                          alt="Image Preview"
                          class="img-fluid large-preview"
                        />
                      </div>
                    </div>
                    <div v-if="form.errors.image" class="text-danger mt-2">
                      {{ form.errors.image }}
                    </div>
                  </div>
  
                  <div class="d-flex justify-content-end">
                    <button type="submit" class="btn btn-primary">Update Service</button>
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
  import { useForm } from "@inertiajs/vue3";
  import { ref } from "vue";
  import AdminLayout from "@/Layouts/AdminLayout.vue";
  import { Head } from "@inertiajs/vue3";
  import { useToast } from "vue-toastification";
  
  const toast = useToast();
  
  // Props
  const props = defineProps({
    service: {
      type: Object,
      required: true,
    },
  });
  
  const form = useForm({
    title: props.service.title || "",
    subtitle: props.service.subtitle || "",
    description: props.service.description || "",
    icon: props.service.icon || "",
    image: null,
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
  
  const submitForm = () => {
    const data = new FormData();
  
    // Append each form field individually
    data.append("title", form.title);
    data.append("subtitle", form.subtitle);
    data.append("description", form.description);
    data.append("icon", form.icon);
  
    // Check if the image has been changed and append it
    if (form.image) {
      console.log("Appending image:", form.image); // Debugging: Log the image file
      data.append("image", form.image);
    } else {
      console.log("No image selected, skipping image field.");
    }
  
    // Send the request with the form data
    form.put(route("services.update", props.service.id), {
      data,
      preserveScroll: true,
      onSuccess: () => {
        toast.success("Service Updated Successfully");
      },
      onError: (err) => {
        toast.error("Error: " + err.message);
      },
    });
  };
  </script>
  
  
  <style scoped>
  .icon-preview {
    font-size: 30px;
    color: #495057;
    line-height: 1;
  }
  
  .image-preview-container {
    max-width: 150px;
    max-height: 150px;
  }
  
  .large-preview {
    width: 150px;
    height: 150px;
    object-fit: cover;
  }
  
  .form-control-sm {
    height: 30px;
  }
  
  .btn-sm {
    font-size: 12px;
  }
  </style>
  