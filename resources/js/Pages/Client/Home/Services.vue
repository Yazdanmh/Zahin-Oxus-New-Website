<template>
  <!-- services-area -->
  <section
    class="services__area fix section-py-130 services__bg"
    data-background="/frontend/assets/img/bg/services_bg.png"
  >
    <div class="container">
      <div class="row justify-content-center">
        <div class="col-xl-6 col-lg-8">
          <div class="section__title text-center mb-50">
            <span class="sub-title">OUR WORK SERVICES</span>
            <h2 class="title">What We Will Provide For Clients</h2>
          </div>
        </div>
      </div>
      <div class="swiper-container services-active fix">
        <div class="swiper-wrapper">
          <!-- Loop through services dynamically -->
          <div 
            class="swiper-slide"
            v-for="(service, index) in services.data"
            :key="index"
          >
          <div class="services__item shine__animate-item">
              <div class="services__thumb shine__animate-link">
                <a :href="'#'">
                  <img :src="'/storage/' + service.image" alt="img" />
                </a>
                <div class="services__icon">
                  <i :class="service.icon"></i>
                </div>
              </div>
              <div class="services__content">
                <h3 class="title">
                  <a :href="'#'">{{ service.title }}</a>
                </h3>
                <p>{{ truncatedDescription(service.description) }}</p>>
                <a :href="'#'" class="link-btn">
                  Read More
                  <img
                    src="/frontend/assets/img/icons/right_arrow.svg"
                    alt=""
                    class="injectable"
                  />
                </a>
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
      </div>
      <div class="services__bottom-content text-center mt-70">
        <p>
          Discover Our Financial Services.
          <a href="services.html">Explore All Services</a>
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
  <!-- services-area-end -->
</template>

<script setup>
const props = defineProps({
  services: {
    type: Object,
    required: true,
  },
})
const truncatedDescription = (description) => {
  if (description && description.length > 100) {
    return description.substring(0, 100) + '...';
  }
  return description;
};

</script>
