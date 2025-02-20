<template>
  <Head title="Events & News" />
  <ClientLayout :setting="props.setting" :service="props.service_categories">
    <Breadcrumb :title="'Events & News'" :nav="nav" />

    <!-- blog-details-area -->
    <section class="blog__details-area section-py-130">
      <div class="container">
        <div class="row">
          <div class="col-70">
            <div class="blog__details-wrap">
              <div class="blog__post-thumb-five blog__details-thumb">
                <img :src="'/storage/' + props.event.image" alt="img" />
              </div>
              <div class="blog__details-content">
                <div class="blog__post-meta">
                  <ul class="list-wrap">
                    <li>
                      <img
                        src="assets/img/icons/calendar.svg"
                        alt=""
                        class="injectable"
                      />
                      {{ formatDate(props.event.created_at) }}
                    </li>
                  </ul>
                </div>
                <h2 class="title">{{ props.event.title }}</h2>
                <p v-html="props.event.content"></p>

                <div class="blog__details-bottom">
                  <div class="row">
                    <div class="col-md-7">
                      <div class="post-tags">
                        <h5 class="title">Post Tags:</h5>
                        <ul class="list-wrap">
                          <li
                            v-for="(tag, index) in formattedTags"
                            :key="index"
                          >
                            <a href="#">{{ tag.trim() }}</a>
                          </li>
                        </ul>
                      </div>
                    </div>
                    <div class="col-md-5">
                      <div class="post-share">
                        <h5 class="title">Social Share:</h5>
                        <ul class="list-wrap">
                          <!-- Social Media Links -->
                          <li>
                            <a href="https://www.facebook.com/" target="_blank">
                              <img
                                src="/frontend/assets/img/icons/facebook.svg"
                                alt=""
                                class="injectable"
                                style="width: 30px; height: 20px"
                              />
                            </a>
                          
                          </li>
                          <li>
                            <a href="https://x.com/home" target="_blank">
                              <img
                                src="/frontend/assets/img/icons/twitter.svg"
                                alt=""
                                class="injectable"
                                style="width: 30px; height: 20px"
                              />
                            </a>
                          </li>
                          <li>
                            <a href="https://www.instagram.com/" target="_blank"
                              ><img
                                src="/frontend/assets/img/icons/instagram.svg"
                                alt=""
                                class="injectable"
                                style="width: 30px; height: 20px"
                            /></a>
                          </li>
                          <li>
                            <a href="https://www.pinterest.com/" target="_blank"
                              ><img
                                src="/frontend/assets/img/icons/pinterest.svg"
                                alt=""
                                class="injectable"
                                style="width: 30px; height: 20px"
                            /></a>
                          </li>
                          <li>
                            <a href="https://www.youtube.com/" target="_blank"
                              ><img
                                src="/frontend/assets/img/icons/youtube.svg"
                                alt=""
                                class="injectable"
                                style="width: 30px; height: 20px"
                            /></a>
                          </li>
                        </ul>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>

          <div class="col-30">
            <aside class="blog__sidebar blog__sidebar-two">
              <!-- Search Form -->
              <div class="sidebar__widget">
                <form
                  @submit.prevent="handleSearch"
                  class="shop__search blog__search"
                >
                  <input
                    type="text"
                    placeholder="Search"
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

              <!-- Pass the filtered recent events to the RecentEvents component -->
              <RecentEvents :recent_event="filteredRecentEvents" />
              <!-- Other sidebar widgets... -->
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
                    >Contact With Us
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
    <!-- blog-details-area-end -->
  </ClientLayout>
</template>
  
  <script setup>
import ClientLayout from "@/Layouts/ClientLayout.vue";
import { Head, Link } from "@inertiajs/vue3";
import Breadcrumb from "@/Components/Client/Breadcrumb.vue";
import RecentEvents from "./RecentEvents.vue";
import { ref, computed } from "vue";

const props = defineProps({
  setting: {
    type: Object,
    required: true,
  },
  event: {
    type: Object,
    required: true,
  },
  recent: {
    type: Array,
    required: true,
  },
    service_categories: {
    type: Object,
    required: true,
  },
});

const searchQuery = ref(""); // Reactive variable for search query

// Compute the filtered list of recent events based on the search query
const filteredRecentEvents = computed(() => {
  return props.recent.filter((event) =>
    event.title.toLowerCase().includes(searchQuery.value.toLowerCase())
  );
});
const formattedTags = computed(() => {
  return props.event.tags ? props.event.tags.split(',') : [];
});
const handleSearch = () => {
  Inertia.visit(
    route("events.show", { slug: props.event.slug, search: searchQuery.value }),
    {
      preserveState: true,
      replace: true,
    }
  );
};

// Navigation
const nav = [
  { name: "Events", url: route("events.index") },
  { name: props.event.title, url: "/" },
];

const formatDate = (date) => {
  const options = { year: "numeric", month: "long", day: "numeric" };
  return new Date(date).toLocaleDateString("en-US", options);
};
</script>
  