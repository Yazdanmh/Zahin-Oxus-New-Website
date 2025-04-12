<template>
  <Head title="Counter" />
  <AdminLayout :setting="props.setting" :user="props.user" :permissions="props.permissions">
    <div class="container-xxl flex-grow-1 container-p-y">
      <h4 class="fw-bold py-3 mb-4">
        <span class="text-muted fw-light">Home /</span> Counter
      </h4>
      <div class="row">
        <div class="col-xl">
          <div class="card mb-4">
            <div
              class="card-header d-flex justify-content-between align-items-center"
            >
              <h5 class="mb-0">Counters</h5>
              <small class="text-muted float-end">Manage counters</small>
            </div>
            <div class="card-body">
              <form @submit.prevent="submit">
                <div class="row">
                  <div class="col-md-3">
                    <div class="mb-3">
                      <label for="happy_users" class="form-label"
                        >Happy Users</label
                      >
                      <input
                        type="number"
                        class="form-control"
                        id="happy_users"
                        v-model="form.happy_users"
                      />
                      <div v-if="errors.happy_users" class="text-danger mt-2">
                        {{ errors.happy_users }}
                      </div>
                    </div>
                  </div>
                  <div class="col-md-3">
                    <div class="mb-3">
                      <label for="case_complete" class="form-label"
                        >Case Complete</label
                      >
                      <input
                        type="number"
                        class="form-control"
                        id="case_complete"
                        v-model="form.case_complete"
                      />
                      <div v-if="errors.case_complete" class="text-danger mt-2">
                        {{ errors.case_complete }}
                      </div>
                    </div>
                  </div>
                  <div class="col-md-3">
                    <div class="mb-3">
                      <label for="years_of_experience" class="form-label"
                        >Years of Experience</label
                      >
                      <input
                        type="number"
                        class="form-control"
                        id="years_of_experience"
                        v-model="form.years_of_experience"
                      />
                      <div
                        v-if="errors.years_of_experience"
                        class="text-danger mt-2"
                      >
                        {{ errors.years_of_experience }}
                      </div>
                    </div>
                  </div>
                  <div class="col-md-3">
                    <div class="mb-3">
                      <label for="professional_advisor" class="form-label"
                        >Professional Advisor</label
                      >
                      <input
                        type="number"
                        class="form-control"
                        id="professional_advisor"
                        v-model="form.professional_advisor"
                      />
                      <div
                        v-if="errors.professional_advisor"
                        class="text-danger mt-2"
                      >
                        {{ errors.professional_advisor }}
                      </div>
                    </div>
                  </div>
                </div>
                <div v-if="hasPermission('site_data.edit')" class="d-flex justify-content-end gap-3 mt-4">
                  <button type="submit" class="btn btn-primary">
                    <i class="bx bx-pencil"></i> Update Counters
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
import { Head } from "@inertiajs/vue3";
import { ref } from "vue";
import { useForm } from "@inertiajs/vue3";
import { useToast } from "vue-toastification";

const props = defineProps({
  counter: {
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
  permissions: {
    type: Array,
    required: true,
  }
});

const toast = useToast();

// Use optional chaining (?.) to safely access properties of `counter` and provide default values
const form = useForm({
  happy_users: props.counter?.happy_users ?? 0, // Default to 0 if null or undefined
  case_complete: props.counter?.case_complete ?? 0, // Default to 0 if null or undefined
  years_of_experience: props.counter?.years_of_experience ?? 0, // Default to 0 if null or undefined
  professional_advisor: props.counter?.professional_advisor ?? 0, // Default to 0 if null or undefined
});

const errors = ref({});

const submit = () => {
  // Assuming you don't need `form.image` in this context, so this line might be unnecessary
  if (!form.image) delete form.image;

  form.post(route("counter.update"), {
    preserveScroll: true,
    onSuccess: () => {
      toast.success("Counters Updated Successfully");
    },
    onError: (err) => {
      errors.value = err;
      toast.error("Error occurred while processing the form!");
    }
  });
};

const hasPermission = (permission) => {
  return props.permissions.includes(permission);
};
</script>

    
    <style scoped>
</style>
    