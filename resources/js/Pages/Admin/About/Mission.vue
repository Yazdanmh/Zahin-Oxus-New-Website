<template>
  <Head title="Our Mission" />
  <AdminLayout :setting="props.setting" :user="props.user" :permissions="props.permissions">
    <div class="container-xxl flex-grow-1 container-p-y">
      <h4 class="fw-bold py-3 mb-4">
        <span class="text-muted fw-light">Pages /</span> About / Our Mission
      </h4>
      <div class="row">
        <div class="col-xl">
          <div class="card mb-4">
            <div class="card-header d-flex justify-content-between align-items-center">
              <h5 class="mb-0">Our Mission</h5>
              <small class="text-muted float-end">Manage Our Mission</small>
            </div>
            <div class="card-body">
              <form @submit.prevent="submit">
                <!-- Reuse the TextEditor component -->
                <TextEditor v-model="form.our_mission" />
                <span v-if="errors.our_mission" class="text-danger mt-2">
                          {{ errors.our_mission }}
                        </span>
                <button v-if="hasPermission('site_data.edit')" type="submit" class="btn btn-primary mt-3">
                  Update
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
import { useForm } from "@inertiajs/vue3";
import { useToast } from "vue-toastification";
import TextEditor from "@/Components/Admin/TextEditor.vue"; // Import the TextEditor component
import { ref } from "vue";

// Props passed from the server
const props = defineProps({
  our_mission: {
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
  permissions:{
    type:Array, 
    required:true, 
  }
});

// Toast notifications
const toast = useToast();
const errors = ref({});
// Initialize form with the correct value
const form = useForm({
  our_mission: props.our_mission?.our_mission || "", // Use the correct property from props
});

// Handle form submission
const submit = () => {
  form.post(route("ourmission"), {
    preserveScroll: true,
    onSuccess: () => {
      toast.success("About Section Updated Successfully");
    },
    onError: (err) => {
      errors.value = err;
      toast.error("An error occurred while updating the About Section.");
    },
  });
};
const hasPermission = (permission) => {
  return props.permissions.includes(permission);
};  
</script>

<style scoped>
</style>
