<template>
  <Head title="Services" />
  <ClientLayout :setting="props.setting">
    <!-- Breadcrumb Section -->
    <Breadcrumb :title="'Our Services'" :nav="nav" />
    
    <!-- services-area -->
    <section class="services__area section-py-130" style="background-color: rgba(234, 240, 255, 0.3);">
      <div class="container">
        <div class="row justify-content-center">
          <div class="col-lg-10">
            <div class="section__title text-center mb-40">
              <span class="sub-title">Our Dedicated Services</span>
              <h2 class="title">
                Marketing Solutions <br />
                for Business Excellence
              </h2>
              <p>
                Transform your business with our transformative consulting
                solute We go beyond
              </p>
            </div>
          </div>
        </div>
        <div class="row gutter-y-30 justify-content-center">
          <div class="col-lg-4 col-md-6" v-for="service in props.services" :key="service.id">
            <div class="services__item-two">
              <div class="services__icon-two">
                <i :class=" service.icon"></i>
              </div>
              <div class="services__content-two">
                <h4 class="title">
                  <a href="services-details.html">{{ service.subtitle }}</a>
                </h4>
                <p>
                  {{ truncatedDescription(service.title) }}
                </p>
                <Link :href="route('service.show', service.slug)" class="tg-btn tg-btn-two"
                  >Read More
                  <img
                    src="assets/img/icons/right_arrow.svg"
                    alt=""
                    class="injectable"
                /></Link>
              </div>
            </div>
          </div>
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
import { onMounted, onBeforeUnmount } from "vue";

const props = defineProps({
  setting: {
    type: Object,
    required: true,
  },
  services: {
    type: Object,
    required: true,
  },
});

const nav = [
  { name: "Home", url: "/" },
  { name: "Services", url: "services" },
];

const truncatedDescription = (description) => {
  if (description && description.length > 100) {
    return description.substring(0, 100) + '...';
  }
  return description;
};

onMounted(() => {
  // document.body.classList.add("theme-gray");
});

onBeforeUnmount(() => {
  // document.body.classList.remove("theme-gray");
});
</script>
