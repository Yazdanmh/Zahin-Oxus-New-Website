<template>
    <Head :title="props.trainer.name" />
    <ClientLayout :setting="props.setting" :service="props.service_categories">
      <Breadcrumb :title="'Our Trainers'" :nav="nav" />
  
      <!-- trainer-details -->
      <section class="team__details-area section-py-130">
        <div class="container">
          <div class="row justify-content-center">
            <!-- Left Section (Image & Contact Info) -->
            <div class="col-md-3">
              <div class="team__details-img">
                <img
                  :src="'/storage/' + props.trainer.image"
                  alt="img"
                  style="width: 100%; height: auto"
                />
                <ul class="team__details-inner list-wrap">
                  <li >
                    <div class="icon">
                      <i class="fas fa-wrench"></i>
                    </div>
                    <div class="content text-start">
                      <span>Service</span>
                      {{ props.trainer.service.title }}
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
                <h2 class="title">{{ props.trainer.name }}</h2>
                <span>{{ props.trainer.position }}</span>
               
                <p v-html="props.trainer.description"></p>
              </div>
            </div>
          </div>
        </div>
      </section>
      <!-- trainer-details-end -->
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
    trainer: { type: Object, required: true },
    service_categories: { type: Object, required: true },
  });
  
  // Parse progress_items JSON safely
  const parsedProgressItems = computed(() => {
    try {
      return JSON.parse(props.trainer.skills || "{}");
    } catch (error) {
      console.error("Invalid JSON format for progress_items:", error);
      return {};
    }
  });
  // Breadcrumb Navigation
  const nav = computed(() => [
    { name: "Home", url: "/" },
    { name: "Trainers", url: "/"},
    { name: props.trainer.name || "Member", url: "" },
  ]);
  </script>
    