<template>
  <Head :title="props.team.name" />
  <ClientLayout :setting="props.setting">
    <Breadcrumb :title="'Our Teams'" :nav="nav" />

    <!-- team-details -->
    <section class="team__details-area section-py-130">
      <div class="container">
        <div class="row justify-content-center">
          <!-- Left Section (Image & Contact Info) -->
          <div class="col-md-3">
            <div class="team__details-img">
              <img
                :src="'/storage/' + props.team.image"
                alt="img"
                style="width: 100%; height: auto"
              />
              <ul class="team__details-inner list-wrap">
                <li v-if="props.team.phone">
                  <div class="icon">
                    <i class="flaticon-phone-call"></i>
                  </div>
                  <div class="content text-start">
                    <span>Phone Number</span>
                    <a :href="'tel:' + props.team.phone">{{
                      props.team.phone
                    }}</a>
                  </div>
                </li>
                <li v-if="props.team.email">
                  <div class="icon">
                    <i class="flaticon-envelope"></i>
                  </div>
                  <div class="content text-start">
                    <span>Email Address</span>
                    <a :href="'mailto:' + props.team.email">{{
                      props.team.email
                    }}</a>
                  </div>
                </li>
              </ul>

              <div class="progress__wrap py-5">
                <!-- Dynamically generate progress items -->
                <div
                  v-for="(value, key) in parsedProgressItems"
                  :key="key"
                  class="progress__item"
                >
                  <h6 class="title text-start">{{ key }}</h6>
                  <div
                    class="progress"
                    role="progressbar"
                    :aria-valuenow="value"
                    aria-valuemin="0"
                    aria-valuemax="100"
                  >
                    <div
                      class="progress-bar wow slideInLeft"
                      data-wow-delay=".2s"
                      :style="{ width: `${value}%` }"
                    >
                      <span>{{ value }}%</span>
                    </div>
                  </div>
                </div>
                <!-- End dynamically generated progress items -->
              </div>
            </div>
          </div>
          <div class="col-md-9">
            <div class="team__details-info-wrap">
              <h2 class="title">{{ props.team.name }}</h2>
              <span>{{ props.team.position }}</span>
              <div class="team__details-social">
                <ul class="list-wrap">
                  <li v-if="props.team.facebook">
                    <a :href="props.team.facebook" target="_blank">
                      <img
                        src="/frontend/assets/img/icons/facebook.svg"
                        alt="Facebook"
                        class="injectable"
                        style="width: 20px; height: 30px"
                      />
                    </a>
                  </li>
                  <li v-if="props.team.twitter">
                    <a :href="props.team.twitter" target="_blank">
                      <img
                        src="/frontend/assets/img/icons/twitter.svg"
                        alt="Twitter"
                        class="injectable"
                        style="width: 20px; height: 30px"
                      />
                    </a>
                  </li>
                </ul>
              </div>
              <p v-html="props.team.description"></p>
            </div>
          </div>
        </div>
      </div>
    </section>
    <!-- team-details-end -->
  </ClientLayout>
</template>
  
  <script setup>
import { computed } from "vue";
import { Head } from "@inertiajs/vue3";
import ClientLayout from "@/Layouts/ClientLayout.vue";
import Breadcrumb from "@/Components/Client/Breadcrumb.vue";

// Define props
const props = defineProps({
  setting: { type: Object, required: true },
  team: { type: Object, required: true },
});

// Parse progress_items JSON safely
const parsedProgressItems = computed(() => {
  try {
    return JSON.parse(props.team.skills || "{}");
  } catch (error) {
    console.error("Invalid JSON format for progress_items:", error);
    return {};
  }
});
// Breadcrumb Navigation
const nav = computed(() => [
  { name: "Home", url: "/" },
  { name: "Teams", url: "/"},
  { name: props.team.name || "Team Member", url: "" },
]);
</script>
  