<template>
  <Head title="Hero" />
  <AdminLayout :setting="props.setting" :user="props.user">
    <div class="container-xxl flex-grow-1 container-p-y">
      <h4 class="fw-bold py-3 mb-4">
        <span class="text-muted fw-light">Home /</span> Hero
      </h4>
      <div class="row">
        <div class="col-xl">
          <div class="card mb-4">
            <div
              class="card-header d-flex justify-content-between align-items-center"
            >
              <h5 class="mb-0">Hero</h5>
              <small class="text-muted float-end">Manage hero</small>
            </div>
            <div class="card-body">
              <form @submit.prevent="submit">
                <div class="card-body">
                  <div
                    class="d-flex align-items-start align-items-sm-center gap-4"
                  >
                    <img
                      :src="imagePreview || '/storage/' + props.hero.image"
                      alt="Website Logo"
                      class="d-block rounded"
                      style="width: 300px; height: 100px; object-fit: contain;"
                      id="uploadedLogo"
                    />
                    <div class="button-wrapper">
                      <label for="upload" class="btn btn-primary me-2 mb-4">
                        <span class="d-none d-sm-block">Upload New image</span>
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
                        <span class="text-warning">Recommended dimensions: 529 x 713 pixels.</span>
                        <br>
                        <span v-if="errors.image" class="text-danger mt-2">
                          {{ errors.image }}
                        </span>
                      </p>
                    </div>
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
                  <div class="col-md-12">
                    <div class="mb-3">
                      <label for="description" class="form-label"
                        >Description</label
                      >
                      <textarea
                        class="form-control"
                        id="description"
                        v-model="form.description"
                      ></textarea>
                      <div v-if="errors.description" class="text-danger mt-2">
                        {{ errors.description }}
                      </div>
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="mb-3">
                      <label for="button" class="form-label"
                        >Button Title</label
                      >
                      <input
                        type="text"
                        class="form-control"
                        id="button"
                        v-model="form.button"
                      />
                      <div v-if="errors.button" class="text-danger mt-2">
                        {{ errors.button }}
                      </div>
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="mb-3">
                      <label for="link" class="form-label">Link</label>
                      <input
                        type="text"
                        class="form-control"
                        id="link"
                        v-model="form.link"
                      />
                      <div v-if="errors.link" class="text-danger mt-2">
                        {{ errors.link }}
                      </div>
                    </div>
                  </div>
                </div>
                <button type="submit" class="btn btn-primary">
                  Update Hero
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
  hero: {
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
  title: props.hero.title,
  subtitle: props.hero.subtitle,
  description: props.hero.description,
  button: props.hero.button,
  link: props.hero.link,
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
  if (!form.image) delete form.image;
  form.post(route("hero.update"), {
    preserveScroll: true,
    onSuccess: () => {
      toast.success("Hero Updated Successfully");
    },
    onError:(err) => {
      errors.value = err; 
    }
  });
};
</script>
  
  <style scoped>
</style>
  