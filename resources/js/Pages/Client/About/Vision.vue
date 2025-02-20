<template>
    <Head title="Our Vision" />
    <ClientLayout :setting="props.setting" :service="props.service_categories">
      <!-- Breadcrumb Section -->
      <Breadcrumb :title="'Our Vision'" :nav="nav" />
  
      <!-- team-details -->
      <section class="team__details-area section-py-130">
        <div class="container">
          <div class="row justify-content-center">
            
            <div class="col-12">
              <div class="team__details-info-wrap">
                <h2 class="title">Our Vision</h2>
                <span>{{ props.setting.site_name }}</span>
                <div class="team__details-social">
                  <ul class="list-wrap">
                    <li>
                      <a :href="props.setting.facebook_url" target="_blank"
                        ><img
                          src="/frontend/assets/img/icons/facebook.svg"
                          alt=""
                          class="injectable"
                          style="width:50px;height: 30px;"
                      /></a>
                    </li>
                    <li>
                      <a :href="props.setting.twitter_url" target="_blank"
                        ><img
                          src="/frontend/assets/img/icons/twitter.svg"
                          alt=""
                          class="injectable"
                           style="width:50px;height: 30px;"
                      /></a>
                    </li>
                    <li>
                      <a :href="props.setting.instagram_url" target="_blank"
                        ><img
                          src="/frontend/assets/img/icons/instagram.svg"
                          alt=""
                          class="injectable"
                           style="width:50px;height: 30px;"
                      /></a>
                    </li>
                    
                    <li>
                      <a :href="props.setting.youtube_url" target="_blank"
                        ><img
                          src="/frontend/assets/img/icons/youtube.svg"
                          alt=""
                          class="injectable"
                           style="width:40px;height: 30px;"
                      /></a>
                    </li>
                  </ul>
                </div>
                <p v-html="props.our_vision.our_vision">
              
                </p>
              
                <ul class="team__details-inner list-wrap">
                  <li>
                    <div class="icon">
                      <i class="flaticon-placeholder"></i>
                    </div>
                    <div class="content">
                      <span>Location</span>
                      <p>{{ props.setting.address }}</p>
                    </div>
                  </li>
                  <li>
                    <div class="icon">
                      <i class="flaticon-phone-call"></i>
                    </div>
                    <div class="content">
                      <span>Phone Number</span>
                      <a :href="'tel:'+props.setting.phone">{{ props.setting.phone }}</a>
                    </div>
                  </li>
                  <li>
                    <div class="icon">
                      <i class="flaticon-envelope"></i>
                    </div>
                    <div class="content">
                      <span>Email Address</span>
                      <a :href="'mailto:' + props.setting.email" >{{ props.setting.email }}</a>
                    </div>
                  </li>
                </ul>
              </div>
            </div>
          </div>
   
        </div>
      </section>
      <!-- team-details-end -->
  
      <!-- cta-area -->
      <section class="cta__area-two">
        <div class="container">
          <div class="cta__inner-wrap-two">
            <div class="row align-items-center">
              <div class="col-lg-6">
                <div class="cta__content-three">
                  <h2 class="title">
                    Let’s Request a Schedule For Free Consultation
                  </h2>
                </div>
              </div>
              <div class="col-lg-6">
                <div class="cta__content-right">
                  <div class="cta__contact">
                    <div class="icon">
                      <i class="flaticon-telephone"></i>
                    </div>
                    <div class="content">
                      <span>Call For More Info</span>
                      <a href="tel:0123456789">{{ props.setting.phone }}</a>
                    </div>
                  </div>
                  <Link
                    :href="route('contact.index')"
                    class="tg-btn tg-btn-three tg-border-btn"
                    >Read More
                    <img
                      src="/frontend/assets/img/icons/right_arrow.svg"
                      alt=""
                      class="injectable"
                  /></Link>
                </div>
              </div>
            </div>
            <div class="cta__shape-three">
              <img
                src="/frontend/assets/img/images/h2_cta_shape.svg"
                alt="shape"
              />
            </div>
          </div>
        </div>
      </section>
      <!-- cta-area-end -->
    </ClientLayout>
  </template>
    
    <script setup>
  import ClientLayout from "@/Layouts/ClientLayout.vue";
  import { Head, Link} from "@inertiajs/vue3";
  import Breadcrumb from "@/Components/Client/Breadcrumb.vue";
  
  const props = defineProps({
    setting: {
      type: Object,
      required: true,
    },
    our_vision: {
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
    { name: "Our Vision", url: "/" },
  ];
  </script>
    