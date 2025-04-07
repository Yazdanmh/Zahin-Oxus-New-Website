<template>
  <AdminLayout :setting="props.setting" :user="props.user" :permissions="props.permissions">
    <div class="container-xxl flex-grow-1 container-p-y">
      <div class="row">
        <div class="col-lg-12 col-md-12 order-1">
          <div class="row">
            <div class="col-lg-3 col-md-3 col-6 mb-4">
              <div class="card">
                <div class="card-body">
                  <div
                    class="card-title d-flex align-items-start justify-content-between"
                  >
                    <div class="avatar flex-shrink-0 me-3">
                      <span class="avatar-initial rounded bg-label-success"
                        ><i class="bx bx-cog"></i
                      ></span>
                    </div>
                    <div class="dropdown">
                      <button
                        class="btn p-0"
                        type="button"
                        id="cardOpt3"
                        data-bs-toggle="dropdown"
                        aria-haspopup="true"
                        aria-expanded="false"
                      >
                        <i class="bx bx-dots-vertical-rounded"></i>
                      </button>
                      <div
                        class="dropdown-menu dropdown-menu-end"
                        aria-labelledby="cardOpt3"
                      >
                        <Link class="dropdown-item" :href="route('services.index')"
                          >View More</Link
                        >
                        
                      </div>
                    </div>
                  </div>
                  <span class="fw-semibold d-block mb-1">Services</span>
                  <h3 class="card-title mb-2">
                    {{
                      props.services.length > 0 ? props.services.length : "0"
                    }}
                  </h3>
                </div>
              </div>
            </div>
            <div class="col-lg-3 col-md-3 col-6 mb-4">
              <div class="card">
                <div class="card-body">
                  <div
                    class="card-title d-flex align-items-start justify-content-between"
                  >
                    <div class="avatar flex-shrink-0 me-3">
                      <span class="avatar-initial rounded bg-label-primary"
                        ><i class="bx bx-image"></i
                      ></span>
                    </div>
                    <div class="dropdown">
                      <button
                        class="btn p-0"
                        type="button"
                        id="cardOpt3"
                        data-bs-toggle="dropdown"
                        aria-haspopup="true"
                        aria-expanded="false"
                      >
                        <i class="bx bx-dots-vertical-rounded"></i>
                      </button>
                      <div
                        class="dropdown-menu dropdown-menu-end"
                        aria-labelledby="cardOpt3"
                      >
                        <Link class="dropdown-item" :href="route('galleries.index')"
                          >View More</Link
                        >
                        
                      </div>
                    </div>
                  </div>
                  <span class="fw-semibold d-block mb-1">Gallery Images</span>
                  <h3 class="card-title mb-2">
                    {{ props.gallery.length > 0 ? props.gallery.length : "0" }}
                  </h3>
                </div>
              </div>
            </div>
            <div class="col-lg-3 col-md-3 col-6 mb-4">
              <div class="card">
                <div class="card-body">
                  <div
                    class="card-title d-flex align-items-start justify-content-between"
                  >
                    <div class="avatar flex-shrink-0 me-3">
                      <span class="avatar-initial rounded bg-label-info"
                        ><i class="bx bx-news"></i
                      ></span>
                    </div>
                    <div class="dropdown">
                      <button
                        class="btn p-0"
                        type="button"
                        id="cardOpt3"
                        data-bs-toggle="dropdown"
                        aria-haspopup="true"
                        aria-expanded="false"
                      >
                        <i class="bx bx-dots-vertical-rounded"></i>
                      </button>
                      <div
                        class="dropdown-menu dropdown-menu-end"
                        aria-labelledby="cardOpt3"
                      >
                      <Link class="dropdown-item" :href="route('news.index')"
                          >View More</Link
                        >
                        
                      </div>
                    </div>
                  </div>
                  <span class="fw-semibold d-block mb-1">News</span>
                  <h3 class="card-title mb-2">
                    {{ props.news.length > 0 ? props.news.length : "0" }}
                  </h3>
                </div>
              </div>
            </div>
            <div class="col-lg-3 col-md-3 col-6 mb-4">
              <div class="card">
                <div class="card-body">
                  <div
                    class="card-title d-flex align-items-start justify-content-between"
                  >
                    <div class="avatar flex-shrink-0 me-3">
                      <span class="avatar-initial rounded bg-label-warning"
                        ><i class="bx bx-chalkboard"></i
                      ></span>
                    </div>
                    <div class="dropdown">
                      <button
                        class="btn p-0"
                        type="button"
                        id="cardOpt3"
                        data-bs-toggle="dropdown"
                        aria-haspopup="true"
                        aria-expanded="false"
                      >
                        <i class="bx bx-dots-vertical-rounded"></i>
                      </button>
                      <div
                        class="dropdown-menu dropdown-menu-end"
                        aria-labelledby="cardOpt3"
                      >
                      <Link class="dropdown-item" :href="route('training.index')"
                          >View More</Link
                        >
                        
                      </div>
                    </div>
                  </div>
                  <span class="fw-semibold d-block mb-1">Trainings</span>
                  <h3 class="card-title mb-2">
                    {{
                      props.trainings.length > 0 ? props.trainings.length : "0"
                    }}
                  </h3>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>

      <div class="row">
        <!-- Order Statistics -->
        <div class="col-md-12 col-lg-12 col-xl-12 order-0 mb-4">
          <div class="card h-100">
            <div
              class="card-header d-flex align-items-center justify-content-between pb-0"
            >
              <div class="card-title mb-0">
                <h5 class="m-0 me-2">Messages</h5>
                <small class="text-muted">via Contact Form</small>
              </div>
              <div class="dropdown">
                <button
                  class="btn p-0"
                  type="button"
                  id="messageDropdown"
                  data-bs-toggle="dropdown"
                  aria-haspopup="true"
                  aria-expanded="false"
                >
                  <i class="bx bx-dots-vertical-rounded"></i>
                </button>
                <div
                  class="dropdown-menu dropdown-menu-end"
                  aria-labelledby="messageDropdown"
                >
                  <Link class="dropdown-item" :href="route('notifications.index')"
                    >View All</Link
                  >
                </div>
              </div>
            </div>
            <div class="card-body">
              <div
                v-if="props.messages.length === 0"
                class="text-muted text-center"
              >
                No messages available.
              </div>
              <div v-else>
                <div
                  v-for="(message, index) in props.messages"
                  :key="index"
                  class="mb-3 p-2 border-bottom"
                >
                  <div class="fw-bold">{{ message.name }}</div>
                  <p class="mb-1 text-muted small">
                    {{ formatDate(message.created_at) }}
                  </p>
                  <p class="m-0">{{ truncateMessage(message.message) }}</p>
                </div>
              </div>
            </div>
          </div>
        </div>
        <!--/ Order Statistics -->
      </div>
    </div>
  </AdminLayout>
</template>
  
<script setup>
import AdminLayout from "@/Layouts/AdminLayout.vue";
import { Link } from "@inertiajs/vue3";
import { computed } from "vue";
const props = defineProps({
  setting: {
    type: Object,
    required: true,
  },
  user: {
    type: Object,
    required: true,
  },
  services: {
    type: Object,
    required: true,
  },
  news: {
    type: Object,
    required: true,
  },
  trainings: {
    type: Object,
    required: true,
  },
  gallery: {
    type: Object,
    required: true,
  },
  messages: {
    type: Object,
    required: true,
  },
  permissions: {
    type: Array,
    required: true,
  },
});
const displayedMessages = computed(() => messages.value.slice(0, 2));

const truncateMessage = (text) => {
  return text.length > 200 ? text.substring(0, 200) + "..." : text;
};

const formatDate = (date) => {
  return new Date(date).toLocaleDateString("en-US", {
    month: "short",
    day: "numeric",
    year: "numeric",
  });
};
</script>
  