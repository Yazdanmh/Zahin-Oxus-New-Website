<template>
  <Head title="Edit Training" />
  <AdminLayout :setting="props.setting" :user="props.user">
    <div class="container-xxl flex-grow-1 container-p-y">
      <h4 class="fw-bold py-3 mb-4">
        <span class="text-muted fw-light">Home /</span> Training / Edit
      </h4>
      <div class="row">
        <div class="col-xl">
          <div class="card mb-4">
            <div
              class="card-header d-flex justify-content-between align-items-center"
            >
              <h5 class="mb-0">Edit Training</h5>
              <small class="text-muted float-end"
                >Update Training Details</small
              >
            </div>
            <div class="card-body">
              <form @submit.prevent="submit">
                <div class="card-body">
                  <div
                    class="d-flex align-items-start align-items-sm-center gap-4"
                  >
                    <img
                      v-if="imagePreview || form.image"
                      :src="imagePreview || `/storage/${props.training.image}`"
                      alt="Training Image Preview"
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
                        Allowed JPG, GIF, or PNG. Max size of 1MB.
                      </p>
                    </div>
                  </div>
                  <div v-if="errors.image" class="text-danger mt-2">
                    {{ errors.image }}
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
                        placeholder="Enter the name"
                      />
                      <div v-if="errors.name" class="text-danger mt-2">
                        {{ errors.name }}
                      </div>
                    </div>
                  </div>

                  <div class="col-md-2">
                    <div class="mb-3">
                      <label for="start_date" class="form-label"
                        >Start Date</label
                      >
                      <input
                        type="date"
                        class="form-control"
                        id="start_date"
                        v-model="form.start_date"
                      />
                      <div v-if="errors.start_date" class="text-danger mt-2">
                        {{ errors.start_date }}
                      </div>
                    </div>
                  </div>

                  <div class="col-md-2">
                    <div class="mb-3">
                      <label for="end_date" class="form-label">End Date</label>
                      <input
                        type="date"
                        class="form-control"
                        id="end_date"
                        v-model="form.end_date"
                      />
                      <div v-if="errors.end_date" class="text-danger mt-2">
                        {{ errors.end_date }}
                      </div>
                    </div>
                  </div>

                  <div class="col-md-2 d-flex align-items-center">
                    <div class="form-check form-switch mb-2">
                      <input
                        class="form-check-input"
                        type="checkbox"
                        id="flexSwitchCheckChecked"
                        v-model="form.has_form"
                      />
                      <label
                        class="form-check-label"
                        for="flexSwitchCheckChecked"
                        >Has Form</label
                      >
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
                  <button
                    type="button"
                    class="btn btn-outline-secondary"
                    @click="cancel"
                  >
                    Cancel
                  </button>
                  <button type="submit" class="btn btn-primary">
                    <i class="bx bx-save"></i> Update Training
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
import { Head, useForm, Link } from "@inertiajs/vue3";
import { ref } from "vue";
import { useToast } from "vue-toastification";
import axios from "axios";
const toast = useToast();
import TextEditor from "@/Components/Admin/TextEditor.vue";

const props = defineProps({
  training: Object, // Make sure this matches the name passed from the backend
  setting:{
    type:Object, 
    required:true, 
  },
  user:{
    type:Object, 
    required:true, 
  },
});

const form = useForm({
  name: props.training.name,
  start_date: props.training.start_date,
  end_date: props.training.end_date,
  description: props.training.description,
  image: null,
  has_form: !!props.training.has_form,
});

const errors = ref({});
const imagePreview = ref(
  props.training.image ? `/storage/${props.training.image}` : ""
);

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

const resetImage = () => {
  form.image = null;
  imagePreview.value = props.training.image
    ? `/storage/${props.training.image}`
    : "";
};

const cancel = () => {
  window.history.back();
};

const validateForm = () => {
  errors.value = {};
  if (!form.name) errors.value.name = "Name is required";
  if (!form.start_date) errors.value.start_date = "Start date is required";
  if (!form.end_date) errors.value.end_date = "End date is required";
  if (!form.description) errors.value.description = "Description is required";
  return Object.keys(errors.value).length === 0;
};

const submit = () => {
  if (!validateForm()) return;

  form.post(route("training.update", props.training.id), {
    preserveScroll: true,
    onSuccess: () => toast.success("Training Updated Successfully"),
    onError: (err) => {
      errors.value = err.response?.data?.errors || {};
      toast.error("An error occurred.");
    },
  });
};
</script>

<style scoped></style>
