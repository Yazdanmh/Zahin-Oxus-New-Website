<template>
  <section class="team__area fix section-py-130" style="margin-bottom: 60px">
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

      <!-- Swiper container for team sliding -->
      <div class="swiper-container team-active fix">
        <div class="swiper-wrapper">
          <div class="swiper-slide" v-for="team in props.teams" :key="team.id">
            <div class="team__item">
              <div class="team__thumb" style="margin-bottom: 50px">
                <img
                  :src="'/storage/' + team.image"
                  alt="Team Member Image"
                  style="
                    width: 200px;
                    height: 200px;
                    object-fit: cover;
                    border-radius: 50%;
                    padding: 3px;
                    border: 1px solid gray;
                  "
                />
              </div>
              <div class="team__content">
                <h2 class="title">
                  <Link :href="route('trainer.show', team.slug)">{{
                    team.name
                  }}</Link>
                </h2>
                <span>{{ team.position }}</span>
              </div>

              <div class="team__shape">
                <img
                  src="/frontend/assets/img/team/team_shape.svg"
                  alt="shape"
                />
              </div>
            </div>
          </div>
        </div>

        <div
          v-if="props.teams.length === 0"
          class="text-center no-team-message"
        >
          <p>No team members available at the moment.</p>
        </div>
      </div>
    </div>
    <div class="services__bottom-content text-center mt-70 text-white">
      <p>
        Discover Our Teams and Trainers.
     
        <Link :href="route('trainer.index')" class="text-white"
          >Explore All</Link
        >
      </p>
    </div>

    <!-- Team section shapes -->
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
</template>

<script setup>
import { Link } from "@inertiajs/vue3";
import Swiper from "swiper";
import "swiper/swiper-bundle.css"; // Import Swiper styles
import { onMounted } from "vue";

const props = defineProps({
  teams: {
    type: Array,
    required: true,
  },
});

onMounted(() => {
  new Swiper(".team-active", {
    loop: true, // Enable looping
    slidesPerView: 3, // Number of visible slides at once
    spaceBetween: 30, // Space between slides
    autoplay: {
      delay: 4000, // 4-second delay for automatic sliding
      disableOnInteraction: false, // Continue autoplay even after interaction
    },
    breakpoints: {
      1200: {
        slidesPerView: 4,
      },
      768: {
        slidesPerView: 2,
      },
      480: {
        slidesPerView: 1,
      },
    },
  });
});
</script>

<style scoped>
.no-team-message {
  font-size: 18px;
  color: #ff4d4f;
  margin-top: 20px;
}
</style>
