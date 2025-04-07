<template>
    <AdminLayout :setting="props.setting" :user="props.user" :permissions="props.permissions">
      <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="fw-bold py-3 mb-4">
          <span class="text-muted fw-light">Participants /</span> See Participants
        </h4>
  
        <div class="card">
          <div class="card-body">
            <!-- Check if participants are available -->
            <div v-if="participants.length > 0">
              <div class="table table-responsive">
                <table class="table table-bordered">
                <thead>
                  <tr>
                    <th>#</th>
                    <th>Full Name</th>
                    <th>Email</th>
                    <th>Phone Number</th>
                    <th>Organization</th>
                    <th>Position</th>
                 
                  </tr>
                </thead>
                <tbody>
                  <!-- Iterate over the participants array and display each participant -->
                  <tr v-for="(participant, index) in participants" :key="participant.id">
                    <td>{{ index + 1 }}</td>
                    <td>{{ participant.full_name }}</td>
                    <td>{{ participant.email }}</td>
                    <td>{{ participant.phone_number }}</td>
                    <td>{{ participant.organization }}</td>
                    <td>{{ participant.position }}</td>
                
                      
                  </tr>
                </tbody>
              </table>
              </div>
            </div>
  
            <!-- If no participants found -->
            <div v-else>
              <p>No participants found for this training.</p>
            </div>
          </div>
        </div>
      </div>
    </AdminLayout>
  </template>
  
  <script setup>
  import { ref } from "vue";
  import { Head, Link } from "@inertiajs/vue3";
  import AdminLayout from "@/Layouts/AdminLayout.vue";
  
  // Props passed from the controller
  const props = defineProps({
    participants: {
      type: Array,
      required: true
    },
    setting: {
      type: Object,
      required: true
    },
    user: {
      type: Object,
      required: true
    },
    permissions:{
    type:Array, 
    required:true, 
  }
  });
  
  // Function to delete a participant (if needed)
  const deleteParticipant = (id) => {
    // Make an API call or trigger a modal to confirm deletion
    if (confirm('Are you sure you want to delete this participant?')) {
      // You can send a request to delete the participant
      // Example: Call an API or an action to delete the participant by id
      console.log(`Participant with id ${id} deleted`);
    }
  };
  </script>
  
  