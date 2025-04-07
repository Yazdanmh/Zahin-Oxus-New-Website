<template>
    <Head title="Gallery List" />
    <AdminLayout :setting="props.setting" :user="props.user" :permissions="props.user.permissions">
      <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="fw-bold py-3 mb-4">
          <span class="text-muted fw-light">Home /</span> Gallery / List
        </h4>
        <div class="row">
          <div class="col-xl">
            <div class="card mb-4">
              <div class="card-header d-flex justify-content-between align-items-center">
                <h5 class="mb-0">Gallery List</h5>
                <Link v-if="hasPermission('gallery.create')" :href="route('galleries.create')" class="btn btn-primary">
                  <i class="bx bx-plus"></i> Add New Image
                </Link>
              </div>
              <div class="card-body">
                <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 row-cols-lg-4">
                  <div
                    v-for="gallery in galleries.data"
                    :key="gallery.id"
                    class="col mb-4 position-relative"
                  >
                    <div class="card image">
                      <img
                        v-if="gallery.image"
                        :src="'/storage/' + gallery.image"
                        class="card-img-top"
                        alt="Gallery Image"
                        style="height: 200px; object-fit: cover"
                      />
                      <!-- Title on hover -->
                      <div
                        class="overlay position-absolute top-0 start-0 end-0 bottom-0 d-flex justify-content-center align-items-center bg-dark bg-opacity-50 text-white p-3"
                      >
                        <h5 class="card-title text-center">
                          {{ gallery.title.slice(0, 50)
                          }}{{ gallery.title.length > 50 ? "..." : "" }}
                        </h5>
                      </div>
                      <!-- Delete Button -->
                      <div v-if="hasPermission('gallery.delete')" class="position-absolute top-0 end-0 p-2">
                        <button
                          @click="deleteGallery(gallery.id)"
                          class="btn btn-outline-danger"
                        >
                          Delete
                        </button>
                      </div>
                    </div>
                  </div>
                </div>
                <div v-if="galleries.data.length === 0" class="text-center mt-4">
                  <p>No galleries available</p>
                </div>
  
                <!-- Pagination -->
                <div class="card-footer d-flex justify-content-between align-items-center">
                  <span>
                    Showing {{ galleries.from }} to {{ galleries.to }} of
                    {{ galleries.total }} Images
                  </span>
                  <nav aria-label="Page navigation">
                    <ul class="pagination">
                      <!-- Previous Page Link -->
                      <li
                        class="page-item"
                        :class="{ disabled: !galleries.prev_page_url }"
                      >
                        <a
                          class="page-link"
                          href="#"
                          @click.prevent="changePage(galleries.prev_page_url)"
                        >
                          Previous
                        </a>
                      </li>
  
                      <!-- Loop through Pages (handling page numbers) -->
                      <li
                        v-for="page in totalPages"
                        :key="page"
                        :class="['page-item', { active: currentPage === page }]"
                      >
                        <a
                          class="page-link"
                          href="#"
                          @click.prevent="changePageTo(page)"
                        >
                          {{ page }}
                        </a>
                      </li>
  
                      <!-- Next Page Link -->
                      <li
                        class="page-item"
                        :class="{ disabled: !galleries.next_page_url }"
                      >
                        <a
                          class="page-link"
                          href="#"
                          @click.prevent="changePage(galleries.next_page_url)"
                        >
                          Next
                        </a>
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
  import { Head, Link, useForm } from "@inertiajs/vue3";
  import { useToast } from "vue-toastification";
  import Swal from "sweetalert2";
  import { computed, ref, watch } from "vue";
  
  // Prop passed to the component
  const props = defineProps({
    galleries: {
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
  
  // Track the current page and total pages safely
  const currentPage = ref(props.galleries?.current_page || 1); // Default to 1 if not defined
  const totalPages = computed(() => {
    // Ensure galleries are loaded before calculating total pages
    return props.galleries?.last_page ? Array.from({ length: props.galleries.last_page }, (_, i) => i + 1) : [];
  });
  
  const form = useForm({});
  const toast = useToast();
  
  // Watch for changes to galleries props and reset currentPage
  watch(
    () => props.galleries,
    (newGalleries) => {
      if (newGalleries) {
        currentPage.value = newGalleries.current_page || 1;
      }
    },
    { immediate: true }
  );
  
  const changePage = (url) => {
    if (url) {
      const page = new URL(url).searchParams.get("page");
      if (page) {
        form.get(
          route("galleries.index", { page }),
          {
            preserveScroll: true,
          }
        );
      }
    }
  };
  
  const changePageTo = (page) => {
    form.get(route("galleries.index", { page }), {
      preserveScroll: true,
    });
  };
  
  // Delete gallery handler
  const deleteGallery = async (id) => {
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
        form.post(route("galleries.destroy", id), {
          preserveScroll: true,
          onSuccess: () => {
            toast.success("Image Deleted Successfully");
          },
          onError: (err) => {
            toast.error("Error: " + err.message);
          },
        });
      }
    });
  };
  const hasPermission = (permission) => {
  return props.permissions.includes(permission);
}; 
  </script>
  
  
  <style scoped>
  .card-img-top {
    object-fit: cover;
    height: 200px;
  }
  
  .overlay {
    opacity: 0;
    transition: opacity 0.3s ease;
  }
  
  .card.image:hover .overlay {
    opacity: 1;
  }
  
  .card-body {
    position: relative;
  }
  
  .card-footer {
    display: none;
  }
  
  .card:hover .card-footer {
    display: block;
  }
  </style>
  