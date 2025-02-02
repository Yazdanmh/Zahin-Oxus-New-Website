<script setup lang="ts">
import { Head, Link } from "@inertiajs/vue3";
import AdminLayout from "@/Layouts/AdminLayout.vue";
import { computed } from "vue";


const props = defineProps({
    setting:{
        type:Object, 
        required:true, 
    }, 
    user:{
        type:Object, 
        required:true, 
    }, 
    messages:{
        type:Object, 
        required:true, 
    }
})
const displayedMessages = computed(() => messages.value.slice(0, 2));

const truncateMessage = (text) => {
  return text.length > 200 ? text.substring(0, 200) + "..." : text;
};

const formatDate = (date) => {
  return new Date(date).toLocaleDateString("en-US", {
    month: "short",
    day: "numeric",
    year: "numeric",
  });
};
</script>

<template>
  <Head title="Profile" />

  <!-- Pass props to AdminLayout -->
  <AdminLayout :setting="props.setting" :user="props.user">
    <!-- Content wrapper -->
   
      <!-- Content -->
      <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="fw-bold py-3 mb-4">
          <span class="text-muted fw-light">Account Settings /</span> Account
        </h4>

        <div class="row">
          <div class="col-md-12">
            <ul class="nav nav-pills flex-column flex-md-row mb-3">
              <li class="nav-item">
                <Link class="nav-link " :href="route('profile.edit')"
                  ><i class="bx bx-user me-1"></i> Account</Link
                >
              </li>
              <li class="nav-item">
                <Link
                  class="nav-link active"
                  :href="route('notifications.index')"
                  ><i class="bx bx-bell me-1"></i> Notifications</Link
                >
              </li>
            </ul>

          </div>
        </div>
        <div class="row">
        <!-- Order Statistics -->
        <div class="col-md-12 col-lg-12 col-xl-12 order-0 mb-4">
          <div class="card h-100">
            <div
              class="card-header d-flex align-items-center justify-content-between pb-0"
            >
              <div class="card-title mb-0">
                <h5 class="m-0 me-2">Messages</h5>
                <small class="text-muted">via Contact Form</small>
              </div>
              <div class="dropdown">
                <button
                  class="btn p-0"
                  type="button"
                  id="messageDropdown"
                  data-bs-toggle="dropdown"
                  aria-haspopup="true"
                  aria-expanded="false"
                >
                  <i class="bx bx-dots-vertical-rounded"></i>
                </button>
                <div
                  class="dropdown-menu dropdown-menu-end"
                  aria-labelledby="messageDropdown"
                >
                  <a class="dropdown-item" href="javascript:void(0);"
                    >View All</a
                  >
                </div>
              </div>
            </div>
            <div class="card-body">
              <div
                v-if="props.messages.length === 0"
                class="text-muted text-center"
              >
                No messages available.
              </div>
              <div v-else>
                <div
                  v-for="(message, index) in props.messages"
                  :key="index"
                  class="mb-3 p-2 border-bottom"
                >
                  <div class="fw-bold">{{ message.name }}</div>
                  <p class="mb-1 text-muted small">
                    {{ formatDate(message.created_at) }}
                  </p>
                  <p class="m-0">{{ truncateMessage(message.message) }}</p>
                </div>
              </div>
            </div>
          </div>
        </div>
        <!--/ Order Statistics -->
      </div>
      </div>
      <!-- / Content -->

      <div class="content-backdrop fade"></div>
  
  </AdminLayout>
</template>
