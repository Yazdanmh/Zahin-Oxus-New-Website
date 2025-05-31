<template>
  <Head title="Trainings" />
  <ClientLayout :setting="props.setting" :service="props.service_categories">
    <!-- Breadcrumb Section -->
    <Breadcrumb :title="'All Trainings'" :nav="nav" />

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
              <Link
                :href="route('certificate.show.verify')"
                class="tg-btn tg-btn-four tg-btn-six tg-btn-lavender"
                >Verify Certificates
                <img
                  src="/frontend/assets/img/icons/right_arrow02.svg"
                  alt=""
                  class="injectable"
              /></Link>
            </div>
          </div>
        </div>

        <!-- Show message if no trainings are available -->
        <div v-if="!props.trainings.data.length" class="text-center py-5">
          <p>No trainings available at the moment.</p>
        </div>

        <!-- training list -->
        <div v-else class="row gutter-y-30">
          <div
            class="col-lg-6 col-md-6"
            v-for="training in props.trainings.data"
            :key="training.id"
          >
            <div class="project__item-six shine__animate-item">
              <div class="project__thumb-six shine__animate-link">
                <Link :href="route('trainings.show', training.slug)">
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
                </Link>
              </div>
              <div class="project__content-six">
                <div class="content-left">
                  <h4 class="title">
                    <Link :href="route('trainings.show', training.slug)">
                      {{ training.name }}
                    </Link>
                  </h4>

                  <!-- Display formatted start and end date together -->
                  <p>
                    <strong>Start Date:</strong>
                    {{
                      new Date(training.start_date).toLocaleDateString(
                        "en-GB",
                        {
                          day: "2-digit",
                          month: "short",
                          year: "numeric",
                        }
                      )
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
                      <Link
                        :href="route('trainings.apply', training.slug)"
                        class="tg-btn tg-btn-six"
                        >Apply</Link
                      >
                    </template>
                  </template>
                  <!-- If the current date is after the end_date, mark as expired -->
                  <template v-else>
                    <span class="expired-text" style="color: red">Expired</span>
                  </template>
                </div>

                <!-- Keep the arrow icon as you requested -->
                <Link
                  :href="route('trainings.show', training.slug)"
                  class="arrow tg-btn tg-btn-four"
                >
                  <img
                    src="/frontend/assets/img/icons/right_arrow02.svg"
                    alt=""
                    class="injectable"
                  />
                </Link>
              </div>
            </div>
          </div>
        </div>

        <!-- Pagination Links (Only page numbers, no Previous/Next) -->
        <div class="pagination__wrap mt-40">
          <ul class="list-wrap">
            <!-- Loop through Pages (handling page numbers) -->
            <li
              v-for="page in totalPages"
              :key="page"
              :class="{ active: currentPage === page }"
            >
              <Link :href="`${props.trainings.path}?page=${page}`">{{
                page
              }}</Link>
            </li>
          </ul>
        </div>
      </div>
    </section>
    <!-- training-area-end -->
  </ClientLayout>
</template>

  
  <script setup>
import { Link } from "@inertiajs/vue3";
import ClientLayout from "@/Layouts/ClientLayout.vue";
import { Head } from "@inertiajs/vue3";
import Breadcrumb from "@/Components/Client/Breadcrumb.vue";
import { computed } from "vue";

const props = defineProps({
  setting: {
    type: Object,
    required: true,
  },
  trainings: {
    type: Object,
    required: true,
  },
  service_categories:{
    type:Object, 
    required:true, 
  }
});

// Breadcrumb Navigation
const nav = [
  { name: "Home", url: "/" },
  { name: "Trainings", url: route("trainings.index") },
];

// Current Page and Total Pages Logic
const currentPage = computed(() => props.trainings.current_page);
const totalPages = computed(() => {
  return Math.ceil(props.trainings.total / props.trainings.per_page);
});
</script>
  