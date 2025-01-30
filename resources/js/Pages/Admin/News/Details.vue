<template>
    <Head title="News Detials" />
    <AdminLayout :setting="props.setting" :user="props.user">
      <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="fw-bold py-3 mb-4">
          <span class="text-muted fw-light">Home /</span> News / Details
        </h4>
        <div class="row">
          <!-- Main Details Card -->
          <div class="col-lg-12">
            <div class="card">
              <div
                class="card-header d-flex justify-content-between align-items-center"
              >
                <h5 class="mb-0">News  Details</h5>
                <Link
                  :href="route('news.create')"
                  class="btn btn-primary btn-sm"
                >
                  <i class="bx bx-edit"></i> Create News
                </Link>
              </div>
              <div class="card-body">
                <div class="row">
                  <!-- Image Section (Optional) -->
                  <div class="col-md-4 mb-3" v-if="props.news.image">
                    <div class="image-container">
                      <img
                        :src="`/storage/${props.news.image}`"
                        alt="Training Image"
                        class="img-fluid rounded"
                      />
                    </div>
                  </div>
                  <div v-else class="col-md-4 mb-3">
                    <p class="text-muted">No image available</p>
                  </div>
    
                  <!-- Training Details Section in Two Columns -->
                  <div class="col-md-6">
                    <div class="row">
                      <div class="col-md-6 mb-3">
                        <h6 class="fw-bold">Title:</h6>
                        <p class="text-muted">{{ props.news.title || "Untitled" }}</p>
                      </div>
                      <div class="col-md-6 mb-3">
                        <h6 class="fw-bold">Status:</h6>
                        <p class="text-muted">
                          <i
                            :class="[props.news.is_published ? 'bx bx-check-circle text-success' : 'bx bx-x-circle text-danger']"
                          ></i>
                          {{ props.news.is_published ? "Published" : "Drafted" }}
                        </p>
                      </div>
                      <div class="col-md-6 mb-3">
                        <h6 class="fw-bold">Tags:</h6>
                        <p class="text-muted">{{ props.news.tags || "Untitled" }}</p>
                      </div>
    
                      
                    </div>
                  </div>
    
                  <!-- Description Section -->
                  <div class="col-md-12">
                    <div class="mb-3">
                      <h6 class="fw-bold">Description:</h6>
                      <p class="text-muted" v-html="props.news.content"></p>
                    </div>
                  </div>
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
  
  const props = defineProps({
    news: Object, // Ensure the training has appropriate fields such as name, start_date, etc.
    setting:{
    type:Object, 
    required:true, 
  },
  user:{
    type:Object, 
    required:true, 
  },
  });
  </script>
  
  <style scoped>
  .card img {
    border: 1px solid #eaeaea;
  }
  
  .card-body h6 {
    font-weight: bold;
  }
  
  .card-body p {
    margin-bottom: 0;
  }
  
  .image-container img {
    width: 100%;
    height: auto;
    object-fit: cover;
  }
  
  /* Ensure responsive design */
  @media (max-width: 768px) {
    .card-body .row {
      flex-direction: column;
    }
  
    .card-body .col-md-4,
    .card-body .col-md-6 {
      margin-bottom: 15px;
    }
  
    .card-body .col-md-12 {
      padding-left: 0;
    }
  }
  </style>
  