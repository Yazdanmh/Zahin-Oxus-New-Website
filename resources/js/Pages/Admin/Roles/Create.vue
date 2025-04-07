<template>
    <Head title="Create Role" />
    <AdminLayout :setting="props.setting" :user="props.user" :permissions ="props.permissions">
      <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="fw-bold py-3 mb-4">
          <span class="text-muted fw-light">Home /</span> Roles / Create
        </h4>
        <div class="row">
          <div class="col-xl">
            <div class="card mb-4">
              <div
                class="card-header d-flex justify-content-between align-items-center"
              >
                <h5 class="mb-0">Create New Role</h5>
                <small class="text-muted float-end">Add a new role to the system</small>
              </div>
              <div class="card-body">
                <form @submit.prevent="submit">
                  <div class="mb-3">
                    <label for="name" class="form-label">Role Name</label>
                    <input
                      type="text"
                      id="name"
                      class="form-control"
                      v-model="form.name"
                      placeholder="Enter role name"
                    />
                    <div v-if="form.errors.name" class="text-danger mt-2">
                      {{ form.errors.name }}
                    </div>
                  </div>
                  <div class="d-flex justify-content-end gap-3 mt-4">
                    <button type="submit" class="btn btn-primary">
                      <i class="bx bx-save"></i> Save Role
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
    setting: {
      type: Object,
      required: true,
    },
    user: {
      type: Object,
      required: true,
    },
    permissions :{type:Array, required:true}
  });
  
  const toast = useToast();
  
  const form = useForm({
    name: "",
  });
  
  const submit = () => {
    form.post(route("roles.store"), {
      preserveScroll: true,
      onSuccess: () => {
        toast.success("Role created successfully");
      },
      onError: () => {
        toast.error("Error creating role");
      },
    });
  };
  </script>
  
  <style scoped>
  </style>
  