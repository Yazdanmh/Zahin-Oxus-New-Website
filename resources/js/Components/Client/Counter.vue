<template>
  <!-- counter-area -->
  <section class="counter__area">
    <div class="container">
      <div class="counter__wrap">
        <div class="row">
          <div class="col-lg-3 col-sm-6">
            <div class="counter__item">
              <h2 class="count">
                <span class="odometer" :data-count="props.counter.happy_users"></span>%
              </h2>
              <p>Happy Users</p>
            </div>
          </div>
          <div class="col-lg-3 col-sm-6">
            <div class="counter__item">
              <h2 class="count">
                <span class="odometer" :data-count="props.counter.case_complete"></span>+
              </h2>
              <p>Case Completed</p>
            </div>
          </div>
          <div class="col-lg-3 col-sm-6">
            <div class="counter__item">
              <h2 class="count">
                <span class="odometer" :data-count="props.counter.professional_advisor"></span>
              </h2>
              <p>Professional Advisor</p>
            </div>
          </div>
          <div class="col-lg-3 col-sm-6">
            <div class="counter__item">
              <h2 class="count">
                <span class="odometer" :data-count="props.counter.years_of_experience"></span>+
              </h2>
              <p>Years of Experience</p>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="counter__shape">
      <img
        src="assets/img/images/counter__shape.svg"
        alt="shape"
        data-aos="fade-up-left"
        data-aos-delay="400"
      />
    </div>
  </section>
  <!-- counter-area-end -->
</template>

<script setup>
const props = defineProps({
  counter: {
    type: Object,
    required: true,
  },
});
</script>