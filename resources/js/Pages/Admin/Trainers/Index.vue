<template>
    <Head title="Trainers" />
    <AdminLayout
        :setting="props.setting"
        :user="props.user"
        :permissions="props.permissions"
    >
        <div class="container-xxl flex-grow-1 container-p-y">
            <h4 class="fw-bold py-3 mb-4">
                <span class="text-muted fw-light">Home /</span> Trainers / All
            </h4>
            <div class="row">
                <div class="col-md-12">
                    <div class="card mb-4">
                        <div
                            class="card-header d-flex justify-content-between align-items-center"
                        >
                            <h5 class="mb-0">All Trainers</h5>
                            <small class="text-muted float-end"
                                >List of all Trainers</small
                            >
                        </div>

                        <div class="card-body">
                            <!-- Filter/Search Area -->
                            <div class="row mb-4 align-items-center">
                                <div class="col-12 col-md-3 mb-3 mb-md-0">
                                    <input
                                        v-model="searchQuery"
                                        @input="applyFilter"
                                        type="text"
                                        class="form-control"
                                        placeholder="Search by name or position"
                                    />
                                </div>
                                <div class="col-12 col-md-3 mb-3 mb-md-0">
                                    <select
                                        v-model="selectedService"
                                        @change="applyFilter"
                                        class="form-select"
                                    >
                                        <option value="">All Services</option>
                                        <option
                                            v-for="service in services"
                                            :key="service.id"
                                            :value="service.id"
                                        >
                                            {{ service.title }}
                                        </option>
                                    </select>
                                </div>
                                <div
                                    class="col-12 col-md-3 mb-3 mb-md-0"
                                    v-if="hasPermission('training.create')"
                                >
                                    <Link
                                        :href="route('trainers.create')"
                                        class="btn btn-primary w-100 w-md-auto"
                                    >
                                        <i class="bx bx-plus"></i> Add Trainer
                                    </Link>
                                </div>
                                <div class="col-12 col-md-3">
                                    <div
                                        class="dropdown w-100"
                                        style="max-width: 100px"
                                    >
                                        <button
                                            class="btn btn-secondary dropdown-toggle w-100"
                                            type="button"
                                            id="exportDropdown"
                                            data-bs-toggle="dropdown"
                                            aria-expanded="false"
                                        >
                                            Export
                                        </button>
                                        <ul
                                            class="dropdown-menu"
                                            aria-labelledby="exportDropdown"
                                        >
                                            <li>
                                                <button
                                                    class="dropdown-item"
                                                    @click="downloadExcel"
                                                >
                                                    Export Excel
                                                </button>
                                            </li>
                                            <li>
                                                <button
                                                    class="dropdown-item"
                                                    @click="downloadPDF"
                                                >
                                                    Export PDF
                                                </button>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>

                            <!-- Trainers Table -->
                            <div class="table-responsive">
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Image</th>
                                            <th>Name</th>
                                            <th>Position</th>
                                            <th>Service</th>
                                            <th
                                                v-if="
                                                    hasPermission(
                                                        'training.edit'
                                                    ) ||
                                                    hasPermission(
                                                        'training.delete'
                                                    )
                                                "
                                            >
                                                Actions
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr
                                            v-for="(
                                                trainer, index
                                            ) in filteredTrainers"
                                            :key="trainer.id"
                                        >
                                            <td>{{ index + 1 }}</td>
                                            <td>
                                                <img
                                                    :src="
                                                        '/storage/' +
                                                        trainer.image
                                                    "
                                                    alt=""
                                                    style="
                                                        width: 70px;
                                                        height: 70px;
                                                        border-radius: 50%;
                                                        object-fit: cover;
                                                    "
                                                />
                                            </td>
                                            <td>{{ trainer.name }}</td>
                                            <td>{{ trainer.position }}</td>
                                            <td>{{ trainer.service.title }}</td>
                                            <td
                                                class="text-center"
                                                v-if="
                                                    hasPermission(
                                                        'training.edit'
                                                    ) ||
                                                    hasPermission(
                                                        'training.delete'
                                                    ) ||
                                                    hasPermission(
                                                        'training.view'
                                                    )
                                                "
                                            >
                                                <Link
                                                    v-if="
                                                        hasPermission(
                                                            'training.edit'
                                                        )
                                                    "
                                                    :href="
                                                        route(
                                                            'trainers.edit',
                                                            trainer.id
                                                        )
                                                    "
                                                >
                                                    <span
                                                        class="badge bg-label-primary p-1_5 me-3 cursor-pointer mb-2"
                                                    >
                                                        <i
                                                            class="bx bx-pencil icon-xs"
                                                        ></i>
                                                    </span>
                                                </Link>
                                                <span
                                                    v-if="
                                                        hasPermission(
                                                            'training.delete'
                                                        )
                                                    "
                                                    @click="
                                                        confirmDelete(
                                                            trainer.id
                                                        )
                                                    "
                                                    class="badge bg-label-danger p-1_5 me-3 cursor-pointer mb-2"
                                                >
                                                    <i
                                                        class="bx bx-trash icon-xs"
                                                    ></i>
                                                </span>
                                                <Link
                                                    :href="
                                                        route(
                                                            'trainers.show',
                                                            trainer.id
                                                        )
                                                    "
                                                >
                                                    <span
                                                        class="badge bg-label-primary p-1_5 me-3 cursor-pointer mb-2"
                                                    >
                                                        <i
                                                            class="bx bx-message-square-detail icon-xs"
                                                        ></i>
                                                    </span>
                                                </Link>
                                            </td>
                                        </tr>
                                        <tr v-if="!filteredTrainers.length">
                                            <td colspan="6" class="text-center">
                                                No trainers found
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            <!-- Pagination -->
                            <div
                                class="card-footer d-flex justify-content-between align-items-center"
                            >
                                <span>
                                    Showing {{  trainers.from }} to
                                    {{ trainers.to }} of
                                    {{ trainers.total }} trainings
                                </span>
                                <nav aria-label="Page navigation">
                                    <ul class="pagination">
                                        <!-- Previous Page Link -->
                                        <li
                                            class="page-item"
                                            :class="{
                                                disabled:
                                                    !props.trainers
                                                        .prev_page_url,
                                            }"
                                        >
                                            <a
                                                class="page-link"
                                                href="#"
                                                @click.prevent="
                                                    changePage(
                                                        props.trainers
                                                            .prev_page_url
                                                    )
                                                "
                                            >
                                                Previous
                                            </a>
                                        </li>

                                        <!-- Loop through Pages (handling page numbers) -->
                                        <li
                                            v-for="page in totalPages"
                                            :key="page"
                                            :class="[
                                                'page-item',
                                                {
                                                    active:
                                                        currentPage === page,
                                                },
                                            ]"
                                        >
                                            <a
                                                class="page-link"
                                                href="#"
                                                @click.prevent="
                                                    changePageTo(page)
                                                "
                                            >
                                                {{ page }}
                                            </a>
                                        </li>

                                        <!-- Next Page Link -->
                                        <li
                                            class="page-item"
                                            :class="{
                                                disabled:
                                                    !props.trainers
                                                        .next_page_url,
                                            }"
                                        >
                                            <a
                                                class="page-link"
                                                href="#"
                                                @click.prevent="
                                                    changePage(
                                                        props.trainers
                                                            .next_page_url
                                                    )
                                                "
                                            >
                                                Next
                                            </a>
                                        </li>
                                    </ul>
                                </nav>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </AdminLayout>
