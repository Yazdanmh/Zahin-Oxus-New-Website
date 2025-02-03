<template>
  <Head title="Certificates" />
  <AdminLayout :setting="props.setting" :user="props.user">
    <div class="container-xxl flex-grow-1 container-p-y">
      <h4 class="fw-bold py-3 mb-4">
        <span class="text-muted fw-light">Home /</span> Certificates
      </h4>
      <div class="row">
        <div class="col-md-12">
          <div class="card mb-4">
            <div
              class="card-header d-flex justify-content-between align-items-center"
            >
              <h5 class="mb-0">Certificates</h5>
              <Link :href="route('certificate.create')" class="btn btn-primary">
                Add Certificate
              </Link>
            </div>

            <div class="card-body">
              <!-- Filter/Search Area -->
              <div class="row mb-4">
                <div class="col-md-3">
                  <input
                    v-model="searchQuery"
                    @input="applyFilter"
                    type="text"
                    class="form-control"
                    placeholder="Search by name"
                  />
                </div>
                <div class="col-md-3">
                  <select
                    v-model="selectedTraining"
                    @change="applyFilter"
                    class="form-select"
                  >
                    <option value="">All Trainings</option>
                    <option
                      v-for="training in trainings"
                      :key="training.id"
                      :value="training.id"
                    >
                      {{ training.name }}
                    </option>
                  </select>
                </div>
                <div class="col-md-3">
                  <input
                    v-model="selectedDate"
                    @change="applyFilter"
                    type="date"
                    class="form-control"
                  />
                </div>
              </div>

              <!-- Table -->
              <div class="table table-responsive">
                <table class="table table-hover align-middle mb-0">
                  <thead>
                    <tr>
                      <th>#</th>
                      <th>Certificate Code</th>
                      <th>Certificate Name</th>
                      <th>For Who</th>
                      <th>Training</th>
                      <th>Issue Date</th>
                      <th>Certificate File</th>
                      <!-- New Column -->
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr
                      v-for="certificate in filteredCertificates"
                      :key="certificate.id"
                    >
                      <td>{{ certificate.id }}</td>
                      <td>{{ certificate.certificate_code || "N/A" }}</td>
                      <td>{{ certificate.certificate_name || "Untitled" }}</td>
                      <td>{{ certificate.for_who || "N/A" }}</td>
                      <td>{{ certificate.training.name || "N/A" }}</td>
                      <td>{{ certificate.issue_date || "N/A" }}</td>
                      <td>
                        <a
                          v-if="certificate.certificate_file"
                          :href="'/storage/' + certificate.certificate_file"
                          target="_blank"
                          download
                          class="btn btn-sm btn-outline-primary"
                        >
                          Download
                        </a>
                        <span v-else class="text-muted">No file</span>
                      </td>
                      <td>
                        <Link :href="route('certificate.edit', certificate.id)">
                          <span
                            class="badge bg-label-primary p-1_5 me-3 cursor-pointer mb-2"
                          >
                            <i class="icon-base bx bx-pencil icon-xs"></i>
                          </span>
                        </Link>
                        <span
                          @click="confirmDelete(certificate.id)"
                          class="badge bg-label-danger p-1_5 me-3 cursor-pointer mb-2"
                        >
                          <i class="icon-base bx bx-trash icon-xs"></i>
                        </span>
                      </td>
                    </tr>
                    <!-- Empty state if no certificates are found -->
                    <tr v-if="!filteredCertificates.length">
                      <td colspan="8" class="text-center">
                        No certificates found
                      </td>
                    </tr>
                  </tbody>
                </table>
              </div>

              <!-- Pagination Links -->
              <div
                v-if="props.certificates.total > 0"
                class="d-flex justify-content-center mt-3"
              >
                <nav aria-label="Page navigation">
                  <ul class="pagination">
                    <li
                      class="page-item"
                      :class="{ disabled: !props.certificates.prev_page_url }"
                    >
                      <a
                        class="page-link"
                        href="#"
                        @click.prevent="
                          changePage(props.certificates.prev_page_url)
                        "
                      >
                        Previous
                      </a>
                    </li>

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

                    <li
                      class="page-item"
                      :class="{ disabled: !props.certificates.next_page_url }"
                    >
                      <a
                        class="page-link"
                        href="#"
                        @click.prevent="
                          changePage(props.certificates.next_page_url)
                        "
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
      </div>
    </div>
  </AdminLayout>
</template>

<script setup>
import AdminLayout from "@/Layouts/AdminLayout.vue";
import Swal from "sweetalert2"; // Import SweetAlert2
import { Head, useForm, Link } from "@inertiajs/vue3";
import { ref, computed, watch } from "vue";
import { useToast } from "vue-toastification";

const form = useForm({}); 
const toast = useToast({});
const props = defineProps({
  certificates: {
    type: Object,
    required: true,
  },
  trainings: {
    type: Array,
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

const searchQuery = ref("");
const selectedTraining = ref("");
const selectedDate = ref("");

const filteredCertificates = computed(() => {
  return props.certificates.data.filter((certificate) => {
    const matchesSearch = certificate.certificate_name
      .toLowerCase()
      .includes(searchQuery.value.toLowerCase());
    const matchesTraining = selectedTraining.value
      ? certificate.training.id === selectedTraining.value
      : true;
    const matchesDate = selectedDate.value
      ? certificate.issue_date === selectedDate.value
      : true;

    return matchesSearch && matchesTraining && matchesDate;
  });
});

const currentPage = ref(props.certificates.current_page); // Track the current page
const totalPages = computed(() => {
  return Array.from({ length: props.certificates.last_page }, (_, i) => i + 1);
});

const changePage = (url) => {
  if (url) {
    form.get(
      route("certificate.index", {
        page: new URL(url).searchParams.get("page"),
        search: searchQuery.value,
        training: selectedTraining.value,
        date: selectedDate.value,
      }),
      {
        preserveScroll: true,
      }
    );
  }
};

const changePageTo = (page) => {
  form.get(route("certificate.index", { page }), {
    preserveScroll: true,
  });
};

const deleteCertificate = (id) => {
  form.delete(route("certificate.destroy", id), {
    preserveScroll: true,
    onSuccess: () => {
      toast.success("Certificate Deleted Successfully");
    },
    onError: (err) => {
      toast.error("Error: " + err.message);
    },
  });
};

const confirmDelete = (id) => {
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
      deleteCertificate(id);
    }
  });
};

const applyFilter = () => {
  changePage(1); // Reset to the first page when applying a new filter
};
</script>
