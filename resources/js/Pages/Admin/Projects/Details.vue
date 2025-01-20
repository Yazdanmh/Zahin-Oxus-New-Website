<template>
  <Head title="Project Details" />
  <AdminLayout>
    <div class="container-xxl flex-grow-1 container-p-y">
      <h4 class="fw-bold py-3 mb-4">
        <span class="text-muted fw-light">Home /</span> Project / Details
      </h4>
      <div class="row">
        <div class="col-xl">
          <div class="card mb-4">
            <div
              class="card-header d-flex justify-content-between align-items-center"
            >
              <h5 class="mb-0">Project Details</h5>
              <small class="text-muted float-end"
                >View Project Information</small
              >
            </div>
            <div class="card-body">
              <div
                class="d-flex align-items-start align-items-sm-center gap-4 mb-4"
              >
                <img
                  v-if="project.image"
                  :src="'/storage/' + project.image"
                  alt="Project Image"
                  class="d-block rounded"
                  style="width: 300px; height: 100px; object-fit: cover"
                />
              </div>

              <div class="row">
                <div class="col-md-4">
                  <div class="mb-3">
                    <label class="form-label">Name</label>
                    <p class="form-control-plaintext">{{ project.name }}</p>
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="mb-3">
                    <label class="form-label">Category</label>
                    <p class="form-control-plaintext">
                      {{
                        categories.find(
                          (category) => category.id === project.category_id
                        )?.title || "N/A"
                      }}
                    </p>
                  </div>
                </div>
                <div class="col-md-12">
                  <div class="mb-3">
                    <label class="form-label">Description</label>
                    <p class="form-control-plaintext">
                      {{ project.description }}
                    </p>
                  </div>
                </div>
              </div>

              <div class="d-flex justify-content-end gap-3 mt-4">
                <button
                  type="button"
                  class="btn btn-outline-secondary"
                  @click="cancel"
                >
                  Back
                </button>
                <Link
                  :href="route('projects.edit', { id: project.id })"
                  class="btn btn-primary"
                >
                  <i class="bx bx-edit"></i> Edit Project
                </Link>
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
  categories: {
    type: Array,
    required: true,
  },
  project: {
    type: Object,
    required: true,
  },
});

const cancel = () => {
  window.history.back();
};
</script>
  
  <style scoped>
</style>
  