<template>
    <!-- choose-area -->
    <section class="choose__area section-py-130" style="margin-bottom: 100px">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-5 order-0 order-lg-2">
                    <div class="about__img-wrap custom-img-wrap">
                        <div class="about__images custom-about-images">
                            <img
                                :src="'/storage/' + props.ceo.image"
                                alt="img"
                                class="ceo-image"
                                data-aos="fade-up"
                                data-aos-delay="400"
                            />
                        </div>
                        <div class="shape shape-container">
                            <img
                                src="/frontend/assets/img/images/about_shape01.svg"
                                alt="Shape 1"
                                class="shape shape-1"
                                data-aos="fade-up-right"
                                data-aos-delay="600"
                            />
                            <img
                                src="/frontend/assets/img/images/about_shape02.svg"
                                alt="Shape 2"
                                class="shape shape-2 alltuchtopdown"
                            />
                        </div>
                    </div>
                </div>

                <div class="col-lg-7">
                    <div class="choose__content">
                        <div class="section__title">
                            <span class="sub-title">Message from CEO</span>
                            <h4 class="title">{{ props.ceo.name }}</h4>
                        </div>

                        <div
                            class="quote-container"
                            v-if="!showFullDescription"
                        >
                            <span class="quote-mark open">
                                <img
                                    src="/frontend/assets/img/icons/quote.svg"
                                    alt="Open quote"
                                    class="quote-icon"
                                />
                            </span>
                            <p class="quote-text">{{ truncatedDescription }}</p>
                            <span class="quote-mark close">
                                <img
                                    src="/frontend/assets/img/icons/quote.svg"
                                    alt="Close quote"
                                    class="quote-icon"
                                />
                            </span>
                        </div>

                        <Link
                            :href="route('ceo.show', props.ceo.slug)"
                            class="tg-btn"
                            data-aos="fade-right"
                            data-aos-delay="400"
                        >
                            Read More
                            <img
                                src="/frontend/assets/img/icons/right_arrow.svg"
                                alt=""
                                class="injectable"
                            />
                        </Link>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- choose-area-end -->
</template>

<script setup>
import { Link } from "@inertiajs/vue3";
import { defineProps, ref, computed } from "vue";

const props = defineProps({
    ceo: {
        type: Object,
        required: true,
    },
});

const MAX_DESCRIPTION_LENGTH = 400;
let showFullDescription = ref(false);

// Computed property to get the truncated description
const truncatedDescription = computed(() => {
    if (props.ceo.description.length > MAX_DESCRIPTION_LENGTH) {
        return (
            props.ceo.description.substring(0, MAX_DESCRIPTION_LENGTH) + "..."
        );
    }
    return props.ceo.description;
});
</script>

<style scoped>
.quote-container {
    position: relative;
    padding: 0 50px 30px;
    margin: 30px 0 0 0;
}

.quote-mark {
    position: absolute;
    width: 60px;
    height: 60px;
}

.quote-mark.open {
    top: -15px;
    left: 0px;
    width: 40px;
    transform: rotate(180deg);
}

.quote-mark.close {
    bottom: 20px;
    right: 10px;
    width: 40px;
}

.quote-icon {
    width: 100%;
    height: 100%;
    object-fit: contain;
    opacity: 0.8;
    filter: brightness(0) saturate(100%) invert(26%) sepia(95%) saturate(2594%)
        hue-rotate(217deg) brightness(101%) contrast(101%);
}

.quote-text {
    font-size: 18px;
    line-height: 1.7;
    color: #555;
    margin: 0;
    padding: 15px 0;
    position: relative;

    z-index: 1;
}

.custom-img-wrap {
    position: relative !important;
    width: 100% !important;
    height: 100% !important;
    display: flex !important;
    align-items: center !important;
    justify-content: center !important;
}

.custom-about-images {
    position: relative !important;
    z-index: 1 !important;
}

.ceo-image {
    max-width: 100% !important;
    height: auto !important;
}

.shape-container {
    position: absolute !important;
    top: 0 !important;
    left: 0 !important;
    width: 100% !important;
    height: 100% !important;
    z-index: 2 !important;
    pointer-events: none !important;
}

.shape-1 {
    /* position: absolute !important; */
    top: 75% !important;
    left: 78% !important;
    transform: scaleX(-1) !important;
    max-width: 100px !important;
    height: auto !important;
}

.shape-2 {
    position: absolute !important;
    bottom: -190 !important;
    left: -20px !important;
    max-width: 100px !important;
    height: auto !important;
    z-index: 0;
}
@media (max-width: 768px) {
    .quote-container {
        padding: 0 30px 20px;
    }

    .quote-mark {
        width: 40px;
        height: 40px;
    }

    .quote-text {
        font-size: 16px;
    }
}

@media (max-width: 576px) {
    .shape-1 {
        top: 65% !important;
        left: 78% !important;
    }
    .shape-2 {
        bottom: -200 !important;
        left: -20px !important;
    }
    .quote-container {
        padding: 0 20px 15px;
    }

    .quote-mark {
        width: 30px;
        height: 30px;
    }
}
</style>
