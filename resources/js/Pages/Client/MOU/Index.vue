<template>
    <Head title="MOUs" />
    <ClientLayout :setting="props.setting">
      <!-- Breadcrumb Section -->
      <Breadcrumb :title="'Memorandums of Understanding (MOUs)'" :nav="nav" />
  
      <!-- MOU List Section -->
      <section class="mou__list-area py-md-5 py-lg-5">
        <div class="container">
          <div class="row">
            <div class="col-md-4 col-lg-3">
              <!-- Sidebar with information about MOUs -->
              <aside class="mou__sidebar">
                <div class="sidebar__widget">
                  <div class="sidebar__contact">
                    <h4 class="title">Explore Our MOUs</h4>
                    <p>
                      Discover our various MOUs with partners, collaborators, and
                      institutions, and gain insights into our ongoing projects
                      and partnerships.
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
  
            <div class="col-md-8 col-lg-9">
              <!-- MOU Listing Section -->
              <section class="mou__listing">
                <div class="row justify-content-center">
                  <div class="col-12">
                    <div class="sidebar__widget">
                      <h4 class="sidebar__widget-title">Our MOUs</h4>
                      <p>
                        Explore the details of our MOUs, including agreements with
                        key institutions and partners. Download, view, or learn
                        more about each one.
                      </p>
  
                      <!-- MOUs Listing -->
                      <div v-if="props.mous.length > 0" class="row">
                        <div
                          v-for="mou in props.mous"
                          :key="mou.id"
                          class="col-lg-4 col-md-6 col-sm-12 mb-4"
                        >
                          <div class="mou__item">
                            <div class="mou__item-content">
                              <h5>{{ mou.title }}</h5>
                              <p>
                                {{ truncatedDescription(mou.parties_involved) }}
                                <span v-if="mou.description.length > 150">
                                  <Link
                                    :href="'#'"
                                    @click.prevent="toggleDescription(mou.id)"
                                    class="text-primary"
                                  >
                                    Read More
                                  </Link>
                                </span>
                              </p>
                              <div
                                class="d-flex justify-content-between align-items-center"
                              >
                                <Link
                                  :href="route('mou.show', { id: mou.id })"
                                  class="btn btn-link"
                                >
                                  <i class="bx bx-info-circle"></i> View Details
                                </Link>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
  
                      <p v-else class="text-warning">
                        No MOUs available at the moment.
                      </p>
                    </div>
                  </div>
                </div>
              </section>
            </div>
          </div>
        </div>
      </section>
    </ClientLayout>
  </template>
  
  <script setup>
  import { ref } from "vue";
  import ClientLayout from "@/Layouts/ClientLayout.vue";
  import Breadcrumb from "@/Components/Client/Breadcrumb.vue";
  import { useForm, Head, Link } from "@inertiajs/vue3";
  
  // Function to handle truncated description
  const truncatedDescription = (description) => {
    if (description.length > 150) {
      return description.slice(0, 150) + '...';
    }
    return description;
  };
  
  // Toggle the full description visibility
  const toggleDescription = (mouId) => {
    const mou = props.mous.find((item) => item.id === mouId);
    mou.showFullDescription = !mou.showFullDescription;
  };
  
  const nav = [
    { name: "Home", url: route("home") },
    { name: "MOUs", url: route("mou.index") },
  ];
  
  const props = defineProps({
    setting: Object,
    mous: {
      type: Array,
      required: true,
    },
  });
  </script>
  
  <style scoped>
  .mou__list-area {
    padding-top: 30px;
    padding-bottom: 30px;
  }
  
  .mou__item {
    background-color: #fff;
    padding: 20px;
    border-radius: 8px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.09);
    font-weight: bold; /* Make the text a little bolder */
  }
  
  .mou__item h5 {
    font-size: 1.25rem;
    font-weight: 700; /* Bold the title more */
    margin-bottom: 10px;
  }
  
  .mou__item p {
    color: #555;
  }
  
  .mou__item .btn {
    font-size: 0.875rem;
  }
  
  .mou__item .btn-outline-primary {
    background-color: #007bff;
    color: white;
    border: 1px solid #007bff;
  }
  
  .mou__item .btn-outline-primary:hover {
    background-color: #0056b3;
    border-color: #0056b3;
  }
  
  .mou__listing {
    margin-top: 30px;
  }
  
  .sidebar__widget-title {
    font-size: 1.5rem;
    font-weight: 600;
  }
  
  .sidebar__contact .title {
    font-size: 1.25rem;
    font-weight: 600;
  }
  
  .mou__item .d-flex {
    justify-content: flex-end;
  }
  
  .text-primary {
    color: #007bff !important;
  }
  
  .text-primary:hover {
    text-decoration: underline;
  }
  
  /* Additional styles to handle responsive grid items */
  @media (min-width: 768px) {
    .mou__item {
      padding: 15px;
    }
  }
  
  @media (max-width: 576px) {
    .mou__item {
      padding: 10px;
    }
  }
  </style>
  