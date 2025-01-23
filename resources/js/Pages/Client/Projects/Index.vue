<template>
  <Head title="Projects" />
  <ClientLayout :setting="props.setting">
    <!-- Breadcrumb Section -->
    <Breadcrumb :title="'Our Projects'" :nav="nav" />

    <!-- project-area -->
    <section class="project__area-five section-py-130">
      <div class="container">
        <div class="row align-items-center">
          <div class="col-lg-6">
            <div class="section__title mb-50 mb-md-30">
              <span class="sub-title">Finished Projects</span>
              <h2 class="title">
                Our dedication shines <br />
                through our work
              </h2>
            </div>
          </div>
          <div class="col-lg-6">
            <div class="section__content mb-50">
              <p>
                Our power of choice is untrammelled and when nothing tsbeing
                able to do what we like best every pleasure.
              </p>
            </div>
          </div>
        </div>
        <div class="row gutter-y-30">
          <div class="col-lg-4 col-md-6" v-for="project in props.projects.data" :key="project.id">
            <div class="project__item-five">
              <div class="project__thumb-five">
                <Link :href="route('project.show', project.slug)"
                  ><img :src="'/storage/' + project.image" alt="img"
                /></Link>
              </div>
              <div class="project__content-five">
                <span>{{ getCategoryTitle(project.category_id) }}</span>
                <h2 class="title">
                  <Link :href="route('project.show', project.slug)">{{ project.name }}</Link>
                </h2>
                <Link :href="route('project.show', project.slug)" class="arrow tg-btn tg-btn-four"
                  ><img
                    src="/frontend/assets/img/icons/right_arrow02.svg"
                    alt=""
                    class="injectable"
                /></Link>
              </div>
            </div>
          </div>

        </div>
      </div>
    </section>
    <!-- project-area-end -->
  </ClientLayout>
</template>
    
    <script setup>
import { Link } from "@inertiajs/vue3";
import ClientLayout from "@/Layouts/ClientLayout.vue";
import { Head } from "@inertiajs/vue3";
import Breadcrumb from "@/Components/Client/Breadcrumb.vue";

const props = defineProps({
  setting: {
    type: Object,
    required: true,
  },
  projects: {
    type: Object,
    required: true,
  },
  categories: {
    type: Object,
    required: true,
  },

});

const nav = [
  { name: "Home", url: "/" },
  { name: "Projects", url: "projects/all" },
];

const truncatedDescription = (description) => {
  if (description && description.length > 100) {
    return description.substring(0, 100) + "...";
  }
  return description;
};
const getCategoryTitle = (categoryId) => {
    const category = props.categories.find(cat => cat.id === categoryId);
    return category ? category.title : 'Unknown Category';
}
</script>
    
  