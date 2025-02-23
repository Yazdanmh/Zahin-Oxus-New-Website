<template>
  <Head title="Trainers" />
  <ClientLayout :setting="props.setting" :service="props.service_categories">
    <!-- Breadcrumb Section -->
    <Breadcrumb :title="'All Teams & Trainers'" :nav="nav" />

    <!-- team-area -->
    <section class="team__area fix section-py-130">
      <div class="container">
        <div class="row align-items-center">
          <div class="col-lg-6">
            <div class="section__title white-title mb-50 mb-md-30">
              <span class="sub-title">MEET OUR TEAM</span>
              <h2 class="title">
                Meet our Specialized <br />
                team of experts
              </h2>
            </div>
          </div>
          <div class="col-lg-6">
            <div class="section__content white-content mb-50">
              <p>
                Our power of choice is untrammelled and when nothing tsbeing
                able to do what we like best every pleasure.
              </p>
            </div>
          </div>
        </div>
        <div class="row gutter-y-30 justify-content-center">
          <div
            class="col-xl-3 col-lg-4 col-md-6"
            v-for="trainer in props.trainers.data"
            :key="trainer.id"
          >
            <div class="team__item" >
              <div class="team__thumb" style="margin-bottom: 50px">
                <img
                  :src="'/storage/' + trainer.image"
                  alt="img"
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
                  <Link :href="route('trainer.show', trainer.slug)">{{ trainer.name }}</Link>
                </h2>
                <span>{{ trainer.position }}</span>
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
  </ClientLayout>
</template>
    
    <script setup>
import ClientLayout from "@/Layouts/ClientLayout.vue";
import { Head, Link } from "@inertiajs/vue3";
import Breadcrumb from "@/Components/Client/Breadcrumb.vue";

const props = defineProps({
  setting: {
    type: Object,
    required: true,
  },
  trainers: {
    type: Object,
    required: true,
  },
  service_categories: {
    type: Object,
    required: true,
  },
});

const nav = [
  { name: "About", url: route("home.about") },
  { name: "trainers", url: route("trainer.index") },
];
</script>
    