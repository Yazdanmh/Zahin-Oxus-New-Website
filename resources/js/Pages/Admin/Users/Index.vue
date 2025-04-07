<template>
    <Head title="Users" />
    <AdminLayout :setting="props.setting" :user="props.user" :permissions ="props.permissions">
      <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="fw-bold py-3 mb-4">
          <span class="text-muted fw-light">Home /</span> Users
        </h4>
  
        <div class="row">
          <div class="col-xl">
            <!-- Users Table Card -->
            <div class="card">
              <div class="card-header">
                <h5 class="mb-0">Users</h5>
                <small class="text-muted">Manage users and their roles</small>
                <div v-if="hasPermission('users.create') " class="d-flex justify-content-end">
                  <Link :href="route('users.create')" class="btn btn-primary">
                    <i class="bx bx-plus"></i> Create User
                  </Link>
                </div>
              </div>
              <div class="card-body">
                <table class="table table-bordered">
                  <thead>
                    <tr>
                      <th>ID</th>
                      <th>Name</th>
                      <th>Email</th>
                      <th>Role</th>
                      <th v-if="hasPermission('users.edit') || hasPermission('users.delete') " class="text-center">Actions</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr v-for="user in users" :key="user.id">
                      <td>{{ user.id }}</td>
                      <td>{{ user.name }}</td>
                      <td>{{ user.email }}</td>
                      <td>{{ user.roles.length ? user.roles[0].name : 'No Role' }}
                    </td  >
                      <td v-if="hasPermission('users.edit') || hasPermission('users.delete') " class="text-center">
                        <Link  v-if="hasPermission('users.edit') ":href="route('users.edit', user.id)">
                          <span class="badge bg-label-primary p-1_5 me-2 cursor-pointer">
                            <i class="bx bx-pencil icon-xs"></i>
                          </span>
                        </Link>
                        <span v-if="hasPermission('users.delete')"
                          @click="confirmDelete(user.id)"
                          class="badge bg-label-danger p-1_5 me-2 cursor-pointer"
                        >
                          <i class="bx bx-trash icon-xs"></i>
                        </span>
                      </td>
                    
                    </tr>
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
      </div>
    </AdminLayout>
  </template>
  
  <script setup>
  import AdminLayout from "@/Layouts/AdminLayout.vue";
  import { Head, Link, useForm} from "@inertiajs/vue3";
  import { useToast } from "vue-toastification";
  import Swal from "sweetalert2";
  
  const props = defineProps({
    users: Array,
    setting: Object,
    user: Object,
    permissions :{type:Array, required:true}
  });
  console.log(props.users);
  const form = useForm();
  
  // Toast notifications
  const toast = useToast();
  
  // Method to confirm delete action
  const confirmDelete = (userId) => {
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
        deleteUser(userId);
      }
    });
  };
  
  // Method to delete the user
  const deleteUser = (userId) => {
    // Send the request to the backend to delete the user
    form.post(route('users.destroy', userId), {
      onSuccess: () => {
        toast.success("User deleted successfully.");
      },
      onError: () => {
        toast.error("Failed to delete the user.");
      }
    });
  };
  const hasPermission = (permission) =>{
  return props.permissions.includes(permission)
}
  </script>
  