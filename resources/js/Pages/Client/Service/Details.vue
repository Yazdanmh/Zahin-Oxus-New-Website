<template>
  <Head :title="props.service.title" />
  <ClientLayout :setting="props.setting" :service="props.service_categories">
    <Breadcrumb :title="'Our Services'" :nav="nav" />
    
    <!-- services-details-area -->
    <section class="services__details-area section-py-130">
      <div class="container">
        <div class="row">
          <div class="col-30 order-2 order-sm-2 order-md-2 order-lg-1">
            <aside class="services__sidebar">
              <!-- Sidebar content: Categories and contact info -->
              <div class="sidebar__widget">
                <div class="sidebar__cat-list">
                  <ul
                    class="list-wrap"
                    v-for="item in props.service_categories"
                    :key="item.id"
                  >
                    <li class="my-1">
                      <Link :href="route('service.category', item.slug)">
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
                </div>
              </div>
            </aside>
          </div>

          <div class="col-70 order-0 order-lg-2 order-sm-1 order-md-1 order-lg-2">
            <div class="services__details-wrap">
              <div class="services__details-content-top">
               <p>{{props.service.category.name}}</p>
                <h2 class="title">{{ props.service.subtitle }}</h2>
              </div>

              <div class="services__details-thumb">
                <img :src="'/storage/' + props.service.image" alt="img" />
              </div>

              <div class="services__details-content-top">
                <h2 class="title">{{ props.service.title }}</h2>
                <p v-html="props.service.description"></p>
              </div>
              
              <!-- Trainers Table -->
              <div class="trainers-table-wrap" v-if="props.trainers.length> 0">
                <h3 class="trainers-list-title">Our Trainers List</h3>
                <table class="table table-modern">
                  <thead>
                    <tr>
                      <th>NO</th>
                      <th>Name</th>
                      <th>Position</th>
                      <th>Description</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr v-for="(trainer, index) in props.trainers" :key="trainer.id">
                      <td>{{ index + 1 }}</td>
                      <td>{{ trainer.name }}</td>
                      <td>{{ trainer.position }}</td>
                      <td>
                        <Link :href="route('trainer.show', trainer.slug)" class="trainer-link">
                          View Details
                        </Link>
                      </td>
                    </tr>
                  </tbody>
                </table>
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
  trainers: {
    type: Object,
    required: true,
  }
});

const nav = [
  { name: "Home", url: "/" },
  { name: "Services", url: route("service.index") },
  { name: props.service.title, url: "" },
];
</script>

<style scoped>
/* Modern Table Styling */
.table-modern {
  width: 100%;
  border-collapse: collapse;
  box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
  margin-top: 20px;
}

.table-modern th, .table-modern td {
  text-align: left;
  padding: 14px 20px;
  font-size: 16px;
  color: #333;
  border: 1px solid #e0e0e0;
}

.table-modern th {
  background-color: #f9f9f9;
  font-weight: 600;
  color: #555;
}

.table-modern tbody tr {
  transition: background-color 0.3s ease;
}

.table-modern tbody tr:hover {
  background-color: #f1f1f1;
}

.table-modern tbody tr:nth-child(even) {
  background-color: #fafafa;
}

.trainers-list-title {
  font-size: 24px;
  font-weight: 700;
  color: #333;
  margin-bottom: 20px;
}

.trainer-link {
  color: #007bff;
  text-decoration: none;
  font-weight: 600;
}

.trainer-link:hover {
  text-decoration: underline;
}

/* Responsive Design for Smaller Screens */
@media (max-width: 768px) {
  .table-modern th, .table-modern td {
    font-size: 14px;
    padding: 12px;
  }
  
  .trainers-list-title {
    font-size: 20px;
  }
}
</style>
