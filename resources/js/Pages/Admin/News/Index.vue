<template>
  <Head title="News" />
  <AdminLayout :setting="props.setting" :user="props.user" :permissions="props.permissions">
    <div class="container-xxl flex-grow-1 container-p-y">
      <h4 class="fw-bold py-3 mb-4">
        <span class="text-muted fw-light">Home /</span> News / All
      </h4>
      <div class="row">
        <div class="col-xl">
          <div class="card mb-4">
            <div
              class="card-header d-flex justify-content-between align-items-center"
            >
              <h5 class="mb-0">All News</h5>
              <small class="text-muted float-end">List of all News</small>
            </div>
            <div class="card-body">
              <div v-if="hasPermission('events.create')" class="d-flex justify-content-end mb-3">
                <Link :href="route('news.create')" class="btn btn-primary">
                  <i class="bx bx-plus"></i> Add News
                </Link>
              </div>

              <!-- Show message if no news -->
              <div v-if="props.news.data.length === 0">
                <p class="text-center text-muted">No news found.</p>
              </div>
              <div v-else class="table-responsive">
                <!-- News Table -->
                <table class="table table-bordered">
                  <thead>
                    <tr>
                      <th>#</th>
                      <th>Image</th>
                      <th>Title</th>
                      <th>Status</th>
                      <th v-if="hasPermission('events.edit')  || hasPermission('events.delete')">Actions</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr v-for="(news, index) in props.news.data" :key="news.id">
                      <td>{{ index + 1 }}</td>
                      <td>
                        <img
                          :src="'/storage/' + news.image"
                          alt=""
                          style="
                            width: 70px;
                            height: 70px;
                            border-radius: 50%;
                            object-fit: cover;
                          "
                        />
                      </td>
                      <td>{{ news.title }}</td>
                      <td class="text-center">
                        <span
                          :class="[
                            'badge',
                            news.is_published ? 'bg-success' : 'bg-danger',
                          ]"
                        >
                          {{ news.is_published ? "Published" : "Draft" }}
                        </span>
                      </td>
                      <td class="text-center" v-if="hasPermission('events.edit')  || hasPermission('events.delete') || hasPermission('events.view')"> 
                        <Link v-if="hasPermission('events.edit')" :href="route('news.edit', news.id)">
                          <span
                            class="badge bg-label-primary p-1_5 me-3 cursor-pointer mb-2"
                          >
                            <i class="icon-base bx bx-pencil icon-xs"></i>
                          </span>
                        </Link>
                        <span v-if="hasPermission('events.delete')"
                          @click="confirmDelete(news.id)"
                          class="badge bg-label-danger p-1_5 me-3 cursor-pointer mb-2"
                        >
                          <i class="icon-base bx bx-trash icon-xs"></i>
                        </span>
                        <Link :href="route('news.show', news.id)">
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

              <div v-if="props.news.last_page > 1" class="pagination-wrapper">
                <nav>
                  <ul class="pagination justify-content-center">
                    <li
                      class="page-item"
                      :class="{ disabled: props.news.current_page === 1 }"
                    >
                      <Link
                        :href="props.news.prev_page_url"
                        class="page-link"
                        :disabled="props.news.current_page === 1"
                        >Previous</Link
                      >
                    </li>
                    <li
                      v-for="page in props.news.last_page"
                      :key="page"
                      :class="{
                        'page-item': true,
                        active: page === props.news.current_page,
                      }"
                    >
                      <Link
                        :href="route('news.index', { page: page })"
                        class="page-link"
                      >
                        {{ page }}
                      </Link>
                    </li>
                    <li
                      class="page-item"
                      :class="{
                        disabled:
                          props.news.current_page === props.news.last_page,
                      }"
                    >
                      <Link
                        :href="props.news.next_page_url"
                        class="page-link"
                        :disabled="
                          props.news.current_page === props.news.last_page
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
  news: {
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
 
const form = useForm({});
const toast = useToast();

// Delete a news
const deleteNews = (id) => {
  form.post(route("news.destroy", id), {
    preserveScroll: true,
    onSuccess: () => {
      toast.success("News Deleted Successfully");
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
      deleteNews(id);
    }
  });
};

const hasPermission = (permission) => {
  return props.permissions.includes(permission);
}; 
</script>
  
  <style scoped>
.pagination-wrapper {
  margin-top: 20px;
}
</style>
  