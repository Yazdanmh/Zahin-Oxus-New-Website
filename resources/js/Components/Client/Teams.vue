<template>
  <!-- team-area -->
  <section class="team__area fix section-py-130">
    <div class="container">
      <div class="row align-items-center">
        <div class="col-lg-6">
          <div class="section__title white-title mb-50 mb-md-30">
            <span class="sub-title">MEET OUR TEAM</span>
            <h2 class="title">
              Meet our Specialized <br />
              Team of Experts
            </h2>
          </div>
        </div>  
        <div class="col-lg-6">
          <div class="section__content white-content mb-50">
            <p>
              Our power of choice is untrammeled, allowing us to do what we love
              the most.
            </p>
          </div>
        </div>
      </div>
      <div class="row gutter-y-30 justify-content-center">
        <div
          class="col-xl-3 col-lg-4 col-md-6"
          v-for="team in props.teams"
          :key="team.id"
        >
          <div class="team__item">
            <div class="team__thumb" style="margin-bottom: 50px;">
              <img
                :src="'/storage/' + team.image"
                alt="Team Member Image"
                style="width: 200px; height: 200px; object-fit: cover; border-radius: 50%; padding: 3px; border: 1px solid gray;"
              />
            </div>
            <div class="team__content">
              <h2 class="title">
                <Link :href="route('team.show', team.slug)">{{
                  team.name
                }}</Link>
              </h2>
              <span>{{ team.position }}</span>
            </div>

            <div class="team__shape">
              <img src="/frontend/assets/img/team/team_shape.svg" alt="shape" />
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="team__shape-wrap">
      <img
        src="/frontend/assets/img/team/team_shape01.svg"
        alt="shape"
        data-aos="fade-down-left"
        data-aos-delay="400"
      />
      <img
        src="/frontend/assets/img/team/team_shape02.svg"
        alt="shape"
        data-aos="fade-up-right"
        data-aos-delay="400"
      />
      <img
        src="/frontend/assets/img/team/team_shape03.svg"
        alt="shape"
        class="rightToLeft"
      />
    </div>
  </section>
  <!-- team-area-end -->
</template>

<script setup>
import { Link } from "@inertiajs/vue3";

const props = defineProps({
  teams: {
    type: Array, // Fixed from Object to Array
    required: true,
  },
});
</script>
