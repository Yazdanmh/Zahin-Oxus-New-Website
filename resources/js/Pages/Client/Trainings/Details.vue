<template>
  <Head :title="props.training.name" />
  <ClientLayout :setting="props.setting" :service="props.service_categories">
    <Breadcrumb :title="'Our Services'" :nav="nav" />
    <!-- services-details-area -->
    
    <section class="services__details-area section-py-130">
      <div class="container">
        <div class="row">
          <div class="col-30 order-2 order-sm-2 order-md-2 order-lg-1">
            <aside class="services__sidebar">
              <div class="sidebar__widget">
                <div class="sidebar__cat-list">
                  <ul class="list-wrap">
                    <li v-for="item in props.trainings.data" :key="item.id">
                      <Link :href="route('trainings.show', item.slug)">
                        {{ item.name }}
                        <span>
                          <svg
                            xmlns="http://www.w3.org/2000/svg"
                            width="24"
                            height="14"
                            viewBox="0 0 24 14"
                            fill="none"
                          >
                            <path
                              d="M1 6.7777H22.6667M22.6667 6.7777L16.9683 1M22.6667 6.7777L16.9683 12.5556"
                              stroke="currentColor"
                              stroke-width="2"
                              stroke-linecap="round"
                              stroke-linejoin="round"
                            />
                          </svg>
                        </span>
                      </Link>
                    </li>
                  </ul>
                </div>
              </div>
              <div class="sidebar__widget">
                <div class="sidebar__contact">
                  <h4 class="title">
                    We Have More Than Years Marketing Experience
                  </h4>
                  <p>
                    It is a long established fact that reader will be
                    distracted.
                  </p>
                  <Link
                    :href="route('contact.index')"
                    class="tg-btn tg-btn-three"
                    >get in touch
                    <img
                      src="/frontend/assets/img/icons/right_arrow.svg"
                      alt=""
                      class="injectable"
                  /></Link>
                  <div class="shape">
                    <img
                      src="/frontend/assets/img/images/sidebar_contact_shape01.svg"
                      alt="shape"
                      class="rotateme"
                    />
                    <img
                      src="/frontend/assets/img/images/sidebar_contact_shape02.svg"
                      alt="shape"
                      class="alltuchtopdown"
                    />
                  </div>
                </div>
              </div>
              
            </aside>
          </div>

          <div class="col-70 order-0 order-lg-2 order-lg-2 order-sm-1 order-md-1 order-lg-2">
            <div class="services__details-wrap">
              <div class="services__details-thumb">
                <img :src="'/storage/' + props.training.image" alt="img" />
              </div>
              <div class="services__details-content-top">
                <p>
                  <strong>Start Date:</strong>
                  {{
                    new Date(props.training.start_date).toLocaleDateString(
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
                    new Date(props.training.end_date).toLocaleDateString(
                      "en-GB",
                      {
                        day: "2-digit",
                        month: "short",
                        year: "numeric",
                      }
                    )
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
                <h2 class="title">{{ props.training.name }}</h2>
                <p v-html="props.training.description ">
                  
                </p>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
    <!-- services-details-area-end -->
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
  training: {
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

const nav = [
  { name: "Home", url: "/" },
  { name: "Trainings", url: route("trainings.index") },
  { name: props.training.name, url: "" },
];
</script>
      
    