<template>
  <Head title="About Us" />
  <ClientLayout :setting="props.setting">
    <!-- Breadcrumb Section -->
    <Breadcrumb :title="'About ZOSC'" :nav="nav" />
    <About :about="props.about" :counter="props.counter" />
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
                <a href="contact.html" class="tg-btn tg-btn-three tg-border-btn"
                  >Read More
                  <img
                    src="assets/img/icons/right_arrow.svg"
                    alt=""
                    class="injectable"
                /></a>
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

    <Testimonial :testimonials="props.testimonials" v-if="props.testimonials" />
    <Friends :friends="props.friends" />
  </ClientLayout>
</template>
  
  <script setup>
import ClientLayout from "@/Layouts/ClientLayout.vue";
import { Head } from "@inertiajs/vue3";
import Breadcrumb from "@/Components/Client/Breadcrumb.vue";
import About from "@/Components/Client/About.vue";
import Testimonial from "@/Components/Client/Testimonial.vue";
import Friends from "@/Components/Client/Friends.vue";

const props = defineProps({
  setting: {
    type: Object,
    required: true,
  },
  counter: {
    type: Object,
    required: true,
  },
  about: {
    type: Object,
    required: true,
  },
  testimonials: {
    type: Object,
    required: true,
  },
  friends: {
    type: Object,
    required: true,
  },
});

const nav = [
  { name: "Home", url: "/" },
  { name: "About", url: "about-us" },
];
</script>
  