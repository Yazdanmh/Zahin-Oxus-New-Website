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
                      <li>
                        <a href="https://www.pinterest.com/" target="_blank"
                          ><img
                            src="/frontend/assets/img/icons/pinterest.svg"
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
                  <a href="index.html"
                    ><img
                      :src="'/storage/' + props.setting.site_logo"
                      alt="Logo"
                  /></a>
                </div>
                <div
                  class="tgmenu__navbar-wrap tgmenu__main-menu d-none d-lg-flex"
                >
                  <ul class="navigation">
                    <li><Link href="/">Home</Link></li>

                    <li class="menu-item-has-children">
                      <a href="#">About Us</a>
                      <ul class="sub-menu">
                        <li> <Link :href="route('about.mission')">Our Mission</Link></li>
                        <li><Link :href="route('about.vision')">Our Vision</Link></li>
                        <li>
                          <Link :href="route('home.about')">About ZOCS</Link>
                         
                          
                        </li>
                      </ul>
                    </li>
                    <li><Link :href="route('service.index')">Services</Link></li>
                    <li><a :href="route('trainings.index')">Trainings</a></li>
                

                    <li><Link href="contact-us">Contact</Link></li>
                  </ul>
                </div>
                <div class="tgmenu__action">
                  <ul class="list-wrap">
                    
                    <li class="offCanvas-menu">
                      <a href="#" class="menu-tigger">
                        <span></span>
                        <span></span>
                        <span></span>
                      </a>
                    </li>
                    <li class="header-btn">
                      <a href="contact.html" class="tg-btn"
                        ><img
                          src="/frontend/assets/img/icons/comment.svg"
                          alt=""
                          class="injectable"
                        />
                        Start Consult</a
                      >
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
          <a href="index.html"
            ><img src="/frontend/assets/img/logo/logo.svg" alt="Logo"
          /></a>
        </div>
        <div class="tgmobile__search">
          <form action="#">
            <input type="text" placeholder="Search here..." />
            <button><i class="fas fa-search"></i></button>
          </form>
        </div>
        <div class="tgmobile__menu-outer">
          <!--Here Menu Will Come Automatically Via Javascript / Same Menu as in Header-->
        </div>
        <div class="social-links">
          <ul class="list-wrap">
            <li>
              <a href="#"><i class="fab fa-facebook-f"></i></a>
            </li>
            <li>
              <a href="#"><i class="fab fa-twitter"></i></a>
            </li>
            <li>
              <a href="#"><i class="fab fa-instagram"></i></a>
            </li>
            <li>
              <a href="#"><i class="fab fa-linkedin-in"></i></a>
            </li>
            <li>
              <a href="#"><i class="fab fa-youtube"></i></a>
            </li>
          </ul>
        </div>
      </nav>
    </div>
    <div class="tgmobile__menu-backdrop"></div>
    <!-- End Mobile Menu -->

    <!-- offCanvas-menu -->
    <div class="offCanvas__info">
      <div class="offCanvas__close-icon menu-close">
        <button>
          <img
            src="/frontend/assets/img/icons/times.svg"
            alt=""
            class="injectable"
          />
        </button>
      </div>
      <div class="offCanvas__logo mb-30">
        <a href="index.html"
          ><img :src="'/storage/' + props.setting.site_logo" alt="Logo"
        /></a>
      </div>
      <div class="offCanvas__content">
        <p>
          {{ props.setting.about }}
        </p>
      </div>
   
      <div class="offCanvas__side-info">
        <div class="contact-list">
          <i class="flaticon-placeholder"></i>
          <p>{{ props.setting.address }}</p>
        </div>
        <div class="contact-list">
          <i class="flaticon-telephone"></i>
          <a :href="'tel:' + props.setting.phone">{{ props.setting.phone }}</a>
        </div>
        <div class="contact-list">
          <i class="flaticon-envelope"></i>
          <a :href="'mailto:' + props.setting.email">{{ props.setting.email }}</a>
        </div>
      </div>
      <div class="offCanvas__social">
        <h6 class="title">Follow us</h6>
        <ul class="list-wrap">
          <li>
            <Link :href="props.setting.facebook_url" target="_blank"
              ><img
                src="/frontend/assets/img/icons/facebook.svg"
                alt=""
                class="injectable"
            /></Link>
          </li>
          <li>
            <a href="https://x.com/home" target="_blank"
              ><img
                src="/frontend/assets/img/icons/twitter.svg"
                alt=""
                class="injectable"
            /></a>
          </li>
          <li>
            <a href="https://www.instagram.com/" target="_blank"
              ><img
                src="/frontend/assets/img/icons/instagram.svg"
                alt=""
                class="injectable"
            /></a>
          </li>
          <li>
            <a href="https://www.pinterest.com/" target="_blank"
              ><img
                src="/frontend/assets/img/icons/pinterest.svg"
                alt=""
                class="injectable"
            /></a>
          </li>
        </ul>
      </div>
    </div>
    <div class="offCanvas__overly"></div>
    <!-- offCanvas-menu-end -->
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