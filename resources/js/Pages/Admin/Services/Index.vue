<template>
  <Head title="Services" />
  <AdminLayout :setting="props.setting" :user="props.user">
    <div class="container-xxl flex-grow-1 container-p-y">
      <h4 class="fw-bold py-3 mb-4">
        <span class="text-muted fw-light">Home /</span> Services
      </h4>

      <div class="mb-3 text-end">
        <Link :href="route('services.create')" class="btn btn-primary">
          <i class="bx bx-plus"></i> Add Service
        </Link>
      </div>

      <div class="card mb-4">
        <div class="card-header">
          <h5 class="mb-0">Add New Service</h5>
        </div>
        <div class="card-body">
          <div v-if="!props.services.data.length" class="text-center py-5">
            <h5 class="mt-3">No services available</h5>
            <p class="text-muted">Please add a service to display here.</p>
          </div>

          <div class="row" v-else>
            <div
              v-for="service in props.services.data"
              :key="service.id"
              class="col-md-4 mb-4"
            >
              <div class="card shadow-sm">
                <img
                  :src="
                    service.image
                      ? '/storage/' + service.image
                      : '/images/default-image.jpg'
                  "
                  class="card-img-top"
                  alt="Service Image"
                />
                <div class="card-body">
                  <h5 class="card-title">{{ service.title }}</h5>

                  <div
                    class="d-flex justify-content-between align-items-center"
                  >
                    <i :class="service.icon"></i>
                    <div class="dropdown">
                      <button
                        class="btn btn-sm btn-light dropdown-toggle"
                        type="button"
                        id="dropdownMenuButton"
                        data-bs-toggle="dropdown"
                        aria-expanded="false"
                      >
                        Actions
                      </button>
                      <ul
                        class="dropdown-menu"
                        aria-labelledby="dropdownMenuButton"
                      >
                        <li>
                          <Link
                            :href="route('services.edit', service.id)"
                            class="dropdown-item"
                            >Edit</Link
                          >
                        </li>
                        <li>
                          <a
                            @click="confirmDelete(service.id)"
                            class="dropdown-item"
                            >Delete</a
                          >
                        </li>
                        <li>
                          <Link
                            :href="route('services.show', service.id)"
                            class="dropdown-item"
                            >Details</Link
                          >
                        </li>
                      </ul>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>

          <!-- Pagination Links -->
          <div
            v-if="props.services.last_page > 1"
            class="d-flex justify-content-center mt-3"
          >
            <nav aria-label="Page navigation">
              <ul class="pagination">
                <!-- Previous Page Link -->
                <li
                  class="page-item"
                  :class="{ disabled: !props.services.prev_page_url }"
                >
                  <a
                    class="page-link"
                    href="#"
                    @click.prevent="changePage(props.services.prev_page_url)"
                  >
                    Previous
                  </a>
                </li>

                <!-- Loop through Pages -->
                <li
                  v-for="page in totalPages"
                  :key="page"
                  :class="['page-item', { active: currentPage === page }]"
                >
                  <a
                    class="page-link"
                    href="#"
                    @click.prevent="changePageTo(page)"
                  >
                    {{ page }}
                  </a>
                </li>

                <!-- Next Page Link -->
                <li
                  class="page-item"
                  :class="{ disabled: !props.services.next_page_url }"
                >
                  <a
                    class="page-link"
                    href="#"
                    @click.prevent="changePage(props.services.next_page_url)"
                  >
                    Next
                  </a>
                </li>
              </ul>
            </nav>
          </div>
        </div>
      </div>
    </div>
  </AdminLayout>
</template>
  
  <script setup>
import AdminLayout from "@/Layouts/AdminLayout.vue";
import Swal from "sweetalert2"; // Import SweetAlert2
import { Head, useForm, Link } from "@inertiajs/vue3";
import { useToast } from "vue-toastification";
import { ref, computed } from "vue";

const props = defineProps({
  services: {
    type: Object,
    required: true,
  },
  setting:{
    type:Object, 
    required:true, 
  },
  user:{
    type:Object, 
    required:true, 
  },
});

const toast = useToast();
const form = useForm({
  name: "",
  image: null,
});

const currentPage = ref(props.services.current_page); // Track the current page
const totalPages = computed(() => {
  // Calculate the total pages based on props
  return Array.from({ length: props.services.last_page }, (_, i) => i + 1);
});

// Change page to the selected URL
const changePage = (url) => {
  if (url) {
    form.get(
      route("services.index", { page: new URL(url).searchParams.get("page") }),
      {
        preserveScroll: true,
      }
    );
  }
};

// Change page to the specific page
const changePageTo = (page) => {
  form.get(route("services.index", { page }), {
    preserveScroll: true,
  });
};

// Delete a service
const deleteService = (serviceId) => {
  form.post(route("services.destroy", serviceId), {
    preserveScroll: true,
    onSuccess: () => {
      toast.success("Service Deleted Successfully");
    },
    onError: (err) => {
      toast.error("Error: " + err.message);
    },
  });
};

// Confirm before deleting a service
const confirmDelete = (serviceId) => {
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
      deleteService(serviceId); // Call the delete method if confirmed
    }
  });
};

// Function to truncate the description
const truncateText = (text, maxLength) => {
  if (text.length > maxLength) {
    return text.substring(0, maxLength) + "...";
  }
  return text;
};
</script>
  
  <style scoped>
.card {
  height: 100%;
}
.card.shadow-lg {
  border-radius: 15px;
}
.card.shadow-sm {
  border-radius: 10px;
}
.card-img-top {
  object-fit: cover;
  height: 200px;
}
</style>