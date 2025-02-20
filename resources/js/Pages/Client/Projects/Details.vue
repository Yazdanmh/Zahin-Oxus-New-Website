<template>
    <Head :title="props.project.name" />
    <ClientLayout :setting="props.setting">
        <Breadcrumb :title="'Our Projects'" :nav="nav" />
        <!-- project-details-area -->
        <section class="project__details-area section-py-130">
            <div class="container">
                <div class="row">
                    <div class="col-70">
                        <div class="project__details-wrap">
                            <div class="project__details-thumb">
                                <img
                                    :src="'/storage/' + props.project.image"
                                    alt="img"
                                />
                            </div>
                            <div class="project__details-content">
                                <h2 class="title">{{ props.project.name }}</h2>
                                <p v-html="props.project.description"></p>
                            </div>
                        </div>
                    </div>
                    <div class="col-30">
                        <aside class="project__sidebar">
                            <div class="sidebar__widget">
                                <div class="project__details-info-wrap">
                                    <h4 class="sidebar__widget-title">
                                        Project Information
                                    </h4>
                                    <ul class="list-wrap">
                                        <li>
                                            <p>
                                                <span>Category:</span> <br />{{
                                                    getCategoryTitle(
                                                        props.project
                                                            .category_id
                                                    )
                                                }}
                                            </p>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <div class="sidebar__widget">
                                <div class="project__details-contact">
                                    <a href="tel:0123456789"
                                        ><i class="flaticon-phone-call"></i
                                        >{{ props.setting.phone }}</a
                                    >
                                    <a href="mailto:info@gmail.com"
                                        ><i class="flaticon-envelope"></i
                                        >{{ props.setting.email }}</a
                                    >
                                </div>
                            </div>
                        </aside>
                    </div>
                </div>
            </div>
        </section>
        <!-- project-details-area-end -->
    </ClientLayout>
</template>

<script setup>
import { Link } from "@inertiajs/vue3";
import ClientLayout from "@/Layouts/ClientLayout.vue";
import { Head } from "@inertiajs/vue3";
import Breadcrumb from "@/Components/Client/Breadcrumb.vue";

const props = defineProps({
    setting: {
        type: Object,
        required: true,
    },
    project: {
        type: Object,
        required: true,
    },
    categories: {
        type: Object,
        required: true,
    },
});

const nav = [
    { name: "Home", url: "/" },
    { name: "Projects", url: route("project.index") },
    { name: props.project.name, url: "" },
];
const getCategoryTitle = (categoryId) => {
    const category = props.categories.find((cat) => cat.id === categoryId);
    return category ? category.title : "Unknown Category";
};
</script>
