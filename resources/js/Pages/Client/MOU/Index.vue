<template>
    <Head title="MOUs" />
    <ClientLayout :setting="props.setting" :service="props.service_categories">
        <!-- Breadcrumb Section -->
        <Breadcrumb :title="'Memorandums of Understanding (MOUs)'" :nav="nav" />

        <!-- MOU List Section -->
        <section class="mou__list-area py-md-5 py-lg-5">
            <div class="container">
                <div class="row">
                    <div
                        class="col-md-4 col-lg-3 order-2 order-sm-2 order-md-2 order-lg-1"
                    >
                        <!-- Sidebar with information about MOUs -->
                        <aside class="mou__sidebar">
                            <div class="sidebar__widget">
                                <div class="sidebar__contact">
                                    <h4 class="title">Explore Our MOUs</h4>
                                    <p>
                                        Discover our various MOUs with partners,
                                        collaborators, and institutions, and
                                        gain insights into our ongoing projects
                                        and partnerships.
                                    </p>
                                    <Link
                                        :href="route('contact.index')"
                                        class="tg-btn tg-btn-three"
                                    >
                                        Contact With Us
                                        <img
                                            src="/frontend/assets/img/icons/right_arrow.svg"
                                            alt=""
                                            class="injectable"
                                        />
                                    </Link>
                                    <div class="shape">
                                        <img
                                            src="/frontend/assets/img/images/sidebar_contact_shape01.svg"
                                            alt="shape"
                                            class="rotateme"
                                        />
                                        <img
                                            src="/frontend/assets/img/images/sidebar_contact_shape02.svg"
                                            alt="shape"
                                            class="alltuchtopdown"
                                        />
                                    </div>
                                </div>
                            </div>
                        </aside>
                    </div>

                    <div
                        class="col-md-8 col-lg-9 order-sm-1 order-md-1 order-lg-2"
                    >
                        <!-- MOU Listing Section -->
                        <section class="mou__listing">
                            <div class="row justify-content-center">
                                <div class="col-12">
                                    <div class="sidebar__widget">
                                        <h4 class="sidebar__widget-title">
                                            Our MOUs
                                        </h4>
                                        <p>
                                            ZOCS enters into contracts with
                                            well-reputed professional
                                            organizations and individuals to
                                            support its clients with outstanding
                                            products and services. The
                                            cooperation and coordination sphere
                                            of ZOCS also incorporates signing of
                                            Memorandum of Understandings with
                                            financial and non-financial
                                            institutions operating in both
                                            public and private sectors. Numerous
                                            MOUs have been signed with banking
                                            and non-banking financial
                                            institutions and are being
                                            implemented in an effective manner,
                                            enhancing our cooperation and
                                            coordination sphere.
                                        </p>

                                        <!-- MOUs Listing -->
                                        <div
                                            v-if="props.mous.data.length > 0"
                                            class="row"
                                        >
                                            <div
                                                v-for="mou in props.mous.data"
                                                :key="mou.id"
                                                class="col-lg-4 col-md-6 col-sm-12 mb-4"
                                            >
                                                <div class="mou__item">
                                                    <div
                                                        class="mou__item-content"
                                                    >
                                                        <h5>{{ mou.title }}</h5>
                                                        <p>
                                                            {{
                                                                truncatedDescription(
                                                                    mou.parties_involved
                                                                )
                                                            }}
                                                            <span
                                                                v-if="
                                                                    mou
                                                                        .parties_involved
                                                                        .length >
                                                                    250
                                                                "
                                                            >
                                                                <Link
                                                                    :href="'#'"
                                                                    @click.prevent="
                                                                        toggleDescription(
                                                                            mou.id
                                                                        )
                                                                    "
                                                                    class="text-primary"
                                                                >
                                                                    ...
                                                                </Link>
                                                            </span>
                                                        </p>
                                                        <div
                                                            class="d-flex justify-content-between align-items-center"
                                                        >
                                                            <Link
                                                                :href="
                                                                    route(
                                                                        'mous.show',
                                                                        {
                                                                            slug: mou.slug,
                                                                        }
                                                                    )
                                                                "
                                                                class="btn btn-link"
                                                            >
                                                                <i
                                                                    class="bx bx-info-circle"
                                                                ></i>
                                                                View Details
                                                            </Link>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <p v-else class="text-warning">
                                            No MOUs available at the moment.
                                        </p>

                                        <!-- Pagination Links -->
                                        <div
                                            v-if="props.mous.total > 6"
                                            class="pagination__wrap mt-40"
                                        >
                                            <ul class="list-wrap">
                                                <!-- Previous Button (disabled on page 1) -->
                                                <li
                                                    :class="{
                                                        disabled:
                                                            currentPage === 1,
                                                    }"
                                                >
                                                    <Link
                                                        v-if="currentPage > 1"
                                                        :href="`${
                                                            props.mous.path
                                                        }?page=${
                                                            currentPage - 1
                                                        }`"
                                                    >
                                                        <span
                                                            class="bx bx-chevron-left"
                                                        ></span>
                                                    </Link>
                                                </li>

                                                <!-- First Page -->
                                                <li v-if="currentPage > 3">
                                                    <Link
                                                        :href="`${props.mous.path}?page=1`"
                                                        >1</Link
                                                    >
                                                </li>

                                                <!-- Ellipsis before pages -->
                                                <li v-if="currentPage > 4">
                                                    <span>...</span>
                                                </li>

                                                <!-- Loop through Pages (handling page numbers) -->
                                                <li
                                                    v-for="page in displayedPages"
                                                    :key="page"
                                                    :class="{
                                                        active:
                                                            currentPage ===
                                                            page,
                                                    }"
                                                >
                                                    <Link
                                                        :href="`${props.mous.path}?page=${page}`"
                                                        >{{ page }}</Link
                                                    >
                                                </li>

                                                <!-- Ellipsis after pages -->
                                                <li
                                                    v-if="
                                                        currentPage <
                                                        totalPages - 3
                                                    "
                                                >
                                                    <span>...</span>
                                                </li>

                                                <!-- Last Page -->
                                                <li
                                                    v-if="
                                                        currentPage <
                                                        totalPages - 2
                                                    "
                                                >
                                                    <Link
                                                        :href="`${props.mous.path}?page=${totalPages}`"
                                                        >{{ totalPages }}</Link
                                                    >
                                                </li>

                                                <!-- Next Button (disabled on last page) -->
                                                <li
                                                    :class="{
                                                        disabled:
                                                            currentPage ===
                                                            totalPages,
                                                    }"
                                                >
                                                    <Link
                                                        v-if="
                                                            currentPage <
                                                            totalPages
                                                        "
                                                        :href="`${
                                                            props.mous.path
                                                        }?page=${
                                                            currentPage + 1
                                                        }`"
                                                    >
                                                        <span
                                                            class="bx bx-chevron-right"
                                                        ></span>
                                                    </Link>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </section>
                    </div>
                </div>
            </div>
        </section>
    </ClientLayout>
</template>

<script setup>
import { ref, computed } from "vue";
import ClientLayout from "@/Layouts/ClientLayout.vue";
import Breadcrumb from "@/Components/Client/Breadcrumb.vue";
import { useForm, Head, Link } from "@inertiajs/vue3";

// Function to handle truncated description
const truncatedDescription = (description) => {
    if (description.length > 150) {
        return description.slice(0, 250) + "...";
    }
    return description;
};

// Toggle the full description visibility
const toggleDescription = (mouId) => {
    const mou = props.mous.data.find((item) => item.id === mouId);
    mou.showFullDescription = !mou.showFullDescription;
};

const nav = [
    { name: "Home", url: route("home") },
    { name: "MOUs", url: route("mou.index") },
];

const props = defineProps({
    setting: Object,
    mous: {
        type: Object,
        required: true,
    },
    service_categories: {
        type: Object,
        required: true,
    },
});

const currentPage = computed(() => props.mous.current_page);
const totalPages = computed(() => {
    return Math.ceil(props.mous.total / props.mous.per_page);
});

const displayedPages = computed(() => {
    const pages = [];
    const range = 3;

    for (
        let i = Math.max(currentPage.value - range, 1);
        i <= Math.min(currentPage.value + range, totalPages.value);
        i++
    ) {
        pages.push(i);
    }

    return pages;
});
</script>
<style scoped>
.mou__list-area {
    padding-top: 30px;
    padding-bottom: 30px;
}

.mou__item {
    background-color: #fff;
    padding: 20px;
    border-radius: 8px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.09);
    font-weight: bold; /* Make the text a little bolder */
}

.mou__item h5 {
    font-size: 1.25rem;
    font-weight: 700; /* Bold the title more */
    margin-bottom: 10px;
}

.mou__item p {
    color: #555;
}

.mou__item .btn {
    font-size: 0.875rem;
}

.mou__item .btn-outline-primary {
    background-color: #007bff;
    color: white;
    border: 1px solid #007bff;
}

.mou__item .btn-outline-primary:hover {
    background-color: #0056b3;
    border-color: #0056b3;
}

.mou__listing {
    margin-top: 30px;
}

.sidebar__widget-title {
    font-size: 1.5rem;
    font-weight: 600;
}

.sidebar__contact .title {
    font-size: 1.25rem;
    font-weight: 600;
}

.mou__item .d-flex {
    justify-content: flex-end;
}

.text-primary {
    color: #007bff !important;
}

.text-primary:hover {
    text-decoration: underline;
}

/* Additional styles to handle responsive grid items */
@media (min-width: 768px) {
    .mou__item {
        padding: 15px;
    }
}

@media (max-width: 576px) {
    .mou__item {
        padding: 10px;
    }
}
</style>
