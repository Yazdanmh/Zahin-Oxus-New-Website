<template>
    <Head title="Home" />
    <ClientLayout :setting="props.setting" :service="service_categories">
        <Hero :hero="props.hero" />
        <Friends :friends="props.friends" />
        <About
            :about="props.about"
            :counter="props.counter"
            :fulltext="false"
        />
        <Services :services="services" />
        <CTA />
        <History v-if="props.history" :history="props.history" />
        <Counter :counter="props.counter" />
        <Video />
        <Trainings
            v-if="
                props.trainings &&
                Array.isArray(props.trainings.data) &&
                props.trainings.data.length > 0
            "
            :trainings="props.trainings"
        />
    </ClientLayout>
</template>

<script setup>
import ClientLayout from "@/Layouts/ClientLayout.vue";
import { Head } from "@inertiajs/vue3";
import Hero from "@/Pages/Client/Home/Hero.vue";
import Friends from "@/Components/Client/Friends.vue";
import About from "@/Components/Client/About.vue";
import CTA from "@/Components/Client/CTA.vue";
import CTA2 from "@/Components/Client/CTA2.vue";
import Counter from "@/Components/Client/Counter.vue";
import Testimonial from "@/Components/Client/Testimonial.vue";
import Services from "@/Pages/Client/Home/Services.vue";
import History from "@/Pages/Client/Home/History.vue";
import Video from "@/Pages/Client/Home/Video.vue";
import Trainings from "@/Pages/Client/Home/Trainings.vue";
import Projects from "@/Pages/Client/Home/Projects.vue";
import Teams from "@/Components/Client/Teams.vue";
const props = defineProps({
    teams: {
        type: Object,
        required: true,
    },
    hero: {
        type: Object,
        required: true,
    },
    setting: {
        type: Object,
        required: true,
    },
    friends: {
        type: Object,
        required: true,
    },
    services: {
        type: Object,
        required: true,
    },
    counter: {
        type: Object,
        required: true,
    },
    projects: {
        type: Object,
        required: true,
    },
    categories: {
        type: Object,
        required: true,
    },
    testimonials: {
        type: Object,
        required: true,
    },
    about: {
        type: Object,
        required: true,
    },
    trainings: {
        type: Object,
        required: true,
    },
    history: {
        type: Object,
        required: true,
    },
    service_categories: {
        type: Object,
        required: true,
    },
});
</script>
