<template>
  <Head title="Trainings" />
  <AdminLayout :setting="props.setting" :user="props.user">
    <div class="container-xxl flex-grow-1 container-p-y">
      <h4 class="fw-bold py-3 mb-4">
        <span class="text-muted fw-light">Home /</span> Trainings
      </h4>

      <div class="card">
        <div
          class="card-header d-flex justify-content-between align-items-center"
        >
          <h5 class="mb-0">Trainings List</h5>
          <Link :href="route('training.create')" class="btn btn-primary"
            >Add Training</Link
          >
        </div>

        <div class="table-responsive">
          <table class="table table-hover">
            <thead>
              <tr>
                <th>#</th>
                <th>Name</th>

                <th>Start Date</th>
                <th>End Date</th>
                <th>Has Form</th>
                <th>Service</th>
                <th>Actions</th>
              </tr>
            </thead>
            <tbody>
              <tr
                v-for="(training, index) in trainings.data"
                :key="training.id"
              >
                <td>
                  {{
                    index +
                    1 +
                    (trainings.current_page - 1) * trainings.per_page
                  }}
                </td>
                <td>{{ training.name || "Untitled" }}</td>

                <td>{{ training.start_date }}</td>
                <td>{{ training.end_date }}</td>
                <td class="text-center">
                  <span
                    :class="[
                      'badge',
                      training.has_form ? 'bg-success' : 'bg-danger',
                    ]"
                  >
                    {{ training.has_form ? "Yes" : "No" }}
                  </span>
                </td>
                <td class="">
                  {{training.service.title}}
                </td>
                <td>
                  <Link :href="route('training.edit', training.id)">
                    <span
                      class="badge bg-label-primary p-1_5 me-3 cursor-pointer mb-2"
                    >
                      <i class="icon-base bx bx-pencil icon-xs"></i>
                    </span>
                  </Link>
                  <span
                    @click="deleteTraining(training.id)"
                    class="badge bg-label-danger p-1_5 me-3 cursor-pointer mb-2"
                  >
                    <i class="icon-base bx bx-trash icon-xs"></i>
                  </span>
                  <Link :href="route('training.show', training.id)">
                    <span
                      class="badge bg-label-primary p-1_5 me-3 cursor-pointer mb-2"
                    >
                      <i class="icon-base bx bx-message-square-detail"></i>
                    </span>
                  </Link>

                  <Link :href="route('participants.show', training.id)">
                    <span
                      class="badge bg-label-primary p-1_5 me-3 cursor-pointer mb-2"
                    >
                      <i class="icon-base bx bx-show icon-xs"></i>
                    </span>
                  </Link>
                </td>
              </tr>
              <tr v-if="!trainings.data.length">
                <td colspan="7" class="text-center">No trainings found</td>
              </tr>
            </tbody>
          </table>
        </div>

        <!-- Pagination -->
        <div
          class="card-footer d-flex justify-content-between align-items-center"
        >
          <span>
            Showing {{ trainings.from }} to {{ trainings.to }} of
            {{ trainings.total }} trainings
          </span>
          <nav aria-label="Page navigation">
            <ul class="pagination">
              <!-- Previous Page Link -->
              <li
                class="page-item"
                :class="{ disabled: !props.trainings.prev_page_url }"
              >
                <a
                  class="page-link"
                  href="#"
                  @click.prevent="changePage(props.trainings.prev_page_url)"
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
                :class="{ disabled: !props.trainings.next_page_url }"
              >
                <a
                  class="page-link"
                  href="#"
                  @click.prevent="changePage(props.trainings.next_page_url)"
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
import { ref, computed } from "vue";
import { useToast } from "vue-toastification";
import Swal from "sweetalert2";
import axios from "axios";

const toast = useToast();
const form = useForm({});
const props = defineProps({
  trainings: {
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
const currentPage = ref(props.trainings.current_page); 
const totalPages = computed(() => {
  return Array.from({ length: props.trainings.last_page }, (_, i) => i + 1);
});

const changePage = (url) => {
  if (url) {
    form.get(
      route("training.index", { page: new URL(url).searchParams.get("page") }),
      {
        preserveScroll: true,
      }
    );
  }
};

const changePageTo = (page) => {
  form.get(route("training.index", { page }), {
    preserveScroll: true,
  });
};


const deleteTraining = (id) => {
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
      form.post(route("training.destroy", id), {
        preserveScroll: true,
        data: { _method: "DELETE" },  // Force DELETE request
        onSuccess: () => {
          toast.success("Training Deleted Successfully");
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
  