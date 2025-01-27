<script setup lang="ts">
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import DeleteUserForm from "./Partials/DeleteUserForm.vue";
import UpdatePasswordForm from "./Partials/UpdatePasswordForm.vue";
import UpdateProfileInformationForm from "./Partials/UpdateProfileInformationForm.vue";
import { Head } from "@inertiajs/vue3";
import AdminLayout from "@/Layouts/AdminLayout.vue";

defineProps<{
  mustVerifyEmail?: boolean;
  status?: string;
}>();
</script>

<template>
  <Head title="Profile" />

  <AdminLayout>
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
                <a
                  class="nav-link"
                  href="pages-account-settings-notifications.html"
                  ><i class="bx bx-bell me-1"></i> Notifications</a
                >
              </li>
              <li class="nav-item">
                <a
                  class="nav-link"
                  href="pages-account-settings-connections.html"
                  ><i class="bx bx-link-alt me-1"></i> Connections</a
                >
              </li>
            </ul>

            <div class="card mb-4">
              <h5 class="card-header">Profile Details</h5>
              <!-- Account -->
              <div class="card-body">
                <div
                  class="d-flex align-items-start align-items-sm-center gap-4"
                >
                  <img
                    src="/backend/assets/img/avatars/1.png"
                    alt="user-avatar"
                    class="d-block rounded"
                    height="100"
                    width="100"
                    id="uploadedAvatar"
                  />
                  <div class="button-wrapper">
                    <label
                      for="upload"
                      class="btn btn-primary me-2 mb-4"
                      tabindex="0"
                    >
                      <span class="d-none d-sm-block">Upload new photo</span>
                      <i class="bx bx-upload d-block d-sm-none"></i>
                      <input
                        type="file"
                        id="upload"
                        class="account-file-input"
                        hidden
                        accept="image/png, image/jpeg"
                      />
                    </label>
                    <button
                      type="button"
                      class="btn btn-outline-secondary account-image-reset mb-4"
                    >
                      <i class="bx bx-reset d-block d-sm-none"></i>
                      <span class="d-none d-sm-block">Reset</span>
                    </button>

                    <p class="text-muted mb-0">
                      Allowed JPG, GIF or PNG. Max size of 800K
                    </p>
                  </div>
                </div>
              </div>
              <hr class="my-0" />
              <div class="card-body">
                <form
                  id="formAccountSettings"
                  method="POST"
                  onsubmit="return false"
                >
                  <div class="row">
                    <div class="mb-3 col-md-6">
                      <label for="firstName" class="form-label"
                        >First Name</label
                      >
                      <input
                        class="form-control"
                        type="text"
                        id="firstName"
                        name="firstName"
                        value="John"
                        autofocus
                      />
                    </div>
                    <div class="mb-3 col-md-6">
                      <label for="lastName" class="form-label">Last Name</label>
                      <input
                        class="form-control"
                        type="text"
                        name="lastName"
                        id="lastName"
                        value="Doe"
                      />
                    </div>
                    <div class="mb-3 col-md-6">
                      <label for="email" class="form-label">E-mail</label>
                      <input
                        class="form-control"
                        type="text"
                        id="email"
                        name="email"
                        value="john.doe@example.com"
                        placeholder="john.doe@example.com"
                      />
                    </div>
                    <div class="mb-3 col-md-6">
                      <label for="organization" class="form-label"
                        >Organization</label
                      >
                      <input
                        type="text"
                        class="form-control"
                        id="organization"
                        name="organization"
                        value="ThemeSelection"
                      />
                    </div>
                  </div>
                  <div class="mt-2">
                    <button type="submit" class="btn btn-primary me-2">
                      Save changes
                    </button>
                    <button type="reset" class="btn btn-outline-secondary">
                      Cancel
                    </button>
                  </div>
                </form>
              </div>
              <!-- /Account -->
            </div>

            
            <DeleteUserForm class="max-w-xl" />
          </div>
        </div>
      </div>
      <!-- / Content -->

      <div class="content-backdrop fade"></div>
    </div>
    <!-- Content wrapper -->
    <div class="container-xxl flex-grow-1 container-p-y">
      <h4 class="fw-bold py-3 mb-4">
        <span class="text-muted fw-light">Home /</span> About
      </h4>
      <div class="row">
        <div class="col-xl">
          <div class="card mb-4">
            <div class="card-body">
              <div class="py-12">
                <div class="mx-auto max-w-7xl space-y-6 sm:px-6 lg:px-8">
                  <div class="bg-white p-4 shadow sm:rounded-lg sm:p-8">
                    <UpdateProfileInformationForm
                      :must-verify-email="mustVerifyEmail"
                      :status="status"
                      class="max-w-xl"
                    />
                  </div>

                  <div class="bg-white p-4 shadow sm:rounded-lg sm:p-8">
                    <UpdatePasswordForm class="max-w-xl" />
                  </div>

                  <div class="bg-white p-4 shadow sm:rounded-lg sm:p-8">
                    
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </AdminLayout>
</template>
