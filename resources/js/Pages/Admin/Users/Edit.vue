<template>
    <Head title="Edit User" />
    <AdminLayout :setting="props.setting" :user="props.user" :permissions="props.permissions">
      <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="fw-bold py-3 mb-4">
          <span class="text-muted fw-light">Home /</span> Users / Edit
        </h4>
  
        <div class="row">
          <div class="col-xl">
            <!-- Edit User Card -->
            <div class="card">
              <div class="card-header">
                <h5 class="mb-0">Edit User</h5>
                <small class="text-muted">Modify user details below</small>
              </div>
              <div class="card-body">
                <form @submit.prevent="submit">
                  <!-- First Row: Name and Role -->
                  <div class="row mb-3">
                    <div class="col-md-6">
                      <label for="name" class="form-label">Name</label>
                      <input
                        type="text"
                        id="name"
                        class="form-control"
                        v-model="form.name"
                        placeholder="Enter full name"
                        required
                      />
                      <div v-if="form.errors.name" class="text-danger mt-2">{{ form.errors.name }}</div>
                    </div>
  
                    <div class="col-md-6">
                      <div class="mb-3">
                        <label for="role" class="form-label">Role</label>
                        <div class="position-relative">
                          <select class="form-select" id="role" v-model="form.role_id" required>
                            <option value="" disabled>-- Select Role --</option>
                            <option v-for="role in roles" :key="role.id" :value="role.id">
                              {{ role.name }}
                            </option>
                          </select>
                        </div>
                        <div v-if="form.errors.role_id" class="text-danger mt-2">
                          {{ form.errors.role_id }}
                        </div>
                      </div>
                    </div>
                  </div>
  
                  <!-- Second Row: Email and Password -->
                  <div class="row mb-3">
                    <div class="col-md-6">
                      <label for="email" class="form-label">Email</label>
                      <input
                        type="email"
                        id="email"
                        class="form-control"
                        v-model="form.email"
                        placeholder="Enter email address"
                        required
                      />
                      <div v-if="form.errors.email" class="text-danger mt-2">{{ form.errors.email }}</div>
                    </div>
  
                    <div class="col-md-6">
                      <label for="password" class="form-label">Password</label>
                      <div class="input-group">
                        <!-- Toggle Password Visibility -->
                        <input
                          :type="passwordVisible ? 'text' : 'password'"
                          id="password"
                          class="form-control"
                          v-model="form.password"
                          placeholder="Leave blank to keep current password"
                        />
                        <button type="button" class="btn btn-outline-secondary" @click="togglePasswordVisibility">
                          <i :class="passwordVisible ? 'bx bx-hide' : 'bx bx-show'"></i>
                        </button>
                      </div>
                      <div v-if="form.errors.password" class="text-danger mt-2">{{ form.errors.password }}</div>
                    </div>
                  </div>
  
                  <div class="d-flex justify-content-end mt-4">
                    <button type="submit" class="btn btn-primary">
                      <i class="bx bx-save"></i> Save Changes
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
  import { ref } from "vue";
  import AdminLayout from "@/Layouts/AdminLayout.vue";
  import { Head, useForm } from "@inertiajs/vue3";
  import { useToast } from "vue-toastification";
  
  const props = defineProps({
    roles: Array,
    setting: Object,
    user: Object,
    permissions: Array,
  });
  
  // Toast notifications
  const toast = useToast();
  
  // Initialize form with fields
  const form = useForm({
    name: props.user.name || "",
    email: props.user.email || "",
    password: "",
    role_id: props.user.roles.length ? props.user.roles[0].id : "", // Set role if available
  });
  
  // Make passwordVisible reactive using ref
  const passwordVisible = ref(false);
  const togglePasswordVisibility = () => {
    passwordVisible.value = !passwordVisible.value;
  };
  
  // Submit the form
  const submit = () => {
    form.post(route("users.update", props.user.id), {
      onSuccess: () => {
        toast.success("User updated successfully");
      },
      onError: () => {
        toast.error("Failed to update user");
      }
    });
  };
  </script>
  
  <style scoped>
  select.form-select {
    position: relative;
    padding-right: 30px; 
  }
  </style>
  