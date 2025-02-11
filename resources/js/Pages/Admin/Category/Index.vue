<template>
  <Head title="Manage Categories" />
  <AdminLayout :setting="props.setting" :user="props.user">
    <div class="container-xxl flex-grow-1 container-p-y">
      <h4 class="fw-bold py-3 mb-4">
        <span class="text-muted fw-light">Home /</span> Categories / Manage
      </h4>

      <!-- Create / Edit Category Form -->
      <div class="card mb-4">
        <div
          class="card-header d-flex justify-content-between align-items-center"
        >
          <h5 class="mb-0">
            {{ editingCategory ? "Edit Category" : "Create Category" }}
          </h5>
        </div>
        <div class="card-body">
          <form @submit.prevent="submitCategory">
            <div class="row">
              <div class="col-md-6">
                <div class="mb-3">
                  <label for="category_title" class="form-label"
                    >Category Title</label
                  >
                  <input
                    type="text"
                    class="form-control"
                    id="category_title"
                    v-model="form.title"
                    placeholder="Enter category title"
                  />
                  <div v-if="form.errors.title" class="text-danger mt-2">
                    {{ form.errors.title }}
                  </div>
                </div>
              </div>
              <div class="col-md-6 d-flex align-items-center">
                <button type="submit" class="btn btn-primary">
                  <i
                    class="bx"
                    :class="editingCategory ? 'bx-save' : 'bx-plus'"
                  ></i>
                  {{ editingCategory ? "Update Category" : "Add Category" }}
                </button>
                <button
                  v-if="editingCategory"
                  type="button"
                  class="btn btn-secondary ms-2"
                  @click="resetForm"
                >
                  <i class="bx bx-x"></i> Cancel
                </button>
              </div>
            </div>
          </form>
        </div>
      </div>

      <!-- Category List -->
      <div class="card mb-4">
        <div class="card-header">
          <h5 class="mb-0">Category List</h5>
        </div>
        <div class="card-body">
          <table class="table table-striped">
            <thead>
              <tr>
                <th>#</th>
                <th>Category Title</th>
                <th>Actions</th>
              </tr>
            </thead>
            <tbody>
              <tr v-for="(category, index) in categories" :key="category.id">
                <td>{{ index + 1 }}</td>
                <td>{{ category.title }}</td>
                <td>
                  <!-- Edit Button -->
                  <span
                    class="badge bg-label-primary p-1_5 me-3 cursor-pointer mb-2"
                    @click="editCategory(category)"
                  >
                    <i class="bx bx-pencil"></i>
                  </span>
                  <!-- Delete Button -->
                  <span
                    class="badge bg-label-danger p-1_5 me-3 cursor-pointer"
                    @click="deleteCategory(category.id)"
                  >
                    <i class="bx bx-trash"></i>
                  </span>
                </td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </AdminLayout>
</template>
  <script setup>
import AdminLayout from "@/Layouts/AdminLayout.vue";
import { Head, useForm } from "@inertiajs/vue3";
import { ref } from "vue";
import { useToast } from "vue-toastification";
import Swal from "sweetalert2";

const toast = useToast();

const props = defineProps({
  categories: {
    type: Array,
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

const form = useForm({
  id: null,
  title: "",
});

const editingCategory = ref(false);

const editCategory = (category) => {
  editingCategory.value = true;
  form.id = category.id;
  form.title = category.title;
};

const resetForm = () => {
  editingCategory.value = false;
  form.reset();
};

const submitCategory = () => {
  if (form.id) {
    form.post(route("categories.update", form.id), {
      onSuccess: () => {
        toast.success("Category updated successfully");
        resetForm();
      },
      onError: () => {
        toast.error("Failed to update category");
      },
    });
  } else {
    form.post(route("categories.store"), {
      onSuccess: () => {
        toast.success("Category created successfully");
        resetForm();
      },
      onError: () => {
        toast.error("Failed to create category");
      },
    });
  }
};

const deleteCategory = (categoryId) => {
  Swal.fire({
    title: "Are you sure?",
    text: "All projects and portfolios under this category will be deleted!",
    icon: "warning",
    showCancelButton: true,
    confirmButtonColor: "#3085d6",
    cancelButtonColor: "#d33",
    confirmButtonText: "Yes, delete it!",
  }).then((result) => {
    if (result.isConfirmed) {
      form.post(route("categories.destroy", categoryId), {
        onSuccess: () => toast.success("Category deleted successfully"),
        onError: () => toast.error("Failed to delete category"),
      });
    }
  });
};
</script>
  