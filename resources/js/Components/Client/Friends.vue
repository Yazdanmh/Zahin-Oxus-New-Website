<template>
    <!-- brand-area -->
    <div class="brand__area">
        <div class="container">
            <div class="swiper-container brand-active fix">
                <div class="swiper-wrapper">
                    <!-- Loop through the friends array and render the brand items dynamically -->
                    <div 
                        class="swiper-slide" 
                        v-for="(friend, index) in friends" 
                        :key="index"
                    >
                        <div class="brand-item">
                            <img :src="'storage/' + friend.image" alt="img" style="width:188px; max-height:42px;object-fit: contain;">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- brand-area-end -->
</template>

<script setup>
const props = defineProps({
    friends: {
        type: Array,
        required: true,
    }
})
</script>
