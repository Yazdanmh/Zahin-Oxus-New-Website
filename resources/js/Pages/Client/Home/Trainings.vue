<template>
  <!-- training-area -->
  <section class="project__area section-py-130">
    <div class="container">
      <div class="row align-items-center">
        <div class="col-lg-6 col-md-8">
          <div class="section__title mb-50 mb-md-30">
            <span class="sub-title">Our Trainings</span>
            <h2 class="title">Popular Trainings Offered Recently</h2>
          </div>
        </div>
        <div class="col-lg-6 col-md-4">
          <div class="section__btn text-end mb-30">
            <a
              href="trainings.html"
              class="tg-btn tg-btn-four tg-btn-six tg-btn-lavender"
              >See All Trainings
              <img
                src="assets/img/icons/right_arrow02.svg"
                alt=""
                class="injectable"
            /></a>
          </div>
        </div>
      </div>
      <div class="row gutter-y-30">
        <div
          class="col-lg-6 col-md-6"
          v-for="training in props.trainings.data"
          :key="training.id"
        >
          <div class="project__item-six shine__animate-item">
            <div class="project__thumb-six shine__animate-link">
              <a :href="route('trainings.show', training.slug)">
                <img :src="'/storage/' + training.image" alt="img" />
                <div class="shape">
                  <img
                    src="/frontend/assets/img/images/h7_project_item_shape01.svg"
                    alt="shape"
                  />
                  <img
                    src="/frontend/assets/img/images/h7_project_item_shape02.svg"
                    alt="shape"
                  />
                </div>
              </a>
            </div>
            <div class="project__content-six">
              <div class="content-left">
                <h4 class="title">
                  <a :href="route('trainings.show', training.slug)">{{
                    training.name
                  }}</a>
                </h4>

                <!-- Display formatted start and end date together -->
                <p>
                  <strong>Start Date:</strong>
                  {{
                    new Date(training.start_date).toLocaleDateString("en-GB", {
                      day: "2-digit",
                      month: "short",
                      year: "numeric",
                    })
                  }}
                  &nbsp;|&nbsp;
                  <strong>End Date:</strong>
                  {{
                    new Date(training.end_date).toLocaleDateString("en-GB", {
                      day: "2-digit",
                      month: "short",
                      year: "numeric",
                    })
                  }}
                </p>

                <!-- Check if the current date is before the end_date -->
                <template v-if="new Date() < new Date(training.end_date)">
                  <!-- If the training has a form, show Apply button -->
                  <template v-if="training.has_form">
                    <a
                      href="route('trainings.apply', training.slug)"
                      class="tg-btn tg-btn-six"
                      >Apply</a
                    >
                  </template>
                </template>
                <!-- If the current date is after the end_date, mark as expired -->
                <template v-else>
                  <span class="expired-text" style="color: red">Expired</span>
                </template>
              </div>

              <!-- Keep the arrow icon as you requested -->
              <a
                :href="route('trainings.show', training.slug)"
                class="arrow tg-btn tg-btn-four"
              >
                <img
                  src="/frontend/assets/img/icons/right_arrow02.svg"
                  alt=""
                  class="injectable"
                />
              </a>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
  <!-- training-area-end -->
</template>
  
<script setup>
const props = defineProps({
  trainings: {
    type: Object,
    required: true,
  },
});
</script>
  