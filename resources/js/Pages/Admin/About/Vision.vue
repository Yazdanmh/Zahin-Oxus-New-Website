<template>
    <Head title="Our vision" />
    <AdminLayout>
      <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="fw-bold py-3 mb-4">
            <span class="text-muted fw-light">Pages /</span> About / Our Vision
        </h4>
        <div class="row">
          <div class="col-xl">
            <div class="card mb-4">
              <div
                class="card-header d-flex justify-content-between align-items-center"
              >
                <h5 class="mb-0">Our Vision</h5>
                <small class="text-muted float-end">Manage Our Vision</small>
              </div>
              <div class="card-body">
                <form @submit.prevent="submit">
                  <!-- Quill Editor -->
                  <div ref="editorContainer" class="editor"></div>
  
                  <button type="submit" class="btn btn-primary mt-3">
                    Update
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
  import { ref, onMounted } from "vue";
  import { useForm } from "@inertiajs/vue3";
  import { useToast } from "vue-toastification";
  import Quill from "quill";
  
  // Props passed from the server
  const props = defineProps({
    our_vision: {
      type: Object,
      required: true,
    },
  });
  
  // Toast notifications
  const toast = useToast();
  
  // Initialize form with the correct value
  const form = useForm({
    our_vision: props.our_vision?.our_vision || "", // Use the correct property from props
  });
  
  const editorContainer = ref(null);
  let editor;
  
  onMounted(() => {
    // Initialize Quill editor
    editor = new Quill(editorContainer.value, {
      theme: "snow",
      modules: {
        toolbar: [
          [{ header: "1" }, { header: "2" }, { font: [] }],
          [{ list: "ordered" }, { list: "bullet" }],
          ["bold", "italic", "underline"],
          ["link"],
          [{ align: [] }],
          ["image"],
        ],
      },
      placeholder: "Compose your text here...",
    });
  
    // Set initial value
    editor.root.innerHTML = form.our_vision;
  
    // Update form.our_vision on editor content change
    editor.on("text-change", () => {
      form.our_vision = editor.root.innerHTML;
    });
  });
  
  // Handle form submission
  const submit = () => {
    form.post(route("ourvision"), {
      preserveScroll: true,
      onSuccess: () => {
        toast.success("About Section Updated Successfully");
      },
      onError: () => {
        toast.error("An error occurred while updating the About Section.");
      },
    });
  };
  </script>
  
  <style scoped>
  .editor {
    height: 300px;
    border: 1px solid #ddd;
    padding: 10px;
    background-color: #fff;
  }
  </style>
  