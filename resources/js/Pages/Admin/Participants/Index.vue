<template>
  <Head title="Participants" />
  <AdminLayout :setting="props.setting" :user="props.user">
    <div class="container-xxl flex-grow-1 container-p-y">
      <h4 class="fw-bold py-3 mb-4">
        <span class="text-muted fw-light">Home /</span> Participants
      </h4>
      <div class="row">
        <div class="col-md-12">
          <div class="card mb-4">
            <div
              class="card-header d-flex justify-content-between align-items-center"
            >
              <h5 class="mb-0">Participants</h5>
              <Link
                :href="route('participants.create')"
                class="btn btn-primary"
              >
                Add Participant
              </Link>
            </div>

            <div class="card-body">
              <!-- Filter/Search Area -->
              <div class="row mb-4">
                <div class="col-md-3">
                  <input
                    v-model="searchQuery"
                    @input="applyFilter"
                    type="text"
                    class="form-control"
                    placeholder="Search by name"
                  />
                </div>
                <div class="col-md-3">
                  <select
                    v-model="selectedTraining"
                    @change="applyFilter"
                    class="form-select"
                  >
                    <option value="">All Trainings</option>
                    <option
                      v-for="training in trainings"
                      :key="training.id"
                      :value="training.id"
                    >
                      {{ training.name }}
                    </option>
                  </select>
                </div>
              </div>

              <!-- Table -->
              <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                  <thead>
                    <tr>
                      <th>#</th>
                      <th>Full Name</th>
                      <th>Email</th>
                      <th>Phone</th>
                      <th>Organization</th>
                      <th>Position</th>
                      <th>Training</th>
                      <th>Actions</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr
                      v-for="participant in filteredParticipants"
                      :key="participant.id"
                    >
                      <td>{{ participant.id }}</td>
                      <td>{{ participant.full_name }}</td>
                      <td>{{ participant.email }}</td>
                      <td>{{ participant.phone_number }}</td>
                      <td>{{ participant.organization }}</td>
                      <td>{{ participant.position }}</td>
                      <td>{{ participant.training.name }}</td>
                     

                      <td class="text-center">
                        <Link :href="route('participants.edit', participant.id)">
                          <span
                            class="badge bg-label-primary p-1_5 me-3 cursor-pointer mb-2"
                          >
                            <i class="icon-base bx bx-pencil icon-xs"></i>
                          </span>
                        </Link>

                        <span
                          @click="confirmDelete(participant.id)"
                          class="badge bg-label-danger p-1_5 me-3 cursor-pointer mb-2"
                        >
                          <i class="icon-base bx bx-trash icon-xs"></i>
                        </span>
                        
                      </td>
                    </tr>
                    <tr v-if="!filteredParticipants.length">
                      <td colspan="8" class="text-center">
                        No participants found
                      </td>
                    </tr>
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </AdminLayout>
</template>
  
  <script setup>
import AdminLayout from "@/Layouts/AdminLayout.vue";
import { Head, Link,useForm } from "@inertiajs/vue3";
import { ref, computed } from "vue";
import Swal from "sweetalert2";
import axios from "axios";

const props = defineProps({
  participants: { type: Object, required: true },
  trainings: { type: Array, required: true },
  setting: { type: Object, required: true },
  user: { type: Object, required: true },
});
const form = useForm({});
const searchQuery = ref("");
const selectedTraining = ref("");

const filteredParticipants = computed(() => {
  return props.participants.data.filter((participant) => {
    const matchesSearch = participant.full_name
      .toLowerCase()
      .includes(searchQuery.value.toLowerCase());
    const matchesTraining = selectedTraining.value
      ? participant.training.id === selectedTraining.value
      : true;
    return matchesSearch && matchesTraining;
  });
});

const confirmDelete = (id) => {
  Swal.fire({
    title: "Are you sure?",
    text: "This will permanently delete the participant.",
    icon: "warning",
    showCancelButton: true,
    confirmButtonColor: "#3085d6",
    cancelButtonColor: "#d33",
    confirmButtonText: "Yes, delete it!",
  }).then((result) => {
    if (result.isConfirmed) {
      deleteParticipant(id);
    }
  });
};

const deleteParticipant = (id) => {
  form.post(route("participants.destroy", id)).then(() => {
    window.location.reload();
  });
};
</script>
  