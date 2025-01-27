<template>
  <Head :title="props.verified ? 'Verified' : ' - Not Found'" />
  <ClientLayout :setting="props.setting">
    <!-- Breadcrumb Section -->
    <Breadcrumb :title="'Certificate Verification'" :nav="nav" />

    <section class="team__details-area py-5">
      <div class="container">
        <div class="row justify-content-center">
          <div class="col-12">
            <div class="team__details-info-wrap text-center">
              <!-- Display Title Based on Verification Status -->
              <h2 class="title">
                <span :class="props.verified ? 'text-success': 'text-danger'">
                  {{
                    props.verified
                      ? "Certificate Verified"
                      : "Certificate Not Found"
                  }}
                </span>
              </h2>
              <!-- <span>{{ props.setting.site_name }}</span> -->

              <!-- Certificate Section -->
              <div v-if="props.verified" class="certificate__layout">
                <div class="certificate__header">
                  <img
                    :src="'/storage/' + props.setting.site_logo"
                    alt="Logo"
                    class="certificate__logo"
                  />
                  <h3>{{ props.setting.site_name }}</h3>
                </div>
                <div class="certificate__body">
                  <p class="certificate__text">
                    This is to certify that
                    <strong>{{ props.certificate.for_who }}</strong> has
                    successfully completed
                    <strong>{{ props.certificate.certificate_name }}</strong> on
                    <strong>{{
                      new Date(
                        props.certificate.issue_date
                      ).toLocaleDateString()
                    }}</strong
                    >.
                  </p>
                  <p class="certificate__code">
                    Certificate Code:
                    <strong>{{ props.certificate.certificate_code }}</strong>
                  </p>
                </div>
              </div>

              <!-- Alert Message if Not Verified -->
              <div
                v-else
                class="alert alert-danger fade show"
              >
                <strong>Oops!</strong> The certificate could not be verified.
                Please check the certificate code and try again.
                
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>

    <!-- CTA Area -->
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
                >
                  Read More
                  <img
                    src="assets/img/icons/right_arrow.svg"
                    alt=""
                    class="injectable"
                  />
                </Link>
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
  </ClientLayout>
</template>
  
  <script setup>
import ClientLayout from "@/Layouts/ClientLayout.vue";
import { Head, Link } from "@inertiajs/vue3";
import Breadcrumb from "@/Components/Client/Breadcrumb.vue";

const props = defineProps({
  setting: {
    type: Object,
    required: true,
  },
  certificate: {
    type: Object,
    required: false,
  },
  verified: Boolean,
  message: {
    type: String,
    required: false,
  },
});

// Adjust nav structure to handle the breadcrumb navigation
const nav = [
  { name: "Home", url: route("home") },
  { name: "Certificate Verification", url: route("certificate.verify") },
  { name: "Verification Result", url: route("certificate.verify") },
];
</script>
  

<style scoped>
.certificate__layout {
  margin-top: 30px;
  border: 2px dashed #ddd;
  padding: 20px;
  border-radius: 10px;
  background: #f9f9f9;
  text-align: center;
  box-shadow: 0 5px 10px rgba(0, 0, 0, 0.1);
}
.certificate__header {
  margin-bottom: 20px;
}
.certificate__logo {
  max-width: 120px;
  margin-bottom: 10px;
}
.certificate__text {
  font-size: 1.2rem;
  line-height: 1.6;
  margin-bottom: 15px;
}
.certificate__code {
  font-size: 1rem;
  color: #555;
}
.alert {
  margin-top: 20px;
  font-size: 1.1rem;
}
</style>
