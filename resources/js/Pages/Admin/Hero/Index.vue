<template>
    <Head title="Hero" />
    <AdminLayout
        :setting="props.setting"
        :user="props.user"
        :permissions="props.permissions"
    >
        <div class="container-xxl flex-grow-1 container-p-y">
            <h4 class="fw-bold py-3 mb-4">
                <span class="text-muted fw-light">Home /</span> Hero
            </h4>
            <div class="row">
                <div class="col-xl">
                    <div class="card mb-4">
                        <div
                            class="card-header d-flex justify-content-between align-items-center"
                        >
                            <h5 class="mb-0">Hero</h5>
                            <small class="text-muted float-end"
                                >Manage hero</small
                            >
                        </div>
                        <div class="card-body">
                            <form @submit.prevent="submit">
                                <!-- Image Upload Section -->
                                <div class="card-body">
                                    <div class="row">
                                        <!-- Image 1 -->
                                        <div class="col-md-4 mb-4">
                                            <div
                                                class="d-flex flex-column align-items-center gap-4"
                                            >
                                                <img
                                                    :src="
                                                        imagePreviews.image_1 ||
                                                        '/storage/' +
                                                            props.hero.image_1
                                                    "
                                                    alt="Hero Image 1"
                                                    class="d-block rounded"
                                                    style="
                                                        width: 100%;
                                                        height: 200px;
                                                        object-fit: cover;
                                                    "
                                                />
                                                <div
                                                    v-if="
                                                        hasPermission(
                                                            'site_data.edit'
                                                        )
                                                    "
                                                    class="button-wrapper"
                                                >
                                                    <label
                                                        :for="'upload_1'"
                                                        class="btn btn-primary me-2 mb-2"
                                                    >
                                                        <span
                                                            class="d-none d-sm-block"
                                                            >Upload Image
                                                            1</span
                                                        >
                                                        <i
                                                            class="bx bx-upload d-block d-sm-none"
                                                        ></i>
                                                        <input
                                                            type="file"
                                                            :id="'upload_1'"
                                                            hidden
                                                            accept="image/png, image/jpeg, image/gif"
                                                            @change="
                                                                (e) =>
                                                                    handleImageUpload(
                                                                        e,
                                                                        'image_1'
                                                                    )
                                                            "
                                                        />
                                                    </label>
                                                    <button
                                                        type="button"
                                                        class="btn btn-outline-secondary mb-2"
                                                        @click="
                                                            resetImage(
                                                                'image_1'
                                                            )
                                                        "
                                                    >
                                                        <i
                                                            class="bx bx-reset d-block d-sm-none"
                                                        ></i>
                                                        <span
                                                            class="d-none d-sm-block"
                                                            >Reset</span
                                                        >
                                                    </button>
                                                    <div
                                                        v-if="errors.image_1"
                                                        class="text-danger mt-2"
                                                    >
                                                        {{ errors.image_1 }}
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Image 2 -->
                                        <div class="col-md-4 mb-4">
                                            <div
                                                class="d-flex flex-column align-items-center gap-4"
                                            >
                                                <img
                                                    :src="
                                                        imagePreviews.image_2 ||
                                                        '/storage/' +
                                                            props.hero.image_2
                                                    "
                                                    alt="Hero Image 2"
                                                    class="d-block rounded"
                                                    style="
                                                        width: 100%;
                                                        height: 200px;
                                                        object-fit: cover;
                                                    "
                                                />
                                                <div
                                                    v-if="
                                                        hasPermission(
                                                            'site_data.edit'
                                                        )
                                                    "
                                                    class="button-wrapper"
                                                >
                                                    <label
                                                        :for="'upload_2'"
                                                        class="btn btn-primary me-2 mb-2"
                                                    >
                                                        <span
                                                            class="d-none d-sm-block"
                                                            >Upload Image
                                                            2</span
                                                        >
                                                        <i
                                                            class="bx bx-upload d-block d-sm-none"
                                                        ></i>
                                                        <input
                                                            type="file"
                                                            :id="'upload_2'"
                                                            hidden
                                                            accept="image/png, image/jpeg, image/gif"
                                                            @change="
                                                                (e) =>
                                                                    handleImageUpload(
                                                                        e,
                                                                        'image_2'
                                                                    )
                                                            "
                                                        />
                                                    </label>
                                                    <button
                                                        type="button"
                                                        class="btn btn-outline-secondary mb-2"
                                                        @click="
                                                            resetImage(
                                                                'image_2'
                                                            )
                                                        "
                                                    >
                                                        <i
                                                            class="bx bx-reset d-block d-sm-none"
                                                        ></i>
                                                        <span
                                                            class="d-none d-sm-block"
                                                            >Reset</span
                                                        >
                                                    </button>
                                                    <div
                                                        v-if="errors.image_2"
                                                        class="text-danger mt-2"
                                                    >
                                                        {{ errors.image_2 }}
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Image 3 -->
                                        <div class="col-md-4 mb-4">
                                            <div
                                                class="d-flex flex-column align-items-center gap-4"
                                            >
                                                <img
                                                    :src="
                                                        imagePreviews.image_3 ||
                                                        '/storage/' +
                                                            props.hero.image_3
                                                    "
                                                    alt="Hero Image 3"
                                                    class="d-block rounded"
                                                    style="
                                                        width: 100%;
                                                        height: 200px;
                                                        object-fit: cover;
                                                    "
                                                />
                                                <div
                                                    v-if="
                                                        hasPermission(
                                                            'site_data.edit'
                                                        )
                                                    "
                                                    class="button-wrapper"
                                                >
                                                    <label
                                                        :for="'upload_3'"
                                                        class="btn btn-primary me-2 mb-2"
                                                    >
                                                        <span
                                                            class="d-none d-sm-block"
                                                            >Upload Image
                                                            3</span
                                                        >
                                                        <i
                                                            class="bx bx-upload d-block d-sm-none"
                                                        ></i>
                                                        <input
                                                            type="file"
                                                            :id="'upload_3'"
                                                            hidden
                                                            accept="image/png, image/jpeg, image/gif"
                                                            @change="
                                                                (e) =>
                                                                    handleImageUpload(
                                                                        e,
                                                                        'image_3'
                                                                    )
                                                            "
                                                        />
                                                    </label>
                                                    <button
                                                        type="button"
                                                        class="btn btn-outline-secondary mb-2"
                                                        @click="
                                                            resetImage(
                                                                'image_3'
                                                            )
                                                        "
                                                    >
                                                        <i
                                                            class="bx bx-reset d-block d-sm-none"
                                                        ></i>
                                                        <span
                                                            class="d-none d-sm-block"
                                                            >Reset</span
                                                        >
                                                    </button>
                                                    <div
                                                        v-if="errors.image_3"
                                                        class="text-danger mt-2"
                                                    >
                                                        {{ errors.image_3 }}
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <p class="text-muted mb-0">
                                        Allowed JPG, GIF, or PNG. Max size of
                                        1MB each. <br />
                                        <span class="text-warning"
                                            >Recommended dimensions: 1920 x 1080
                                            pixels.</span
                                        >
                                    </p>
                                </div>

                                <!-- Form Fields -->
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label
                                                for="title"
                                                class="form-label"
                                                >Title</label
                                            >
                                            <TextEditor v-model="form.title" />
                                            <div
                                                v-if="errors.title"
                                                class="text-danger mt-2"
                                            >
                                                {{ errors.title }}
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label
                                                for="subtitle"
                                                class="form-label"
                                                >Subtitle</label
                                            >
                                            <TextEditor
                                                v-model="form.subtitle"
                                            />
                                            <div
                                                v-if="errors.subtitle"
                                                class="text-danger mt-2"
                                            >
                                                {{ errors.subtitle }}
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="mb-3">
                                            <label
                                                for="description"
                                                class="form-label"
                                                >Description</label
                                            ><TextEditor
                                                v-model="form.description"
                                            />
                                            <div
                                                v-if="errors.description"
                                                class="text-danger mt-2"
                                            >
                                                {{ errors.description }}
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label
                                                for="button"
                                                class="form-label"
                                                >Button Title</label
                                            >
                                            <input
                                                type="text"
                                                class="form-control"
                                                id="button"
                                                v-model="form.button"
                                            />
                                            <div
                                                v-if="errors.button"
                                                class="text-danger mt-2"
                                            >
                                                {{ errors.button }}
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="link" class="form-label"
                                                >Link</label
                                            >
                                            <input
                                                type="text"
                                                class="form-control"
                                                id="link"
                                                v-model="form.link"
                                            />
                                            <div
                                                v-if="errors.link"
                                                class="text-danger mt-2"
                                            >
                                                {{ errors.link }}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <button
                                    v-if="hasPermission('site_data.edit')"
                                    type="submit"
                                    class="btn btn-primary"
                                >
                                    Update Hero
                                </button>
                            </form>
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
import { ref } from "vue";
import { useForm } from "@inertiajs/vue3";
import { useToast } from "vue-toastification";
import TextEditor from "@/Components/Admin/TextEditor.vue";

