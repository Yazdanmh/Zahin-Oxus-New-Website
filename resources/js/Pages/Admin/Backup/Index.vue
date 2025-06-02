<template>
    <Head title="Backup Management" />
    <AdminLayout
        :setting="props.setting"
        :user="props.user"
        :permissions="props.permissions"
    >
        <div class="container-xxl flex-grow-1 container-p-y">
            <h4 class="fw-bold py-3 mb-4">
                <span class="text-muted fw-light">Admin /</span> Backup
                Management
            </h4>

            <!-- Backup History -->
            <div class="row mt-4">
                <div class="col-xl">
                    <div class="card mb-4">
                        <div
                            class="card-header d-flex justify-content-between align-items-center"
                        >
                            <h5 class="mb-0">Backup History</h5>
                            <div class="btn-group">
                                <button
                                    type="button"
                                    class="btn btn-primary dropdown-toggle"
                                    data-bs-toggle="dropdown"
                                    aria-expanded="false"
                                >
                                    Backup Options
                                </button>
                                <ul class="dropdown-menu" style="">
                                    <li>
                                        <a
                                            class="dropdown-item"
                                            href="javascript:void(0);"
                                            @click="startFullBackup"
                                            >Files</a
                                        >
                                    </li>
                                    <li>
                                        <a
                                            @click="startDbBackup"
                                            :disabled="isBackingUp"
                                            class="dropdown-item"
                                            href="javascript:void(0);"
                                            >Database</a
                                        >
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <div class="card-body">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Name</th>
                                        <th>Date Created</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr
                                        v-for="(backup, index) in backups"
                                        :key="backup.file"
                                    >
                                        <td>{{ index + 1 }}</td>
                                        <td>{{ backup.name }}</td>
                                        <td>
                                            {{
                                                new Date(
                                                    backup.created_at
                                                ).toLocaleString("en-GB", {
                                                    year: "numeric",
                                                    month: "short",
                                                    day: "2-digit",
                                                    hour: "2-digit",
                                                    minute: "2-digit",
                                                })
                                            }}
                                        </td>
                                        <td>
                                            <a
                                                :href="
                                                    '/admin/backups/download/' +
                                                    backup.name
                                                "
                                                class="btn btn-icon btn-outline-primary m-1"
                                            >
                                                <span
                                                    class="tf-icons bx bx-download"
                                                ></span>
                                            </a>
                                            <button
                                                type="button"
                                                @click="
                                                    confirmDelete(backup.name)
                                                "
                                                class="btn btn-icon btn-outline-danger m-1"
                                            >
                                                <span
                                                    class="tf-icons bx bx-trash"
                                                ></span>
                                            </button>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </AdminLayout>
</template>

<script setup>
import AdminLayout from "@/Layouts/AdminLayout.vue";
import { Head } from "@inertiajs/vue3";
import { useForm } from "@inertiajs/vue3";
import { useToast } from "vue-toastification";
import { ref } from "vue";
const isBackingUp = ref(false);
import Swal from "sweetalert2";

const props = defineProps({
    setting: Object,
    user: Object,
    permissions: Array,
    backups: Object,
    errors: Object
});

const toast = useToast();
const dbForm = useForm({});
const fullForm = useForm({});
const deleteForm = useForm({
    path: ""
});

const startDbBackup = () => {
    if (isBackingUp.value) return;

    isBackingUp.value = true;

    dbForm.post("/admin/backup/db/now", {
        onSuccess: () => {
            toast.success("Database backup has started. This may take a few minutes. Please check back shortly.");
            setTimeout(() => {
                window.location.reload();
            }, 4000);
        },
        onError: () => {
            toast.error("Failed to start database backup. Please try again later.");
            setTimeout(() => {
                window.location.reload();
            }, 1000);
        },
        onFinish: () => {
            isBackingUp.value = false;
        }
    });
};


const startFullBackup = () => {
    if (isBackingUp.value) return;

    isBackingUp.value = true;

    fullForm.post("/admin/backup/full/now", {
        onSuccess: () => {
            toast.success("Full files backup has started. This may take several minutes. Please check back shortly.");
            setTimeout(() => {
                window.location.reload();
            }, 10000);
        },
        onError: () => {
            toast.error("Failed to start full files backup. Please try again later.");
            setTimeout(() => {
                window.location.reload();
            }, 7000);
        },
        onFinish: () => {
            isBackingUp.value = false;
        }
    });
};



const confirmDelete = (path) => {
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
            deleteFile(path);
        }
    });
};

const deleteFile = (path) => {
    deleteForm.path = path;
    deleteForm.post(route("backup.delete"), {
        preserveScroll: true,
        onSuccess: (msg) => {
            toast.success('file deleted successfully');
        },
        onError: (errors) => {
            const message = errors.message || "Failed to delete backup";
            toast.error(message);
            console.error("Delete error:", errors);
        }
    });
};

const hasPermission = (permission) => {
    return props.permissions.includes(permission);
};
</script>