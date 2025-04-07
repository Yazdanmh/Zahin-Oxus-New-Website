<template>
  <Head title="Setting" />
  <AdminLayout :setting = "props.setting" :user="props.user" :permissions="props.permissions">
    <div class="container-xxl flex-grow-1 container-p-y">
      <h4 class="fw-bold py-3 mb-4">
        <span class="text-muted fw-light">Settings /</span> Edit
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
              <form @submit.prevent="submit">
                <div class="card-body">
                  <div
                    class="d-flex align-items-start align-items-sm-center gap-4"
                  >
                    <img
                      :src="
                        imagePreview || '/storage/' + props.settings.site_logo
                      "
                      alt="Website Logo"
                      class="d-block rounded"
                      height="100"
                      width="100"
                      id="uploadedLogo"
                    />
                    <div v-if="hasPermission('site_data.edit') "class="button-wrapper">
                      <label for="upload" class="btn btn-primary me-2 mb-4">
                        <span class="d-none d-sm-block">Upload New Logo</span>
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
                        <span class="text-warning">Recommended dimensions: 130 x 30 pixels.</span>
                        <br>
                        <span v-if="errors.logo" class="text-danger mt-2">
                    {{ errors.logo }}
                  </span>

                      </p>
                    </div>
                  </div>
                  
                </div>
                <div class="row">
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
                <button  v-if="hasPermission('site_data.edit') " type="submit" class="btn btn-primary">
                  Update Settings
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
import { Head } from '@inertiajs/vue3';
import { ref, onMounted} from "vue";
import { useForm } from "@inertiajs/vue3";
import { useToast } from 'vue-toastification';

const props = defineProps({
  settings: {
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
  permissions: {
    type: Array,
    required: true,
  },
});
console.log(props.permissions);
const toast = useToast();
const form = useForm({
  website_name: props.settings.site_name,
  email: props.settings.email,
  phone: props.settings.phone,
  address: props.settings.address,
  about: props.settings.about,
  facebook_url: props.settings.facebook_url,
  twitter_url: props.settings.twitter_url,
  instagram_url: props.settings.instagram_url,
  youtube_url: props.settings.youtube_url,
  logo: null,
});

const errors = ref({});
const imagePreview = ref(null);

const fields = [
  {
    id: "websiteName",
    label: "Website Name",
    type: "text",
    placeholder: "Enter website name",
    model: "website_name",
    col: "col-md-4",
    class: "form-control",
    required: true,
  },
  {
    id: "email",
    label: "Email",
    type: "email",
    placeholder: "Enter website email",
    model: "email",
    col: "col-md-4",
    class: "form-control",
    required: true,
  },
  {
    id: "phone",
    label: "Phone",
    type: "text",
    placeholder: "Enter website phone",
    model: "phone",
    col: "col-md-4",
    class: "form-control",
    required: true,
  },
  {
    id: "address",
    label: "Address",
    type: "text",
    placeholder: "Enter website address",
    model: "address",
    col: "col-md-8",
    class: "form-control",
    required: true,
  },
  {
    id: "facebook",
    label: "Facebook",
    type: "url",
    placeholder: "Enter Facebook URL",
    model: "facebook_url",
    col: "col-md-4",
    class: "form-control",
    required: true,
  },
  {
    id: "twitter",
    label: "Twitter",
    type: "url",
    placeholder: "Enter Twitter URL",
    model: "twitter_url",
    col: "col-md-4",
    class: "form-control",
    required: true,
  },
  {
    id: "instagram",
    label: "Instagram",
    type: "url",
    placeholder: "Enter Instagram URL",
    model: "instagram_url",
    col: "col-md-4",
    class: "form-control",
    required: true,
  },
  {
    id: "youtube",
    label: "YouTube",
    type: "url",
    placeholder: "Enter YouTube URL",
    model: "youtube_url",
    col: "col-md-4",
    class: "form-control",
    required: true,
  },
  {
    id: "about",
    label: "About",
    type: "textarea",
    rows: 4,
    placeholder: "Enter About info",
    model: "about",
    col: "col-md-12",
    class: "form-control",
    required: true,
  },
];

const handleImageUpload = (event) => {
  const file = event.target.files[0];
  if (file) {
    form.logo = file;
    const reader = new FileReader();
    reader.onload = (e) => {
      imagePreview.value = e.target.result;
    };
    reader.readAsDataURL(file);
  }
};

const resetImage = () => {
  form.logo = null;
  imagePreview.value = null;
};

const submit = () => {
  if (!form.logo) delete form.logo;
  form.post(route("settings.update"), {
    preserveScroll: true,
    onSuccess: () => {
      toast.success('Setting Updated Successfully');
    },
    onError:(err) =>{
      errors.value = err; 
      toast.error('Error occurred while processing the form!');
    }
  });
};

const hasPermission = (permission) =>{
  return props.permissions.includes(permission)
}
</script>
