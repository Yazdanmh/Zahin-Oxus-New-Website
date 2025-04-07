<template>
    <Head title="Edit MOU" />
    <AdminLayout :setting="props.setting" :user="props.user" :permissions="props.permissions">
      <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="fw-bold py-3 mb-4">
          <span class="text-muted fw-light">Home /</span> MOUs / Edit
        </h4>
        <div class="row">
          <div class="col-xl">
            <div class="card mb-4">
              <div class="card-header d-flex justify-content-between align-items-center">
                <h5 class="mb-0">Edit MOU</h5>
                <small class="text-muted float-end">Manage MOUs</small>
              </div>
              <div class="card-body">
                <form @submit.prevent="submit">
                  <div class="row">
                    <!-- MOU Title -->
                    <div class="col-md-6">
                      <div class="mb-3">
                        <label for="title" class="form-label">MOU Title</label>
                        <input
                          type="text"
                          class="form-control"
                          id="title"
                          v-model="form.title"
                          placeholder="Enter MOU title"
                        />
                        <!-- Display error for title -->
                        <div v-if="errors.title" class="text-danger mt-2">
                          {{ errors.title }}
                        </div>
                      </div>
                    </div>
                    <!-- Start Date -->
                    <div class="col-md-3">
                      <div class="mb-3">
                        <label for="start_date" class="form-label">Start Date</label>
                        <input
                          type="date"
                          class="form-control"
                          id="start_date"
                          v-model="form.start_date"
                        />
                        <!-- Display error for start_date -->
                        <div v-if="errors.start_date" class="text-danger mt-2">
                          {{ errors.start_datetitle }}
                        </div>
                      </div>
                    </div>
                    <!-- End Date -->
                    <div class="col-md-3">
                      <div class="mb-3">
                        <label for="end_date" class="form-label">End Date (Optional)</label>
                        <input
                          type="date"
                          class="form-control"
                          id="end_date"
                          v-model="form.end_date"
                        />
                        <!-- Display error for end_date -->
                        <div v-if="errors.end_date" class="text-danger mt-2">
                          {{ errors.end_datetitle }}
                        </div>
                      </div>
                    </div>
                  </div>
  
                  <div class="row">
                    <!-- Parties Involved -->
                    <div class="col-md-6">
                      <div class="mb-3">
                        <label for="parties_involved" class="form-label">Parties Involved</label>
                        <input
                          type="text"
                          class="form-control"
                          id="parties_involved"
                          v-model="form.parties_involved"
                          placeholder="Zahin Oxus, etc ..."
                        />
                        <!-- Display error for parties_involved -->
                        <div v-if="errors.parties_involved" class="text-danger mt-2">
                          {{ errors.parties_involvedtitle }}
                        </div>
                      </div>
                    </div>
  
                    <!-- MOU Status -->
                    <div class="col-md-3">
                      <div class="mb-3">
                        <label for="status" class="form-label">Status</label>
                        <select
                          class="form-select"
                          id="status"
                          v-model="form.status"
                        >
                          <option value="Active">Active</option>
                          <option value="Inactive">Inactive</option>
                          <option value="Pending">Pending</option>
                        </select>
                        <!-- Display error for status -->
                        <div v-if="errors.status" class="text-danger mt-2">
                          {{ errors.statustitle }}
                        </div>
                      </div>
                    </div>
  
                    <!-- MOU File -->
                    <div class="col-md-3">
                      <div class="mb-3">
                        <label for="mou_file" class="form-label">Upload MOU File (Optional)</label>
                        <input
                          type="file"
                          class="form-control"
                          id="mou_file"
                          @change="handleFileUpload"
                        />
                        <!-- Display error for mou_file -->
                        <div v-if="errors.mou_file" class="text-danger mt-2">
                          {{ errors.mou_file }}
                        </div>
                        <!-- Display existing file link if available -->
                      
                      </div>
                    </div>
  
                    <!-- Description -->
                    <div class="col-md-12">
                      <div class="mb-3">
                        <!-- Bind the description to the TextEditor -->
                        <TextEditor v-model="form.description" @editor-change="updateDescription" />
                        <div v-if="errors.description" class="text-danger mt-2">
                          {{ errors.descriptiontitle }}
                        </div>
                      </div>
                    </div>
                  </div>
  
                  <div class="d-flex justify-content-end gap-3 mt-4">
                    <Link
                    :href="route('mou.index')"
                    class="btn btn-outline-secondary"
                    
                  >
                     Cancel
                </Link>
                    <button type="submit" class="btn btn-primary">
                      <i class="bx bx-save"></i> Update MOU
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
  import { Head, Link } from "@inertiajs/vue3";
  import { useForm } from "@inertiajs/vue3";
  import { useToast } from "vue-toastification";
  import { ref, nextTick, watch, onMounted } from "vue";
  import TextEditor from "@/Components/Admin/TextEditor.vue";
  
  // Define props from the parent component
  const props = defineProps({
    setting: {
      type: Object,
      required: true,
    },
    user: {
      type: Object,
      required: true,
    },
    errors: {
      type: Object,
      default: () => ({}), // Default to an empty object if not passed
    },
    mou: {
      type: Object,
      required: true, // Make sure the MOU data is passed as a prop
    },

    permissions:{
      type:Array, required:true
    }
  });
  
  // Initialize Toast for success/error messages
  const toast = useToast();
  
  // Initialize form using the useForm hook from inertia
  const form = useForm({
    id: props.mou.id, // Pre-fill with MOU ID
    title: props.mou.title,
    description: props.mou.description,
    parties_involved: props.mou.parties_involved,
    start_date: props.mou.start_date,
    end_date: props.mou.end_date,
    status: props.mou.status,
    mou_file: null, // For file upload
    existing_file: props.mou.mou_file, // Pre-fill the existing file information
    existing_file_url: props.mou.mou_file_url, // Pre-fill the existing file URL
  });
  
  // Reactive error object
  const errors = ref(props.errors);
  
  // Watch for changes in the errors prop
  watch(() => props.errors, (newErrors) => {
    errors.value = { ...newErrors }; // Ensure a new reference to trigger reactivity
  });
  
  const handleFileUpload = (event) => {
    const file = event.target.files[0];
    form.mou_file = file; // Assign the selected file to the form's mou_file field
  };
  
  const updateDescription = (newValue) => {
    form.description = newValue;
  };
  
  const submit = () => {
    form.post(route("mou.update", form.id), {
      preserveScroll: true,
      onSuccess: () => {
        toast.success("MOU Updated Successfully");
        // Reset errors after a successful submission
        errors.value = {};
      },
      
      onError: (err) => {
        errors.value = err; 
  
        toast.error("Error occurred while processing the form! ");
      },
    });
  };
  </script>
  
  <style scoped>
  </style>
  