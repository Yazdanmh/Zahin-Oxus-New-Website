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
                <li><i class=""></i><a href="/auth/login">Login</a></li>
               
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
                  <Link :href="route('home')" data-aos="fade-right" data-aos-delay="200">
                    <img
                      :src="'/storage/' + props.setting.site_logo"
                      alt="Logo"
                    />
                  </Link>
                  <span class="mx-2 " style='font-weight:bold; color:#1a377c;'>{{props.setting.site_name}}</span>
                </div>
                <div
                  class="tgmenu__navbar-wrap tgmenu__main-menu d-none d-lg-flex"
                >
                  <ul class="navigation">
                    <li :class="{ active: isActiveHome() }">
                      <Link href="/">Home</Link>
                    </li>

                    <!-- About Us Section -->
                    <li
                      :class="{
                        'menu-item-has-children': true,
                        active:
                          isActiveRoute('about.mission') ||
                          isActiveRoute('about.vision') ||
                          isActiveRoute('trainer.index') ||
                          isActiveRoute('home.about'),
                      }"
                    >
                      <a href="#">About Us</a>
                      <ul class="sub-menu">
                        <li
                          :class="{
                            active: isActiveRoute('home.about'),
                          }"
                        >
                          <Link :href="route('home.about')">About ZOCS</Link>
                        </li>
                        <li
                          :class="{
                            active: isActiveRoute('about.mission'),
                          }"
                        >
                          <Link :href="route('about.mission')"
                            >Our Mission</Link
                          >
                        </li>
                        <li
                          :class="{
                            active: isActiveRoute('about.vision'),
                          }"
                        >
                          <Link :href="route('about.vision')">Our Vision</Link>
                        </li>
                 
                        <li
                          :class="{
                            active: isActiveRoute('trainer.index'),
                          }"
                        >
                          <Link :href="route('trainer.index')">Our Teams</Link>
                        </li>
                      </ul>
                    </li>

                    <!-- Academic Section -->
                    <li
                      :class="{
                        'menu-item-has-children': true,
                        active: isActiveRoute('calendar.index'),
                      }"
                    >
                      <a href="#">Academic</a>
                      <ul class="sub-menu">
                        <li
                          :class="{
                            active: isActiveRoute('calendar.index'),
                          }"
                        >
                          <Link :href="route('calendar.index')"
                            >Academic Calendar</Link
                          >
                        </li>
                      </ul>
                    </li>
                    <li
                      :class="{
                        active: isActiveRoute('mous.index'),
                      }"
                    >
                      <Link :href="route('mous.index')">MOU<span style="text-transform: lowercase;">s</span></Link>
                    </li>
                    <!-- Services Section -->
                    <li
                      :class="{
                        'menu-item-has-children': true,
                        active: isActiveService(),
                      }"
                    >
                      <a href="#">Services</a>
                      <ul class="sub-menu" style="min-width:370px;">
                        <li
                          v-for="item in service"
                          :key="item.id"
                          :class="{
                            active: isActiveSlug(item.slug),
                          }"
                        >
                          <Link :href="route('service.category', item.slug)" style="text-transform: none">
                            {{ item.name }}
                          </Link>
                        </li>
                      </ul>
                    </li>

                    <!-- Training Section -->
                    <li
                      :class="{
                        'menu-item-has-children': true,
                        active:
                          isActiveSlug('upcoming') || isActiveSlug('previous'),
                      }"
                    >
                      <a href="#">Trainings</a>
                      <ul class="sub-menu">
                        <li
                          :class="{
                            active: isActiveSlug('upcoming'),
                          }"
                        >
                          <Link :href="route('trainings.category', 'upcoming')">
                            Upcoming
                          </Link>
                        </li>
                        <li
                          :class="{
                            active: isActiveSlug('previous'),
                          }"
                        >
                          <Link :href="route('trainings.category', 'previous')">
                            Completed
                          </Link>
                        </li>
                      </ul>
                    </li>

                    <!-- Media & News Section -->
                    <li
                      :class="{
                        'menu-item-has-children': true,
                        active:
                          isActiveRoute('gallery.index') ||
                          isActiveRoute('events.index'),
                      }"
                    >
                      <a href="#">Media & Events</a>
                      <ul class="sub-menu">
                        <li
                          :class="{
                            active: isActiveRoute('gallery.index'),
                          }"
                        >
                          <Link :href="route('gallery.index')">Gallery</Link>
                        </li>
                        <li
                          :class="{
                            active: isActiveRoute('events.index'),
                          }"
                        >
                          <Link :href="route('events.index')"
                            >News & Events</Link
                          >
                        </li>
                      </ul>
                    </li>
                  </ul>
                </div>
                <div class="tgmenu__action">
                  <ul class="list-wrap">
                    <li class="header-btn" data-aos="fade-left" data-aos-delay="0">
                      <Link
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
                      </Link>
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
          <span class="mx-2 " style='font-weight:bold; color:#1a377c;'>{{props.setting.site_name}}</span>
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
              <a :href="'tel:' + props.setting.phone"
                ><i class="fab fa-whatsapp"></i
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
import { Link, usePage } from "@inertiajs/vue3";

const props = defineProps({
  setting: {
    type: Object,
    required: true,
  },
  service: {
    type: Object,
    required: true,
  },
});

// Access Inertia page data
const { url, currentRouteName, props: pageProps } = usePage();

// Function to check if the current route is active
function isActiveRoute(routeName) {
  const routePath = route(routeName)
    .replace(window.location.origin, "")
    .replace(/^\/+/, "/");

  console.log("Current URL:", url);
  console.log("Route Path for", routeName, ":", routePath);

  // Special case for home route ('/')
  if (routeName === "home" && (url === "/" || url === window.location.origin)) {
    return true;
  }

  return url.includes(routePath);
}
function isActiveService() {
  const urlPath = window.location.pathname.toLowerCase();
  return urlPath.startsWith("/services") || urlPath.includes("/services");
}

// Function to check if it's the home route
function isActiveHome() {
  return url === "/" || url === window.location.origin;
}

function isActiveSlug(slug) {
  return window.location.pathname.includes(slug);
}
</script>

<style scoped>
ul.navigation li ul {
  width: 300px;
}
</style>
