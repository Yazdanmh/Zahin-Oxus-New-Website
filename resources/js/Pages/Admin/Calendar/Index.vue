<template>
    <Head title="Academic Calendar" />
    <AdminLayout>
      <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="fw-bold py-3 mb-4">
          <span class="text-muted fw-light">Home /</span> Academic Calendar
        </h4>
        <div class="row">
          <div class="col-xl">
            <div class="card mb-4">
              <div class="card-header d-flex justify-content-between align-items-center">
                <h5 class="mb-0">Upload Academic Calendar</h5>
                <small class="text-muted float-end">Manage academic calendar file</small>
              </div>
              <div class="card-body">
                <form @submit.prevent="submit">
                  <div class="d-flex gap-3">
                    <!-- File Upload Section -->
                    <div class="d-flex flex-column" style="flex: 1">
                      <div class="mb-3">
                        <label for="calendarFile" class="form-label">Upload Academic Calendar</label>
                        <input
                          type="file"
                          class="form-control"
                          id="calendarFile"
                          @change="handleFileUpload"
                          accept=".pdf,.docx,.xls,.xlsx"
                        />
                        <div v-if="filePreview" class="mt-2">
                          <strong>Preview:</strong>
                          <p>{{ filePreview.name }}</p>
                        </div>
                      </div>
                      <div v-if="form.errors.file" class="text-danger mt-2">
                        {{ form.errors.file }}
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
  
          <!-- Displaying the Uploaded File -->
          <div v-if="uploadedFile" class="col-md-12">
            <div class="card mb-4">
              <div class="card-header d-flex justify-content-between align-items-center">
                <h5 class="mb-0">Uploaded Academic Calendar</h5>
                <small class="text-muted float-end">View the uploaded calendar</small>
              </div>
              <div class="card-body">
                <p><strong>Uploaded File:</strong> {{ uploadedFile.name }}</p>
                <a :href="`/storage/${uploadedFile.path}`" target="_blank" class="btn btn-info">
                  View Calendar
                </a>
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
  
  const toast = useToast();
  const form = useForm({
    file: null, // The uploaded file will be stored here
  });
  
  const filePreview = ref(null); // Holds preview information about the file
  const uploadedFile = ref(null); // Holds information about the uploaded file
  
  // Handle file upload
  const handleFileUpload = (event) => {
    const file = event.target.files[0];
    if (file) {
      form.file = file;
      filePreview.value = file;
    }
  };
  
  // Submit the form with the file
  const submit = () => {
    if (!form.file) {
      toast.error("Please select a file to upload");
      return;
    }
  
    form.post(route("academic-calendar.upload"), {
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
  </script>
  
  <style scoped>
  </style>
  