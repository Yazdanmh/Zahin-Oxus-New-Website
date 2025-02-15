<template>
    <Head title="Members" />
    <AdminLayout :setting="props.setting" :user="props.user">
      <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="fw-bold py-3 mb-4">
          <span class="text-muted fw-light">Home /</span> Members / All
        </h4>
        <div class="row">
          <div class="col-xl">
            <div class="card mb-4">
              <div
                class="card-header d-flex justify-content-between align-items-center"
              >
                <h5 class="mb-0">All Members</h5>
                <small class="text-muted float-end">List of all Members</small>
              </div>
              <div class="card-body">
                <div class="d-flex justify-content-end mb-3">
                  <Link :href="route('members.create')" class="btn btn-primary">
                    <i class="bx bx-plus"></i> Add Member
                  </Link>
                </div>
  
                <!-- Show message if no members -->
                <div v-if="props.members.data.length === 0">
                  <p class="text-center text-muted">No members found.</p>
                </div>
                <div v-else class="table-responsive">
                  <!-- Members Table -->
                  <table class="table table-bordered">
                    <thead>
                      <tr>
                        <th>#</th>
                        <th>Image</th>
                        <th>Name</th>
                        <th>Position</th>
                        <th>Email</th>
                        <th>Phone</th>
                        <th>Actions</th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr v-for="(member, index) in props.members.data" :key="member.id">
                        <td>{{ index + 1 }}</td>
                        <td>
                          <img
                            :src="'/storage/' + member.image"
                            alt=""
                            style="
                              width: 70px;
                              height: 70px;
                              border-radius: 50%;
                              object-fit: cover;
                            "
                          />
                        </td>
                        <td>{{ member.name }}</td>
                        <td>{{ member.position }}</td>
                        <td>{{ member.email }}</td>
                        <td>{{ member.phone || 'N/A' }}</td>
                        <td class="text-center">
                          <Link :href="route('members.edit', member.id)">
                            <span
                              class="badge bg-label-primary p-1_5 me-3 cursor-pointer mb-2"
                            >
                              <i class="icon-base bx bx-pencil icon-xs"></i>
                            </span>
                          </Link>
                          <span
                            @click="confirmDelete(member.id)"
                            class="badge bg-label-danger p-1_5 me-3 cursor-pointer mb-2"
                          >
                            <i class="icon-base bx bx-trash icon-xs"></i>
                          </span>
                          <Link :href="route('members.show', member.id)">
                            <span
                              class="badge bg-label-primary p-1_5 me-3 cursor-pointer mb-2"
                            >
                              <i
                                class="icon-base bx bx-message-square-detail"
                              ></i>
                            </span>
                          </Link>
                        </td>
                      </tr>
                    </tbody>
                  </table>
                </div>
  
                <div v-if="props.members.last_page > 1" class="pagination-wrapper">
                  <nav>
                    <ul class="pagination justify-content-center">
                      <li
                        class="page-item"
                        :class="{ disabled: props.members.current_page === 1 }"
                      >
                        <Link
                          :href="props.members.prev_page_url"
                          class="page-link"
                          :disabled="props.members.current_page === 1"
                          >Previous</Link
                        >
                      </li>
                      <li
                        v-for="page in props.members.last_page"
                        :key="page"
                        :class="{
                          'page-item': true,
                          active: page === props.members.current_page,
                        }"
                      >
                        <Link
                          :href="route('members.index', { page: page })"
                          class="page-link"
                        >
                          {{ page }}
                        </Link>
                      </li>
                      <li
                        class="page-item"
                        :class="{
                          disabled:
                            props.members.current_page === props.members.last_page,
                        }"
                      >
                        <Link
                          :href="props.members.next_page_url"
                          class="page-link"
                          :disabled="
                            props.members.current_page === props.members.last_page
                          "
                          >Next</Link
                        >
                      </li>
                    </ul>
                  </nav>
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
  import Swal from "sweetalert2";
  import { Head, useForm, Link } from "@inertiajs/vue3";
  import { defineProps } from "vue";
  import { useToast } from "vue-toastification";
  
  const props = defineProps({
    members: {
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
   
  const form = useForm({});
  const toast = useToast();
  
  // Delete a member
  const deleteMember = (id) => {
    form.post(route("members.destroy", id), {
      preserveScroll: true,
      onSuccess: () => {
        toast.success("Member Deleted Successfully");
      },
      onError: (err) => {
        toast.error("Error: " + err.message);
      },
    });
  };
  
  const confirmDelete = (id) => {
    Swal.fire({
      title: "Are you sure?",
      text: "You won't be able to revert this!",
      icon: "warning",
      showCancelButton: true,
      confirmButtonColor: "#3085d6",
      cancelButtonColor: "#d33",
      confirmButtonText: "Yes, delete it!",
    }).then((result) => {
      if (result.isConfirmed) {
        deleteMember(id);
      }
    });
  };
  </script>
  
  <style scoped>
  .pagination-wrapper {
    margin-top: 20px;
  }
  </style>