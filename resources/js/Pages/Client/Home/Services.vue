<template>
  <section
    class="services__area fix section-py-130 services__bg"
    data-background="/frontend/assets/img/bg/services_bg.png"
  >
    <div class="container">
      <div class="row justify-content-center">
        <div class="col-xl-6 col-lg-8">
          <div class="section__title text-center mb-50">
            <h2 class="title">What We Provide For Clients</h2>
            <span class="">
              The founders of ZOCS envisioned a company that could offer a comprehensive range of products and services that could add value to the overall performances of our clients.
            </span>
          </div>
        </div>
      </div>

      <div class="swiper-container services-active fix">
        <div v-if="services.data.length > 0" class="swiper-wrapper">
          <div
            class="swiper-slide"
            v-for="(service, index) in services.data"
            :key="index"
          >
            <div class="services__item shine__animate-item">
              <div class="services__thumb shine__animate-link">
                <a :href="route('service.show', service.slug)">
                  <img :src="'/storage/' + service.image" alt="img" />
                </a>
                <div class="services__icon">
                  <i :class="service.icon"></i>
                </div>
              </div>
              <div class="services__content">
                <h3 class="title">
                  <a :href="route('service.show', service.slug)">{{
                    service.title
                  }}</a>
                </h3>
                <p>{{ truncatedDescription(service.subtitle) }}</p>
                <Link
                  :href="route('service.show', service.slug)"
                  class="link-btn"
                >
                  Read More
                  <img
                    src="/frontend/assets/img/icons/right_arrow.svg"
                    alt=""
                    class="injectable"
                  />
                </Link>
              </div>
              <div class="services__item-shape">
                <img
                  src="/frontend/assets/img/services/services_item_shape.svg"
                  alt="shape"
                />
              </div>
            </div>
          </div>
        </div>

        <!-- Display message when there are no services -->
        <div v-else class="text-center no-services-message">
          <p>No services available at the moment.</p>
        </div>
      </div>

      <div class="services__bottom-content text-center mt-70">
        <p>
          Discover Our Financial and IT Services.
          <Link :href="route('service.index')">Explore All Services</Link>
        </p>
      </div>
    </div>
    <div class="services__shape-wrap">
      <img
        src="/frontend/assets/img/services/services_shape01.svg"
        alt="shape"
        data-aos="fade-down-left"
        data-aos-delay="400"
      />
      <img
        src="/frontend/assets/img/services/services_shape02.svg"
        alt="shape"
        data-aos="fade-up-right"
        data-aos-delay="400"
      />
    </div>
  </section>
</template>


<script setup>
import { Link } from "@inertiajs/vue3";

const props = defineProps({
  services: {
    type: Object,
    required: true,
  },
});
const truncatedDescription = (description) => {
  if (description && description.length > 100) {
    return description.substring(0, 100) + "...";
  }
  return description;
};
</script>

<style scoped>
.no-services-message {
  font-size: 18px;
  color: #ff4d4f;
  margin-top: 20px;
}

</style>