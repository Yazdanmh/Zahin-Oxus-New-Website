<template>
  <Head title="Backup Management" />
  <AdminLayout :setting="props.setting" :user="props.user" :permissions="props.permissions">
    <div class="container-xxl flex-grow-1 container-p-y">
      <h4 class="fw-bold py-3 mb-4">
        <span class="text-muted fw-light">Admin /</span> Backup Management
      </h4>
      
      <!-- Backup Form -->
      <div class="row">
        <div class="col-xl">
          <div class="card mb-4">
            <div class="card-header d-flex justify-content-between align-items-center">
              <h5 class="mb-0">Create Backup</h5>
              <small class="text-muted float-end">Initiate Manual Backup</small>
            </div>
            <div class="card-body">
              <form @submit.prevent="submitBackup">
                <!-- Backup Type Selection -->
                <div class="form-group">
                  <label for="backup_type" class="form-label">Select Backup Type</label>
                  <select v-model="form.backup_type" class="form-control" id="backup_type" required>
                    <option value="full">Full Backup</option>
                    <option value="database">Database Backup</option>
                  </select>
                </div>
                
                <!-- Submit Button -->
                <button type="submit" class="btn btn-primary mt-3">
                  Start Backup
                </button>
              </form>
            </div>
          </div>
        </div>
      </div>

      <!-- Backup History -->
      <div class="row mt-4">
        <div class="col-xl">
          <div class="card mb-4">
            <div class="card-header d-flex justify-content-between align-items-center">
              <h5 class="mb-0">Backup History</h5>
              <small class="text-muted float-end">List of all backups</small>
            </div>
            <div class="card-body">
              <table class="table table-striped">
                <thead>
                  <tr>
                    <th>#</th>
                    <th>Backup Type</th>
                    <th>Date Created</th>
                    <th>Download</th>
                  </tr>
                </thead>
                <tbody>
                  <tr v-for="(backup, index) in backups" :key="backup.file">
                    <td>{{ index + 1 }}</td>
                    <td>{{ backup.type }}</td>
                    <td>{{ new Date(backup.created_at * 1000).toLocaleString() }}</td>
                    <td><a :href="backup.file_url" class="btn btn-success btn-sm" download>Download</a></td>
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
import { Head } from "@inertiajs/vue3";
import { useForm } from "@inertiajs/vue3";
import { useToast } from "vue-toastification";
import { ref } from "vue";

// Props passed from the server
const props = defineProps({
  setting: {
    type: Object,
    required: true,
  },
  user: {
    type: Object,
    required: true,
  },
  permissions: {
    type: Array,
    required: true,
  },
  backups: {
    type: Array,
    required: true,
  }
});

// Toast notifications
const toast = useToast();
const errors = ref({});
const form = useForm({
  backup_type: "full", // Default backup type
});

// Handle backup submission
const submitBackup = () => {
  form.post(route("backup.store"), {
    preserveScroll: true,
    onSuccess: () => {
      toast.success("Backup started successfully.");
    },
    onError: (err) => {
      errors.value = err;
      toast.error("An error occurred while initiating the backup.");
    },
  });
};

// Initialize backups list
const backups = ref(props.backups);

// Check if the user has permission
const hasPermission = (permission) => {
  return props.permissions.includes(permission);
};
</script>
