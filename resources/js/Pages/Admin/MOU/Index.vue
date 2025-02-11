<template>
    <Head title="MOUs" />
    <AdminLayout :setting="props.setting" :user="props.user">
      <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="fw-bold py-3 mb-4">
          <span class="text-muted fw-light">Home /</span> MOUs
        </h4>
  
        <div class="mb-3 text-end">
          <Link :href="route('mou.create')" class="btn btn-primary">
            <i class="bx bx-plus"></i> Add MOU
          </Link>
        </div>
  
        <div class="card mb-4">
          <div class="card-header">
            <h5 class="mb-0">MOUs List</h5>
          </div>
          <div class="card-body">
            <div v-if="!props.mou.data.length" class="text-center py-5">
              <h5 class="mt-3">No MOUs available</h5>
              <p class="text-muted">Please add an MOU to display here.</p>
            </div>
  
            <!-- Table -->
            <div v-else class="table table-responsive">
              <table class="table table-hover align-middle mb-0">
                <thead>
                  <tr>
                    <th>#</th>
                    <th>MOU Title</th>
                    <th>Start Date</th>
                    <th>End Date</th>
                    <th>Status</th>
                    <th>Action</th>
                  </tr>
                </thead>
                <tbody>
                  <tr v-for="mou in filteredMOUs" :key="mou.id">
                    <td>{{ mou.id }}</td>
                    <td>{{ mou.title || "Untitled" }}</td>
                    <td>{{ mou.start_date || "N/A" }}</td>
                    <td>{{ mou.end_date || "Ongoing" }}</td>
                    <td>{{ mou.status || "N/A" }}</td>
                    <td>
                      <Link :href="route('mou.edit', mou.id)">
                        <span class="badge bg-label-primary p-1.5 me-3 cursor-pointer mb-2">
                          <i class="icon-base bx bx-pencil icon-xs"></i>
                        </span>
                      </Link>
                      <span @click="confirmDelete(mou.id)" class="badge bg-label-danger p-1.5 me-3 cursor-pointer mb-2">
                        <i class="icon-base bx bx-trash icon-xs"></i>
                      </span>
                      <Link :href="route('mou.show', mou.id)">
                          <span
                            class="badge bg-label-primary p-1_5 me-3 cursor-pointer mb-2"
                          >
                            <i
                              class="icon-base bx bx-message-square-detail"
                            ></i>
                          </span>
                        </Link>
                    </td>
                  </tr>
                  <!-- Empty state if no MOUs are found -->
                  <tr v-if="!filteredMOUs.length">
                    <td colspan="6" class="text-center">No MOUs found</td>
                  </tr>
                </tbody>
              </table>
            </div>
            <!-- Pagination Links -->
            <div v-if="props.mou.last_page > 1" class="d-flex justify-content-center mt-3">
              <nav aria-label="Page navigation">
                <ul class="pagination">
                  <!-- Previous Page Link -->
                  <li class="page-item" :class="{ disabled: !props.mou.prev_page_url }">
                    <a class="page-link" href="#" @click.prevent="changePage(props.mou.prev_page_url)">Previous</a>
                  </li>
  
                  <!-- Loop through Pages -->
                  <li v-for="page in totalPages" :key="page" :class="['page-item', { active: currentPage === page }]">
                    <a class="page-link" href="#" @click.prevent="changePageTo(page)">
                      {{ page }}
                    </a>
                  </li>
  
                  <!-- Next Page Link -->
                  <li class="page-item" :class="{ disabled: !props.mou.next_page_url }">
                    <a class="page-link" href="#" @click.prevent="changePage(props.mou.next_page_url)">Next</a>
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
  import { ref, computed } from "vue";
  
  const props = defineProps({
    mou: { type: Object, required: true },
    setting: { type: Object, required: true },
    user: { type: Object, required: true },
  });
  
  const toast = useToast();
  const form = useForm({
    name: "",
    image: null,
  });
  
  const currentPage = ref(props.mou.current_page); 
  const totalPages = computed(() => Array.from({ length: props.mou.last_page }, (_, i) => i + 1));
  
  const filteredMOUs = computed(() => props.mou.data);
  
  const changePage = (url) => {
    if (url) {
      const newPage = new URL(url).searchParams.get("page");
      form.get(route("mou.index", { page: newPage }), {
        preserveScroll: true,
      });
      currentPage.value = Number(newPage);
    }
  };
  
  const changePageTo = (page) => {
    form.get(route("mou.index", { page }), {
      preserveScroll: true,
    });
    currentPage.value = page;
  };
  
  const deleteMOU = (mouId) => {
    form.post(route("mou.destroy", mouId), {
      preserveScroll: true,
      onSuccess: () => toast.success("MOU Deleted Successfully"),
      onError: (err) => toast.error("Error: " + err.message),
    });
  };
  
  const confirmDelete = (mouId) => {
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
        deleteMOU(mouId);
      }
    });
  };
  </script>
  