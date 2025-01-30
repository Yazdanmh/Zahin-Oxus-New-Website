<template>
  <Head title="Projects" />
  <AdminLayout :setting="props.setting" :user="props.user">
    <div class="container-xxl flex-grow-1 container-p-y">
      <h4 class="fw-bold py-3 mb-4">
        <span class="text-muted fw-light">Home /</span> Projects / All
      </h4>
      <div class="row">
        <div class="col-xl">
          <div class="card mb-4">
            <div
              class="card-header d-flex justify-content-between align-items-center"
            >
              <h5 class="mb-0">All Projects</h5>
              <small class="text-muted float-end">List of all Projects</small>
            </div>
            <div class="card-body">
              <div class="d-flex justify-content-end mb-3">
                <Link :href="route('projects.create')" class="btn btn-primary">
                  <i class="bx bx-plus"></i> Add Project
                </Link>
              </div>

              <!-- Show message if no projects -->
              <div v-if="props.projects.data.length === 0">
                <p class="text-center text-muted">No projects found.</p>
              </div>
              <div v-else class="table-responsive">
                <!-- Projects Table -->
                <table class="table table-bordered">
                  <thead>
                    <tr>
                      <th>#</th>
                      <th>Image</th>
                      <th>Name</th>
                      <th>Category</th>
                      <th>Actions</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr
                      v-for="(project, index) in props.projects.data"
                      :key="project.id"
                    >
                      <td>{{ index + 1 }}</td>
                      <td>
                        <img
                          :src="'/storage/' + project.image"
                          alt=""
                          style="
                            width: 70px;
                            height: 70px;
                            border-radius: 50%;
                            object-fit: cover;
                          "
                        />
                      </td>
                      <td>{{ project.name }}</td>
                      <td>{{ project.category.title }}</td>
                      <td class="text-center">
                        <Link :href="route('projects.edit', project.id)">
                          <span
                            class="badge bg-label-primary p-1_5 me-3 cursor-pointer mb-2"
                          >
                            <i class="icon-base bx bx-pencil icon-xs"></i>
                          </span>
                        </Link>
                        <span
                          @click="confirmDelete(project.id)"
                          class="badge bg-label-danger p-1_5 me-3 cursor-pointer mb-2"
                        >
                          <i class="icon-base bx bx-trash icon-xs"></i>
                        </span>
                        <Link :href="route('projects.show', project.id)">
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
                  </tbody>
                </table>
              </div>

              <div
                v-if="props.projects.last_page > 1"
                class="pagination-wrapper"
              >
                <nav>
                  <ul class="pagination justify-content-center">
                    <li
                      class="page-item"
                      :class="{ disabled: props.projects.current_page === 1 }"
                    >
                      <Link
                        :href="props.projects.prev_page_url"
                        class="page-link"
                        :disabled="props.projects.current_page === 1"
                        >Previous</Link
                      >
                    </li>
                    <li
                      v-for="page in props.projects.last_page"
                      :key="page"
                      :class="{
                        'page-item': true,
                        active: page === props.projects.current_page,
                      }"
                    >
                      <Link
                        :href="route('projects.index', { page: page })"
                        class="page-link"
                      >
                        {{ page }}
                      </Link>
                    </li>
                    <li
                      class="page-item"
                      :class="{
                        disabled:
                          props.projects.current_page ===
                          props.projects.last_page,
                      }"
                    >
                      <Link
                        :href="props.projects.next_page_url"
                        class="page-link"
                        :disabled="
                          props.projects.current_page ===
                          props.projects.last_page
                        "
                        >Next</Link
                      >
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
import Swal from "sweetalert2";
import { Head, useForm, Link } from "@inertiajs/vue3";
import { defineProps } from "vue";
import { useToast } from "vue-toastification";

const props = defineProps({
  projects: {
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

const form = useForm({});
const toast = useToast();

// Delete a project
const deleteProject = (id) => {
  form.delete(route("projects.destroy", id), {
    preserveScroll: true,
    onSuccess: () => {
      toast.success("Project Deleted Successfully");
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
      deleteProject(id);
    }
  });
};
</script>

<style scoped>
.pagination-wrapper {
  margin-top: 20px;
}
</style>
