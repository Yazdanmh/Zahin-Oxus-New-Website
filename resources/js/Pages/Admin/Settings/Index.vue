<template>
  <AdminLayout>
    <div class="container-xxl flex-grow-1 container-p-y">
      <h4 class="fw-bold py-3 mb-4">
        <span class="text-muted fw-light">Settings/</span> Edit
      </h4>

      <div class="row">
        <div class="col-xl">
          <div class="card mb-4">
            <div
              class="card-header d-flex justify-content-between align-items-center"
            >
              <h5 class="mb-0">Site Settings</h5>
              <small class="text-muted float-end">Manage settings</small>
            </div>
            <div class="card-body">
              <form @submit.prevent="submit" enctype="multipart/form-data">
                <!-- Avatar and File Upload Section -->
                <div class="card-body">
                  <div
                    class="d-flex align-items-start align-items-sm-center gap-4"
                  >
                    <img
                      :src="previewImage || propsAvatar"
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
                          name="logo"
                          class="account-file-input"
                          hidden
                          accept="image/png, image/jpeg, image/gif"
                          @change="onFileChange"
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
                        Allowed JPG, GIF, or PNG. Max size of 800KB.
                      </p>
                    </div>
                  </div>
                </div>

                <!-- Form Inputs Section -->
                <div
                  class="col-md-6"
                  v-for="(label, key) in formFields"
                  :key="key"
                >
                  <div class="mb-3">
                    <label :for="key" class="form-label">{{ label }}</label>
                    <input
                      v-if="key !== 'about'"
                      type="text"
                      class="form-control"
                      :id="key"
                      v-model="form[key]"
                    />
                    <textarea
                      v-else
                      class="form-control"
                      :id="key"
                      v-model="form[key]"
                    ></textarea>
                  </div>
                </div>

                <!-- Submit Button -->
                <button type="submit" class="btn btn-primary">
                  Save Settings
                </button>
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
import { ref, defineProps } from "vue";
import { useForm } from "@inertiajs/vue3";

const props = defineProps({
  settings: {
    type: Object,
    required: true,
  },
});

const form = useForm({
  site: props.settings.site_name,
  email: props.settings.email,
  phone: props.settings.phone,
  address: props.settings.address,
  facebook: props.settings.facebook_url,
  instagram: props.settings.instagram_url,
  youtube: props.settings.youtube_url,
  twitter: props.settings.twitter_url,
  about: props.settings.about,
});

const formFields = {
  site_name: "Site Name",
  email: "Email",
  phone: "Phone",
  address: "Address",
  facebook: "Facebook",
  instagram: "Instagram",
  youtube: "YouTube",
  twitter: "Twitter",
  about: "About",
};

const avatarPreview = ref(
  props.settings.site_logo || "/backend/assets/img/avatars/1.png"
);
const previewImage = ref(null);
const propsAvatar = props.avatar || "/backend/assets/img/avatars/1.png";

// Submit function
const submit = () => {
  // Create a new FormData object to handle file uploads
  const formData = new FormData();

  // Append the regular form fields to the FormData
  formData.append("site", form.site);
  formData.append("email", form.email);
  formData.append("phone", form.phone);
  formData.append("address", form.address);
  formData.append("facebook", form.facebook);
  formData.append("instagram", form.instagram);
  formData.append("youtube", form.youtube);
  formData.append("twitter", form.twitter);
  formData.append("about", form.about);

  // Append the image file (if any) to the FormData
  if (previewImage.value) {
    const imageFile = dataURLtoBlob(previewImage.value);
    formData.append("site_logo", imageFile, "site_logo.png");
  }

  // Use Inertia's form method to submit the FormData
  form.post(route("settings.update"), {
    data: formData,
    onSuccess: () => {
      console.log("Settings saved successfully");
    },
    onError: (errors) => {
      console.error(errors);
    },
    headers: {
      "Content-Type": "multipart/form-data", // This is important for file uploads
    },
  });
};

// File upload handler
const onFileChange = (event) => {
  const file = event.target.files[0];
  if (file) {
    if (!["image/jpeg", "image/png", "image/gif"].includes(file.type)) {
      alert("Please upload a valid image file (JPG, PNG, or GIF).");
      return;
    }
    if (file.size > 800 * 1024) {
      alert("File size exceeds 800KB.");
      return;
    }

    const reader = new FileReader();
    reader.onload = (e) => {
      previewImage.value = e.target.result; // Update preview image
    };
    reader.readAsDataURL(file);
  }
};

// Reset image handler
const resetImage = () => {
  previewImage.value = null; // Reset to original avatar
};

// Utility function to convert Base64 string to Blob
const dataURLtoBlob = (dataURL) => {
  const [mime, base64Data] = dataURL.split(",");
  const byteString = atob(base64Data);
  const arrayBuffer = new ArrayBuffer(byteString.length);
  const uint8Array = new Uint8Array(arrayBuffer);

  for (let i = 0; i < byteString.length; i++) {
    uint8Array[i] = byteString.charCodeAt(i);
  }

  return new Blob([uint8Array], { type: mime.split(":")[1] });
};
</script>
  