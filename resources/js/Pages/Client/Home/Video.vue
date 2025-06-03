<template>
    <!-- video-area -->
    <section class="video__area">
        <div
            class="video__bg"
            data-background="/frontend/assets/img/bg/video_bg.webp"
        ></div>
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-5 order-0 order-lg-2">
                    <div class="video__btn">
                        <a
                            data-aos="fade-up"
                            data-aos-delay="200"
                            href="#"
                            class="play__btn popup-video"
                        >
                            <img
                                class="rotate-on-scroll"
                                src="/frontend/assets/img/images/play_video.svg"
                                alt=""
                            />
                        </a>
                    </div>
                </div>
                <div class="col-lg-7">
                    <div class="video__content">
                        <span class="sub-title">Let’s Make A Tour</span>
                        <h2 class="title">
                            Offering The Best Experience Of Business Consulting
                        </h2>
                        <p>
                            Transform your business with our transformative
                            consulting solutions. We go beyond short-term fixes
                            to deliver lasting results
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- video-area-end -->
</template>
<style scoped>
/* Initial state of the image (not rotated) */
.rotate-on-scroll {
    transform: rotate(180deg);
    transition: transform 5s ease; /* Smooth transition for rotation */
}

/* Apply the rotation effect when AOS triggers the animation */
[data-aos="fade-up"].aos-animate .rotate-on-scroll {
    transform: rotate(360deg); /* Rotate 90 degrees when in view */
}
</style>
