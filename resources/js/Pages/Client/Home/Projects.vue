<template>
  <!-- project-area -->
  <section
    class="project__area section-py-130 project__bg"
    data-background="/frontend/assets/img/bg/project_bg.jpg"
  >
    <div class="container">
      <div class="row justify-content-center">
        <div class="col-xl-6 col-lg-8">
          <div class="section__title text-center mb-50">
            <span class="sub-title">PUBLICATION</span>
            <h2 class="title">Some Of Our Projects That Will Help You</h2>
          </div>
        </div>
      </div>
    </div>
    <div class="swiper-container project-active fix">
      <div class="swiper-wrapper">
        <!-- Loop through the projects and display each one dynamically -->
        <div
          class="swiper-slide"
          v-for="(project, index) in projects.data"
          :key="index"
        >
          <div class="project__item">
            <div class="project__thumb">
              <img :src="'/storage/' + project.image" :alt="project.title" />
            </div>
            <div class="project__content">
              <div class="project__content-left">
                <!-- Dynamically display the category title -->
                <span>{{ getCategoryTitle(project.category_id) }}</span>
                <h2 class="title">
                  <Link :href="route('project.show', project.slug)">{{
                    project.name
                  }}</Link>
                </h2>
              </div>
              <div class="project__content-arrow">
                <Link :href="route('project.show', project.slug)">
                  <img
                    src="/frontend/assets/img/icons/right_arrow.svg"
                    alt=""
                    class="injectable"
                  />
                </Link>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="project__nav-wrap">
        <button class="project-button-prev">
          <img
            src="/frontend/assets/img/icons/right_arrow.svg"
            alt=""
            class="injectable"
          />
        </button>
        <button class="project-button-next">
          <img
            src="/frontend/assets/img/icons/right_arrow.svg"
            alt=""
            class="injectable"
          />
        </button>
      </div>
    </div>
  </section>
  <!-- project-area-end -->
</template>

<script setup>
import { Link } from "@inertiajs/vue3";

const props = defineProps({
  projects: {
    type: Object,
    required: true,
  },
  categories: {
    type: Object,
    required: true,
  },
});
const getCategoryTitle = (categoryId) => {
  const category = props.categories.find((cat) => cat.id === categoryId);
  return category ? category.title : "Unknown Category";
};
</script>
