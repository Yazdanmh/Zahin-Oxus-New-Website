<template>
  <div class="layout-wrapper layout-content-navbar">
      <div class="layout-container">
        <Sidebar/>
        <div class="layout-page">
          <Navbar/>
          <!-- / Navbar -->
          <!-- Content wrapper -->
          <div class="content-wrapper">
      
            <!-- Content -->
              <slot></slot>
            <!-- / Content -->
            <div class="content-backdrop fade"></div>
          </div>
          <!-- Content wrapper -->
        </div>
        <!-- / Layout page -->
      </div>
      <!-- Overlay -->
      <div class="layout-overlay layout-menu-toggle"></div>
    </div>
</template>

<script setup>
import { onMounted } from "vue";
import Sidebar from  "@/Components/Admin/Sidebar.vue"; 
import Navbar from  "@/Components/Admin/Navbar.vue"; 

const props = defineProps({

})
onMounted(() => {
  
});
</script>
