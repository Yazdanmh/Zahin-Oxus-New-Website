<template>
  <aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">
    <div class="app-brand demo" style="height: 100px;">
      <div class="d-flex flex-column">
        <a href="index.html" class="app-brand-link">
          <span class="app-brand-logo demo">
            <img
              :src="'/storage/' + props.setting.site_logo"
              alt=""
              style="width: 50px; height: 50px; border-radius: 50%;"
            />
          </span>
          <br />
        </a>
        <a href="index.html" class="app-brand-link">
          <span class="demo menu-text  text-wrap">{{ props.setting.site_name }}</span>
        </a>
      </div>
      <br />

      <a
        href="javascript:void(0);"
        class="layout-menu-toggle menu-link text-large ms-auto d-xl-none"
      >
        <i class="bx bx-chevron-left bx-sm align-middle"></i>
      </a>
    </div>
    <div class="menu-inner-shadow"></div>
    <ul class="menu-inner py-1">
      <!-- Dashboard -->
      <li
        :class="{ 'menu-item': true, active: isActiveRoute('dashboard.index') }"
      >
        <Link :href="route('dashboard.index')" class="menu-link">
          <i class="menu-icon tf-icons bx bx-home-circle"></i>
          <div>Dashboard</div>
        </Link>
      </li>

      <li class="menu-header small text-uppercase">
        <span class="menu-header-text">Pages</span>
      </li>

      <!-- Home Section -->
      <li
        :class="{
          'menu-item': true,
          'active open':
            isActiveRoute('hero.index') ||
            isActiveRoute('friends.index') ||
            isActiveRoute('services.index') ||
            isActiveRoute('testimonails.index') ||
            isActiveRoute('history.index') ||
            isActiveRoute('counter.index'),
        }"
      >
        <a href="javascript:void(0);" class="menu-link menu-toggle">
          <i class="menu-icon tf-icons bx bx-home-alt"></i>
          <div>Home</div>
        </a>
        <ul class="menu-sub">
          <li
            :class="{ 'menu-item': true, active: isActiveRoute('hero.index') }"
          >
            <Link :href="route('hero.index')" class="menu-link"
              ><div>Hero</div></Link
            >
          </li>
          <li
            :class="{
              'menu-item': true,
              active: isActiveRoute('history.index'),
            }"
          >
            <Link :href="route('history.index')" class="menu-link"
              ><div>History</div></Link
            >
          </li>
          <li
            :class="{
              'menu-item': true,
              active: isActiveRoute('friends.index'),
            }"
          >
            <Link :href="route('friends.index')" class="menu-link"
              ><div>Friends</div></Link
            >
          </li>
          <li
            :class="{
              'menu-item': true,
              active: isActiveRoute('services.index'),
            }"
          >
            <Link :href="route('services.index')" class="menu-link"
              ><div>Services</div></Link
            >
          </li>
          <li
            :class="{
              'menu-item': true,
              active: isActiveRoute('counter.index'),
            }"
          >
            <Link :href="route('counter.index')" class="menu-link"
              ><div>Counter</div></Link
            >
          </li>
          <li
            :class="{
              'menu-item': true,
              active: isActiveRoute('testimonails.index'),
            }"
          >
            <Link :href="route('testimonails.index')" class="menu-link"
              ><div>Testimonials</div></Link
            >
          </li>
        </ul>
      </li>

      <!-- About Section -->
      <li
        :class="{
          'menu-item': true,
          'active open':
            isActiveRoute('about.index') ||
            isActiveRoute('ourmission') ||
            isActiveRoute('ourvision'),
        }"
      >
        <a href="javascript:void(0);" class="menu-link menu-toggle">
          <i class="menu-icon tf-icons bx bx-user"></i>
          <div>About</div>
        </a>
        <ul class="menu-sub">
          <li
            :class="{ 'menu-item': true, active: isActiveRoute('about.index') }"
          >
            <Link :href="route('about.index')" class="menu-link"
              ><div>About ZOCS</div></Link
            >
          </li>
          <li
            :class="{ 'menu-item': true, active: isActiveRoute('ourmission') }"
          >
            <Link :href="route('ourmission')" class="menu-link"
              ><div>Our Mission</div></Link
            >
          </li>
          <li
            :class="{ 'menu-item': true, active: isActiveRoute('ourvision') }"
          >
            <Link :href="route('ourvision')" class="menu-link"
              ><div>Our Vision</div></Link
            >
          </li>
        </ul>
      </li>

      <!-- Media Section (Gallery & News) -->
      <li
        :class="{
          'menu-item': true,
          'active open':
            isActiveRoute('galleries.index') || isActiveRoute('news.index'),
        }"
      >
        <a href="javascript:void(0);" class="menu-link menu-toggle">
          <i class="menu-icon tf-icons bx bxs-image"></i>
          <div>Media</div>
        </a>
        <ul class="menu-sub">
          <li
            :class="{
              'menu-item': true,
              active: isActiveRoute('galleries.index'),
            }"
          >
            <Link :href="route('galleries.index')" class="menu-link"
              ><div>Gallery</div></Link
            >
          </li>
          <li
            :class="{ 'menu-item': true, active: isActiveRoute('news.index') }"
          >
            <Link :href="route('news.index')" class="menu-link"
              ><div>News</div></Link
            >
          </li>
        </ul>
      </li>

      <!-- Educational Resources (Training & Certificates) -->
      <li
        :class="{
          'menu-item': true,
          'active open':
            isActiveRoute('training.index') ||
            isActiveRoute('mou.index') ||
            isActiveRoute('participants.index') ||
            isActiveRoute('certificate.index'),
        }"
      >
        <a href="javascript:void(0);" class="menu-link menu-toggle">
          <i class="menu-icon tf-icons bx bx-book"></i>
          <div>Educational Resources</div>
        </a>
        <ul class="menu-sub">
          <li
            :class="{
              'menu-item': true,
              active: isActiveRoute('training.index'),
            }"
          >
            <Link :href="route('training.index')" class="menu-link"
              ><div>Training</div></Link
            >
          </li>
          <li
            :class="{
              'menu-item': true,
              active: isActiveRoute('mou.index'),
            }"
          >
            <Link :href="route('mou.index')" class="menu-link"
              ><div>MOU</div></Link
            >
          </li>
          <li
            :class="{
              'menu-item': true,
              active: isActiveRoute('participants.index'),
            }"
          >
            <Link :href="route('participants.index')" class="menu-link"
              ><div>Participants</div></Link
            >
          </li>
          <li
            :class="{
              'menu-item': true,
              active: isActiveRoute('certificate.index'),
            }"
          >
            <Link :href="route('certificate.index')" class="menu-link"
              ><div>Certificates</div></Link
            >
          </li>
        </ul>
      </li>

      <!-- Projects -->
      <li
        :class="{ 'menu-item': true, active: isActiveRoute('projects.index') }"
      >
        <Link :href="route('projects.index')" class="menu-link">
          <i class="menu-icon tf-icons bx bx-briefcase"></i>
          <div>Project</div>
        </Link>
      </li>

      <!-- Portfolio -->
      <li
        :class="{ 'menu-item': true, active: isActiveRoute('portfolio.index') }"
      >
        <Link :href="route('portfolio.index')" class="menu-link">
          <i class="menu-icon tf-icons bx bx-archive"></i>
          <div>Portfolio</div>
        </Link>
      </li>

      <!-- Academic Calendar -->
      <li
        :class="{ 'menu-item': true, active: isActiveRoute('calendars.index') }"
      >
        <Link :href="route('calendars.index')" class="menu-link">
          <i class="menu-icon tf-icons bx bxs-calendar"></i>
          <div>Academic Calendar</div>
        </Link>
      </li>

      <li class="menu-header small text-uppercase">
        <span class="menu-header-text">Settings</span>
      </li>

      <!-- Settings -->
      <li
        :class="{ 'menu-item': true, active: isActiveRoute('settings.index') }"
      >
        <Link :href="route('settings.index')" class="menu-link">
          <i class="menu-icon tf-icons bx bx-cog"></i>
          <div>Settings</div>
        </Link>
      </li>
    </ul>
  </aside>
</template>

<script setup>
import { Link, usePage } from "@inertiajs/vue3";

const props = defineProps({
  setting: {
    type: Object,
    required: true,
  },
});
const { url, currentRouteName } = usePage();

function isActiveRoute(routeName) {
  const routePath = route(routeName)
    .replace(window.location.origin, "")
    .replace(/^\/+/, "/");
  return url.includes(routePath);
}
</script>
