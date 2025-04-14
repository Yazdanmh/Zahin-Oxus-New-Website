<template>
    <!-- Error -->
    <div class="container-xxl container-p-y py-5">
      <div class="misc-wrapper text-center">
        <h2 class="mb-2 mx-2">Too Many Requests :(</h2>
        <p class="mb-4 mx-2">
          Oops! 😖 The requested URL was not found on this server.
        </p>
        <Link :href="route('home')" class="btn btn-primary">Back to home</Link>
        <div class="mt-3">
          <img
            src="/backend/assets/img/illustrations/page-misc-error-light.png"
            alt="page-misc-error-light"
            width="500"
            class="img-fluid"
            data-app-dark-img="illustrations/page-misc-error-dark.png"
            data-app-light-img="illustrations/page-misc-error-light.png"
          />
        </div>
      </div>
    </div>
    <!-- /Error -->
  </template>
  <script setup>
  import { Link } from '@inertiajs/vue3';
  </script>