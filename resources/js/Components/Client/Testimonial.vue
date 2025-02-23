<template>
    <!-- testimonial-area -->
    <section class="testimonial__area fix">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-xl-10">
                    <div class="testimonial__wrap">
                        <div class="swiper-container fix testimonial-active">
                            <div class="swiper-wrapper">
                                <!-- Loop through testimonials and display each one -->
                                <div class="swiper-slide" v-for="(testimonial, index) in testimonials" :key="index">
                                    <div class="testimonial__item">
                                        <div class="testimonial__icon">
                                            <img src="/frontend/assets/img/icons/quote.svg" alt="icon" class="injectable">
                                        </div>
                                        <div class="testimonial__content">
                                            <p>{{ testimonial.message }}</p>
                                            <div class="testimonial__rating">
                                                <i v-for="n in testimonial.stars" :key="n" class="fas fa-star"></i>
                                            </div>
                                            <div class="testimonial__content-bottom">
                                                <h4 class="title">{{ testimonial.name }}</h4>
                                                <span>{{ testimonial.position }}, {{ testimonial.company }}</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="swiper testimonial__nav">
                            <div class="swiper-wrapper">
                                <!-- Loop through testimonial avatars -->
                                <div class="swiper-slide" v-for="(testimonial, index) in testimonials" :key="'avatar-' + index">
                                    <button>
                                        <img :src="'/storage/' + testimonial.image" alt="img" style="width:50px; height:50px; border-radius: 50%; object-fit: cover;">
                                    </button>
                                </div>
                            </div>
                        </div>
                        <div class="testimonial__nav-two">
                            <button class="testimonial-button-prev">
                                <img src="/frontend/assets/img/icons/right_arrow.svg" alt="" class="injectable">
                            </button>
                            <button class="testimonial-button-next">
                                <img src="/frontend/assets/img/icons/right_arrow.svg" alt="" class="injectable">
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="testimonial__shape-wrap">
            <img src="/frontend/assets/img/images/testi_shape01.svg" alt="shape" >
            <img src="/frontend/assets/img/images/testi_shape02.svg" alt="shape">
            <img src="/frontend/assets/img/images/testi_shape03.svg" alt="shape" data-aos="fade-up-right" data-aos-delay="400">
            <img src="/frontend/assets/img/images/testi_shape04.svg" alt="shape">
            <img src="/frontend/assets/img/images/testi_shape05.svg" alt="shape">
            <img src="/frontend/assets/img/images/map.svg" alt="shape" class="big-shape">
        </div>
    </section>
    <!-- testimonial-area-end -->
</template>

<script setup>
const props = defineProps({
    testimonials: {
        type: Array,
        required: true,
    }
})
</script>
