<template>
  <Head title="Create Service" />
  <AdminLayout :setting="props.setting" :user="props.user" :permissions="props.permissions">
    <div class="container-xxl flex-grow-1 container-p-y">
      <h4 class="fw-bold py-3 mb-4">
        <span class="text-muted fw-light">Home /</span> Services / Create
      </h4>
      <div class="row">
        <div class="col-xl">
          <div class="card mb-4">
            <div
              class="card-header d-flex justify-content-between align-items-center"
            >
              <h5 class="mb-0">Create Service</h5>
              <small class="text-muted float-end">Add a new service</small>
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
                      alt="Service Image Preview"
                      class="d-block rounded"
                      style="width: 300px; height: 100px; object-fit: contain"
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
                          >Recommended dimensions: 600 x 383 pixels.</span
                        >
                      </p>
                    </div>
                  </div>
                  <div v-if="errors.image" class="text-danger mt-2">
                    {{ errors.image }}
                  </div>
                </div>
                <div class="row">
                  <div class="col-md-6">
                    <div class="mb-3">
                      <label for="title" class="form-label">Title</label>
                      <input
                        type="text"
                        class="form-control"
                        id="title"
                        v-model="form.title"
                        placeholder="Enter service title"
                      />
                      <div v-if="errors.title" class="text-danger mt-2">
                        {{ errors.title }}
                      </div>
                    </div>
                  </div>
                  <div class="col-md-5">
                    <div class="mb-3">
                      <label for="subtitle" class="form-label">Subtitle</label>
                      <input
                        type="text"
                        class="form-control"
                        id="subtitle"
                        v-model="form.subtitle"
                        placeholder="Enter service subtitle"
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
                        <input
                          type="text"
                          class="form-control w-50"
                          id="icon"
                          v-model="form.icon"
                          placeholder="Enter icon class (e.g., bx bx-home)"
                        />
                        <i :class="form.icon" style="font-size: 2rem"></i>
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
                  <div class="col-md-6">
                    <div class="mb-3">
                      <label for="category" class="form-label">Category</label>
                      <div class="d-flex align-items-center gap-3">
                        <select
                          class="form-control"
                          id="category"
                          v-model="form.category"
                        >
                          <option value="" disabled>
                            -- Select Service Category --
                          </option>
                          <option
                            v-for="category in categories"
                            :key="category.id"
                            :value="category.id"
                          >
                            {{ category.name }}
                          </option>
                        </select>
                        <Link
                          :href="route('service-categories.index')"
                          class="btn btn-outline-primary"
                          title="Manage Categories"
                        >
                          <i class="bx bx-cog"></i>
                        </Link>
                      </div>
                      <div v-if="errors.category" class="text-danger mt-2">
                        {{ errors.category }}
                      </div>
                    </div>
                  </div>
                  <div class="col-md-12">
                    <div class="mb-3">
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
                  <button
                    type="button"
                    class="btn btn-outline-secondary"
                    @click="cancel"
                  >
                    Cancel
                  </button>
                  <button type="submit" class="btn btn-primary">
                    <i class="bx bx-save"></i> Create Service
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
import { ref } from "vue";
import AdminLayout from "@/Layouts/AdminLayout.vue";
import { Head, Link } from "@inertiajs/vue3";
import { useForm } from "@inertiajs/vue3";
import { useToast } from "vue-toastification";
import TextEditor from "@/Components/Admin/TextEditor.vue";
const props = defineProps({ setting: Object, user: Object, categories: Array,  permissions:{
    type:Array, 
    required:true, 
  } });
const toast = useToast();
const form = useForm({
  title: "",
  subtitle: "",
  description: "",
  icon: "",
  image: null,
  category: "",
});
const errors = ref({});
const imagePreview = ref(null);
const handleImageUpload = (event) => {
  const file = event.target.files[0];
  if (file) {
    form.image = file;
    imagePreview.value = URL.createObjectURL(file);
  }
};
const resetImage = () => {
  form.image = null;
  imagePreview.value = null;
};
const cancel = () => window.history.back();
const submit = () => {
  form.post(route("services.store"), {
    preserveScroll: true,
    onSuccess: () => toast.success("Service Created Successfully"),
    onError: (err) => {
      errors.value = err;
      toast.error("Error occurred while processing the form!");
    },
  });
};

</script>