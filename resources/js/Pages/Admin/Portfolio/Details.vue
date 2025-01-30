<template>
  <Head title="Portfolio Details" />
  <AdminLayout :setting="props.setting" :user="props.user">
    <div class="container-xxl flex-grow-1 container-p-y">
      <h4 class="fw-bold py-3 mb-4">
        <span class="text-muted fw-light">Home /</span> Portfolio / Details
      </h4>
      <div class="row">
        <!-- Main Details Card -->
        <div class="col-lg-12">
          <div class="card">
            <div
              class="card-header d-flex justify-content-between align-items-center"
            >
              <h5 class="mb-0">Portfolio Details</h5>
              <Link
                :href="route('portfolio.edit', portfolio.id)"
                class="btn btn-primary btn-sm"
              >
                <i class="bx bx-edit"></i> Edit
              </Link>
            </div>
            <div class="card-body">
              <div class="row">
                <!-- Image Section -->
                <div class="col-md-4 mb-3">
                  <div class="image-container">
                    <img
                      v-if="portfolio.image"
                      :src="`/storage/${portfolio.image}`"
                      alt="Portfolio Image"
                      class="img-fluid rounded"
                    />
                    <p v-else class="text-muted">No image available</p>
                  </div>
                </div>

                <!-- Portfolio Details Section in One Row -->
                <div class="col-md-4">
                  <div class="mb-3">
                    <h6 class="fw-bold">Title:</h6>
                    <p class="text-muted">{{ portfolio.title || "N/A" }}</p>
                  </div>

                  <div class="mb-3">
                    <h6 class="fw-bold">Category:</h6>
                    <p class="text-muted">
                      {{
                        portfolio.category ? portfolio.category.title : "N/A"
                      }}
                    </p>
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="mb-3">
                    <h6 class="fw-bold">Date:</h6>
                    <p class="text-muted">{{ portfolio.date || "N/A" }}</p>
                  </div>

                  <div class="mb-3">
                    <h6 class="fw-bold">Has Form:</h6>
                    <p class="text-muted">
                      <i
                        :class="[
                          portfolio.has_form
                            ? 'bx bx-check-circle text-success'
                            : 'bx bx-x-circle text-danger',
                        ]"
                      ></i>
                      {{ portfolio.has_form ? "Yes" : "No" }}
                    </p>
                  </div>
                </div>
                <div class="col-md-12">
                  <div class="mb-3">
                    <h6 class="fw-bold">Description:</h6>
                    <p class="text-muted" v-html="portfolio.description">
                     
                    </p>
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
  portfolio: Object, 
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

  .card-body .col-md-4 {
    margin-bottom: 15px;
  }

  .card-body .col-md-8 {
    padding-left: 0;
  }
}
</style>
