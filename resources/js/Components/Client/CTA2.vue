<script setup >
import { Link } from '@inertiajs/vue3';

</script>

<template>
    <!-- cta-area -->
    <section class="cta__area-two">
            <div class="container">
                <div class="cta__inner-wrap">
                    <div class="row align-items-center">
                        <div class="col-lg-8">
                            <div class="cta__content-two">
                                <h2 class="title">Still have questions?</h2>
                                <p>Can’t find the answer you’re looking for? Please get in touch with our team.</p>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="cta__btn-two">
                                <Link :href="route('contact.index')" class="tg-btn tg-hover-btn">Get in touch <img src="/frontend/assets/img/icons/right_arrow.svg" alt="" class="injectable"></Link>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="cta__shape-two">
                <img src="/frontend/assets/img/images/cta_shape04.svg" alt="shape">
            </div>
        </section>
        <!-- cta-area-end -->
</template>