<template>
  <Head :title="props.training.name" />
  <ClientLayout :setting="props.setting">
    <Breadcrumb :title="'Our Services'" :nav="nav" />
    <!-- services-details-area -->
    <section class="services__details-area section-py-130">
      <div class="container">
        <div class="row">
          <div class="col-30">
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
                    >Contact With Us
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
              <div class="sidebar__widget">
                <h4 class="sidebar__widget-title">Service Brochure</h4>
                <div class="sidebar__brochure">
                  <p>
                    View our 2025 Business prospectus of brochure for an easy to
                    read guide on all of the services offer.
                  </p>
                  <a
                    :href="'/storage/' + props.training.image"
                    target="_blank"
                    download
                  >
                    <span class="icon">
                      <svg
                        xmlns="http://www.w3.org/2000/svg"
                        width="18"
                        height="24"
                        viewBox="0 0 18 24"
                        fill="none"
                      >
                        <path
                          d="M18 21V6.75L11.25 0H3C2.20435 0 1.44129 0.316071 0.87868 0.87868C0.31607 1.44129 0 2.20435 0 3V21C0 21.7957 0.31607 22.5587 0.87868 23.1213C1.44129 23.6839 2.20435 24 3 24H15C15.7957 24 16.5587 23.6839 17.1213 23.1213C17.6839 22.5587 18 21.7957 18 21ZM11.25 4.5C11.25 5.09674 11.4871 5.66903 11.909 6.09099C12.331 6.51295 12.9033 6.75 13.5 6.75H16.5V21C16.5 21.3978 16.342 21.7794 16.0607 22.0607C15.7794 22.342 15.3978 22.5 15 22.5H3C2.60218 22.5 2.22064 22.342 1.93934 22.0607C1.65804 21.7794 1.5 21.3978 1.5 21V3C1.5 2.60218 1.65804 2.22064 1.93934 1.93934C2.22064 1.65804 2.60218 1.5 3 1.5H11.25V4.5Z"
                          fill="currentColor"
                        />
                        <path
                          d="M3.9045 21.1305C3.61214 21.0136 3.37659 20.7877 3.2475 20.5005C2.955 19.9185 3.0525 19.3365 3.3675 18.8475C3.6645 18.387 4.1565 17.9955 4.713 17.667C5.41791 17.2672 6.16303 16.9429 6.936 16.6995C7.53629 15.6204 8.06833 14.5047 8.529 13.359C8.25357 12.7332 8.03762 12.0828 7.884 11.4165C7.755 10.8165 7.7055 10.2225 7.815 9.7125C7.9275 9.1815 8.226 8.7045 8.79 8.478C9.078 8.3625 9.39 8.298 9.693 8.3625C9.84542 8.39495 9.9887 8.46091 10.1125 8.55561C10.2362 8.65031 10.3373 8.77137 10.4085 8.91C10.5405 9.156 10.5885 9.444 10.599 9.717C10.6095 9.999 10.581 10.311 10.5285 10.638C10.4025 11.403 10.1235 12.339 9.7485 13.329C10.1623 14.214 10.6543 15.0604 11.2185 15.858C11.8862 15.8053 12.5577 15.8304 13.2195 15.933C13.7655 16.032 14.3205 16.2255 14.6595 16.6305C14.8395 16.8465 14.949 17.1105 14.9595 17.4075C14.97 17.6955 14.889 17.9805 14.7525 18.252C14.6343 18.5036 14.4509 18.719 14.2215 18.876C13.9947 19.0239 13.7269 19.0964 13.4565 19.083C12.96 19.062 12.4755 18.789 12.057 18.4575C11.5481 18.0367 11.0896 17.5586 10.6905 17.0325C9.67613 17.1476 8.6738 17.3514 7.695 17.6415C7.24677 18.4364 6.73511 19.1939 6.165 19.9065C5.727 20.4315 5.2515 20.8905 4.7745 21.087C4.50043 21.211 4.18957 21.2265 3.9045 21.1305ZM5.973 18.279C5.724 18.393 5.493 18.513 5.2845 18.636C4.7925 18.927 4.473 19.2105 4.314 19.4565C4.173 19.674 4.17 19.8315 4.254 19.998C4.269 20.031 4.284 20.052 4.293 20.064C4.3109 20.0592 4.32844 20.0532 4.3455 20.046C4.551 19.962 4.878 19.6935 5.298 19.188C5.53687 18.8955 5.76211 18.5922 5.973 18.279ZM8.433 16.284C8.93389 16.1671 9.4393 16.0705 9.948 15.9945C9.67488 15.5765 9.41965 15.1471 9.183 14.7075C8.94773 15.2394 8.69763 15.7646 8.433 16.2825V16.284ZM12.102 16.959C12.327 17.2035 12.546 17.409 12.7545 17.574C13.1145 17.859 13.365 17.9535 13.5015 17.958C13.538 17.9628 13.5751 17.9548 13.6065 17.9355C13.6689 17.8862 13.7175 17.8216 13.7475 17.748C13.8008 17.6566 13.8312 17.5537 13.836 17.448C13.8351 17.4128 13.8212 17.3791 13.797 17.3535C13.719 17.2605 13.497 17.1255 13.02 17.04C12.7166 16.9893 12.4096 16.9627 12.102 16.9605V16.959ZM9.117 11.7C9.24324 11.2928 9.34344 10.8779 9.417 10.458C9.4635 10.176 9.4815 9.9435 9.474 9.7605C9.47441 9.65954 9.4582 9.55919 9.426 9.4635C9.35096 9.47279 9.27769 9.493 9.2085 9.5235C9.078 9.576 8.9715 9.6825 8.9145 9.948C8.8545 10.236 8.8695 10.6515 8.9835 11.181C9.0195 11.3475 9.0645 11.5215 9.1185 11.7H9.117Z"
                          fill="currentColor"
                        />
                      </svg>
                    </span>

                    <span class="content">
                      <strong>PDF. Download</strong>
                      <svg
                        xmlns="http://www.w3.org/2000/svg"
                        width="23"
                        height="23"
                        viewBox="0 0 23 23"
                        fill="none"
                      >
                        <path
                          d="M7.5 11.5L11.5 15.5M11.5 15.5L15.5 11.5M11.5 15.5V7.5M21.5 11.5C21.5 17.0228 17.0228 21.5 11.5 21.5C5.97715 21.5 1.5 17.0228 1.5 11.5C1.5 5.97715 5.97715 1.5 11.5 1.5C17.0228 1.5 21.5 5.97715 21.5 11.5Z"
                          stroke="currentColor"
                          stroke-width="2"
                          stroke-linecap="round"
                          stroke-linejoin="round"
                        />
                      </svg>
                    </span>
                  </a>
                </div>
              </div>
            </aside>
          </div>

          <div class="col-70 order-0 order-lg-2">
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
                <p>
                  {{ props.training.description }}
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
});

const nav = [
  { name: "Home", url: "/" },
  { name: "Trainings", url: route("trainings.index") },
  { name: props.training.name, url: "" },
];
</script>
      
    