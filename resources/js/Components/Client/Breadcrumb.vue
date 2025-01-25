<template>
    <!-- breadcrumb-area -->
    <section class="breadcrumb__area">
      <div class="breadcrumb__bg" data-background="/frontend/assets/img/bg/breadcrumb__bg.jpg"></div>
      <div class="container">
        <div class="row">
          <div class="col-12">
            <div class="breadcrumb__content">
              <h2 class="title">{{ title }}</h2>
              <nav class="breadcrumb">
                <!-- Loop through the nav array -->
                <span v-for="(item, index) in nav" :key="index" property="itemListElement" typeof="ListItem" >
                  <!-- If it's the first breadcrumb, make it a link -->
                  <template v-if="index < nav.length - 1">
                    <Link :href="item.url" class="breadcrumb-link">{{ item.name }}</Link>
                  </template>
  
                  <!-- If it's the last breadcrumb, just display the name -->
                  <template v-else>
                    <span class="breadcrumb-text">{{ item.name }}</span>
                  </template>
  
                  <!-- Add separator after each breadcrumb except the last one -->
                  <span v-if="index < nav.length - 1" class="breadcrumb-separator">
                    <i class="fas fa-angle-right"></i>
                  </span>
                </span>
              </nav>
            </div>
          </div>
        </div>
      </div>
    </section>
    <!-- breadcrumb-area-end -->
  </template>
  
  <script setup>
  import { Link } from "@inertiajs/vue3";
  
  // Props to accept breadcrumb data
  const props = defineProps({
    title: {
      type: String,
      required: true,
    },
    nav: {
      type: Array,
      required: true,
    },
  })
  </script>
  
  <style scoped>
  
  

  
  .breadcrumb-separator {
    margin-left: 8px;
    /* margin-right: 8px; */
    color: #666;
  }
  
  

  </style>
  