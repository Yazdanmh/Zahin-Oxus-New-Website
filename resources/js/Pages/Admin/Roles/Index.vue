<template>
  <Head title="Roles" />
  <AdminLayout :setting="props.setting" :user="props.user">
    <div class="container-xxl flex-grow-1 container-p-y">
      <h4 class="fw-bold py-3 mb-4">
        <span class="text-muted fw-light">Home /</span> Roles / All
      </h4>

      <div class="row">
        <div class="col-xl">
          <div class="card mb-4">
            <div class="card-header d-flex justify-content-between align-items-center">
              <h5 class="mb-0">All Roles</h5>
              <small class="text-muted float-end">List of all roles</small>
            </div>

            <div class="card-body">
              <div class="d-flex justify-content-end mb-3">
                <Link :href="route('roles.create')" class="btn btn-primary">
                  <i class="bx bx-plus"></i> Add Role
                </Link>
              </div>

              <div v-if="props.roles.data.length === 0">
                <p class="text-center text-muted">No roles found.</p>
              </div>

              <div v-else class="table-responsive">
                <table class="table table-bordered">
                  <thead>
                    <tr>
                      <th>#</th>
                      <th>Role Name</th>
                      <th>Actions</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr v-for="(role, index) in props.roles.data" :key="role.id">
                      <td>{{ index + 1 }}</td>
                      <td>{{ role.name }}</td>
                      <td class="text-center">
                        <Link :href="route('roles.edit', role.id)">
                          <span class="badge bg-label-primary p-1_5 me-2 cursor-pointer">
                            <i class="bx bx-pencil icon-xs"></i>
                          </span>
                        </Link>
                        <span
                          @click="confirmDelete(role.id)"
                          class="badge bg-label-danger p-1_5 me-2 cursor-pointer"
                        >
                          <i class="bx bx-trash icon-xs"></i>
                        </span>
                      </td>
                    </tr>
                  </tbody>
                </table>
              </div>

              <!-- Pagination -->
              <div v-if="props.roles.last_page > 1" class="pagination-wrapper mt-4">
                <nav>
                  <ul class="pagination justify-content-center">
                    <li class="page-item" :class="{ disabled: !props.roles.prev_page_url }">
                      <Link :href="props.roles.prev_page_url || '#'" class="page-link">Previous</Link>
                    </li>

                    <li
                      v-for="page in props.roles.last_page"
                      :key="page"
                      class="page-item"
                      :class="{ active: page === props.roles.current_page }"
                    >
                      <Link
                        :href="route('roles.index', { page })"
                        class="page-link"
                      >
                        {{ page }}
                      </Link>
                    </li>

                    <li class="page-item" :class="{ disabled: !props.roles.next_page_url }">
                      <Link :href="props.roles.next_page_url || '#'" class="page-link">Next</Link>
                    </li>
                  </ul>
                </nav>
              </div>
              <!-- End Pagination -->
            </div>
          </div>
        </div>
      </div>
    </div>
  </AdminLayout>
</template>

<script setup>
import AdminLayout from "@/Layouts/AdminLayout.vue";
import { Head, useForm, Link } from "@inertiajs/vue3";
import Swal from "sweetalert2";
import { defineProps } from "vue";
import { useToast } from "vue-toastification";

const props = defineProps({
  roles: {
    type: Object,
    required: true,
  },
  setting: {
    type: Object,
    required: true,
  },
  user: {
    type: Object,
    required: true,
  },
});

const form = useForm({});
const toast = useToast();

const deleteRole = (id) => {
  form.post(route("roles.destroy", id), {
    preserveScroll: true,
    onSuccess: () => {
      toast.success("Role deleted successfully");
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
      deleteRole(id);
    }
  });
};
</script>