</template>

<script setup>
import AdminLayout from "@/Layouts/AdminLayout.vue";
import Swal from "sweetalert2";
import { Head, useForm, Link } from "@inertiajs/vue3";
import { ref, computed } from "vue";
import { useToast } from "vue-toastification";

const toast = useToast();

const props = defineProps({
    trainers: { type: Object, required: true },
    services: { type: Array, required: true },
    setting: { type: Object, required: true },
    user: { type: Object, required: true },
    permissions: {
        type: Array,
        required: true,
    },
});
const currentPage = ref(props.trainers.current_page);
const totalPages = computed(() => {
    return Array.from({ length: props.trainers.last_page }, (_, i) => i + 1);
});
const changePage = (url) => {
    if (url) {
        form.get(
            route("trainers.index", {
                page: new URL(url).searchParams.get("page"),
            }),
            {
                preserveScroll: true,
            }
        );
    }
};

const changePageTo = (page) => {
    form.get(route("trainers.index", { page }), {
        preserveScroll: true,
    });
};

const form = useForm({});
const searchQuery = ref("");
const selectedService = ref("");

const filteredTrainers = computed(() => {
    return props.trainers.data.filter((trainer) => {
        const matchesSearch =
            trainer.name
                .toLowerCase()
                .includes(searchQuery.value.toLowerCase()) ||
            trainer.position
                .toLowerCase()
                .includes(searchQuery.value.toLowerCase());
        const matchesService = selectedService.value
            ? trainer.service.id === selectedService.value
            : true;
        return matchesSearch && matchesService;
    });
});

const confirmDelete = (id) => {
    Swal.fire({
        title: "Are you sure?",
        text: "You won't be able to revert this!",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Yes, delete it!",
    }).then((result) => {
        if (result.isConfirmed) {
            deleteTrainer(id);
        }
    });
};

const deleteTrainer = (id) => {
    form.post(route("trainers.destroy", id), {
        preserveScroll: true,
        onSuccess: () => {
            toast.success("Trainer Deleted Successfully");
        },
        onError: (err) => {
            toast.error("Error: " + err.message);
        },
    });
};
const hasPermission = (permission) => {
    return props.permissions.includes(permission);
};
const downloadFile = (fileType) => {
    window.location.href = route("trainers.export", { fileType });
};

// Usage
const downloadExcel = () => {
    downloadFile("excel");
};

const downloadPDF = () => {
    downloadFile("pdf");
};
</script>

<style scoped>
.pagination-wrapper {
    margin-top: 20px;
}
</style>
