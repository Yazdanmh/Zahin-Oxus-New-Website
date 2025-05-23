<template>
    <!-- banner-area -->
    <section
        class="banner__area fix"
        style="padding-top: 50px; padding-bottom: 100px"
    >
        <div
            class="banner__bg"
            data-background="/frontend/assets/img/banner/hero_bg.jpg"
        ></div>
        <div class="container">
            <div class="row align-items-center justify-content-center">
                <div class="col-lg-7">
                    <div class="banner__content">
                        <span
                            class="sub-title"
                            data-aos="fade-up"
                            data-aos-delay="0"
                            v-html="props.hero.subtitle"
                        ></span>
                        <h2
                            class="title"
                            data-aos="fade-up"
                            data-aos-delay="300"
                            v-html="props.hero.title"
                            style="font-size:18px;text-align:center;"
                        ></h2>
                        <p data-aos="fade-up" data-aos-delay="500" v-html="props.hero.description">
                           
                        </p>
                        <div
                            v-if="props.hero.button"
                            class="banner__btn"
                            data-aos="fade-up"
                            data-aos-delay="700"
                        >
                            <Link :href="props.hero.link" class="tg-btn"
                                >{{ props.hero.button }}
                                <img
                                    src="/frontend/assets/img/icons/right_arrow.svg"
                                    alt=""
                                    class="injectable"
                            /></Link>
                        </div>
                    </div>
                </div>
                <div class="col-lg-5 col-md-8">
                    <div
                        class="banner__img"
                        data-aos="fade-up"
                        data-aos-delay="100"
                    >
                        <img
                            :src="'/storage/' + props.hero.image"
                            alt="img"
                            class="main-img"
                            style="width: auto"
                        />
                    </div>
                </div>
            </div>
        </div>
        <div class="banner__shape">
            <img
                src="/frontend/assets/img/banner/hero_shape02.svg"
                alt="shape"
                data-aos="fade-right"
                data-aos-delay="800"
            />
        </div>
    </section>
    <!-- banner-area-end -->
</template>

<script setup>
import { Link } from "@inertiajs/vue3";
const props = defineProps({
    hero: {
        type: Object,
        require: true,
    },
});
</script>
