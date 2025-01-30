<template>
  <Head title="Testimonials" />
  <AdminLayout :setting="props.setting" :user="props.user">
    <div class="container-xxl flex-grow-1 container-p-y">
      <h4 class="fw-bold py-3 mb-4">
        <span class="text-muted fw-light">Home /</span> Testimonial / All
      </h4>
      <div class="row">
        <div class="col-xl">
          <div class="card mb-4">
            <div
              class="card-header d-flex justify-content-between align-items-center"
            >
              <h5 class="mb-0">All Testimonials</h5>
              <small class="text-muted float-end"
                >List of all testimonials</small
              >
            </div>
            <div class="card-body">
              <div class="d-flex justify-content-end mb-3">
                <Link :href="route('testimonails.create')" class="btn btn-primary">
                  <i class="bx bx-plus"></i> Add Testimonial
                </Link>
              </div>
              <table class="table table-bordered">
                <thead>
                  <tr>
                    <th>#</th>
                    <th>Image</th>
                    <th>Name</th>
                    <th>Position</th>
                    <th>Stars</th>
                    <th>Message</th>
                    <th>Actions</th>
                  </tr>
                </thead>

                <tbody>
                  <tr
                    v-for="(testimonial, index) in props.testimonails"
                    :key="testimonial.id"
                  >
                    <td>{{ index + 1 }}</td>
                    <td>
                      <img
                        :src="'/storage/' + testimonial.image"
                        alt=""
                        style="
                          width: 70px;
                          height: 70px;
                          border-radius: 50%;
                          object-fit: cover;
                        "
                      />
                    </td>
                    <td>{{ testimonial.name }}</td>
                    <td>{{ testimonial.position }}</td>
                    <td>{{ testimonial.stars }}</td>
                    <td>{{ testimonial.message.slice(0, 50) }}...</td>
                    <td>
                      <Link :href="route('testimonails.edit', testimonial.id)">
                        <span
                         
                          class="badge bg-label-primary p-1_5 me-3 cursor-pointer mb-2"
                          ><i class="icon-base bx bx-pencil icon-xs"></i
                        ></span>
                      </Link>
                      <span
                        @click="confirmDelete(testimonial.id)"
                        class="badge bg-label-danger p-1_5 me-3 cursor-pointer"
                        ><i class="icon-base bx bx-trash icon-xs"></i
                      ></span>
                    </td>
                  </tr>
                </tbody>
              </table>
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
  testimonails: {
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
const form = useForm({
});
const toast = useToast();

// Delete a service
const deleteTestimonial = (id) => {
  form.delete(route("testimonails.destroy", id), {
    preserveScroll: true,
    onSuccess: () => {
      toast.success("Testimonail Deleted Successfully");
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
      deleteTestimonial(id); // Call the delete method if confirmed
    }
  });
};
</script>
  
  <style scoped>
/* You can add custom styles for this page if necessary */
</style>
  