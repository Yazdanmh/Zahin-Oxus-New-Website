<template>
    <!-- Hero Section -->
    <section class="hero-section">
        <div class="hero-container" >
            <!-- Text Content -->
            <div class="hero-content" style="padding-top: 50px;">
                <span class="hero-subtitle" 
                      data-aos="fade-up"
                      data-aos-delay="0"
                      v-html="props.hero.subtitle"
                      style=""
                      ></span>
                <h1 class="hero-title"
                    data-aos="fade-up"
                    data-aos-delay="300"
                    v-html="props.hero.title"></h1>
                <p class="hero-description"
                   data-aos="fade-up"
                   data-aos-delay="500"
                   v-html="props.hero.description" style="margin-bottom: 0px;"></p>
                <div v-if="props.hero.button"
                     class="hero-button"
                     data-aos="fade-up"
                     data-aos-delay="700"
                     style="margin-bottom: 40px;">
                    <Link :href="props.hero.link" class="btn-primary">
                        {{ props.hero.button }}
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" viewBox="0 0 16 16">
                            <path fill-rule="evenodd" d="M1 8a.5.5 0 0 1 .5-.5h11.793l-3.147-3.146a.5.5 0 0 1 .708-.708l4 4a.5.5 0 0 1 0 .708l-4 4a.5.5 0 0 1-.708-.708L13.293 8.5H1.5A.5.5 0 0 1 1 8z"/>
                        </svg>
                    </Link>
                </div>
            </div>
            
            <!-- Image Slider - Desktop Only -->
            <div class="hero-slider">
                <div class="slider-container">
                    <!-- Slides -->
                    <div class="slide" 
                         v-for="(image, index) in sliderImages" 
                         :key="index"
                         :class="{ active: activeSlide === index }">
                        <img :src="image" :alt="'Slide ' + (index + 1)">
                    </div>
                </div>
            </div>

            <!-- Gradient Overlay (now below controls) -->
            <div class="gradient-overlay"></div>

            <!-- Controls Container (absolute positioned at bottom) -->
            <div class="slider-controls-container">
                <!-- Navigation Arrows - Left Side -->
                <div class="slider-arrows">
                    <button class="slider-arrow prev" @click="prevSlide">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M15 18l-6-6 6-6"/>
                        </svg>
                    </button>
                </div>

                <!-- Bullet Indicators - Centered -->
                <div class="slider-bullets">
                    <button v-for="(image, index) in sliderImages" 
                            :key="'bullet-' + index"
                            @click="goToSlide(index)"
                            :class="{ active: activeSlide === index }"></button>
                </div>

                <!-- Navigation Arrows - Right Side -->
                <div class="slider-arrows-right">
                    <button class="slider-arrow next" @click="nextSlide">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M9 18l6-6-6-6"/>
                        </svg>
                    </button>
                </div>
            </div>
        </div>
    </section>
</template>

<script setup>
import { Link } from "@inertiajs/vue3";
import { ref, onMounted, onUnmounted } from 'vue';

const props = defineProps({
    hero: {
        type: Object,
        require: true,
    },
});

// Sample slider images - replace with your actual images
const sliderImages = ref([
    '/storage/'+ props.hero.image_1,
    '/storage/'+ props.hero.image_2,
    '/storage/'+ props.hero.image_3,
]);

const activeSlide = ref(0);
let slideInterval;

const nextSlide = () => {
    activeSlide.value = (activeSlide.value + 1) % sliderImages.value.length;
    resetInterval();
};

const prevSlide = () => {
    activeSlide.value = (activeSlide.value - 1 + sliderImages.value.length) % sliderImages.value.length;
    resetInterval();
};

const goToSlide = (index) => {
    activeSlide.value = index;
    resetInterval();
};

const startInterval = () => {
    slideInterval = setInterval(() => {
        nextSlide();
    }, 5000);
};

const resetInterval = () => {
    clearInterval(slideInterval);
    startInterval();
};

onMounted(() => {
    startInterval();
});

onUnmounted(() => {
    clearInterval(slideInterval);
});
</script>

<style scoped>
/* Base Styles */
.hero-section {
    position: relative;
    height: 85vh;
    min-height: 500px;
    max-height: 650px;
    color: #fff;
    overflow: hidden;
}

.hero-container {
    position: relative;
    width: 100%;
    height: 100%;
    display: flex;
}

/* Text Content Styles */
.hero-content {
    position: relative;
    z-index: 3;
    width: 50%;
    padding: 0 5%;
    display: flex;
    flex-direction: column;
    justify-content: center;
}

