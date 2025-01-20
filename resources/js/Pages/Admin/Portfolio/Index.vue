<template>
  <Head title="Portfolio Index" />
  <AdminLayout>
    <div class="container-xxl flex-grow-1 container-p-y">
      <h4 class="fw-bold py-3 mb-4">
        <span class="text-muted fw-light">Home /</span> Portfolio
      </h4>

      <div class="card">
        <div
          class="card-header d-flex justify-content-between align-items-center"
        >
          <h5 class="mb-0">Portfolio List</h5>
          <Link :href="route('portfolio.create')" class="btn btn-primary"
            >Add Portfolio</Link
          >
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
              <tr
                v-for="(portfolio, index) in portfolios.data"
                :key="portfolio.id"
              >
                <td>
                  {{
                    index +
                    1 +
                    (portfolios.current_page - 1) * portfolios.per_page
                  }}
                </td>
                <td>{{ portfolio.title || "Untitled" }}</td>
                <td>{{ portfolio.category?.title || "Uncategorized" }}</td>
                <td>{{ portfolio.date }}</td>
                <td>
                  <span
                    :class="[
                      'badge',
                      portfolio.has_form ? 'bg-success' : 'bg-danger',
                    ]"
                  >
                    {{ portfolio.has_form ? "Yes" : "No" }}
                  </span>
                </td>
                <td>
                  <Link :href="route('portfolio.edit', portfolio.id)">
                    <span
                      class="badge bg-label-primary p-1_5 me-3 cursor-pointer mb-2"
                    >
                      <i class="icon-base bx bx-pencil icon-xs"></i>
                    </span>
                  </Link>
                  <span
                    @click="deletePortfolio(portfolio.id)"
                    class="badge bg-label-danger p-1_5 me-3 cursor-pointer mb-2"
                  >
                    <i class="icon-base bx bx-trash icon-xs"></i>
                  </span>
                  <Link :href="route('portfolio.show', portfolio.id)">
                    <span
                      class="badge bg-label-primary p-1_5 me-3 cursor-pointer mb-2"
                    >
                      <i class="icon-base bx bx-message-square-detail"></i>
                    </span>
                  </Link>
                </td>
              </tr>
              <tr v-if="!portfolios.data.length">
                <td colspan="6" class="text-center">No portfolios found</td>
              </tr>
            </tbody>
          </table>
        </div>

        <!-- Pagination -->
        <div
          class="card-footer d-flex justify-content-between align-items-center"
        >
          <span>
            Showing {{ portfolios.from }} to {{ portfolios.to }} of
            {{ portfolios.total }} portfolios
          </span>
          <nav aria-label="Portfolio pagination">
            <ul class="pagination mb-0">
              <li
                class="page-item"
                :class="{ disabled: !portfolios.prev_page_url }"
              >
                <a
                  class="page-link"
                  href="#"
                  @click.prevent="fetchPage(portfolios.prev_page_url)"
                >
                  Previous
                </a>
              </li>
              <li
                class="page-item"
                :class="{ active: page === portfolios.current_page }"
                v-for="page in portfolios.last_page"
                :key="page"
              >
                <a
                  class="page-link"
                  href="#"
                  @click.prevent="fetchPage(portfolios.links[page - 1].url)"
                >
                  {{ page }}
                </a>
              </li>
              <li
                class="page-item"
                :class="{ disabled: !portfolios.next_page_url }"
              >
                <a
                  class="page-link"
                  href="#"
                  @click.prevent="fetchPage(portfolios.next_page_url)"
                >
                  Next
                </a>
              </li>
            </ul>
          </nav>
        </div>
      </div>
    </div>
  </AdminLayout>
</template>

<script setup>
import AdminLayout from "@/Layouts/AdminLayout.vue";
import { Head, Link, useForm } from "@inertiajs/vue3";
import { ref } from "vue";
import { useToast } from "vue-toastification";
import Swal from "sweetalert2";

const toast = useToast();
const form = useForm({});
const props = defineProps({
  portfolios: {
    type: Object,
    required: true,
  },
});

const fetchPage = (url) => {
  if (url) {
    axios
      .get(url)
      .then((response) => {
        history.pushState(null, "", url);
        location.reload(); // Optional: You can also update portfolios dynamically here
      })
      .catch((error) => {
        toast.error(
          "An error occurred while fetching the page: " +
            (error.response?.data?.message || error.message)
        );
      });
  }
};

const deletePortfolio = (id) => {
  Swal.fire({
    title: "Are you sure?",
    text: "You won't be able to revert this!",
    icon: "warning",
    showCancelButton: true,
    confirmButtonColor: "#3085d6",
    cancelButtonColor: "#d33",
    confirmButtonText: "Yes, delete it!",
  }).then((result) => {
    if (result.isConfirmed) {
      form.delete(route("portfolio.destroy", id), {
        preserveScroll: true,
        onSuccess: () => {
          toast.success("Project Deleted Successfully");
        },
        onError: (err) => {
          toast.error("Error: " + err.message);
        },
      });
    }
  });
};
</script>

<style scoped>
.table {
  margin-bottom: 0;
}
</style>
