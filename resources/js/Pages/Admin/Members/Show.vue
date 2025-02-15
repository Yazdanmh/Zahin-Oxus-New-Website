<template>
    <Head title="Member Details" />
    <AdminLayout :setting="props.setting" :user="props.user">
      <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="fw-bold py-3 mb-4">
          <span class="text-muted fw-light">Home /</span> Members / Details
        </h4>
        <div class="row">
          <div class="col-xl">
            <div class="card mb-4">
              <div class="card-header d-flex justify-content-between align-items-center">
                <h5 class="mb-0">Member Details</h5>
              </div>
              <div class="card-body">
                <div class="d-flex align-items-start align-items-sm-center gap-4">
                  <img
                    v-if="form.image"
                    :src="'/storage/' + form.image"
                    alt="Member Image"
                    class="d-block rounded"
                    style="width: 100px; height: 100px; object-fit: cover"
                  />
                  <div>
                    <h6 class="fw-bold">{{ form.name }}</h6>
                    <p class="text-muted">{{ form.position }}</p>
                  </div>
                </div>
  
                <div class="row mt-3">
                  <div class="col-md-4">
                    <h6><strong>Email:</strong></h6>
                    <p>{{ form.email }}</p>
                  </div>
                  <div class="col-md-4">
                    <h6><strong>Phone:</strong></h6>
                    <p>{{ form.phone }}</p>
                  </div>
                  <div class="col-md-4">
                    <h6><strong>Facebook:</strong></h6>
                    <p v-if="form.facebook">
                      <a :href="form.facebook" target="_blank">{{ form.facebook }}</a>
                    </p>
                    <p v-else>No Facebook profile</p>
                  </div>
                  <div class="col-md-4">
                    <h6><strong>Twitter:</strong></h6>
                    <p v-if="form.twitter">
                      <a :href="form.twitter" target="_blank">{{ form.twitter }}</a>
                    </p>
                    <p v-else>No Twitter profile</p>
                  </div>
                  <div class="col-md-4">
                    <h6><strong>Skills:</strong></h6>
                    <p v-if="form.skills">
                      {{ form.skills }}
                    </p>
                    <p v-else>No Skills</p>
                  </div>
                </div>
  
                <div class="mt-3">
                  <h6><strong>Description:</strong></h6>
                  <p v-html="form.description"></p>
                </div>
  
                <div class="d-flex justify-content-end gap-3 mt-4">
                  <button type="button" class="btn btn-outline-secondary" @click="cancel">Back</button>
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
  import { Head } from "@inertiajs/vue3";
  import { ref } from "vue";
  
  const props = defineProps({
    setting: { type: Object, required: true },
    user: { type: Object, required: true },
    member: { type: Object, required: true },
  });
  
  const form = ref({ ...props.member });
  
  const cancel = () => {
    window.history.back(); // Go back to the previous page
  };
  </script>
  
  <style scoped>
  </style>
  