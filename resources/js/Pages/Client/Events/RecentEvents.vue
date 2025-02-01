<template>
  <div class="sidebar__widget">
    <h4 class="sidebar__widget-title">Recent Events & News</h4>
    <div class="rc-post-wrap">
      <!-- Check if there are events to display -->
      <div v-if="props.recent_event.length > 0">
        <div
          class="rc-post-item"
          v-for="event in props.recent_event"
          :key="event.id"
        >
          <div class="thumb">
            <a :href="route('events.show', event.slug)">
              <img :src="'/storage/' + event.image" alt="News image" />
            </a>
          </div>
          <div class="content">
            <span class="date">
              <img src="/frontend/assets/img/icons/calendar.svg" alt="Calendar icon" class="injectable" />
              {{ formatDate(event.created_at) }}
            </span>
            <h2 class="title">
              <Link :href="route('events.show', event.slug)">{{ event.title }}</Link>
            </h2>
          </div>
        </div>
      </div>
      
      <!-- Display message if no events -->
      <div v-else>
        <p class="text-warning">No events found.</p>
      </div>
    </div>
  </div>
</template>

<script setup>
import { Link } from "@inertiajs/vue3";

const props = defineProps({
  recent_event: {
    type: Array,  // It's an array of events
    required: true,
  },
});

const formatDate = (date) => {
  const options = { year: 'numeric', month: 'long', day: 'numeric' };
  return new Date(date).toLocaleDateString('en-US', options);
};
</script>
