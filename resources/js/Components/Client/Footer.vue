<template>
  <!-- footer-area -->
  <footer class="footer__area fix">
    <div class="footer__top">
      <div class="container">
        <div class="row">
          <!-- Logo and About Section -->
          <div class="col-xl-3 col-lg-4 col-md-6">
            <div class="footer__widget">
              <div class="footer__logo">
                <a href="index.html">
                  <img
                    :src="'/storage/' + props.setting.site_logo"
                    alt="logo"
                    style="max-width: 70px"
                  />
                </a>
              </div>
              <div class="footer__content">
                <p>{{ props.setting.about }}</p>
              </div>
              <div class="footer__social">
                <ul class="list-wrap">
                  <li>
                    <a :href="props.setting.facebook_url" target="_blank">
                      <img
                        src="/frontend/assets/img/icons/facebook.svg"
                        alt="Facebook"
                        class="injectable"
                        style="width: 30px; height: 20px"
                      />
                    </a>
                  </li>
                  <li>
                    <a :href="props.setting.twitter_url" target="_blank">
                      <img
                        src="/frontend/assets/img/icons/twitter.svg"
                        alt="Twitter"
                        class="injectable"
                        style="width: 30px; height: 20px"
                      />
                    </a>
                  </li>
                  <li>
                    <a :href="props.setting.instagram_url" target="_blank">
                      <img
                        src="/frontend/assets/img/icons/instagram.svg"
                        alt="Instagram"
                        class="injectable"
                         style="width: 30px; height: 20px"
                      />
                    </a>
                  </li>
                  <li>
                    <a :href="props.setting.youtube_url" target="_blank">
                      <img
                        src="/frontend/assets/img/icons/youtube.svg"
                        alt="YouTube"
                        class="injectable"
                 style="width: 30px; height: 20px"
                      />
                    </a>
                  </li>
                </ul>
              </div>
            </div>
          </div>

          <!-- About Company Links -->
          <div class="col-xl-3 col-lg-4 col-md-6 col-sm-6">
            <div class="footer__widget">
              <h4 class="footer__widget-title">About Company</h4>
              <ul class="footer__widget-link list-wrap">
                <li><Link :href="route('home.about')">About Us</Link></li>
                <li><Link :href="route('about.mission')">Our Missions</Link></li>
                <li><Link :href="route('about.vision')">Our Vision</Link></li>
                <li><Link :href="route('project.index')">Projects</Link></li>
              </ul>
            </div>
          </div>

          <!-- Quick Links -->
          <div class="col-xl-2 col-lg-4 col-md-4 col-sm-6">
            <div class="footer__widget">
              <h4 class="footer__widget-title">Quick Links</h4>
              <ul class="footer__widget-link list-wrap">
                <li><Link :href="route('contact.index')">Contact Us</Link></li>
                <li><Link :href="route('service.index')">Services</Link></li>
                <li><Link :href="route('trainings.index')">Trainings</Link></li>
                <li><Link :href="route('home')">Testimonials</Link></li>
              </ul>
            </div>
          </div>

          <!-- Newsletter Section -->
          <div class="col-xl-4 col-lg-4 col-md-8">
            <div class="footer__widget">
              <h4 class="footer__widget-title">Subscribe Newsletter</h4>
              <div class="footer__newsletter">
                <span>*Only valuable resource no bullshit</span>

                <form
                  @submit.prevent="submitForm"
                  class="footer__newsletter-form"
                >
                  <!-- Email Input -->
                  <input
                    type="email"
                    placeholder="Enter your e-mail"
                    v-model="form.email"
                    :class="{ 'is-invalid': form.errors.email }"
                  />
                  <!-- Validation Errors -->
                  <div v-if="form.errors.email" class="invalid-feedback">
                    {{ form.errors.email }}
                  </div>
                  <!-- Success Message -->

                  <!-- Submit Button -->
                  <button type="submit" :disabled="form.processing">
                    <img
                      src="/frontend/assets/img/icons/right_arrow.svg"
                      alt="Submit"
                      class="injectable"
                    />
                  </button>
                </form>
                <span id="successMessage" class="valid-feedback"></span>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- Footer Bottom -->
    <div class="footer__bottom">
      <div class="container">
        <div class="row">
          <div class="col-lg-12">
            <div class="copyright__content">
              <p>Developed by 'Yazdan Mohammadi'</p>
              <p>Copyright © Zahin Oxus | All Right Reserved</p>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- Footer Shapes -->
    <div class="footer__shape-wrap">
      <img
        src="/frontend/assets/img/images/footer_shape01.svg"
        alt="Shape"
        data-aos="fade-down-left"
        data-aos-delay="400"
      />
      <img src="/frontend/assets/img/images/footer_shape02.svg" alt="Shape" />
      <img
        src="/frontend/assets/img/images/footer_shape03.svg"
        alt="Shape"
        class="rotateme"
      />
    </div>
  </footer>
  <!-- footer-area-end -->
</template>

<script setup>
import { Link, useForm } from "@inertiajs/vue3";
import { ref } from "vue";

// Props
const props = defineProps({
  setting: {
    type: Object,
    required: true,
  },
});

// Form state
const form = useForm({
  email: "",
});

// Success message
const successMessage = ref("");

// Submit function
const submitForm = () => {
  form.post(route("newsletter.subscribe"), {
    preserveScroll: true,
    onSuccess: () => {
      successMessage.value = "Thank you for subscribing to our newsletter!";
      const successElement = document.getElementById("successMessage");
      if (successElement) {
        successElement.textContent = successMessage.value;
      }
      form.reset();
      setTimeout(() => {
        successMessage.value = null;
        if (successElement) {
          successElement.textContent = ""; 
        }
      }, 5000);
    },

    onError: () => {
      successMessage.value = null;
    },
  });
};
</script>

<style>
.is-invalid {
  border-color: #e3342f;
}

.invalid-feedback {
  color: #e3342f;
  font-size: 0.875rem;
}

.valid-feedback {
  color: #38c172;
  font-size: 0.875rem;
  margin-top: 5px;
}
</style>
