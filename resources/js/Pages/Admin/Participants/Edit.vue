<template>
    <Head title="Edit Participant" />
    <AdminLayout :setting="props.setting" :user="props.user" :permissions="props.permissions">
      <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="fw-bold py-3 mb-4">
          <span class="text-muted fw-light">Participants /</span> Edit Participant
        </h4>
  
        <div class="card">
        
          <div class="card-body">
            <form @submit.prevent="submitForm">
              <div class="row">
                <!-- Full Name -->
                <div class="col-md-4 mb-3">
                  <label for="full_name" class="form-label">Full Name</label>
                  <input
                    v-model="form.full_name"
                    type="text"
                    class="form-control"
                    id="full_name"
                    placeholder="Enter Full Name"
                    required
                  />
                  <span v-if="errors.full_name" class="text-danger">{{ errors.full_name }}</span>
                </div>
  
                <!-- Email -->
                <div class="col-md-4 mb-3">
                  <label for="email" class="form-label">Email</label>
                  <input
                    v-model="form.email"
                    type="email"
                    class="form-control"
                    id="email"
                    placeholder="Enter Email"
                    required
                  />
                  <span v-if="errors.email" class="text-danger">{{ errors.email }}</span>
                </div>
  
                <!-- Phone Number -->
                <div class="col-md-4 mb-3">
                  <label for="phone_number" class="form-label">Phone Number</label>
                  <input
                    v-model="form.phone_number"
                    type="text"
                    class="form-control"
                    id="phone_number"
                    placeholder="Enter Phone Number"
                  />
                  <span v-if="errors.phone_number" class="text-danger">{{ errors.phone_number }}</span>
                </div>
  
                <!-- Tazkira Number -->
                <div class="col-md-4 mb-3">
                  <label for="taskira_number" class="form-label">Tazkira Number</label>
                  <input
                    v-model="form.taskira_number"
                    type="text"
                    class="form-control"
                    id="taskira_number"
                    placeholder="Enter Tazkira Number"
                  />
                  <span v-if="errors.taskira_number" class="text-danger">{{ errors.taskira_number }}</span>
                </div>
  
                <!-- Address -->
                <div class="col-md-4 mb-3">
                  <label for="address" class="form-label">Address</label>
                  <input
                    v-model="form.address"
                    type="text"
                    class="form-control"
                    id="address"
                    placeholder="Enter Address"
                  />
                  <span v-if="errors.address" class="text-danger">{{ errors.address }}</span>
                </div>
  
                <!-- Organization -->
                <div class="col-md-4 mb-3">
                  <label for="organization" class="form-label">Organization</label>
                  <input
                    v-model="form.organization"
                    type="text"
                    class="form-control"
                    id="organization"
                    placeholder="Enter Organization"
                  />
                  <span v-if="errors.organization" class="text-danger">{{ errors.organization }}</span>
                </div>
  
                <!-- Position -->
                <div class="col-md-4 mb-3">
                  <label for="position" class="form-label">Position</label>
                  <input
                    v-model="form.position"
                    type="text"
                    class="form-control"
                    id="position"
                    placeholder="Enter Position"
                  />
                  <span v-if="errors.position" class="text-danger">{{ errors.position }}</span>
                </div>
  
                <!-- Select Training -->
                <div class="col-md-4 mb-3">
                  <label for="training_id" class="form-label">Select Training</label>
                  <select v-model="form.training_id" class="form-select" id="training_id" required>
                    <option value="">-- Select Training --</option>
                    <option v-for="training in trainings" :key="training.id" :value="training.id">
                      {{ training.name }}
                    </option>
                  </select>
                  <span v-if="errors.training_id" class="text-danger">{{ errors.training_id }}</span>
                </div>
              </div>
  
              <div class="text-end">
                <Link :href="route('participants.index')" class="btn btn-secondary me-2">Cancel</Link>
                <button type="submit" class="btn btn-primary">Save Changes</button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </AdminLayout>
  </template>
  
  <script setup>
  import { ref, onMounted } from "vue";
  import { Head, Link, useForm } from "@inertiajs/vue3";
  import AdminLayout from "@/Layouts/AdminLayout.vue";
  
  const props = defineProps({
    trainings: { type: Array, required: true },
    setting: { type: Object, required: true },
    user: { type: Object, required: true },
    participant: { type: Object, required: true },
    permissions:{
      type:Array, required:true
    }
  });
  
  const form = useForm({
    full_name: props.participant.full_name || "",
    email: props.participant.email || "",
    phone_number: props.participant.phone_number || "",
    organization: props.participant.organization || "",
    position: props.participant.position || "",
    address: props.participant.address || "",
    taskira_number: props.participant.taskira_number || "",
    training_id: props.participant.training_id || ""
  });
  
  const errors = ref({});
  
  const submitForm = () => {
    form.post(route("participants.update", props.participant.id), {
      onSuccess: () => {
        form.reset();
      },
      onError: (err) => {
        errors.value = err;
      }
    });
  };
  </script>
  