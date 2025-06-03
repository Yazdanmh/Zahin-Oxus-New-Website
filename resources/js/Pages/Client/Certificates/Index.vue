<template>
  <Head title="Certificate Verification" />
  <ClientLayout :setting="props.setting" :service="props.service_categories">
    <!-- Breadcrumb Section -->
    <Breadcrumb :title="'Certificate Verification'" :nav="nav" />

    <!-- services-details-area -->
    <section class="services__details-area py-md-5 py-lg-5">
      <div class="container">
        <div class="row">
          <div class="col-30">
            <aside class="services__sidebar">
              <div class="sidebar__widget">
                <div class="sidebar__contact">
                  <h4 class="title">
                    We Have More Than Years of Marketing Experience
                  </h4>
                  <p>
                    It is a long-established fact that readers will be
                    distracted.
                  </p>
                  <Link
                    :href="route('contact.index')"
                    class="tg-btn tg-btn-three"
                  >
                    Get in Touch 
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

          <div class="col-70 order-0 order-lg-2 p-0 mt-2">
            <!-- team-details -->
            <section class="team__details-area ">
              <div class="container">
                <div class="row justify-content-center">
                  <div class="col-12">
                    <div class="team__details-info-wrap pb-0 pt-4">
                      <h2 class="title">Verify Your Certificate</h2>
                      <span class="mb-2">{{ props.setting.site_name }}</span>
                      <!-- Form Section -->
                      <form @submit.prevent="submitForm">
                        <div class="form-group">
                          <label for="certificate_number" class="form-label text-secondary"
                            >Certificate Number</label
                          >
                          <input
                            v-model="form.certificate_number"
                            type="text"
                            id="certificate_number"
                            class="form-control"
                            placeholder="Enter your certificate number"
                            required
                          />
                          <span
                            v-if="form.errors.certificate_number"
                            class="text-danger"
                            >{{ form.errors.certificate_number }}</span
                          >
                        </div>
                        <button type="submit" class="tg-btn tg-btn-three">
                          Verify Certificate
                        </button>
                      </form>

                      <!-- Verification Result -->
                      <div v-if="certificateVerified !== null">
                        <p v-if="certificateVerified" class="text-success">
                          Certificate is verified and valid!
                        </p>
                        <p v-else class="text-danger">
                          No certificate found with this number.
                        </p>
                      </div>
                      <p></p>
                    </div>
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
import { useForm, Head, Link} from "@inertiajs/vue3";
const nav = [
  { name: "Trainings", url: route("trainings.index") },
  { name: "Certificate Verification", url: route("certificate.verify") },
];

const props = defineProps({
  setting: Object,
  service_categories: Object, 
});

const form = useForm({
  certificate_number: "",
});

const certificateVerified = ref(null);

const submitForm = async () => {
  try {
     form.post(route("certificate.verify"), {
      preserveScroll:true,
    });
  } catch (error) {
    console.error("An unexpected error occurred:", error);
  }
};
</script>
  
  <style scoped>
/* Add necessary styles here */
.form-group {
  margin-bottom: 1rem;
}
</style>
  