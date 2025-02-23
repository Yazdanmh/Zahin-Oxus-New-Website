<template>
    <!-- choose-area -->
    <section class="choose__area section-py-130 " style="margin-bottom: 100px;">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6 order-0 order-lg-2">
                    <div class="choose__img-wrap">
                        <img :src="'/storage/' + props.ceo.image" alt="img" style="width:500px;" data-aos="fade-up" data-aos-delay="400">
                        <img src="/frontend/assets/img/images/choose_shape02.svg" alt="shape" class="shape-two rotateme">
                        <img src="/frontend/assets/img/images/choose_shape03.svg" alt="shape" class="shape-three">
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="choose__content">
                        <div class="section__title mb-20">
                            <span class="sub-title">Learn About CEO</span>
                            <h2 class="title">{{ props.ceo.name }}</h2>
                        </div>
                        <p v-if="!showFullDescription">
                            {{ truncatedDescription }}
                            <span class="read-more">...</span>
                        </p>
                       
                        
                     
                        <Link :href="route('ceo.show', props.ceo.slug)" class="tg-btn" data-aos="fade-right" data-aos-delay="400">
                            Read More <img src="/frontend/assets/img/icons/right_arrow.svg" alt="" class="injectable">
                        </Link>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- choose-area-end -->
</template>

<script setup>
import { Link } from '@inertiajs/vue3';
import { defineProps, ref, computed } from 'vue';

const props = defineProps({
    ceo: {
        type: Object,
        required: true,
    }
});

const MAX_DESCRIPTION_LENGTH = 500;
let showFullDescription = ref(false);

// Computed property to get the truncated description
const truncatedDescription = computed(() => {
    if (props.ceo.description.length > MAX_DESCRIPTION_LENGTH) {
        return props.ceo.description.substring(0, MAX_DESCRIPTION_LENGTH);
    }
    return props.ceo.description;
});

// Function to toggle the full description
const toggleDescription = () => {
    showFullDescription.value = !showFullDescription.value;
};
</script>

<style scoped>

</style>
