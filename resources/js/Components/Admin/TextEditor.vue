<template>
    <div>
      <div ref="editorContainer" class="editor"></div>
    </div>
  </template>
  
  <script>
  import { ref, onMounted, watch } from "vue";
  import Quill from "quill";
  
  export default {
    name: "TextEditor",
    props: {
      value: {
        type: String,
        default: "",
      },
    },
    emits: ["update:value"],
  
    setup(props, { emit }) {
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
  
        // Set initial value in the editor
        editor.root.innerHTML = props.value;
  
        // Emit changes back to the parent whenever content changes
        editor.on("text-change", () => {
          emit("update:value", editor.root.innerHTML);
        });
      });
  
      // Watch for external changes to props.value and update the editor
      watch(
        () => props.value,
        (newValue) => {
          if (editor && newValue !== editor.root.innerHTML) {
            editor.root.innerHTML = newValue;
          }
        }
      );
  
      return { editorContainer };
    },
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
  