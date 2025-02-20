<template>
  <Head title="History" />
  <AdminLayout :setting="props.setting" :user="props.user">
    <div class="container-xxl flex-grow-1 container-p-y">
      <h4 class="fw-bold py-3 mb-4">
        <span class="text-muted fw-light">Home /</span> History
      </h4>
      <div class="row">
        <div class="col-xl">
          <div class="card mb-4">
            <div
              class="card-header d-flex justify-content-between align-items-center"
            >
              <h5 class="mb-0">Manage History Section</h5>
              <small class="text-muted float-end">Update History Section</small>
            </div>
            <div class="card-body">
              <form @submit.prevent="submit">
                <div class="row">
                  <div class="col-md-12">
                    <div class="mb-3">
                      <label for="subtitle" class="form-label">Subtitle</label>
                      <input
                        type="text"
                        class="form-control"
                        id="subtitle"
                        v-model="form.subtitle"
                      />
                      <small v-if="errors.subtitle" class="text-danger">{{
                        errors.subtitle
                      }}</small>
                    </div>
                  </div>
                  <div class="col-md-12">
                    <div class="mb-3">
                      <label for="title" class="form-label">Title</label>
                      <input
                        type="text"
                        class="form-control"
                        id="title"
                        v-model="form.title"
                      />
                      <small v-if="errors.title" class="text-danger">{{
                        errors.title
                      }}</small>
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
                        rows="4"
                        v-model="form.description"
                      ></textarea>
                      <small v-if="errors.description" class="text-danger">{{
                        errors.description
                      }}</small>
                    </div>
                  </div>
                  <div class="col-md-12">
                    <div class="mb-3">
                      <label for="progress_items" class="form-label"
                        >Progress Items (JSON)</label
                      >
                      <textarea
                        class="form-control"
                        id="progress_items"
                        rows="3"
                        v-model="form.progress_items"
                        placeholder='Example: {"Consulting": 75, "Investment": 90}'
                      ></textarea>
                      <small v-if="errors.progress_items" class="text-danger">{{
                        errors.progress_items
                      }}</small>
                    </div>
                  </div>

                  <!-- Image Uploads -->
                  <div class="col-md-6">
                    <div class="mb-3">
                      <label class="form-label">Image One</label>
                      <div
                        class="d-flex align-items-start align-items-sm-center gap-4"
                      >
                        <img
                          :src="
                            imagePreviewOne ||
                            (props.history?.image_one
                              ? '/storage/' + props.history.image_one
                              : '/default-placeholder.jpg')
                          "
                          alt="Image One"
                          class="d-block rounded"
                          style="width: 300px; height: 100px; object-fit: cover"
                        />
                        <div class="button-wrapper">
                          <label
                            for="upload-one"
                            class="btn btn-primary me-2 mb-4"
                          >
                            <span class="d-none d-sm-block">Upload Image</span>
                            <input
                              type="file"
                              id="upload-one"
                              hidden
                              accept="image/png, image/jpeg"
                              @change="handleImageOneUpload"
                            />
                          </label>
                          <p class="text-muted mb-0">
                            Allowed formats: JPG, PNG. Max size: 1MB. <br>
                            <span class="text-warning">Recommended dimensions: 481 x 481 pixels.</span>
                          </p>
                          <small v-if="errors.image_one" class="text-danger">{{
                            errors.image_one
                          }}</small>
                        </div>
                      </div>
                    </div>
                  </div>

                  <div class="col-md-6">
                    <div class="mb-3">
                      <label class="form-label">Image Two</label>
                      <div
                        class="d-flex align-items-start align-items-sm-center gap-4"
                      >
                        <img
                          :src="
                            imagePreviewTwo ||
                            (props.history?.image_two
                              ? '/storage/' + props.history.image_two
                              : '/default-placeholder.jpg')
                          "
                          alt="Image Two"
                          class="d-block rounded"
                          style="width: 300px; height: 100px; object-fit: cover"
                        />
                        <div class="button-wrapper">
                          <label
                            for="upload-two"
                            class="btn btn-primary me-2 mb-4"
                          >
                            <span class="d-none d-sm-block">Upload Image</span>
                            <input
                              type="file"
                              id="upload-two"
                              hidden
                              accept="image/png, image/jpeg"
                              @change="handleImageTwoUpload"
                            />
                          </label>
                          <p class="text-muted mb-0">
                            Allowed formats: JPG, PNG. Max size: 1MB.<br>
                            <span class="text-warning">Recommended dimensions: 274 x 299 pixels.</span>

                          </p>
                          <small v-if="errors.image_two" class="text-danger">{{
                            errors.image_two
                          }}</small>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>

                <button type="submit" class="btn btn-primary mt-3">
                  Update History
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
  history: {
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
const toast = useToast();
const errors = ref({});
const form = useForm({
  subtitle: props.history.subtitle,
  title: props.history.title,
  description: props.history.description,
  progress_items: JSON.stringify(props.history.progress_items || {}),
  image_one: null,
  image_two: null,
});

const imagePreviewOne = ref(null);
const imagePreviewTwo = ref(null);

const handleImageOneUpload = (event) => {
  const file = event.target.files[0];
  if (file) {
    form.image_one = file;
    const reader = new FileReader();
    reader.onload = (e) => {
      imagePreviewOne.value = e.target.result;
    };
    reader.readAsDataURL(file);
  }
};

const handleImageTwoUpload = (event) => {
  const file = event.target.files[0];
  if (file) {
    form.image_two = file;
    const reader = new FileReader();
    reader.onload = (e) => {
      imagePreviewTwo.value = e.target.result;
    };
    reader.readAsDataURL(file);
  }
};

const submit = () => {
  if (!form.image_one) delete form.image_one;
  if (!form.image_two) delete form.image_two;
  form.post(route("history.update"), {
    preserveScroll: true,
    onSuccess: () => {
      toast.success("History Section Updated Successfully");
    },
    onError: (err) => {
      errors.value = err;
      toast.error("Error occured while processing the form!");
    },
  });
};
</script>
  