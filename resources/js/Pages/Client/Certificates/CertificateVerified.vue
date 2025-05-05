<template>
    <Head
        :title="
            props.verified ? 'Certificate Verified' : 'Certificate Not Found'
        "
    />
    <ClientLayout :setting="props.setting" :service="props.service_categories">
        <!-- Breadcrumb Section -->
        <Breadcrumb :title="'Certificate Verification'" :nav="nav" />

        <!-- Certificate Verification Section -->
        <section class="certificate__details-area py-md-5 py-lg-5">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-lg-8 mb-3">
                        <div
                            :class="[
                                'certificate__layout',
                                props.verified ? 'verified' : 'not-found',
                            ]"
                        >
                            <div class="certificate__header">
                                <h2 class="title">
                                    {{
                                        props.verified
                                            ? "Certificate Verified"
                                            : "Certificate Not Found"
                                    }}
                                </h2>
                            </div>

                            <div
                                class="certificate__content d-flex flex-column align-items-center justify-content-center"
                            >
                                <div
                                    v-if="props.verified"
                                    class="certificate__details"
                                >
                                    <p class="certificate__text" style="font-size: 18px;">
                                        This certificate was awarded to
                                        <strong>{{
                                            props.certificate.for_who
                                        }}</strong>
                                        for successfully completing the
                                        <strong>{{
                                            props.certificate.training.name
                                        }}</strong>
                                        training program.
                                    </p>
                                    <p class="certificate__text" style="font-size: 14px;">
                                        <strong>Issued on:</strong>
                                        {{ formatDate(props.certificate.issue_date) }}<br />
                                        
                                    </p>
                                </div>
                                <p v-else class="certificate__text">
                                    We couldn't find this certificate in our
                                    records. Please double-check the certificate
                                    ID and try again. If you believe this is an
                                    error, please contact our support team.
                                </p>
                            </div>
                        </div>
                    </div>
                    <!-- Sidebar Section -->
                    <div class="col-lg-4 mt-4">
                        <aside class="certificate__sidebar">
                            <div class="sidebar__widget">
                                <div class="sidebar__contact">
                                    <h4 class="title">Need Assistance?</h4>
                                    <p>
                                        If you have any questions regarding the
                                        verification process, feel free to
                                        contact us.
                                    </p>
                                    <Link
                                        :href="route('contact.index')"
                                        class="tg-btn tg-btn-three"
                                    >
                                        Contact Us
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
                </div>
            </div>
        </section>
    </ClientLayout>
</template>

<script setup>
import ClientLayout from "@/Layouts/ClientLayout.vue";
import { Head, Link } from "@inertiajs/vue3";
import Breadcrumb from "@/Components/Client/Breadcrumb.vue";

const props = defineProps({
    setting: {
        type: Object,
        required: true,
    },
    certificate: {
        type: Object,
        required: false,
    },
    verified: {
        type: Boolean,
        required: true,
    },
    message: {
        type: String,
        required: false,
    },
    service_categories: {
        type: Object,
        required: true,
    },
});
const formatDate = (dateString) => {
    const date = new Date(dateString);
    const day = date.getDate();
    const month = date.toLocaleString('default', { month: 'short' });
    const year = date.getFullYear();
    return `${day} ${month}, ${year}`;
};
// Adjust nav structure to handle the breadcrumb navigation
const nav = [
    { name: "Home", url: route("home") },
    { name: "Certificate Verification", url: route("certificate.verify") },
    { name: "Verification Result", url: route("certificate.verify") },
];
</script>

<style scoped>
.certificate__layout {
    margin-top: 30px;
    border: 2px dashed #ddd;
    padding: 30px;
    border-radius: 10px;
    background: #f9f9f9;
    text-align: center;
    box-shadow: 0 5px 10px rgba(0, 0, 0, 0.1);
}
.certificate__layout.verified {
    border-color: #4caf50;
}
.certificate__layout.not-found {
    border-color: #f44336;
}
.certificate__header {
    margin-bottom: 20px;
}
.certificate__text {
    font-size: 1.2rem;
    line-height: 1.6;
    margin-bottom: 10px;
    color: #333;
}
.certificate__download {
    margin-top: 20px;
}
.tg-btn {
    display: inline-block;
    padding: 10px 20px;
    background-color: #007bff;
    color: #fff;
    text-decoration: none;
    border-radius: 5px;
    transition: background-color 0.3s;
}
.tg-btn:hover {
    background-color: #0056b3;
}
</style>
