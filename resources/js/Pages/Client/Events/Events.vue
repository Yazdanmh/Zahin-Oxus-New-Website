<template>
  <div class="inner-blog-post-wrap">
    <!-- Check if there are events to display -->
    <div v-if="props.events.data.length > 0">
      <div class="blog__post-item-five" v-for="event in props.events.data" :key="event.id">
        <div class="blog__post-thumb-five">
          <a :href="route('events.show', event.slug )">
            <img :src="'/storage/' + event.image" alt="img" />
          </a>
        </div>
        <div class="blog__post-content-five">
          <div class="blog__post-meta">
            <ul class="list-wrap">
              <li>
                <img src="assets/img/icons/calendar.svg" alt="" class="injectable" />
                {{ formatDate(event.created_at) }}
              </li>
            </ul>
          </div>
          <h2 class="title">
            <a :href="route('events.show', event.slug)">{{ event.title }}</a>
          </h2>
          <p v-html="truncateContent(event.content)">
          </p>
          <a :href="route('events.show', event.slug)" class="tg-btn tg-btn-four tg-btn-six">
            Read More
            <img src="/frontend/assets/img/icons/right_arrow02.svg" alt="" class="injectable" />
          </a>
        </div>
      </div>
    </div>
    
    <!-- Display message if no events -->
    <div v-else>
      <p class='text-warning'>Please check back soon for upcoming events and updates.</p>

    </div>
  </div>
  
  <!-- Pagination Links -->
  <div class="pagination__wrap mt-40">
    <ul class="list-wrap">
      <!-- Previous Button (disabled on page 1) -->
      <li :class="{ disabled: currentPage === 1 }">
        <Link v-if="currentPage > 1" :href="`${props.events.path}?page=${currentPage - 1}`">
          <span class="bx bx-chevron-left"></span>
        </Link>
      </li>

      <!-- First Page -->
      <li v-if="currentPage > 3">
        <Link :href="`${props.events.path}?page=1`">1</Link>
      </li>

      <!-- Ellipsis before pages -->
      <li v-if="currentPage > 4">
        <span>...</span>
      </li>

      <!-- Loop through Pages (handling page numbers) -->
      <li v-for="page in displayedPages" :key="page" :class="{ active: currentPage === page }">
        <Link :href="`${props.events.path}?page=${page}`">{{ page }}</Link>
      </li>

      <!-- Ellipsis after pages -->
      <li v-if="currentPage < totalPages - 3">
        <span>...</span>
      </li>

      <!-- Last Page -->
      <li v-if="currentPage < totalPages - 2">
        <Link :href="`${props.events.path}?page=${totalPages}`">{{ totalPages }}</Link>
      </li>

      <!-- Next Button (disabled on last page) -->
      <li :class="{ disabled: currentPage === totalPages }">
        <Link v-if="currentPage < totalPages" :href="`${props.events.path}?page=${currentPage + 1}`">
          <span class="bx bx-chevron-right"></span>
        </Link>
      </li>
    </ul>
  </div>
</template>

<script setup>
import { computed } from "vue";
import { Link } from "@inertiajs/vue3";

const props = defineProps({
  events: {
    type: Object,
    required: true,
  },
});

// Method to format the created_at date
const formatDate = (date) => {
  const options = { year: 'numeric', month: 'long', day: 'numeric' };
  return new Date(date).toLocaleDateString('en-US', options);  // Format as: January 29, 2025
};

// Truncate content to 200 characters and add ellipsis
const truncateContent = (content) => {
  if (content.length > 200) {
    return content.substring(0, 200) + '...';
  }
  return content;
};

// Current Page and Total Pages Logic
const currentPage = computed(() => props.events.current_page);
const totalPages = computed(() => {
  return Math.ceil(props.events.total / props.events.per_page);
});

// Determine which pages to display based on current page
const displayedPages = computed(() => {
  const pages = [];
  const range = 3; // Number of pages to show before and after the current page

  // Pages before and after the current page
  for (
    let i = Math.max(currentPage.value - range, 1);
    i <= Math.min(currentPage.value + range, totalPages.value);
    i++
  ) {
    pages.push(i);
  }

  return pages;
});
</script>
