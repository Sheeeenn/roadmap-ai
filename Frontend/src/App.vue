<template>
  <div id="app">
    <!-- Render Navbar on all pages -->
    <NavBar />
    <!-- Render the current route's component -->
    <router-view />
    <!-- Render Footer on all pages -->
     <Footer />
  </div>
</template>

<script setup>
import NavBar from './components/NavBar.vue';
import Footer from './components/Footer.vue';

</script>
