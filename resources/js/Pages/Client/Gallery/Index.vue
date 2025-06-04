<template>
  <Head title="Gallery" />
  <ClientLayout :setting="props.setting" :service="props.service_categories">
    <Breadcrumb :title="'Gallery'" :nav="nav" />

    <!-- services-area -->
    <section
      class="services__area section-py-130"
      style="background-color: rgba(234, 240, 255, 0.3)"
    >
      <div class="container">
        <div class="row justify-content-center">
          <div class="col-lg-10">
            <div class="section__title text-center mb-40">
              <span class="sub-title">Gallery Showcase</span>
              <h2 class="title">Capturing Moments</h2>
              <p>
                Explore our collection of images that capture the essence of
                creativity and beauty. Each image tells a unique story of
                excellence.
              </p>
            </div>
          </div>
        </div>

        <!-- Gallery Section -->
        <div v-if="props.gallery && props.gallery.length > 0" class="row gutter-y-30 justify-content-center mt-3">
          <div class="container py-6">
            <!-- Gallery Grid -->
            <div class="gallery-grid">
              <div
                v-for="image in images"
                :key="image.id"
                class="gallery-item"
                @click="openPreview(image)"
              >
                <img
                  :src="'/storage/' + image.image"
                  :alt="image.title"
                  class="gallery-image"
                  style="height: 200px"
                />
                <div class="image-overlay">
                  <div class="image-title">{{ image.title }}</div>
                </div>
              </div>
            </div>

            <!-- Preview Modal -->
            <div
              v-if="previewImage"
              class="preview-modal"
              @click="closePreview"
            >
              <div class="modal-content" @click.stop>
                <button class="close-btn" @click="closePreview">&times;</button>
                <button class="prev-btn" @click="showPrevious">&lt;</button>
                <img
                  :src="'/storage/' + previewImage.image"
                  :alt="previewImage.title"
                  class="preview-image"
                />
                <div class="preview-title">{{ previewImage.title }}</div>
                <button class="next-btn" @click="showNext">&gt;</button>
              </div>
            </div>
          </div>
        </div>

        <!-- No Images Message -->
        <div v-else class="text-center">
          <p class="text-warning">We're in the process of capturing amazing moments — check back soon to explore our gallery.</p>
        </div>
      </div>
    </section>
    <!-- services-area-end -->
  </ClientLayout>
</template>


<script setup>
import { ref } from "vue";
import ClientLayout from "@/Layouts/ClientLayout.vue";
import Breadcrumb from "@/Components/Client/Breadcrumb.vue";
import { Head } from "@inertiajs/vue3";

const props = defineProps({
  setting: {
    type: Object,
    required: true,
  },
  gallery: {
    type: Array,
    required: true,
  },
    service_categories: {
    type: Object,
    required: true,
  },
});

const nav = [
  { name: "Home", url: route("home") },
  { name: "Gallery", url: route("gallery.index") },
];

const previewImage = ref(null);
const currentIndex = ref(null);

// Images are dynamically populated from the gallery prop
const images = ref(props.gallery);

function openPreview(image) {
  currentIndex.value = images.value.findIndex((img) => img.id === image.id);
  previewImage.value = image;
}

function closePreview() {
  previewImage.value = null;
}

function showPrevious() {
  if (currentIndex.value > 0) {
    currentIndex.value--;
    previewImage.value = images.value[currentIndex.value];
  }
}

function showNext() {
  if (currentIndex.value < images.value.length - 1) {
    currentIndex.value++;
    previewImage.value = images.value[currentIndex.value];
  }
}
</script>


  
<style scoped>
.container {
  max-width: 1200px;
  margin: 0 auto;
}

.gallery-grid {
  display: grid;
  grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
  gap: 1.5rem;
}

.gallery-item {
  position: relative;
  cursor: pointer;
  overflow: hidden;
  border-radius: 0.5rem;
}

.gallery-image {
  width: 100%;
  max-height: 200px;
  transition: transform 0.3s;
  object-fit: cover;
}

.gallery-item:hover .gallery-image {
  transform: scale(1.1);
}

.image-overlay {
  position: absolute;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  background: rgba(0, 0, 0, 0.5);
  display: flex;
  justify-content: center;
  align-items: center;
  opacity: 0;
  transition: opacity 0.3s;
}

.gallery-item:hover .image-overlay {
  opacity: 1;
}

.image-title {
  color: white;
  font-size: 1.25rem;
  text-align: center;
  font-weight: bold;
}

.preview-modal {
  position: fixed;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  background: rgba(0, 0, 0, 0.8);
  display: flex;
  justify-content: center;
  align-items: center;
  z-index: 1000;
}

.modal-content {
  position: relative;
  max-width: 90%;
  max-height: 90%;
  text-align: center;
}

.close-btn {
  position: absolute;
  top: 1rem;
  right: 1rem;
  background: none;
  border: none;
  font-size: 2rem;
  color: white;
  cursor: pointer;
}

.prev-btn,
.next-btn {
  position: absolute;
  top: 50%;
  transform: translateY(-50%);
  background: rgba(0, 0, 0, 0.5);
  border: none;
  color: white;
  font-size: 2rem;
  cursor: pointer;
  padding: 0.5rem 1rem;
  border-radius: 0.5rem;
}

.prev-btn {
  left: 1rem;
}

.next-btn {
  right: 1rem;
}

.preview-image {
  max-width: 800px;
  height: 80vh;
  border-radius: 0.5rem;
  margin: auto;
  object-fit: contain;
}

.preview-title {
  margin-top: 1rem;
  color: white;
  font-size: 1.25rem;
}
</style>
  