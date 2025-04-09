<template>
    <aside
        id="layout-menu"
        class="layout-menu menu-vertical menu bg-menu-theme"
    >
        <div class="app-brand demo" style="height: 100px">
            <div class="d-flex flex-column">
                <Link class="app-brand-link">
                    <span class="app-brand-logo demo">
                        <img
                            :src="'/storage/' + props.setting.site_logo"
                            alt=""
                            style="
                                width: 50px;
                                height: 50px;
                             
                            "
                        />
                    </span>
                    <br />
                </Link>
                <Link :href="route('dashboard')" class="app-brand-link">
                    <span class="demo menu-text text-wrap">{{
                        props.setting.site_name
                    }}</span>
                </Link>
            </div>
            <br />
            <a
                href="javascript:void(0);"
                class="layout-menu-toggle menu-link text-large ms-auto d-xl-none close-menu"
            >
                <i class="bx bx-chevron-left bx-sm align-middle"></i>
            </a>
        </div>
        <div class="menu-inner-shadow"></div>
        <ul class="menu-inner py-1">
            <!-- Dashboard -->
            <li
                :class="{
                    'menu-item': true,
                    active: isActiveRoute('dashboard'),
                }"
            >
                <Link :href="route('dashboard')" class="menu-link">
                    <i class="menu-icon tf-icons bx bx-home-circle"></i>
                    <div>Dashboard</div>
                </Link>
            </li>

            <li class="menu-header small text-uppercase">
                <span class="menu-header-text">Pages</span>
            </li>

            <!-- Home Section -->
            <li
                v-if="hasPermission('site_data.view')"
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
                        :class="{
                            'menu-item': true,
                            active: isActiveRoute('hero.index'),
                        }"
                    >
                        <Link :href="route('hero.index')" class="menu-link">
                            <div>Hero</div>
                        </Link>
                    </li>
                    <li
                        :class="{
                            'menu-item': true,
                            active: isActiveRoute('history.index'),
                        }"
                    >
                        <Link :href="route('history.index')" class="menu-link">
                            <div>History</div>
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
                        <Link
                            :href="route('testimonails.index')"
                            class="menu-link"
                        >
                            <div>Testimonials</div>
                        </Link>
                    </li>
                </ul>
            </li>

            <!-- About Section -->
            <li
                v-if="hasPermission('site_data.view')"
                :class="{
                    'menu-item': true,
                    'active open':
                        isActiveRoute('about.index') ||
                        isActiveRoute('ourmission') ||
                        isActiveRoute('ceo.index') ||
                        isActiveRoute('ourvision'),
                }"
            >
                <a href="javascript:void(0);" class="menu-link menu-toggle">
                    <i class="menu-icon tf-icons bx bx-user"></i>
                    <div>About</div>
                </a>
                <ul class="menu-sub">
                    <li
                        :class="{
                            'menu-item': true,
                            active: isActiveRoute('about.index'),
                        }"
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
                    <li
                        :class="{
                            'menu-item': true,
                            active: isActiveRoute('ceo.index'),
                        }"
                    >
                        <Link :href="route('ceo.index')" class="menu-link">
                            <div>CEO</div>
                        </Link>
                    </li>
                </ul>
            </li>

            <!-- Media Section (Gallery & News) -->
            <li
                v-if="
                    hasPermission('events.view') ||
                    hasPermission('gallery.view')
                "
                :class="{
                    'menu-item': true,
                    'active open':
                        isActiveRoute('galleries.index') ||
                        isActiveRoute('news.index'),
                }"
            >
                <a href="javascript:void(0);" class="menu-link menu-toggle">
                    <i class="menu-icon tf-icons bx bxs-image"></i>
                    <div>Media</div>
                </a>
                <ul class="menu-sub">
                    <li
                        v-if="hasPermission('gallery.view')"
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
                        v-if="hasPermission('events.view')"
                        :class="{
                            'menu-item': true,
                            active: isActiveRoute('news.index'),
                        }"
                    >
                        <Link :href="route('news.index')" class="menu-link"
                            ><div>News</div></Link
                        >
                    </li>
                </ul>
            </li>

            <!-- Educational Resources (Training & Certificates) -->
            <li
                v-if="
                    hasPermission('training.view') ||
                    hasPermission('certificate.view')
                "
                :class="{
                    'menu-item': true,
                    'active open':
                        isActiveRoute('training.index') ||
                        isActiveRoute('participants.index') ||
                        isActiveRoute('trainers.index') ||
                        isActiveRoute('certificate.index'),
                }"
            >
                <a href="javascript:void(0);" class="menu-link menu-toggle">
                    <i class="menu-icon tf-icons bx bx-book"></i>
                    <div>Educational Resources</div>
                </a>
                <ul class="menu-sub">
                    <li
                        v-if="hasPermission('training.view')"
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
                        v-if="hasPermission('training.view')"
                        :class="{
                            'menu-item': true,
                            active: isActiveRoute('trainers.index'),
                        }"
                    >
                        <Link :href="route('trainers.index')" class="menu-link"
                            ><div>Trainer</div></Link
                        >
                    </li>

                    <li
                        v-if="hasPermission('training.view')"
                        :class="{
                            'menu-item': true,
                            active: isActiveRoute('participants.index'),
                        }"
                    >
                        <Link
                            :href="route('participants.index')"
                            class="menu-link"
                            ><div>Participants</div></Link
                        >
                    </li>
                    <li
                        v-if="hasPermission('certificate.view')"
                        :class="{
                            'menu-item': true,
                            active: isActiveRoute('certificate.index'),
                        }"
                    >
                        <Link
                            :href="route('certificate.index')"
                            class="menu-link"
                            ><div>Certificates</div></Link
                        >
                    </li>
                </ul>
            </li>

            <!-- MOUs -->
            <li
                v-if="hasPermission('MOUs.view')"
                :class="{
                    'menu-item': true,
                    active: isActiveRoute('mou.index'),
                }"
            >
                <Link :href="route('mou.index')" class="menu-link">
                    <i class="menu-icon tf-icons bx bx-file"></i>
                    <div>MOUs</div>
                </Link>
            </li>

            <!-- Projects -->
            <li
                v-if="hasPermission('projects.view')"
                :class="{
                    'menu-item': true,
                    active: isActiveRoute('projects.index'),
                }"
            >
                <Link :href="route('projects.index')" class="menu-link">
                    <i class="menu-icon tf-icons bx bx-briefcase"></i>
                    <div>Project</div>
                </Link>
            </li>

            <!-- Academic Calendar -->
            <li
                v-if="hasPermission('site_data.view')"
                :class="{
                    'menu-item': true,
                    active: isActiveRoute('calendars.index'),
                }"
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
                v-if="hasPermission('site_data.view') || hasPermission('users.view') || hasPermission('roles.view')"
                :class="{
                    'menu-item': true,
                    'active open':
                        isActiveRoute('roles.index') ||
                        isActiveRoute('users.index') ||
                        isActiveRoute('settings.index'),
                }"
            >
                <a href="javascript:void(0);" class="menu-link menu-toggle">
                    <i class="menu-icon tf-icons bx bx-cog"></i>
                    <div>Setting</div>
                </a>
                <ul class="menu-sub">
                    <li
                        v-if="hasPermission('roles.view')"
                        :class="{
                            'menu-item': true,
                            active: isActiveRoute('roles.index'),
                        }"
                    >
                        <Link :href="route('roles.index')" class="menu-link"
                            ><div>Roles</div></Link
                        >
                    </li>
                    <li
                        v-if="hasPermission('users.view')"
                        :class="{
                            'menu-item': true,
                            active: isActiveRoute('users.index'),
                        }"
                    >
                        <Link :href="route('users.index')" class="menu-link"
                            ><div>Users</div></Link
                        >
                    </li>
                    <li
                        v-if="hasPermission('site_data.view')"
                        :class="{
                            'menu-item': true,
                            active: isActiveRoute('settings.index'),
                        }"
                    >
                        <Link :href="route('settings.index')" class="menu-link"
                            ><div>Settings</div></Link
                        >
                    </li>
                    <li
                        v-if="hasPermission('system.backup')"
                        :class="{
                            'menu-item': true,
                            active: isActiveRoute('settings.index'),
                        }"
                    >
                        <Link :href="route('backup.index')" class="menu-link"
                            ><div>Backup</div></Link
                        >
                    </li>
                </ul>
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
    permissions: {
        type: Array,
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
const hasPermission = (permission) => {
    return props.permissions.includes(permission);
};
</script>
