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
          <i class="menu-icon tf-icons bx bx-dock-top"></i>
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
        :class="{ 'menu-item': true, active: isActiveRoute('projects.index') }"
      >
        <Link :href="route('projects.index')" class="menu-link">
          <i class="menu-icon tf-icons bx bx-cog"></i>
          <div>Project</div>
        </Link>
      </li>

      <li
        :class="{ 'menu-item': true, active: isActiveRoute('portfolio.index') }"
      >
        <Link :href="route('portfolio.index')" class="menu-link">
          <i class="menu-icon tf-icons bx bx-cog"></i>
          <div>Portfolio</div>
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

// Get current page data
const { url, currentRouteName } = usePage();

// Helper function to check if the route is active
function isActiveRoute(routeName) {
  // Explicitly check for the URL that includes '/admin' + the route name path
  const routePath = route(routeName)
    .replace(window.location.origin, "")
    .replace(/^\/+/, "/"); // Normalize URL
  return url.includes(routePath);
}
</script>
