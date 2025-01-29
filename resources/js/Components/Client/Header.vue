<template>
  <!-- header-area -->
  <header>
    <div class="tg-header__top">
      <div class="container custom-container">
        <div class="row align-items-center">
          <div class="col-lg-7">
            <div class="tg-header__top-info">
              <ul class="list-wrap">
                <li v-if="props.setting.address">
                  <i class="flaticon-placeholder"></i
                  >{{ props.setting.address }}
                </li>
                <li v-if="props.setting.email">
                  <i class="flaticon-envelope"></i
                  ><a href="mailto:info@gmail.com">{{ props.setting.email }}</a>
                </li>
              </ul>
            </div>
          </div>

          <div class="col-lg-5">
            <div class="tg-header__top-right">
              <ul class="list-wrap">
                <li v-if="props.setting.phone">
                  <i class="flaticon-telephone"></i
                  ><a href="tel:0123456789">{{ props.setting.phone }}</a>
                </li>
                <li>
                  <div class="tg-header__top-social">
                    <ul class="list-wrap">
                      <li>
                        <a :href="props.setting.facebook_url" target="_blank"
                          ><img
                            src="/frontend/assets/img/icons/facebook.svg"
                            alt=""
                            class="injectable"
                        /></a>
                      </li>
                      <li>
                        <a :href="props.setting.twitter_url" target="_blank"
                          ><img
                            src="/frontend/assets/img/icons/twitter.svg"
                            alt=""
                            class="injectable"
                        /></a>
                      </li>
                      <li>
                        <a :href="props.setting.instagram_url" target="_blank"
                          ><img
                            src="/frontend/assets/img/icons/instagram.svg"
                            alt=""
                            class="injectable"
                        /></a>
                      </li>
                    </ul>
                  </div>
                </li>
              </ul>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div id="header-fixed-height"></div>
    <div id="sticky-header" class="tg-header__area">
      <div class="container custom-container">
        <div class="row">
          <div class="col-12">
            <div class="tgmenu__wrap">
              <nav class="tgmenu__nav">
                <div class="logo">
                  <Link :href="route('home')"
                    ><img
                      :src="'/storage/' + props.setting.site_logo"
                      alt="Logo"
                  /></Link>
                </div>
                <div
                  class="tgmenu__navbar-wrap tgmenu__main-menu d-none d-lg-flex"
                >
                  <ul class="navigation">
                    <li><Link href="/">Home</Link></li>

                    <li class="menu-item-has-children">
                      <a href="#">About Us</a>
                      <ul class="sub-menu">
                        <li>
                          <Link :href="route('about.mission')"
                            >Our Mission</Link
                          >
                        </li>
                        <li>
                          <Link :href="route('about.vision')">Our Vision</Link>
                        </li>
                        <li>
                          <Link :href="route('home.about')">About ZOCS</Link>
                        </li>
                      </ul>
                    </li>
                    <li>
                      <Link :href="route('service.index')">Services</Link>
                    </li>
                    <li><a :href="route('calendar.index')">Academic Calendar</a></li>
                    <li><a :href="route('trainings.index')">Trainings</a></li>

                    <li><Link :href="route('gallery.index')">Gallery</Link></li>
                    <li><Link :href="route('events.index')">Events</Link></li>
                  </ul>
                </div>
                <div class="tgmenu__action">
                  <ul class="list-wrap">
                    <li class="header-btn">
                      <a
                        :href="route('certificate.verify')"
                        class="tg-btn"
                        data-toggle="popover"
                        title="Verify Certificate"
                        data-content="Click here to verify your certificate and achievements."
                      >
                        <img
                          src="/frontend/assets/img/icons/checklist (1).png"
                          alt=""
                        />
                        Verify Certificate
                      </a>
                    </li>
                  </ul>
                </div>
                <div class="mobile-nav-toggler">
                  <i class="tg-flaticon-menu"></i>
                </div>
              </nav>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- Mobile Menu  -->
    <div class="tgmobile__menu">
      <nav class="tgmobile__menu-box">
        <div class="close-btn"><i class="tg-flaticon-close-1"></i></div>
        <div class="nav-logo">
          <a :href="route('home')"
            ><img
              :src="'/storage/' + props.setting.site_logo"
              alt="Logo"
              style="max-width: 50px"
          /></a>
        </div>
        <div class="p-2">
          <a
            :href="route('certificate.verify')"
            class="tg-btn"
            data-toggle="popover"
            title="Verify Certificate"
            data-content="Click here to verify your certificate and achievements."
          >
            <img src="/frontend/assets/img/icons/checklist (1).png" alt="" />
            Verify Certificate
          </a>
        </div>
        <div class="tgmobile__menu-outer">
          <!--Here Menu Will Come Automatically Via Javascript / Same Menu as in Header-->
        </div>
        <div class="social-links">
          <ul class="list-wrap">
            <li>
              <a :href="props.setting.facebook_url"
                ><i class="fab fa-facebook-f"></i
              ></a>
            </li>
            <li>
              <a :href="props.setting.twitter_url"
                ><i class="fab fa-twitter"></i
              ></a>
            </li>
            <li>
              <a :href="props.setting.instagram_url"
                ><i class="fab fa-instagram"></i
              ></a>
            </li>
            <li>
              <a :href="props.setting.youtube_url"
                ><i class="fab fa-youtube"></i
              ></a>
            </li>
          </ul>
        </div>
      </nav>
    </div>
    <div class="tgmobile__menu-backdrop"></div>
    <!-- End Mobile Menu -->
  </header>
  <!-- header-area-end -->
</template>
<script setup>
import { Link } from "@inertiajs/vue3";
const props = defineProps({
  setting: {
    type: Object,
    required: true,
  },
});
</script>

<style scoped>
</style>