.hero-subtitle {
    display: block;
    font-size: 1.1rem;
    font-weight: 600;
    color: #4e93ff;
    text-transform: uppercase;
    letter-spacing: 1px;
    margin-bottom: 1rem;
}

.hero-title {
    font-size: 2.5rem;
    font-weight: 700;
    line-height: 1.2;
    margin-bottom: 1.5rem;
    color: white;
}

.hero-title >>> * {
    color: inherit !important;
}

.hero-description {
    font-size: 1.1rem;
    line-height: 1.6;
    color: rgba(255, 255, 255, 0.8);
    margin-bottom: 2rem;
    max-width: 90%;
}

.btn-primary {
    padding: 12px 30px;
    background-color: #0047ff;
    color: white;
    font-weight: 600;
    border-radius: 50px;
    display: inline-flex;
    align-items: center;
    gap: 8px;
    transition: all 0.3s ease;
    border: none;
    cursor: pointer;
}

.btn-primary:hover {
    background-color: #3a7de0;
}

.btn-primary svg {
    transition: transform 0.3s ease;
}

.btn-primary:hover svg {
    transform: translateX(3px);
}

/* Slider Styles */
.hero-slider {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    z-index: 1;
}

.slider-container {
    position: relative;
    width: 100%;
    height: 100%;
}

.slide {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    opacity: 0;
    transition: opacity 0.5s ease;
}

.slide.active {
    opacity: 1;
}

.slide img {
    width: 100%;
    height: 100%;
    object-fit: cover;
}

/* Gradient Overlay */
.gradient-overlay {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: linear-gradient(90deg, 
        rgba(10, 10, 20, 0.95) 0%, 
        rgba(10, 10, 20, 0.85) 30%, 
        rgba(10, 10, 20, 0.5) 60%, 
        rgba(10, 10, 20, 0) 100%);
    z-index: 2;
}

/* Controls Container */
.slider-controls-container {
    position: absolute;
    bottom: 30px;
    left: 0;
    width: 100%;
    display: flex;
    justify-content: center;
    align-items: center;
    gap: 20px;
    padding: 0 30px;
    z-index: 4;
    pointer-events: none;
}

/* Navigation Arrows */
.slider-arrows, .slider-arrows-right {
    display: flex;
    pointer-events: auto;
}

.slider-bullets {
    display: flex;
    gap: 8px;
    pointer-events: auto;
}

.slider-arrow {
    width: 40px;
    height: 40px;
    background: rgba(255, 255, 255, 0.2);
    border: none;
    border-radius: 50%;
    color: white;
    display: flex;
    align-items: center;
    justify-content: center;
    cursor: pointer;
    transition: all 0.3s ease;
    backdrop-filter: blur(5px);
}

.slider-arrow:hover {
    background: rgba(255, 255, 255, 0.4);
}

.slider-arrow svg {
    width: 20px;
    height: 20px;
}

/* Bullet Indicators */
.slider-bullets button {
    width: 12px;
    height: 12px;
    border-radius: 50%;
    border: none;
    background: rgba(255, 255, 255, 0.5);
    cursor: pointer;
    transition: all 0.3s ease;
    padding: 0;
}

.slider-bullets button.active {
    background: white;
    width: 30px;
    border-radius: 6px;
}

/* Responsive Adjustments */
@media (max-width: 992px) {
    .hero-section {
        height: auto;
        min-height: auto;
        max-height: none;
    }
    
    .hero-container {
        flex-direction: column;
    }
    
    .hero-content {
        width: 100%;
        padding: 80px 5% 60px;
        text-align: center;
        background: rgba(10, 10, 20, 0.8);
    }
    
    .hero-description {
        max-width: 100%;
        margin-left: auto;
        margin-right: auto;
    }
    
    .gradient-overlay {
        background: linear-gradient(0deg, 
            rgba(10, 10, 20, 0.9) 0%, 
            rgba(10, 10, 20, 0.7) 50%, 
            rgba(10, 10, 20, 0.4) 80%, 
            rgba(10, 10, 20, 0) 100%);
    }
    
    /* Hide slider and controls on mobile */
    .hero-slider,
    .slider-controls-container {
        display: none;
    }
}

@media (max-width: 768px) {
    .hero-title {
        font-size: 2rem;
    }
    
    .hero-description {
        font-size: 1rem;
    }
    
    .hero-content {
        padding: 60px 5%;
    }
}

@media (max-width: 576px) {
    .hero-title {
        font-size: 1.8rem;
    }
    
    .hero-subtitle {
        font-size: 1rem;
    }
    
    .btn-primary {
        padding: 10px 25px;
        font-size: 0.9rem;
    }
}
</style>