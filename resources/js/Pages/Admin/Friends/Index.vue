<template>
  <Head title="Company" />
  <AdminLayout :setting="props.setting" :user="props.user">
    <div class="container-xxl flex-grow-1 container-p-y">
      <h4 class="fw-bold py-3 mb-4">
        <span class="text-muted fw-light">Home /</span> Company
      </h4>
      <div class="row">
        <div class="col-xl">
          <div class="card mb-4">
            <div
              class="card-header d-flex justify-content-between align-items-center"
            >
              <h5 class="mb-0">Add Company</h5>
              <small class="text-muted float-end">Manage companies</small>
            </div>
            <div class="card-body">
              <form @submit.prevent="submit">
                <div class="d-flex gap-3">
                  <div
                    class="d-flex flex-column align-items-center gap-2"
                    style="max-width: 150px"
                  >
                    <label for="">Company Logo</label>
                    <label for="upload" class="btn btn-primary me-2 mb-4">
                      <span class="d-none d-sm-block">Upload Image</span>
                      <i class="bx bx-upload d-block d-sm-none"></i>
                      <input
                        type="file"
                        id="upload"
                        hidden
                        accept="image/png, image/jpeg, image/gif"
                        @change="handleImageUpload"
                      />
                    </label>
                    <img
                      v-if="imagePreview"
                      :src="imagePreview"
                      alt="Image Preview"
                      class="d-block rounded mb-2"
                      style="width: 120px; height: 100px; object-fit: cover"
                    />
                    <button
                      v-if="imagePreview"
                      type="button"
                      class="btn btn-outline-secondary mb-4"
                      @click="resetImage"
                    >
                      <i class="bx bx-reset d-block d-sm-none"></i>
                      <span class="d-none d-sm-block">Reset</span>
                    </button>
                    <p class="text-muted mb-0">
                      Allowed JPG, GIF, or PNG. Max size of 1MB.
                      <span class="text-warning">Recommended dimensions: 188 x 22 pixels.</span>
                    </p>
                  </div>

                  <div class="d-flex flex-column" style="flex: 1">
                    <div class="mb-3">
                      <label for="companyName" class="form-label"
                        >Company Name</label
                      >
                      <input
                        type="text"
                        class="form-control"
                        id="companyName"
                        v-model="form.name"
                        placeholder="Enter company name"
                      />
                    </div>
                    <div v-if="form.errors.name" class="text-danger mt-2">
                      {{ form.errors.name }}
                    </div>
                  </div>
                </div>

                <div class="d-flex justify-content-end mt-3">
                  <button type="submit" class="btn btn-primary">
                    Add Company
                  </button>
                </div>
              </form>
            </div>
          </div>
        </div>

        <div class="col-md-12">
          <div class="card mb-4">
            <div
              class="card-header d-flex justify-content-between align-items-center"
            >
              <h5 class="mb-0">Companies</h5>
              <small class="text-muted float-end">Manage companies</small>
            </div>
            <div class="card-body">
              <div class="table">
                <table class="table table-hover align-middle mb-0">
                  <thead>
                    <tr>
                      <th>Company Logo</th>
                      <th>Company Name</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr
                      v-for="company in props.companies.data"
                      :key="company.id"
                    >
                      <td>
                        <img
                          :src="
                            company.image
                              ? '/storage/' + company.image
                              : '/images/default-image.jpg'
                          "
                          alt="Company Logo"
                          class="rounded"
                          style="width: 50px; height: 50px; object-fit: cover"
                        />
                      </td>
                      <td>{{ company.name }}</td>
                      <td>
                        <span
                          @click="confirmDelete(company.id)"
                          class="badge bg-label-danger p-1_5 me-3 cursor-pointer"
                          ><i class="icon-base bx bx-trash icon-xs"></i
                        ></span>
                      </td>
                    </tr>
                  </tbody>
                </table>
              </div>

              <!-- Pagination Links -->
              <div class="d-flex justify-content-center mt-3">
                <nav aria-label="Page navigation">
                  <ul class="pagination">
                    <!-- Previous Page Link -->
                    <li
                      class="page-item"
                      :class="{ disabled: !props.companies.prev_page_url }"
                    >
                      <a
                        class="page-link"
                        href="#"
                        @click.prevent="
                          changePage(props.companies.prev_page_url)
                        "
                      >
                        Previous
                      </a>
                    </li>

                    <!-- Loop through Pages (handling page numbers) -->
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
                      :class="{ disabled: !props.companies.next_page_url }"
                    >
                      <a
                        class="page-link"
                        href="#"
                        @click.prevent="
                          changePage(props.companies.next_page_url)
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
import { Head } from "@inertiajs/vue3";
import { useForm } from "@inertiajs/vue3";
import { useToast } from "vue-toastification";
import { ref, computed } from "vue";

const props = defineProps({
  companies: {
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

const imagePreview = ref(null);
const currentPage = ref(props.companies.current_page); // Track the current page
const totalPages = computed(() => {
  // Calculate the total pages based on props
  return Array.from({ length: props.companies.last_page }, (_, i) => i + 1);
});

const handleImageUpload = (event) => {
  const file = event.target.files[0];
  if (file) {
    form.image = file;
    const reader = new FileReader();
    reader.onload = (e) => {
      imagePreview.value = e.target.result;
    };
    reader.readAsDataURL(file);
  }
};

const resetImage = () => {
  imagePreview.value = null;
  form.image = null;
  document.getElementById("upload").value = ""; // Reset the input
};

const submit = () => {
  if (!form.image) delete form.image; // Remove image if not selected
  form.post(route("friends.store"), {
    preserveScroll: true,
    onSuccess: () => {
      toast.success("Company Added Successfully");
      form.reset();
      resetImage();
    },
    onError: (err) => {
      toast.error("Error: " + err.message);
    },
  });
};

const changePage = (url) => {
  if (url) {
    form.get(
      route("friends.index", { page: new URL(url).searchParams.get("page") }),
      {
        preserveScroll: true,
      }
    );
  }
};

const changePageTo = (page) => {
  form.get(route("friends.index", { page }), {
    preserveScroll: true,
  });
};

const deleteCompany = (companyId) => {
  // Make the delete request
  form.delete(route("friends.destroy", companyId), {
    preserveScroll: true,
    onSuccess: () => {
      toast.success("Company Deleted Successfully");
    },
    onError: (err) => {
      toast.error("Error: " + err.message);
    },
  });
};

const confirmDelete = (companyId) => {
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
      deleteCompany(companyId); // Call the delete method if confirmed
    }
  });
};
</script>
  <style scoped>
</style>
    