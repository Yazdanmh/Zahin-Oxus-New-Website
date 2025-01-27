<template>
    <Head title="Certificate Verification" />
    <ClientLayout :setting="props.setting">
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
                    <Link :href="route('contact.index')" class="tg-btn tg-btn-three">
                      Contact With Us
                      <img src="/frontend/assets/img/icons/right_arrow.svg" alt="" class="injectable" />
                    </Link>
                    <div class="shape">
                      <img src="/frontend/assets/img/images/sidebar_contact_shape01.svg" alt="shape" class="rotateme" />
                      <img src="/frontend/assets/img/images/sidebar_contact_shape02.svg" alt="shape" class="alltuchtopdown" />
                    </div>
                  </div>
                </div>
               
              </aside>
            </div>
  
            <div class="col-70 order-0 order-lg-2 p-4 ">
              <div class="services__details-wrap">
                <div class="services__details-content-top">
                  <!-- Certificate Verification -->
                  <section class="certificate__verification-area">
                    <div class="container">
                      <div class="row justify-content-center">
                        <div class="col-12">
                          <div class="certificate__verification-wrap">
                            <h2 class="title">Verify Your Certificate</h2>
                            
  
                            <!-- Form Section -->
                            <form @submit.prevent="submitForm">
                              <div class="form-group">
                                <label for="certificate_number">Certificate Number</label>
                                <input
                                  v-model="form.certificate_number"
                                  type="text"
                                  id="certificate_number"
                                  class="form-control"
                                  placeholder="Enter your certificate number"
                                  required
                                />
                                <span v-if="form.errors.certificate_number" class="text-danger">{{ form.errors.certificate_number }}</span>
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
                          </div>
                        </div>
                      </div>
                    </div>
                  </section>
                </div>
              </div>
            </div>
          </div>
        </div>
      </section>
    </ClientLayout>
  </template>
  
  <script setup>
  import { ref } from 'vue';
  import ClientLayout from '@/Layouts/ClientLayout.vue';
  import Breadcrumb from '@/Components/Client/Breadcrumb.vue';
  import { useForm, Head} from '@inertiajs/vue3';
  
  const props = defineProps({
    setting: Object,
  });
  
  const form = useForm({
    certificate_number: '',
  });
  
  const certificateVerified = ref(null);
  
  const submitForm = async () => {
  try {
    await form.post(route('certificate.verify'), {
      onSuccess: (response) => {
        if (response.data.verified) {
          // Handle successful verification
          certificateVerified.value = true;
          console.log('Certificate verified successfully');
          // Optionally, you can add further actions like displaying the certificate data.
        } else {
          // Handle failure to verify certificate (if not found)
          certificateVerified.value = false;
          alert(response.data.message || 'Certificate not found'); // Display the message sent from the backend
        }
      },
      onError: (errors) => {
        // Handle errors such as validation errors or server issues
        alert('An error occurred while verifying the certificate');
        console.error(errors); // Log the error details for debugging
      },
    });
  } catch (error) {
    console.error('An unexpected error occurred:', error);
  }
};

  </script>
  
  <style scoped>
  /* Add necessary styles here */
  .form-group {
    margin-bottom: 1rem;
  }
  </style>
  