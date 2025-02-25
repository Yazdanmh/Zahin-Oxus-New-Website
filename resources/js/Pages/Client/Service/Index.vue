<template>
  <Head :title="category ? `${category.name} Services` : 'All Services'" />
  <ClientLayout :setting="setting" :service="service_categories">
    <!-- Breadcrumb Section -->
    <Breadcrumb :title="category ? category.name : 'All Services'" :nav="nav" />
    
    <!-- services-area -->
    <section class="services__area section-py-130" style="background-color: rgba(234, 240, 255, 0.3);">
      <div class="container">
        <div class="row justify-content-center">
          <div class="col-lg-10">
            <div class="section__title text-center mb-40">
              <span class="sub-title">Explore Our Services </span>
              <h2 class="title">
                {{ category ? category.name : 'All Services' }}
              </h2>
              <p>
                Enhance your business with our professional 
                <strong>{{ category ? category.name.toUpperCase() : '' }}</strong> services.
              </p>
            </div>
          </div>
        </div>
        <div class="row gutter-y-30 justify-content-center" v-if="services.length">
          <div class="col-lg-4 col-md-6" v-for="service in services" :key="service.id">
            <div class="services__item-two">
              <div class="services__icon-two">
                <i :class="service.icon"></i>
              </div>
              <div class="services__content-two">
                <h4 class="title">
                  <Link :href="route('service.show', service.slug)">{{ service.title }}</Link>
                </h4>
                <p>
                  {{ truncatedDescription(service.subtitle) }}
                </p>
                <Link :href="route('service.show', service.slug)" class="tg-btn tg-btn-two">
                  Read More
                  <img src="/frontend/assets/img/icons/right_arrow.svg" alt="" class="injectable"/>
                </Link>
              </div>
            </div>
          </div>
        </div>
        <div v-else class="text-center py-5">
          <p>There are no services available.</p>
        </div>
      </div>
    </section>
    <!-- services-area-end -->
  </ClientLayout>
</template>

<script setup>
import { Link } from "@inertiajs/vue3";
import ClientLayout from "@/Layouts/ClientLayout.vue";
import { Head } from "@inertiajs/vue3";
import Breadcrumb from "@/Components/Client/Breadcrumb.vue";
import { computed } from "vue";

const props = defineProps({
  setting: { type: Object, required: true },
  services: { type: Array, required: true },
  category: { type: Object, required: false },
  service_categories: { type: Object, required: false },
});

const nav = [
  { name: "Home", url: "/" },
  { name: "Services", url: "/services" },
];

const truncatedDescription = (description) => {
  return description && description.length > 100 ? description.substring(0, 100) + '...' : description;
};
</script>

<style>
.category-icon {
  width: 24px;
  height: 24px;
  margin-right: 5px;
  vertical-align: middle;
}
</style>
