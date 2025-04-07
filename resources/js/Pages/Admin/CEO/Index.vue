<template>
    <Head title="CEO" />
    <AdminLayout :setting="props.setting" :user="props.user" :permissions="props.permissions">
      <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="fw-bold py-3 mb-4">
          <span class="text-muted fw-light">CEO /</span> Edit
        </h4>
        <div class="row">
          <div class="col-xl">
            <div class="card mb-4">
              <div class="card-header d-flex justify-content-between align-items-center">
                <h5 class="mb-0">CEO Information</h5>
                <small class="text-muted float-end">Manage CEO details</small>
              </div>
              <div class="card-body">
                <form @submit.prevent="submit">
                  <div class="card-body">
                    <div class="d-flex align-items-start align-items-sm-center gap-4">
                      <!-- Image Section -->
                      <img
                        :src="imagePreview || '/storage/' + (props.ceo?.image || 'default-image.png')"
                        alt="CEO Image"
                        class="d-block rounded"
                        height="100"
                        width="100"
                        id="uploadedImage"
                      />
                      <div v-if="hasPermission('site_data.edit')" class="button-wrapper">
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
                          Allowed JPG, GIF, or PNG. Max size of 1MB.
                          <br />
                          <span v-if="errors.image" class="text-danger mt-2">
                            {{ errors.image }}
                          </span>
                        </p>
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <!-- Dynamic Fields -->
                    <template v-for="(field, index) in fields" :key="index">
                      <div :class="field.col">
                        <div class="form-group mb-3">
                          <label :for="field.id">{{ field.label }}</label>
                          <input
                            v-if="field.type !== 'textarea'"
                            :type="field.type"
                            :id="field.id"
                            :placeholder="field.placeholder"
                            v-model="form[field.model]"
                            :class="field.class"
                            :required="field.required"
                          />
                          <textarea
                            v-else
                            :id="field.id"
                            :rows="field.rows"
                            :placeholder="field.placeholder"
                            v-model="form[field.model]"
                            :class="field.class"
                            :required="field.required"
                          ></textarea>
                          <div v-if="errors[field.model]" class="text-danger">
                            {{ errors[field.model] }}
                          </div>
                        </div>
                      </div>
                    </template>
                  </div>
                  <button v-if="hasPermission('site_data.edit')" type="submit" class="btn btn-primary">
                    Update CEO Info
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
  import { Head } from "@inertiajs/vue3";
  import { ref } from "vue";
  import { useForm } from "@inertiajs/vue3";
  import { useToast } from "vue-toastification";
  
  const props = defineProps({
    ceo: {
      type: Object,
      required: true,
    },
    user: {
      type: Object,
      required: true,
    },
    setting: {
      type: Object,
      required: true,
    },
    permissions:{
    type:Array, 
    required:true, 
  }
  });
  
  const toast = useToast();
  
  // Initialize the form with default values (check if props.ceo has data)
  const form = useForm({
    name: props.ceo?.name || '',
    position: props.ceo?.position || '',
    email: props.ceo?.email || '',
    phone: props.ceo?.phone || '',
    description: props.ceo?.description || '',
    skills: props.ceo?.skills || '',
    image: null,
  });
  
  const errors = ref({});
  const imagePreview = ref(null);
  
  // Fields definitions (same as in your template)
  const fields = [
    {
      id: "name",
      label: "Name",
      type: "text",
      placeholder: "Enter CEO's name",
      model: "name",
      col: "col-md-6",
      class: "form-control",
      required: true,
    },
    {
      id: "position",
      label: "Position",
      type: "text",
      placeholder: "Enter CEO's position",
      model: "position",
      col: "col-md-6",
      class: "form-control",
      required: true,
    },
    {
      id: "email",
      label: "Email",
      type: "email",
      placeholder: "Enter CEO's email",
      model: "email",
      col: "col-md-6",
      class: "form-control",
      required: true,
    },
    {
      id: "phone",
      label: "Phone",
      type: "text",
      placeholder: "Enter CEO's phone number",
      model: "phone",
      col: "col-md-6",
      class: "form-control",
      required: true,
    },
    {
      id: "description",
      label: "Description",
      type: "textarea",
      rows: 4,
      placeholder: "Enter CEO's description",
      model: "description",
      col: "col-md-12",
      class: "form-control",
      required: true,
    },
    {
      id: "skills",
      label: "Skills (JSON)",
      type: "textarea",
      rows: 4,
      placeholder: 'Enter skills as JSON e.g. ["Leadership":20, "Innovation":50]',
      model: "skills",
      col: "col-md-12",
      class: "form-control",
      required: false,
    },
  ];
  
  // Handle Image Upload
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
  
  // Reset Image
  const resetImage = () => {
    form.image = null;
    imagePreview.value = null;
  };
  
  // Submit Form
  const submit = () => {
    if (!form.image) delete form.image; // Avoid sending null image
    form.post(route("ceo.update"), {
      preserveScroll: true,
      onSuccess: () => {
        toast.success("CEO info updated successfully!");
      },
      onError: (err) => {
        errors.value = err;
        toast.error("Error occurred while updating CEO information.");
      },
    });
  };
  const hasPermission = (permission) => {
  return props.permissions.includes(permission);
}; 
  </script>
  