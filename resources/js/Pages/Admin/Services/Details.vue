<template>
  <Head title="Service Details" />
  <AdminLayout>
    <div class="container-xxl flex-grow-1 container-p-y">
      <h4 class="fw-bold py-3 mb-4">
        <span class="text-muted fw-light">Home /</span> Services / Details
      </h4>
      <div class="row">
        <div class="col-xl">
          <div class="card mb-4">
            <div
              class="card-header d-flex justify-content-between align-items-center"
            >
              <h5 class="mb-0">Service Details</h5>
              <small class="text-muted float-end"
                >View service information</small
              >
            </div>
            <div class="card-body">
              <!-- Image section on top -->
              <div class="text-center mb-4">
                <img
                  :src="'/storage/' + service.image"
                  alt="Service Image"
                  class="d-block rounded"
                  style="width: 150px; height: 100px; object-fit: cover"
                />
              </div>

              <!-- Details section -->
              <div class="row">
                <div class="col-md-6">
                  <h6 class="text-muted">Title</h6>
                  <p class="fs-5">{{ service.title }}</p>
                </div>
                <div class="col-md-6">
                  <h6 class="text-muted">Subtitle</h6>
                  <p class="fs-5">{{ service.subtitle }}</p>
                </div>
                <div class="col-md-12">
                  <h6 class="text-muted">Description</h6>
                  <p>{{ service.description }}</p>
                </div>
                <div class="col-md-6">
                  <h6 class="text-muted">Icon</h6>
                  <i :class="service.icon" style="font-size: 2rem"></i>
                  <p class="mt-2">{{ service.icon }}</p>
                </div>
              </div>

              <!-- Action buttons -->
              <div class="d-flex justify-content-end gap-3 mt-4">
                <button
                  type="button"
                  class="btn btn-outline-secondary"
                  @click="goBack"
                >
                   Back
                </button>
                
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </AdminLayout>
</template>
  
  <script setup>
import AdminLayout from "@/Layouts/AdminLayout.vue";
import { Head, Link } from "@inertiajs/vue3";
import { usePage } from "@inertiajs/vue3";

const { props } = usePage();
const service = props.service; // Assume service data is passed as a prop from the backend

const goBack = () => {
  window.history.back(); // Navigate to the previous page
};

</script>
  
  <style scoped>
</style>
  