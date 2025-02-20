<template>
  <Head :title="props.service.title" />
  <ClientLayout :setting="props.setting" :service="props.service_categories">
    <Breadcrumb :title="'Our Services'" :nav="nav" />
    <!-- services-details-area -->
    <section class="services__details-area section-py-130">
      <div class="container">
        <div class="row">
          <div class="col-30">
            <aside class="services__sidebar">
              <div class="sidebar__widget">
                <div class="sidebar__cat-list">
                  <ul
                    class="list-wrap"
                    v-for="item in props.service_categories"
                    :key="item.id"
                  >
                    <li class="my-1">
                      <Link :href="route('service.category', item.slug)"
                        >{{ item.name }}
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
                    We Have Over 10 Years of Expertise in Financial Consulting
                  </h4>
                  <p>
                    With over a decade of experience, we offer professional
                    guidance and practical strategies for your business to
                    achieve success in an ever-changing financial landscape.
                  </p>
                  <Link
                    :href="route('contact.index')"
                    class="tg-btn tg-btn-three"
                  >
                    Contact With Us
                    <img
                      src="/frontend/assets/img/icons/right_arrow.svg"
                      alt=""
                      class="injectable"
                    />
                  </Link>
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

          <div class="col-70 order-0 order-lg-2">
            <div class="services__details-wrap">
              <div class="services__details-content-top">
                <h2 class="title">{{ props.service.subtitle }}</h2>
              </div>
              <div class="services__details-thumb">
                <img :src="'/storage/' + props.service.image" alt="img" />
              </div>
              <div class="services__details-content-top">
                <h2 class="title">{{ props.service.title }}</h2>
                <p v-html="props.service.description"></p>
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
  service: {
    type: Object,
    required: true,
  },
  services: {
    type: Object,
    required: true,
  },
  service_categories: {
    type: Object,
    required: true,
  },
});

const nav = [
  { name: "Home", url: "/" },
  { name: "Services", url: route("service.index") },
  { name: props.service.title, url: "" },
];
</script>
    
  