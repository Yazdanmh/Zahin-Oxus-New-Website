<script setup lang="ts">
import InputError from "@/Components/InputError.vue";
import InputLabel from "@/Components/InputLabel.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import TextInput from "@/Components/TextInput.vue";
import { useForm, usePage } from "@inertiajs/vue3";
import { ref } from "vue";

defineProps<{
  mustVerifyEmail?: Boolean;
  status?: String;
}>();

const user = usePage().props.auth.user;
const uploadedAvatar = ref(
  "/storage/" + user.profile_image || "/backend/assets/img/avatars/1.png"
);

const form = useForm({
  name: user.name,
  email: user.email,
  profile_image: null, // Add profile_image to the form data
});

function handleFileUpload(event) {
  const file = event.target.files[0];
  if (file) {
    form.profile_image = file; // Attach the file to the form
    const reader = new FileReader();
    reader.onload = (e) => {
      uploadedAvatar.value = e.target?.result as string;
    };
    reader.readAsDataURL(file);
  }
}

function resetImage() {
  uploadedAvatar.value =
    "/storage/" + user.profile_image || "/backend/assets/img/avatars/1.png";
  form.profile_image = null; // Reset the image field
}

function resendVerification() {
  console.log("Resend verification email");
}
</script>

<template>
  <div class="card mb-4">
    <h5 class="card-header">Profile Details</h5>

    <div class="card-body">
      <div class="d-flex align-items-start align-items-sm-center gap-4">
        <img
          :src="uploadedAvatar"
          alt="user-avatar"
          class="d-block rounded"
          height="100"
          width="100"
          id="uploadedAvatar"
        />
        <div class="button-wrapper">
          <label for="upload" class="btn btn-primary me-2 mb-4" tabindex="0">
            <span class="d-none d-sm-block">Upload new photo</span>
            <i class="bx bx-upload d-block d-sm-none"></i>
            <input
              type="file"
              id="upload"
              class="account-file-input"
              hidden
              accept="image/png, image/jpeg"
              @change="handleFileUpload"
            />
          </label>
          <button
            type="button"
            class="btn btn-outline-secondary account-image-reset mb-4"
            @click="resetImage"
          >
            <i class="bx bx-reset d-block d-sm-none"></i>
            <span class="d-none d-sm-block">Reset</span>
          </button>

          <p class="text-muted mb-0">
            Allowed JPG, GIF, or PNG. Max size of 800KB
          </p>
        </div>
      </div>
    </div>

    <hr class="my-0" />

    <div class="card-body">
      <form @submit.prevent="form.post(route('profile.update'))">
        <div class="row">
          <div class="mb-3 col-md-6">
            <InputLabel for="name" value="Name" />
            <TextInput
              id="name"
              type="text"
              class="form-control"
              v-model="form.name"
              required
              autofocus
              autocomplete="name"
            />
            <InputError class="mt-2" :message="form.errors.name" />
          </div>

          <div class="mb-3 col-md-6">
            <InputLabel for="email" value="Email" />
            <TextInput
              id="email"
              type="email"
              class="form-control"
              v-model="form.email"
              required
              autocomplete="username"
            />
            <InputError class="mt-2" :message="form.errors.email" />
          </div>
        </div>

        <div v-if="mustVerifyEmail && user.email_verified_at === null">
          <p class="mt-2 text-sm text-gray-800">
            Your email address is unverified.
            <button
              type="button"
              @click="resendVerification"
              class="btn btn-link text-decoration-none"
            >
              Click here to re-send the verification email.
            </button>
          </p>

          <div
            v-if="status === 'verification-link-sent'"
            class="mt-2 text-sm text-success"
          >
            A new verification link has been sent to your email address.
          </div>
        </div>

        <div class="mt-2">
          <PrimaryButton class="btn btn-primary" :disabled="form.processing"
            >Save Changes</PrimaryButton
          >
          <button type="reset" class="btn btn-outline-secondary ms-2">
            Cancel
          </button>
        </div>
      </form>
    </div>
  </div>
</template>
