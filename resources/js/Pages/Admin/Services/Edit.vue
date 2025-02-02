<template>
  <Head title="Hero" />
  <AdminLayout :setting="props.setting" :user="props.user">
    <div class="container-xxl flex-grow-1 container-p-y">
      <h4 class="fw-bold py-3 mb-4">
        <span class="text-muted fw-light">Home /</span> Services / Edit
      </h4>
      <div class="row">
        <div class="col-xl">
          <div class="card mb-4">
            <div
              class="card-header d-flex justify-content-between align-items-center"
            >
              <h5 class="mb-0">Hero</h5>
              <small class="text-muted float-end">Update hero</small>
            </div>
            <div class="card-body">
              <form @submit.prevent="submit">
                <div class="card-body">
                  <div
                    class="d-flex align-items-start align-items-sm-center gap-4"
                  >
                    <img
                      :src="imagePreview || '/storage/' + props.service.image"
                      alt="Website Logo"
                      class="d-block rounded"
                      style="width: 300px; height: 100px; object-fit: cover"
                      id="uploadedLogo"
                    />
                    <div class="button-wrapper">
                      <label for="upload" class="btn btn-primary me-2 mb-4">
                        <span class="d-none d-sm-block">Upload New Image</span>
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
                        Allowed JPG, GIF, or PNG. Max size of 1MB. <br>
                        <span class="text-warning">Recommended dimensions: 600 x 383 pixels.</span>
                      </p>
                    </div>
                  </div>
                  <div v-if="errors.image" class="text-danger mt-2">
                    {{ errors.image }}
                  </div>
                </div>
                <div class="row">
                  <div class="col-md-12">
                    <div class="mb-3">
                      <label for="title" class="form-label">Title</label>
                      <input
                        type="text"
                        class="form-control"
                        id="title"
                        v-model="form.title"
                      />
                      <div v-if="errors.title" class="text-danger mt-2">
                        {{ errors.title }}
                      </div>
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="mb-3">
                      <label for="subtitle" class="form-label">Subtitle</label>
                      <input
                        type="text"
                        class="form-control"
                        id="subtitle"
                        v-model="form.subtitle"
                      />
                      <div v-if="errors.subtitle" class="text-danger mt-2">
                        {{ errors.subtitle }}
                      </div>
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="mb-3">
                      <label for="icon" class="form-label">Icon</label>
                      <div class="d-flex align-items-center gap-3">
                        <!-- Icon Input -->
                        <input
                          type="text"
                          class="form-control w-50"
                          id="icon"
                          v-model="form.icon"
                          placeholder="Enter icon class (e.g., bx bx-home)"
                        />
                        <!-- Preview -->
                        <i :class="form.icon" style="font-size: 2rem"></i>
                        <!-- Link Button -->
                        <a
                          href="https://boxicons.com/"
                          class="btn btn-info"
                          target="_blank"
                          title="Browse Icons"
                        >
                          Browse Icons
                        </a>
                      </div>
                      <div v-if="errors.icon" class="text-danger mt-2">
                        {{ errors.icon }}
                      </div>
                    </div>
                  </div>
                  <div class="col-md-12">
                      <div class="mb-3">
                        <!-- Bind the description to the TextEditor -->
                        <TextEditor
                          v-model="form.description"
                          @editor-change="updateDescription"
                        />
                        <div v-if="errors.description" class="text-danger mt-2">
                          {{ errors.description }}
                        </div>
                      </div>
                    </div>
                </div>
                <div class="d-flex justify-content-end gap-3 mt-4">
                  <Link
                    :href="route('services.index')"
                    class="btn btn-outline-secondary"
                    @click="cancel"
                  >
                     Cancel
                </Link>
                  <button type="submit" class="btn btn-primary">
                    <i class="bx bx-pencil mr-2"></i>Update Service
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
import { Head , Link} from "@inertiajs/vue3";
import { ref } from "vue";
import { useForm } from "@inertiajs/vue3";
import { useToast } from "vue-toastification";
import TextEditor from "@/Components/Admin/TextEditor.vue";

const props = defineProps({
  service: {
    type: Object,
    required: true,
  },
  setting:{
    type:Object, 
    required:true, 
  },
  user:{
    type:Object, 
    required:true, 
  },
});

const toast = useToast();

const form = useForm({
  title: props.service.title,
  subtitle: props.service.subtitle,
  description: props.service.description,
  icon: props.service.icon,
  image: null,
});

const errors = ref({});
const imagePreview = ref(null);

const handleImageUpload = (event) => {
  const file = event.target.files[0];
  if (file) {
    form.image = file;
    const reader = new FileReader();
    reader.onload = (e) => {
      imagePreview.value = e.target.result;
    };
    reader.readAsDataURL(file);
  }
};

const resetImage = () => {
  form.image = null;
  imagePreview.value = null;
};

const submit = () => {
  if (!form.image) delete form.image; // Remove the image field if no image is selected
  form.post(route("services.update", props.service.id), {
    preserveScroll: true, // Preserve the scroll position
    onSuccess: () => {
      toast.success("Services Updated Successfully"); // Show success message
    },
    onError: (err) => {
      toast.error("Error: " + err); // Show error message
    },
  });
};
</script>

<style scoped>
</style>
