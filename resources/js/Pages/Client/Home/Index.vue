<template>
  <Head title="Home"/>
  <ClientLayout :setting="props.setting">
    <Hero :hero="props.hero"/>
    <Friends :friends="props.friends"/>
    <About/>
    <Services :services="services"/>
    <CTA />
    <History />
    <Counter :counter="props.counter"/>
    <Video />
    <Projects :projects = "props.projects" :categories="props.categories"/>
    <CTA2 />
    <Testimonial :testimonials="props.testimonials"/>

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
import Projects from "@/Pages/Client/Home/Projects.vue";

const props = defineProps({
  hero: {
    type: Object,  // Changed from Array to Object
    required: true,
  },
  setting:{
    type:Object, 
    required:true, 
  }, 
  friends:{
    type:Object, 
    required:true, 
  }, 
  services:{
    type:Object, 
    required:true, 
  }, 
  counter:{
    type:Object, 
    required:true, 
  }, 
  projects:{
    type:Object, 
    required:true, 
  }, 
  categories:{
    type:Object, 
    required:true, 
  }, 
  testimonials:{
    type:Object, 
    required:true, 
  }, 


}); 
</script>
