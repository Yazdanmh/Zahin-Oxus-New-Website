<template>
  <!-- Scroll-top -->
  <button class="scroll__top scroll-to-target" data-target="html">
    <i class="fas fa-chevron-up"></i>
  </button>
  <!-- Scroll-top-end-->

  <!-- Header -->
  <Header :setting="props.setting" />

  <!-- Main Content -->
  <main>
    <slot></slot>
    
  </main>

  <!-- Footer -->
  <Footer :setting="props.setting"/>
</template>

<script setup>
import { onMounted } from "vue";
import Header from "@/Components/Client/Header.vue";
import Footer from "@/Components/Client/Footer.vue";

const props = defineProps({
  setting:{
    type:Object, 
    required:true, 
  }
})
onMounted(() => {
  const script = document.createElement("script");
  script.src = "/frontend/assets/js/main.js";
  script.async = true; 
  document.head.appendChild(script);

  const script2 = document.createElement("script");
  script2.src = "/frontend/assets/js/bootstrap.min.js";
  script2.async = true;
  document.head.appendChild(script2);
});
</script>
