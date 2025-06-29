<template>
   <div id="wrapper">
      <!-- header -->

      <!-- sidebar -->
      <SideBar></SideBar>
      <!-- main -->
      <main class="container">
        <router-view></router-view>
      </main>

      <!-- Main footer -->
      <Footer></Footer>
    </div>
</template>

<script>
import Footer from './pages/Footer.vue';
import SideBar from './pages/SideBar.vue';
export default{
  components: {
    Footer,
    SideBar
  }
}

</script>
