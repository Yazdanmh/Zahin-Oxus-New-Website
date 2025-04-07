<template>
    <Head title="MOU Details" />
    <AdminLayout :setting="props.setting" :user="props.user" :permissions="props.permissions">
      <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="fw-bold py-3 mb-4">
          <span class="text-muted fw-light">Home /</span> MOUs / Details
        </h4>
        <div class="row">
          <div class="col-xl">
            <div class="card mb-4">
              <div class="card-header d-flex justify-content-between align-items-center">
                <h5 class="mb-0">MOU Details</h5>
                <small class="text-muted float-end">View MOU Information</small>
              </div>
              <div class="card-body">
                <!-- File Display Section -->
                <div class="d-flex align-items-start align-items-sm-center gap-4 mb-4">
                  <template v-if="props.mou.mou_file">
                    <div v-if="isImage(props.mou.mou_file)">
                      <img
                        :src="'/storage/' + props.mou.mou_file"
                        alt="MOU File"
                        class="d-block rounded"
                        style="width: 300px; height: 100px; object-fit: cover"
                      />
                    </div>
                    <div v-else>
                      <a
                        :href="'/storage/' + props.mou.mou_file"
                        target="_blank"
                        class="btn btn-outline-primary"
                      >
                        <i class="bx bx-download"></i> Download MOU File
                      </a>
                    </div>
                  </template>
                </div>
  
                <!-- MOU Information -->
                <div class="row">
                  <div class="col-md-6">
                    <div class="mb-3">
                      <label class="form-label">Title</label>
                      <p class="form-control-plaintext">{{ props.mou.title }}</p>
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="mb-3">
                      <label class="form-label">Parties Involved</label>
                      <p class="form-control-plaintext">{{ props.mou.parties_involved }}</p>
                    </div>
                  </div>
                  <div class="col-md-4">
                    <div class="mb-3">
                      <label class="form-label">Start Date</label>
                      <p class="form-control-plaintext">{{ props.mou.start_date }}</p>
                    </div>
                  </div>
                  <div class="col-md-4">
                    <div class="mb-3">
                      <label class="form-label">End Date</label>
                      <p class="form-control-plaintext">{{ props.mou.end_date || "Ongoing" }}</p>
                    </div>
                  </div>
                  <div class="col-md-4">
                    <div class="mb-3">
                      <label class="form-label">Status</label>
                      <p class="form-control-plaintext">{{ props.mou.status }}</p>
                    </div>
                  </div>
                  <div class="col-md-12">
                    <div class="mb-3">
                      <label class="form-label">Description</label>
                      <p class="form-control-plaintext" v-html="props.mou.description"></p>
                    </div>
                  </div>
                </div>
  
                <!-- Action Buttons -->
                <div class="d-flex justify-content-end gap-3 mt-4">
                  <button type="button" class="btn btn-outline-secondary" @click="cancel">
                    Back
                  </button>
                  <Link :href="route('mou.edit', props.mou.id)" class="btn btn-primary">
                    <i class="bx bx-edit"></i> Edit MOU
                  </Link>
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
  import { Head, Link } from "@inertiajs/vue3";
  
  const props = defineProps({
    mou: {
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
    permissions:{
      type:Array, required:true
    }
  });
  
  // Check if the file is an image based on its extension
  const isImage = (filePath) => {
    const imageExtensions = ['jpg', 'jpeg', 'png', 'gif', 'bmp'];
    const fileExtension = filePath.split('.').pop().toLowerCase();
    return imageExtensions.includes(fileExtension);
  };
  
  // Go back to the previous page
  const cancel = () => {
    window.history.back();
  };
  </script>
  
  <style scoped>
  </style>
  