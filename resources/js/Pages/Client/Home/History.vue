<template>
  <!-- history-area -->
  <section class="history__area section-py-130">
    <div class="container">
      <div class="row justify-content-center">
        <div class="col-lg-6 col-md-10">
          <div class="history__img-wrap">
            <img
              :src="'/storage/' + props.history.image_one"
              alt="img"
              style="height: 481px; width: 481px; object-fit: cover"
            />
            <img
              :src="'/storage/' + props.history.image_two"
              alt="img"
              data-aos="fade-up"
              data-aos-delay="400"
              style="height: 299px; width: 274px; object-fit: cover"
            />
            <img
              src="/frontend/assets/img/images/history_shape.svg"
              alt="shape"
              class="shape"
              data-aos="fade-down-right"
              data-aos-delay="400"
            />
           
          </div>
        </div>
        <div class="col-lg-6">
          <div class="history__content">
            <div class="section__title mb-20">
              <span class="sub-title">{{ props.history.subtitle }}</span>
              <h2 class="title">
                {{ props.history.title }}
              </h2>
            </div>
            <p>
              {{ props.history.description }}
            </p>
            <div class="progress__wrap">
              <!-- Dynamically generate progress items -->
              <div
                v-for="(value, key) in parsedProgressItems"
                :key="key"
                class="progress__item"
              >
                <h6 class="title">{{ key }}</h6>
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
      </div>
    </div>
  </section>
  <!-- history-area-end -->
</template>

<script setup>
import { computed } from "vue";

const props = defineProps({
  history: {
    type: Object,
    required: true,
  },
});

// Parse progress_items JSON safely
const parsedProgressItems = computed(() => {
  try {
    return JSON.parse(props.history.progress_items || "{}");
  } catch (error) {
    console.error("Invalid JSON format for progress_items:", error);
    return {};
  }
});
</script>
