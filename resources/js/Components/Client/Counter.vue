<template>
  <section ref="counterSection" class="counter__area">
    <div class="container">
      <div class="counter__wrap">
        <div class="row">
          <div class="col-lg-3 col-sm-6" v-for="([key, value]) in filteredCounter" :key="key">
            <div class="counter__item">
              <h2 class="count">
                <span ref="odometers" class="odometer count">{{ value }}</span>{{ key === 'happy_users' ? '%' : '+' }}
              </h2>
              <p>{{ getLabel(key) }}</p>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
</template>

<script setup>
import { ref, computed, onMounted } from "vue";
import "odometer/themes/odometer-theme-default.css";
import Odometer from "odometer";

const props = defineProps({
  counter: {
    type: Object,
    required: true,
  },
});

const odometers = ref([]);
const counterSection = ref(null);
const animationTriggered = ref(false); // Prevent re-triggering

const allowedKeys = ["happy_users", "case_complete", "professional_advisor", "years_of_experience"];

const filteredCounter = computed(() =>
  Object.entries(props.counter).filter(([key]) => allowedKeys.includes(key))
);

const getLabel = (key) => {
  const labels = {
    happy_users: "Happy Users",
    case_complete: "Cases Completed",
    professional_advisor: "Professional Advisors",
    years_of_experience: "Years of Experience",
  };
  return labels[key] || key;
};

const startAnimation = () => {
  if (animationTriggered.value) return; // Prevent multiple triggers

  animationTriggered.value = true; // Mark as triggered
  odometers.value.forEach((el, index) => {
    if (el) {
      new Odometer({
        el,
        value: 0,
        format: "(,ddd)",
        duration: 2000,
      }).update(filteredCounter.value[index][1]);
    }
  });
};

onMounted(() => {
  const observer = new IntersectionObserver(
    (entries) => {
      if (entries[0].isIntersecting) {
        startAnimation();
        observer.disconnect(); // Stop observing after animation starts
      }
    },
    { threshold: 0.3 } // 30% of the counter section must be visible
  );

  if (counterSection.value) {
    observer.observe(counterSection.value);
  }
});
</script>

<style>
.odometer {
  font-size: 2rem;
}
</style>
