<template>
    <Head title="Edit Role" />
    <AdminLayout :setting="props.setting" :user="props.user" :permissions ="props.permissions">
      <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="fw-bold py-3 mb-4">
          <span class="text-muted fw-light">Home /</span> Roles / Edit
        </h4>
  
        <div class="row">
          <div class="col-xl">
  
            <!-- Role Edit Form -->
            <div class="card mb-4">
              <div class="card-header">
                <h5 class="mb-0">Edit Role</h5>
                <small class="text-muted">Update role name and permissions</small>
              </div>
              <div class="card-body">
                <form @submit.prevent="submit">
                  <div class="mb-3">
                    <label for="name" class="form-label">Role Name</label>
                    <input type="text" id="name" class="form-control" v-model="form.name" style="max-width:250px;" />
                    <div v-if="form.errors.name" class="text-danger mt-2">{{ form.errors.name }}</div>
                  </div>
  
                  <!-- Permissions Table Card -->
                  <div class="card mt-4">
                    <div class="card-header">
                      <h5 class="mb-0">Permissions</h5>
                      <small class="text-muted">Assign permissions to this role</small>
                    </div>
                    <div class="card-body table-responsive">
                      <table class="table table-bordered">
                        <thead>
                          <tr>
                            <th>Service</th>
                            <th class="text-center">View</th>
                            <th class="text-center">Create</th>
                            <th class="text-center">Edit</th>
                            <th class="text-center">Delete</th>
                          </tr>
                        </thead>
                        <tbody>
                          <tr v-for="service in services" :key="service">
                            <td class="text-capitalize">{{ service.replace('_', ' ') }}</td>
                            <td class="text-center">
                              <input type="checkbox" :value="`${service}.view`" v-model="form.permissions" />
                            </td>
                            <td class="text-center">
                              <input type="checkbox" :value="`${service}.create`" v-model="form.permissions" />
                            </td>
                            <td class="text-center">
                              <input type="checkbox" :value="`${service}.edit`" v-model="form.permissions" />
                            </td>
                            <td class="text-center">
                              <input type="checkbox" :value="`${service}.delete`" v-model="form.permissions" />
                            </td>
                          </tr>
                        </tbody>
                      </table>
                    </div>
                  </div>
  
                  <!-- Submit Button -->
                  <div class="d-flex justify-content-end mt-4">
                    <button type="submit" class="btn btn-primary">
                      <i class="bx bx-save"></i> Save Permissions
                    </button>
                  </div>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
    </AdminLayout>
  </template>
  
  <script setup>
  import AdminLayout from "@/Layouts/AdminLayout.vue";
  import { Head, useForm } from "@inertiajs/vue3";
  import { useToast } from "vue-toastification";
  
  const props = defineProps({
    role: Object,
    setting: Object,
    user: Object,
    assignedPermissions: Array,
    permissions :{type:Array, required:true}
  });
  
  const toast = useToast();
  
  // List of services for permissions, including user and role permissions
  const services = [
    "site_data",
    "training",
    "events",
    "gallery",
    "projects",
    "MOUs",
    "certificate",
    "users",        // Added user permissions
    "roles",        // Added role permissions
  ];
  
  const form = useForm({
    name: props.role.name,
    permissions: [...props.assignedPermissions], // Pre-populating with assigned permissions
  });
  
  const submit = () => {
    form.post(route("roles.update", props.role.id), {
      preserveScroll: true,
      onSuccess: () => toast.success("Role updated successfully"),
      onError: () => toast.error("Failed to update role"),
    });
  };
  </script>
  