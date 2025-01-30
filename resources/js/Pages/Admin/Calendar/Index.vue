<template>
  <Head title="Academic Calendar" />
  <AdminLayout :setting="props.setting" :user="props.user">
    <div class="container-xxl flex-grow-1 container-p-y">
      <h4 class="fw-bold py-3 mb-4">
        <span class="text-muted fw-light">Home /</span> Academic Calendar
      </h4>
      <div class="row">
        <div class="col-md-12">
          <div class="card mb-4">
            <div
              class="card-header d-flex justify-content-between align-items-center"
            >
              <h5 class="mb-0">Upload Academic Calendar</h5>
              <small class="text-muted float-end"
                >Manage academic calendar file</small
              >
            </div>
            <div class="card-body">
              <form @submit.prevent="submit">
                <div class="row">
                  <div class="col-md-6">
                    <div class="mb-3">
                      <label for="calendarTitle" class="form-label"
                        >Title</label
                      >
                      <input
                        type="text"
                        class="form-control"
                        id="calendarTitle"
                        placeholder="Academic Calendar 2025"
                        v-model="form.title"
                      />
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="mb-3">
                      <label for="calendarFile" class="form-label"
                        >Upload Academic Calendar</label
                      >
                      <input
                        type="file"
                        class="form-control"
                        id="calendarFile"
                        @change="handleFileUpload"
                        accept=".pdf,.docx,.xls,.xlsx"
                      />
                    </div>
                  </div>
                </div>

                <div class="d-flex justify-content-end mt-3">
                  <button type="submit" class="btn btn-primary">
                    Upload Calendar
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
              <h5 class="mb-0">Upload Academic Calendar</h5>
              <small class="text-muted float-end"
                >Manage academic calendar file</small
              >
            </div>
            <div class="card-body">
              <!-- Table -->
              <div class="table table-responsive">
                <table class="table table-hover align-middle mb-0">
                  <thead>
                    <tr>
                      <th>#</th>
                      <th>Title</th>
                      <th>File</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr
                      v-for="calendar in props.calendars.data"
                      :key="calendar.id"
                    >
                      <td>{{ calendar.id }}</td>
                      <td>{{ calendar.title }}</td>
                      <!-- Fixed: Added title column -->
                      <td>
                        <a
                          v-if="calendar.file"
                          :href="'/storage/' + calendar.file"
                          target="_blank"
                          download
                          class="btn btn-sm btn-outline-primary"
                        >
                          Download
                        </a>
                        <span v-else class="text-muted">No file</span>
                      </td>
                      <td>
                        <span
                          @click="confirmDelete(calendar.id)"
                          class="badge bg-label-danger p-1_5 me-3 cursor-pointer mb-2"
                        >
                          <i class="icon-base bx bx-trash icon-xs"></i>
                        </span>
                      </td>
                    </tr>
                  </tbody>
                </table>
              </div>
              <!-- Pagination Links -->
              <div
                v-if="props.calendars.total > 0"
                class="d-flex justify-content-center mt-3"
              >
                <nav aria-label="Page navigation">
                  <ul class="pagination">
                    <li
                      class="page-item"
                      :class="{ disabled: !props.calendars.prev_page_url }"
                    >
                      <a
                        class="page-link"
                        href="#"
                        @click.prevent="
                          changePage(props.calendars.prev_page_url)
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
                      :class="{ disabled: !props.calendars.next_page_url }"
                    >
                      <a
                        class="page-link"
                        href="#"
                        @click.prevent="
                          changePage(props.calendars.next_page_url)
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
import { Head } from "@inertiajs/vue3";
import { useForm } from "@inertiajs/vue3";
import { useToast } from "vue-toastification";
import { ref, computed } from "vue";
import Swal from "sweetalert2";

const props = defineProps({
  calendars: {
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
  title: "",
  file: null, // The uploaded file will be stored here
});

const filePreview = ref(null); // Holds preview information about the file
const uploadedFile = ref(null); // Holds information about the uploaded file

const currentPage = ref(props.calendars.current_page); // Track the current page
const totalPages = computed(() => {
  return Array.from({ length: props.calendars.last_page }, (_, i) => i + 1);
});

// Handle file upload
const handleFileUpload = (event) => {
  const file = event.target.files[0];
  if (file) {
    form.file = file;
    filePreview.value = file;
  }
};
const changePage = (url) => {
  if (url) {
    form.get(
      route("caledars.index", {
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
  form.get(route("calendars.index", { page }), {
    preserveScroll: true,
  });
};

// Submit the form with the file
const submit = () => {
  if (!form.file) {
    toast.error("Please select a file to upload");
    return;
  }

  form.post(route("calendars.store"), {
    preserveScroll: true,
    onSuccess: (response) => {
      toast.success("Academic Calendar Uploaded Successfully");
      uploadedFile.value = response.data; // Assuming the server returns file data
      form.reset();
      filePreview.value = null;
    },
    onError: (err) => {
      toast.error("Error: " + err.message);
    },
  });
};

const deleteCalendar = (id) => {
  form.delete(route("calendars.destroy", id), {
    preserveScroll: true,
    onSuccess: () => {
      toast.success("Calendar Deleted Successfully");
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
      deleteCalendar(id);
    }
  });
};
</script>
  
  <style scoped>
</style>
  