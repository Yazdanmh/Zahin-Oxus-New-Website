<template>
    <div>
      <header>
        <h1>Client Dashboard</h1>
        <!-- Client-specific header content -->
      </header>
  
      <main>
        <slot></slot> <!-- Dynamic content from pages will be inserted here -->
      </main>
  
      <footer>
        <!-- Client footer content -->
      </footer>
    </div>
  </template>
  
  <script>
  export default {
    name: 'ClientLayout',
  }
  </script>
  
  <style scoped>

  </style>
  