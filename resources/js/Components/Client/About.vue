<template>
    <!-- about-area -->
    <section
        class="about__area section-py-130 bg-red"
        style="padding-bottom: 0px"
    >
        <div class="container">
            <div class="row justify-content-center">
                <!-- Left Image Section -->
                <div class="col-lg-6 col-md-9">
                    <div class="about__img-wrap">
                        <div class="about__images">
                            <img
                                :src="'/storage/' + about.image_one"
                                alt="Image One"
                                style="
                                    width: 511px;
                                    height: 338px;
                                    object-fit: cover;
                                "
                            />
                            <img
                                :src="'/storage/' + about.image_two"
                                alt="Image Two"
                                data-aos="fade-up"
                                data-aos-delay="200"
                                style="
                                    width: 357px;
                                    height: 228px;
                                    object-fit: cover;
                                "
                            />
                        </div>
                        <!-- Experience Wrap -->
                        <div
                            class="experience__wrap"
                            data-aos="fade-left"
                            data-aos-delay="200"
                            style="background-color: #0074a5; text-align:center;"
                        >
                            <h2 class="count" style="font-size:24px;text-align:center;">Leading Professions </h2>
                            <span><i>to</i><br>Excellence . . .</span>
                        </div>

                        <!-- Shapes -->
                        <div class="shape">
                            <img
                                src="/frontend/assets/img/images/about_shape01.svg"
                                alt="Shape 1"
                                data-aos="fade-up-right"
                                data-aos-delay="600"
                            />
                            <img
                                src="/frontend/assets/img/images/about_shape02.svg"
                                alt="Shape 2"
                                class="alltuchtopdown"
                            />
                        </div>
                    </div>
                </div>
                <!-- Right Content Section -->
                <div class="col-lg-6">
                    <div class="about__content">
                        <div class="section__title mb-15">
                            <span class="sub-title">WHY WE ARE BETTER?</span>
                            <h2 class="title">{{ about.title }}</h2>
                        </div>
                        <p>{{ truncatedDescription }}</p>

                        <!-- Features List -->
                        <div v-if="!fulltext" class="about__inner-wrap">
                            <div class="about__inner-content">
                                <ul class="list-wrap about__list-item">
                                    <li
                                        v-for="(feature, index) in featuresList"
                                        :key="index"
                                    >
                                        <div class="icon">
                                            <svg
                                                xmlns="http://www.w3.org/2000/svg"
                                                width="14"
                                                height="14"
                                                viewBox="0 0 14 14"
                                                fill="none"
                                            >
                                                <path
                                                    d="M11.5252 3.5L5.30301 9.72222L2.47473 6.89394"
                                                    stroke="currentColor"
                                                    stroke-width="1.6"
                                                    stroke-linecap="round"
                                                    stroke-linejoin="round"
                                                />
                                            </svg>
                                        </div>
                                        {{ feature }}
                                    </li>
                                </ul>
                            </div>
                        </div>

                        <div
                            v-if="!props.fulltext"
                            class="about__content-bottom"
                        >
                            <Link :href="route('home.about')" class="tg-btn">
                                Explore Our Company
                                <img
                                    src="/frontend/assets/img/icons/right_arrow.svg"
                                    alt="Arrow Icon"
                                    class="injectable"
                                />
                            </Link>
                        </div>
                    </div>
                </div>
                <div class="col-12 py-5">
                    <div v-if="fulltext && remainingDescription">
                        <p>{{ remainingDescription }}</p>
                    </div>
                    <!-- Features List -->
                    <div v-if="fulltext" class="about__inner-wrap">
                        <div class="about__inner-content">
                            <ul class="list-wrap about__list-item">
                                <li
                                    v-for="(feature, index) in featuresList"
                                    :key="index"
                                >
                                    <div class="icon">
                                        <svg
                                            xmlns="http://www.w3.org/2000/svg"
                                            width="14"
                                            height="14"
                                            viewBox="0 0 14 14"
                                            fill="none"
                                        >
                                            <path
                                                d="M11.5252 3.5L5.30301 9.72222L2.47473 6.89394"
                                                stroke="currentColor"
                                                stroke-width="1.6"
                                                stroke-linecap="round"
                                                stroke-linejoin="round"
                                            />
                                        </svg>
                                    </div>
                                    {{ feature }}
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- about-area-end -->
</template>

<script setup>
import { computed } from "vue";
import { Link } from "@inertiajs/vue3";

const props = defineProps({
    about: {
        type: Object,
        required: true,
    },
    counter: {
        type: Object,
        required: true,
    },
    fulltext: {
        type: Boolean,
        required: true,
    },
});

const featuresList = computed(() => {
    return props.about.features
        ? props.about.features.split(",").map((item) => item.trim())
        : [];
});

const textLimit = computed(() => (props.fulltext ? 1000 : 500));

const truncatedDescription = computed(() => {
    if (!props.about.description) return "";
    if (props.about.description.length > textLimit.value) {
        return (
            props.about.description.substring(0, textLimit.value) +
            (props.fulltext ? " - " : "...")
        );
    }
    return props.about.description;
});

const remainingDescription = computed(() => {
    return props.about.description &&
        props.about.description.length > textLimit.value
        ? props.about.description.substring(textLimit.value)
        : "";
});
</script>
