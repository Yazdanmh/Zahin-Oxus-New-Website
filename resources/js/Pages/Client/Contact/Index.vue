<template>
    <Head title="Contact-us" />
    <ClientLayout :setting="props.setting">
      <!-- Breadcrumb Section -->
      <Breadcrumb :title="'Contact with us'" :nav="nav" />
  
      <!-- Contact Map -->
      <div class="contact-map">
        <iframe
          src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3288.2581877318776!2d69.13619087477709!3d34.496338194152344!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x38d1691b74f1fcfd%3A0x485434788a511e45!2sZahin%20Oxus!5e0!3m2!1sen!2s!4v1737538415826!5m2!1sen!2s"
          width="600"
          height="450"
          style="border: 0"
          allowfullscreen=""
          loading="lazy"
          referrerpolicy="no-referrer-when-downgrade"
        ></iframe>
      </div>
  
      <!-- Contact Area -->
      <section class="contact__area">
        <div class="container">
          <div class="row">
            <!-- Contact Information Section -->
            <div class="col-lg-6">
              <div class="contact__info-wrap">
                <div v-if="props.setting.address" class="contact__info-item">
                  <h4 class="title">Address</h4>
                  <p>{{ props.setting.address }}</p>
                  <div class="shape">
                    <!-- SVG for Address Icon -->
                  </div>
                </div>
                <div v-if="props.setting.email" class="contact__info-item">
                  <h4 class="title">Email</h4>
                  <p>{{ props.setting.email }}</p>
                  <div class="shape">
                    <!-- SVG for Email Icon -->
                  </div>
                </div>
                <div v-if="props.setting.phone" class="contact__info-item">
                  <h4 class="title">Phone</h4>
                  <p>{{ props.setting.phone }}</p>
                  <div class="shape">
                    <!-- SVG for Phone Icon -->
                  </div>
                </div>
              </div>
            </div>
  
            <!-- Contact Form Section -->
            <div class="col-lg-6">
              <div class="contact__form-wrap">
                <h2 class="title">Leave Us A Message</h2>
                <form @submit.prevent="submitForm" class="contact__form">
                  <div class="form-grp">
                    <label for="name">Name *</label>
                    <input 
                      id="name" 
                      v-model="form.name" 
                      type="text" 
                    />
                    <!-- Show error message for 'name' -->
                    <span v-if="form.errors.name" class="error-message">{{ form.errors.name[0] }}</span>
                  </div>
                  <div class="form-grp">
                    <label for="email">Email *</label>
                    <input 
                      id="email" 
                      v-model="form.email" 
                      type="email" 
                    />
                    <!-- Show error message for 'email' -->
                    <span v-if="form.errors.email" class="error-message">{{ form.errors.email[0] }}</span>
                  </div>
                  <div class="form-grp">
                    <label for="comment">Comment *</label>
                    <textarea 
                      v-model="form.message" 
                      id="comment" 
                    ></textarea>
                    <!-- Show error message for 'message' -->
                    <span v-if="form.errors.message" class="error-message">{{ form.errors.message[0] }}</span>
                  </div>
                  <button type="submit" class="tg-btn tg-btn-three">{{ buttonText }}</button>
                </form>
                <p class="ajax-response mb-0" :class="responseClass">{{ responseMessage }}</p>
              </div>
            </div>
          </div>
        </div>
      </section>
      <!-- Contact Area End -->
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
                      src="assets/img/icons/right_arrow.svg"
                      alt=""
                      class="injectable"
                  /></Link>
                </div>
              </div>
            </div>
            <div class="cta__shape-three">
              <img src="/frontend/assets/img/images/h2_cta_shape.svg" alt="shape" />
            </div>
          </div>
        </div>
      </section>
      <!-- cta-area-end -->
    </ClientLayout>
  </template>
  
  <script setup>
  import { Link, useForm } from "@inertiajs/vue3";
  import { ref } from "vue";  
  import ClientLayout from "@/Layouts/ClientLayout.vue";
  import { Head } from "@inertiajs/vue3";
  import Breadcrumb from "@/Components/Client/Breadcrumb.vue";
  
  const props = defineProps({
    setting: {
      type: Object,
      required: true,
    },
  });
  
  const nav = [
    { name: "Home", url: "/" },
    { name: "Contact", url: "contact-us" },
  ];
  
  // Initialize the form with the useForm hook
  const form = useForm({
    name: '',
    email: '',
    message: '',
    submitted: false, // Track if form has been submitted
  });
  
  // Define response message, button text, and the class for response message
  const responseMessage = ref('');
  const buttonText = ref('Send Message');
  const responseClass = ref('');  // This will handle the color of the response message
  
  // Client-side form validation
  const validateForm = () => {
    let valid = true;
    if (!form.name) {
      form.errors.name = ["Name is required."];
      valid = false;
    } else {
      form.errors.name = [];
    }
  
    const emailRegex = /^[A-Za-z0-9._%+-]+@[A-Za-z0-9.-]+\.[A-Za-z]{2,}$/;
    if (!form.email || !emailRegex.test(form.email)) {
      form.errors.email = ["A valid email is required."];
      valid = false;
    } else {
      form.errors.email = [];
    }
  
    if (!form.message) {
      form.errors.message = ["Message is required."];
      valid = false;
    } else {
      form.errors.message = [];
    }
  
    return valid;
  };
  
  // Form submit handler
  const submitForm = async () => {
    responseMessage.value = ''; // Clear previous response message
    responseClass.value = '';   // Reset the class for response message color
    form.submitted = true; // Mark the form as submitted
  
    if (!validateForm()) {
      return; // Stop submission if validation fails
    }
  
    try {
      await form.post(route('contact.store'), {
        preserveScroll: true, 
        onStart: () => {
          buttonText.value = 'Sending...'; 
        },
        onFinish: () => {
          buttonText.value = 'Send Message'; 
        },
        onSuccess: () => {
          responseMessage.value = 'Your message has been sent successfully!';
          responseClass.value = 'success-message';  
          form.reset();
        },
        onError: () => {
          responseMessage.value = 'There was an error sending your message. Please try again.';
          responseClass.value = 'error-message';  // Set class for error color
        }
      });
    } catch (error) {
      responseMessage.value = 'An unexpected error occurred. Please try again later.';
      responseClass.value = 'error-message';  // Set class for error color
    }
  };
  </script>
  
  <style scoped>
  .error-message {
    color: red;
    font-size: 12px;
  }
  
  .success-message {
    color: green;
    font-size: 14px;
  }
  
  .tg-btn {
    /* Your button styles */
  }
  
  .tg-btn-three {
    /* Your button styles */
  }
  </style>
  