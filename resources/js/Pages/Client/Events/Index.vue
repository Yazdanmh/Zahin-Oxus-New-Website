<template>
  <Head title="Events & News" />
  <ClientLayout :setting="props.setting" :service="props.service_categories">
    <Breadcrumb :title="'Events & News'" :nav="nav" />
    <!-- blog-post-area -->
    <section class="blog__post-area-five section-py-130">
      <div class="container">
        <div class="row">
          <div class="col-70 order-0 order-lg-2">
            <Events :events="props.events" />
          </div>

          <div class="col-30">
            <aside class="blog__sidebar">
              <!-- Search Form -->
              <div class="sidebar__widget" >
                <form
                  action="#"
                  class="shop__search blog__search"
                  @submit.prevent="handleSearch"
                >
                  <input
                    type="text"
                    placeholder="Search Recent Events"
                    v-model="searchQuery"
                  />
                  <button type="submit">
                    <svg
                      xmlns="http://www.w3.org/2000/svg"
                      width="18"
                      height="18"
                      viewBox="0 0 18 18"
                      fill="none"
                    >
                      <path
                        d="M17 17L13.5247 13.5247M15.681 8.3405C15.681 12.3945 12.3945 15.681 8.3405 15.681C4.28645 15.681 1 12.3945 1 8.3405C1 4.28645 4.28645 1 8.3405 1C12.3945 1 15.681 4.28645 15.681 8.3405Z"
                        stroke="currentColor"
                        stroke-width="1.8"
                        stroke-linecap="round"
                        stroke-linejoin="round"
                      />
                    </svg>
                  </button>
                </form>
              </div>
              <RecentEvents :recent_event="filteredRecentEvents" />
              
              
            
              <div class="sidebar__widget">
                <div class="sidebar__contact">
                  <h4 class="title">
                    We Have More Than Years Marketing Experience
                  </h4>
                  <p>
                    It is a long established fact that reader will be
                    distracted.
                  </p>
                  <a :href="route('contact.index')" class="tg-btn tg-btn-three"
                    >Get in Touch
                    <img
                      src="/frontend/assets/img/icons/right_arrow.svg"
                      alt=""
                      class="injectable"
                  /></a>
                  <div class="shape">
                    <img
                      src="/frontend/assets/img/images/sidebar_contact_shape01.svg"
                      alt="shape"
                      class="rotateme"
                    />
                    <img
                      src="/frontend/assets/img/images/sidebar_contact_shape02.svg"
                      alt="shape"
                      class="alltuchtopdown"
                    />
                  </div>
                </div>
              </div>
            </aside>
          </div>
        </div>
      </div>
    </section>
    <!-- blog-post-area-end -->
  </ClientLayout>
</template>

<script setup>
import ClientLayout from "@/Layouts/ClientLayout.vue";
import { Head, Link } from "@inertiajs/vue3";
import Breadcrumb from "@/Components/Client/Breadcrumb.vue";
import RecentEvents from "./RecentEvents.vue";
import Events from "./Events.vue";
import { ref, computed } from "vue";

const props = defineProps({
  setting: {
    type: Object,
    required: true,
  },
  recent: {
    type: Array,
    required: true,
  },
  events: {
    type: Object,
    required: true,
  },
    service_categories: {
    type: Object,
    required: true,
  },
});

const nav = [
  { name: "Events", url: route("events.index") },
  { name: "All", url: "/" },
];

const searchQuery = ref(""); // Reactive variable for search query

// Filter recent events based on search query
const filteredRecentEvents = computed(() => {
  return props.recent.filter((event) =>
    event.title.toLowerCase().includes(searchQuery.value.toLowerCase())
  );
});

// Handle the search logic
const handleSearch = () => {
  // When the user submits the search form, you could trigger an Inertia request
  // This would typically reload the page with the updated query in the URL (or using Inertia's `replace` for dynamic behavior)
  // For now, we're filtering on the client side (via `filteredRecentEvents`), but you can modify this to make a server-side request.
};
</script>
