<template>
    <Head title="Portfolio Index" />
    <AdminLayout>
      <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="fw-bold py-3 mb-4">
          <span class="text-muted fw-light">Home /</span> Portfolio
        </h4>
  
        <div class="card">
          <div class="card-header d-flex justify-content-between align-items-center">
            <h5 class="mb-0">Portfolio List</h5>
            <a href="/portfolio/create" class="btn btn-primary">Add Portfolio</a>
          </div>
  
          <div class="table-responsive">
            <table class="table table-hover">
              <thead>
                <tr>
                  <th>#</th>
                  <th>Title</th>
                  <th>Category</th>
                  <th>Date</th>
                  <th>Has Form</th>
                  <th>Actions</th>
                </tr>
              </thead>
              <tbody>
                <tr v-for="(portfolio, index) in portfolios.data" :key="portfolio.id">
                  <td>{{ index + 1 }}</td>
                  <td>{{ portfolio.title || 'Untitled' }}</td>
                  <td>{{ portfolio.category?.title || 'Uncategorized' }}</td>
                  <td>{{ portfolio.date }}</td>
                  <td>
                    <span
                      :class="[
                        'badge',
                        portfolio.has_form ? 'bg-success' : 'bg-danger',
                      ]"
                    >
                      {{ portfolio.has_form ? 'Yes' : 'No' }}
                    </span>
                  </td>
                  <td>
                    <a
                      :href="`/portfolio/${portfolio.id}/edit`"
                      class="btn btn-sm btn-outline-primary me-2"
                    >
                      Edit
                    </a>
                    <button
                      class="btn btn-sm btn-outline-danger"
                      @click="deletePortfolio(portfolio.id)"
                    >
                      Delete
                    </button>
                  </td>
                </tr>
                <tr v-if="!portfolios.data.length">
                  <td colspan="6" class="text-center">No portfolios found</td>
                </tr>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </AdminLayout>
  </template>
  
  <script setup>
  import AdminLayout from "@/Layouts/AdminLayout.vue";
  import { Head } from "@inertiajs/vue3";
  import { ref } from "vue";
  import { useToast } from "vue-toastification";
  
  const toast = useToast();
  
  const props = defineProps({
    portfolios: {
      type: Object,
      required: true,
    },
  });
  
  // Handle portfolio deletion
  const deletePortfolio = (id) => {
    if (confirm("Are you sure you want to delete this portfolio?")) {
      axios
        .delete(`/portfolio/${id}`)
        .then(() => {
          toast.success("Portfolio deleted successfully.");
          location.reload(); // Reload the page after deletion
        })
        .catch((error) => {
          toast.error(
            "An error occurred while deleting the portfolio: " +
              (error.response?.data?.message || error.message)
          );
        });
    }
  };
  </script>
  
  <style scoped>
  .table {
    margin-bottom: 0;
  }
  </style>
  