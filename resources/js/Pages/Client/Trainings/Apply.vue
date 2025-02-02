<template>
  <Head :title="props.training.name" />
  <ClientLayout :setting="props.setting">
    <!-- Breadcrumb Section -->
    <Breadcrumb :title="'Contact with us'" :nav="nav" />

    <!-- Contact Area -->
    <section class="contact__area">
      <div class="container">
        <div class="row">
          <!-- Contact Information Section -->
          <div class="col-lg-4">
            <div class="contact__info-wrap">
              <img
                :src="'/storage/' + props.training.image"
                alt=""
                class="rounded mb-3"
              />
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
              <h2>{{ props.training.name }}</h2>
              <p>{{ props.training.description }}</p>
            </div>
          </div>

          <!-- Contact Form Section -->
          <div class="col-lg-8">
            <div class="contact__form-wrap">
              <h2 class="title">Apply for Training</h2>
              <p>Please fill in the details below to register.</p>
              <form @submit.prevent="submitForm" class="contact__form">
                <div class="row">
                  <div class="col-md-6">
                    <div class="form-grp">
                      <label for="name">Full Name *</label>
                      <input
                        id="name"
                        v-model="form.name"
                        type="text"
                        placeholder="Enter your full name"
                      />
                      <span v-if="form.errors.name" class="error-message">{{
                        form.errors.name[0]
                      }}</span>
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-grp">
                      <label for="email">Email *</label>
                      <input
                        id="email"
                        v-model="form.email"
                        type="email"
                        placeholder="Enter your email address"
                      />
                      <span v-if="form.errors.email" class="error-message">{{
                        form.errors.email[0]
                      }}</span>
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-grp">
                      <label for="phone">Phone *</label>
                      <input
                        id="phone"
                        v-model="form.phone"
                        type="text"
                        placeholder="Enter your phone number"
                      />
                      <span v-if="form.errors.phone" class="error-message">{{
                        form.errors.phone[0]
                      }}</span>
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-grp">
                      <label for="organization">Organization *</label>
                      <input
                        id="organization"
                        v-model="form.organization"
                        type="text"
                        placeholder="Enter your organization"
                      />
                      <span
                        v-if="form.errors.organization"
                        class="error-message"
                        >{{ form.errors.organization[0] }}</span
                      >
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-grp">
                      <label for="identity_card_id">Identity Card ID *</label>
                      <input
                        id="identity_card_id"
                        v-model="form.identity_card_id"
                        type="text"
                        placeholder="Enter your identity card ID"
                      />
                      <span
                        v-if="form.errors.identity_card_id"
                        class="error-message"
                        >{{ form.errors.identity_card_id[0] }}</span
                      >
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-grp">
                      <label for="position">Position *</label>
                      <input
                        id="position"
                        v-model="form.position"
                        type="text"
                        placeholder="Enter your position"
                      />
                      <span v-if="form.errors.position" class="error-message">{{
                        form.errors.position[0]
                      }}</span>
                    </div>
                  </div>
                  <div class="col-md-12">
                    <div class="form-grp">
                      <label for="address">Address *</label>
                      <input
                        id="address"
                        v-model="form.address"
                        type="text"
                        placeholder="Enter your address"
                      />
                      <span v-if="form.errors.address" class="error-message">{{
                        form.errors.address[0]
                      }}</span>
                    </div>
                  </div>
                </div>

                <button type="submit" class="tg-btn tg-btn-three">
                  {{ buttonText }}
                </button>
              </form>
              <p class="ajax-response mb-0" :class="responseClass">
                {{ responseMessage }}
              </p>
            </div>
          </div>
        </div>
      </div>
    </section>
    <!-- Contact Area End -->

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
                    alt="right arrow"
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
    <!-- CTA Area End -->
  </ClientLayout>
</template>
  
  <script setup>
import { Link, useForm } from "@inertiajs/vue3";
import { ref } from "vue";
import ClientLayout from "@/Layouts/ClientLayout.vue";
import { Head } from "@inertiajs/vue3";
import Breadcrumb from "@/Components/Client/Breadcrumb.vue";

const props = defineProps({
  setting: { type: Object, required: true },
  training: { type: Object, required: true },
});

const nav = [
  { name: "Trainings", url: route("trainings.index") },
  { name: props.training.name, url: "/" },
];

const form = useForm({
  name: "",
  email: "",
  phone: "",
  organization: "",
  identity_card_id: "",
  position: "",
  address: "",
  training_name: props.training.name, 
});

const responseMessage = ref("");
const buttonText = ref("Apply");
const responseClass = ref("");

const validateForm = () => {
  let valid = true;

  form.errors = {}; // Clear errors before validating

  if (!form.name) {
    form.errors.name = ["Name is required."];
    valid = false;
  }

  const emailRegex = /^[A-Za-z0-9._%+-]+@[A-Za-z0-9.-]+\.[A-Za-z]{2,}$/;
  if (!form.email || !emailRegex.test(form.email)) {
    form.errors.email = ["A valid email is required."];
    valid = false;
  }

  const phoneRegex = /^[0-9]{10,15}$/;
  if (!form.phone || !phoneRegex.test(form.phone)) {
    form.errors.phone = ["Phone number should be between 10 to 15 digits."];
    valid = false;
  }

  if (!form.organization) {
    form.errors.organization = ["Organization is required."];
    valid = false;
  }

  const identityCardRegex = /^[A-Za-z0-9]{5,15}$/;
  if (
    !form.identity_card_id ||
    !identityCardRegex.test(form.identity_card_id)
  ) {
    form.errors.identity_card_id = [
      "Identity Card ID must be between 5 to 15 alphanumeric characters.",
    ];
    valid = false;
  }

  if (!form.position) {
    form.errors.position = ["Position is required."];
    valid = false;
  }

  if (!form.address) {
    form.errors.address = ["Address is required."];
    valid = false;
  }

  return valid;
};

const submitForm = async () => {
  responseMessage.value = "";
  responseClass.value = "";

  if (!validateForm()) {
    return;
  }

  try {
    await form.post(route("trainings.apply_store", props.training.id), {
      preserveScroll: true,
      onStart: () => (buttonText.value = "Sending..."),
      onFinish: () => (buttonText.value = "Apply"),
      onSuccess: () => {
        responseMessage.value =
          "Your application has been submitted successfully!";
        responseClass.value = "success-message";
        form.reset();
      },
      onError: () => {
        responseMessage.value =
          "Error occurred while submitting your application.";
        responseClass.value = "error-message";
      },
    });
  } catch {
    responseMessage.value =
      "Unexpected error occurred. Please try again later.";
    responseClass.value = "error-message";
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
  /* Add button styling here */
}

.tg-btn-three {
  /* Add additional styling for this variant here */
}
</style>
  