<template>
  <Head title="Services" />
  <AdminLayout :setting="props.setting" :user="props.user" :permissions=" props.permissions">
    <div class="container-xxl flex-grow-1 container-p-y">
      <h4 class="fw-bold py-3 mb-4">
        <span class="text-muted fw-light">Home /</span> Services
      </h4>

      <!-- Top Section: Search, Filter & Add Button -->
      <div class="d-flex justify-content-start align-items-center mb-3 gap-4">
        <input
          type="text"
          v-model="searchQuery"
          class="form-control w-25"
          placeholder="Search services..."
        />

        <select v-model="selectedCategory" class="form-select w-25">
          <option value="">All Categories</option>
          <option v-for="category in props.categories" :key="category.id" :value="category.id">
            {{ category.name }}
          </option>
        </select>

        <Link v-if="hasPermission('site_data.create')" :href="route('services.create')" class="btn btn-primary">
          <i class="bx bx-plus"></i> Add Service
        </Link>
      </div>

      <div class="card mb-4">
        <div class="card-header">
          <h5 class="mb-0">Services List</h5>
        </div>
        <div class="card-body">
          <div v-if="!filteredServices.length" class="text-center py-5">
            <h5 class="mt-3">No services available</h5>
            <p class="text-muted">Please add a service to display here.</p>
          </div>

          <div class="row" v-else>
            <div v-for="service in filteredServices" :key="service.id" class="col-md-4 mb-4">
              <div class="card shadow-sm">
                <img
                  :src="service.image ? '/storage/' + service.image : '/images/default-image.jpg'"
                  class="card-img-top"
                  alt="Service Image"
                />
                <div class="card-body">
                  <h5 class="card-title">{{ service.title }}</h5>
                  <span>{{ service.subtitle }}</span>
                  <div class="d-flex justify-content-between align-items-center">
                    <i :class="service.icon"></i>
                    <div class="dropdown">
                      <button class="btn btn-sm btn-light dropdown-toggle" type="button"
                        data-bs-toggle="dropdown" aria-expanded="false">
                        Actions
                      </button>
                      <ul class="dropdown-menu">
                        <li v-if="hasPermission('site_data.edit')">
                          <Link :href="route('services.edit', service.id)" class="dropdown-item">Edit</Link>
                        </li>
                        <li v-if="hasPermission('site_data.delete')">
                          <a @click="confirmDelete(service.id)" class="dropdown-item">Delete</a>
                        </li>
                        <li>
                          <Link :href="route('services.show', service.id)" class="dropdown-item">Details</Link>
                        </li>
                      </ul>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>

          <!-- Pagination -->
          <div v-if="props.services.last_page > 1" class="d-flex justify-content-center mt-3">
            <nav aria-label="Page navigation">
              <ul class="pagination">
                <li class="page-item" :class="{ disabled: !props.services.prev_page_url }">
                  <a class="page-link" href="#" @click.prevent="changePage(props.services.prev_page_url)">Previous</a>
                </li>
                <li v-for="page in totalPages" :key="page" :class="['page-item', { active: currentPage === page }]">
                  <a class="page-link" href="#" @click.prevent="changePageTo(page)">{{ page }}</a>
                </li>
                <li class="page-item" :class="{ disabled: !props.services.next_page_url }">
                  <a class="page-link" href="#" @click.prevent="changePage(props.services.next_page_url)">Next</a>
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
import Swal from "sweetalert2";
import { Head, useForm, Link } from "@inertiajs/vue3";
import { useToast } from "vue-toastification";
import { ref, computed, watch } from "vue";
import { debounce } from "lodash";

const props = defineProps({
  services: Object,
  categories: Array,
  setting: Object,
  user: Object,
  permissions:{
    type:Array, 
    required:true, 
  }
});

const toast = useToast();
const searchQuery = ref(props.search || "");
const selectedCategory = ref(props.selectedCategory || "");
const currentPage = ref(props.services.current_page);
const totalPages = computed(() => Array.from({ length: props.services.last_page }, (_, i) => i + 1));

// Filtered services based on search query and selected category
const filteredServices = computed(() => {
  return props.services.data.filter(service => {
    const matchesSearch = service.title.toLowerCase().includes(searchQuery.value.toLowerCase());
    const matchesCategory = selectedCategory.value ? service.service_category_id == selectedCategory.value : true;
    return matchesSearch && matchesCategory;
  });
});

// Debounce function to avoid frequent requests
const fetchFilteredResults = debounce(() => {
  useForm().get(route("services.index", {
    search: searchQuery.value,
    category: selectedCategory.value,
  }), { preserveState: true });
}, 500);

// Watch searchQuery & selectedCategory, trigger filtered results after debounce
watch([searchQuery, selectedCategory], () => {
  fetchFilteredResults();
});

const changePage = (url) => {
  if (url) {
    useForm().get(route("services.index", { page: new URL(url).searchParams.get("page") }), { preserveState: true });
  }
};

const changePageTo = (page) => {
  useForm().get(route("services.index", { page }), { preserveState: true });
};

const confirmDelete = (serviceId) => {
  Swal.fire({
    title: "Are you sure?",
    text: "This action cannot be undone.",
    icon: "warning",
    showCancelButton: true,
    confirmButtonColor: "#3085d6",
    cancelButtonColor: "#d33",
    confirmButtonText: "Yes, delete it!",
  }).then((result) => {
    if (result.isConfirmed) {
      useForm().post(route("services.destroy", serviceId), {
        preserveScroll: true,
        onSuccess: () => toast.success("Service Deleted Successfully"),
      });
    }
  });
};
const hasPermission = (permission) => {
  return props.permissions.includes(permission);
};
</script>
