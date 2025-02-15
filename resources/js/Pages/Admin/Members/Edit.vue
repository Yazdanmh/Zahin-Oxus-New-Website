<template>
  <Head title="Edit Member" />
  <AdminLayout :setting="props.setting" :user="props.user">
    <div class="container-xxl flex-grow-1 container-p-y">
      <h4 class="fw-bold py-3 mb-4">
        <span class="text-muted fw-light">Home /</span> Members / Edit
      </h4>
      <div class="row">
        <div class="col-xl">
          <div class="card mb-4">
            <div
              class="card-header d-flex justify-content-between align-items-center"
            >
              <h5 class="mb-0">Edit Members</h5>
              <small class="text-muted float-end">Edit existing member</small>
            </div>
            <div class="card-body">
              <form @submit.prevent="submit">
                <div class="card-body">
                  <div
                    class="d-flex align-items-start align-items-sm-center gap-4"
                  >
                    <img
                      v-if="imagePreview"
                      :src="imagePreview"
                      alt="member Image Preview"
                      class="d-block rounded"
                      style="width: 300px; height: 100px; object-fit: cover"
                      id="uploadedImage"
                    />
                    <div class="button-wrapper">
                      <label for="upload" class="btn btn-primary me-2 mb-4">
                        <span class="d-none d-sm-block">Upload Image</span>
                        <i class="bx bx-upload d-block d-sm-none"></i>
                        <input
                          type="file"
                          id="upload"
                          hidden
                          accept="image/png, image/jpeg, image/gif"
                          @change="handleImageUpload"
                        />
                      </label>
                      <button
                        type="button"
                        class="btn btn-outline-secondary mb-4"
                        @click="resetImage"
                      >
                        <i class="bx bx-reset d-block d-sm-none"></i>
                        <span class="d-none d-sm-block">Reset</span>
                      </button>
                      <p class="text-muted mb-0">
                        Allowed JPG, GIF, or PNG. Max size of 1MB. <br />
                        <span class="text-warning"
                          >Recommended dimensions: 520 x 600 pixels.</span
                        ><br>
                        <span v-if="errors.image" class="text-danger mt-2">
                          {{ errors.image }}
                        </span>
                      </p>
                    </div>
                  </div>
                </div>

                <div class="row">
                  <div class="col-md-4">
                    <div class="mb-3">
                      <label for="name" class="form-label">Name</label>
                      <input
                        type="text"
                        class="form-control"
                        id="name"
                        v-model="form.name"
                        placeholder="Enter member name"
                      />
                      <div v-if="errors.name" class="text-danger mt-2">
                        {{ errors.name }}
                      </div>
                    </div>
                  </div>

                  <div class="col-md-4">
                    <div class="mb-3">
                      <label for="position" class="form-label"
                        >Position</label
                      >
                      <input
                        type="text"
                        class="form-control"
                        id="position"
                        v-model="form.position"
                        placeholder="Business, "
                      />
                      <div v-if="errors.position" class="text-danger mt-2">
                        {{ errors.position }}
                      </div>
                    </div>
                  </div>
                  <div class="col-md-4">
                    <div class="mb-3">
                      <label for="email" class="form-label"
                        >Email</label
                      >
                      <input
                        type="email"
                        class="form-control"
                        id="email"
                        v-model="form.email"
                        placeholder="Business, "
                      />
                      <div v-if="errors.email" class="text-danger mt-2">
                        {{ errors.email }}
                      </div>
                    </div>
                  </div>
                  <div class="col-md-4">
                    <div class="mb-3">
                      <label for="phone" class="form-label"
                        >phone</label
                      >
                      <input
                        type="text"
                        class="form-control"
                        id="phone"
                        v-model="form.phone"
                        placeholder="Business, "
                      />
                      <div v-if="errors.phone" class="text-danger mt-2">
                        {{ errors.phone }}
                      </div>
                    </div>
                  </div>
                  <div class="col-md-4">
                    <div class="mb-3">
                      <label for="facebook" class="form-label"
                        >Facebook</label
                      >
                      <input
                        type="text"
                        class="form-control"
                        id="facebook"
                        v-model="form.facebook"
                        placeholder="Business, "
                      />
                      <div v-if="errors.facebook" class="text-danger mt-2">
                        {{ errors.facebook }}
                      </div>
                    </div>
                  </div>
                  <div class="col-md-4">
                    <div class="mb-3">
                      <label for="twitter" class="form-label"
                        >Twitter</label
                      >
                      <input
                        type="text"
                        class="form-control"
                        id="twitter"
                        v-model="form.twitter"
                        placeholder="Business, "
                      />
                      <div v-if="errors.twitter" class="text-danger mt-2">
                        {{ errors.twitter }}
                      </div>
                    </div>
                  </div>
                  <div class="col-md-12">
                    <div class="mb-3">
                      <label for="skills" class="form-label"
                        >Skills</label
                      >
                      <input
                        type="text"
                        class="form-control"
                        id="skills"
                        v-model="form.skills"
                        placeholder="Example {'management':20} "
                      />
                      <div v-if="errors.skills" class="text-danger mt-2">
                        {{ errors.skills }}
                      </div>
                    </div>
                  </div>
                  

                  <div class="col-md-12">
                    <div class="mb-3">
                      
                      <TextEditor v-model="form.description" />
                      <div v-if="errors.description" class="text-danger mt-2">
                        {{ errors.description }}
                      </div>
                    </div>
                  </div>
                </div>

                <div class="d-flex justify-content-end gap-3 mt-4">
                  <button
                    type="button"
                    class="btn btn-outline-secondary"
                    @click="cancel"
                  >
                    Cancel
                  </button>
                  <button type="submit" class="btn btn-primary">
                    <i class="bx bx-save"></i> Save Changes
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
import { Head, useForm, usePage } from "@inertiajs/vue3";
import { ref } from "vue";
import { useToast } from "vue-toastification";
import TextEditor from "@/Components/Admin/TextEditor.vue";

const toast = useToast();

const props = defineProps({
  member: {
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
});

// Initialize the form with the current values from the news object
const form = useForm({
  name: props.member.name || "",
  position: props.member.position || "",
  email: props.member.email || "",
  description: props.member.description || "",
  phone: props.member.phone || "",
  facebook: props.member.facebook || "",
  twitter: props.member.twitter || "",
  skills: props.member.skills || "",

  image: null, // Image will be handled separately
});

// Track any validation errors
const errors = ref({});

// Initialize image preview
const imagePreview = ref(
  props.member.image ? `/storage/${props.member.image}` : null
);

// Handle image upload
const handleImageUpload = (event) => {
  const file = event.target.files[0];
  if (file) {
    if (file.size > 1048576) {
      toast.error("File size exceeds the 1MB limit.");
      return;
    }
    form.image = file;
    const reader = new FileReader();
    reader.onload = (e) => {
      imagePreview.value = e.target.result;
    };
    reader.readAsDataURL(file);
  }
};

// Reset the image
const resetImage = () => {
  form.image = null;
  imagePreview.value = null;
};

// Cancel the edit and go back
const cancel = () => {
  window.history.back();
};

// Handle form submission
const submit = () => {
  form.post(route("members.update", props.member.id), {
    preserveScroll: true,
    onSuccess: () => {
      toast.success("Member updated successfully");
    },
    onError: (err) => {
      errors.value = err; 
      toast.error('Error occurred while processing the form!');
    },
  });
};
</script>
  
  <style scoped>
</style>
  