const props = defineProps({
    hero: {
        type: Object,
        required: true,
    },
    setting: {
        type: Object,
        required: true,
    },
    user: {
        type: Object,
        required: true,
    },
    permissions: {
        type: Array,
        required: true,
    },
});
const toast = useToast();

const form = useForm({
    title: props.hero.title,
    subtitle: props.hero.subtitle,
    description: props.hero.description,
    button: props.hero.button,
    link: props.hero.link,
    image_1: null,
    image_2: null,
    image_3: null,
});

const errors = ref({});
const imagePreviews = ref({
    image_1: null,
    image_2: null,
    image_3: null,
});

const handleImageUpload = (event, fieldName) => {
    const file = event.target.files[0];
    if (file) {
        form[fieldName] = file;
        const reader = new FileReader();
        reader.onload = (e) => {
            imagePreviews.value[fieldName] = e.target.result;
        };
        reader.readAsDataURL(file);
    }
};

const resetImage = (fieldName) => {
    form[fieldName] = null;
    imagePreviews.value[fieldName] = null;
};

const submit = () => {
    form.post(route("hero.update"), {
        preserveScroll: true,
        onSuccess: () => {
            toast.success("Hero Updated Successfully");
        },
        onError: (err) => {
            errors.value = err;
        },
    });
};

const hasPermission = (permission) => {
    return props.permissions.includes(permission);
};
</script>

<style scoped></style>
