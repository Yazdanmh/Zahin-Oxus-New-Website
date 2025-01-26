<template>
  <aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">
    <div class="app-brand demo">
      <a href="index.html" class="app-brand-link"> Zahin Oxus </a>
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

      <li
        :class="{
          'menu-item': true,
          'active open':
            isActiveRoute('hero.index') ||
            isActiveRoute('friends.index') ||
            isActiveRoute('services.index') ||
            isActiveRoute('testimonails.index') ||
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
            <Link :href="route('hero.index')" class="menu-link">
              <div>Hero</div>
            </Link>
          </li>
          <li
            :class="{
              'menu-item': true,
              active: isActiveRoute('friends.index'),
            }"
          >
            <Link :href="route('friends.index')" class="menu-link">
              <div>Friends</div>
            </Link>
          </li>
          <li
            :class="{
              'menu-item': true,
              active: isActiveRoute('services.index'),
            }"
          >
            <Link :href="route('services.index')" class="menu-link">
              <div>Services</div>
            </Link>
          </li>
          <li
            :class="{
              'menu-item': true,
              active: isActiveRoute('counter.index'),
            }"
          >
            <Link :href="route('counter.index')" class="menu-link">
              <div>Counter</div>
            </Link>
          </li>
          <li
            :class="{
              'menu-item': true,
              active: isActiveRoute('testimonails.index'),
            }"
          >
            <Link :href="route('testimonails.index')" class="menu-link">
              <div>Testimonails</div>
            </Link>
          </li>
        </ul>
      </li>
      <li
        :class="{
          'menu-item': true,
          'active open':
            isActiveRoute('about.index') ||
            isActiveRoute('ourmission') ||
            isActiveRoute('ourvision')
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
            <Link :href="route('about.index')" class="menu-link">
              <div>About ZOCS</div>
            </Link>
          </li>
          <li
            :class="{
              'menu-item': true,
              active: isActiveRoute('ourmission'),
            }"
          >
            <Link :href="route('ourmission')" class="menu-link">
              <div>Our Mission</div>
            </Link>
          </li>
          <li
            :class="{
              'menu-item': true,
              active: isActiveRoute('ourvision'),
            }"
          >
            <Link :href="route('ourvision')" class="menu-link">
              <div>Our Vision</div>
            </Link>
          </li>

        </ul>
      </li>
      <li
        :class="{ 'menu-item': true, active: isActiveRoute('projects.index') }"
      >
        <Link :href="route('projects.index')" class="menu-link">
          <i class="menu-icon tf-icons bx bx-briefcase"></i> <!-- Updated icon -->
          <div>Project</div>
        </Link>
      </li>

      <li
        :class="{ 'menu-item': true, active: isActiveRoute('portfolio.index') }"
      >
        <Link :href="route('portfolio.index')" class="menu-link">
          <i class="menu-icon tf-icons bx bx-archive"></i> <!-- Updated icon -->
          <div>Portfolio</div>
        </Link>
      </li>

      <li
        :class="{ 'menu-item': true, active: isActiveRoute('training.index') }"
      >
        <Link :href="route('training.index')" class="menu-link">
          <i class="menu-icon tf-icons bx bx-book"></i> <!-- Updated icon -->
          <div>Training</div>
        </Link>
      </li>
     


      <li class="menu-header small text-uppercase">
        <span class="menu-header-text">Settings</span>
      </li>

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

const { url, currentRouteName } = usePage();

function isActiveRoute(routeName) {
  const routePath = route(routeName)
    .replace(window.location.origin, "")
    .replace(/^\/+/, "/"); 
  return url.includes(routePath);
}
</script>
