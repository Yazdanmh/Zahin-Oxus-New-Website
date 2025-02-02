<script setup lang="ts">
import { defineProps } from "vue";
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import DeleteUserForm from "./Partials/DeleteUserForm.vue";
import UpdatePasswordForm from "./Partials/UpdatePasswordForm.vue";
import UpdateProfileInformationForm from "./Partials/UpdateProfileInformationForm.vue";
import { Head, Link } from "@inertiajs/vue3";
import AdminLayout from "@/Layouts/AdminLayout.vue";

// Define the props type
const props = defineProps<{
  mustVerifyEmail?: boolean;
  status?: string;
  setting: object;
  user: object;
}>();
</script>

<template>
  <Head title="Profile" />

  <!-- Pass props to AdminLayout -->
  <AdminLayout :setting="props.setting" :user="props.user">
    <!-- Content wrapper -->
    <div class="content-wrapper">
      <!-- Content -->
      <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="fw-bold py-3 mb-4">
          <span class="text-muted fw-light">Account Settings /</span> Account
        </h4>

        <div class="row">
          <div class="col-md-12">
            <ul class="nav nav-pills flex-column flex-md-row mb-3">
              <li class="nav-item">
                <a class="nav-link active" href="javascript:void(0);"
                  ><i class="bx bx-user me-1"></i> Account</a
                >
              </li>
              <li class="nav-item">
                <Link
                  class="nav-link"
                  :href="route('notifications.index')"
                  ><i class="bx bx-bell me-1"></i> Notifications</Link
                >
              </li>
            </ul>

            <div class="my-3">
              <UpdateProfileInformationForm
                :must-verify-email="props.mustVerifyEmail"
                :status="props.status"
                class="max-w-xl"
              />
              <UpdatePasswordForm class="max-w-xl" />
            </div>
            <DeleteUserForm class="max-w-xl" />
          </div>
        </div>
      </div>
      <!-- / Content -->

      <div class="content-backdrop fade"></div>
    </div>
  </AdminLayout>
</template>
