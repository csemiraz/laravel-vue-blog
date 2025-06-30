<template>
   <div id="wrapper">
      <!-- header -->

      <!-- sidebar -->
       <div class="sidebar" :class="{overLay: overLayVisibility}">
        <span class="closeButton" @click="hideOverLay">&times;</span>
        <p class="brand-title"><a href="">Alphayo Blog</a></p>

        <div class="side-links">
          <ul>
            <li><router-link :to="{name: 'home'}" @click="hideOverLay">Home</router-link></li>
            <li><router-link :to="{name:'blog'}" @click="hideOverLay">Blog</router-link></li>
            <li><router-link :to="{name: 'about'}" @click="hideOverLay">About</router-link></li>
            <li><router-link :to="{name: 'contact'}" @click="hideOverLay">Contact</router-link></li>
            <li v-if="!loggedIn"><router-link :to="{name: 'login'}" @click="hideOverLay">Login</router-link></li>
            <li v-if="!loggedIn"><router-link :to="{name: 'register'}" @click="hideOverLay">Register</router-link></li>
            <li v-if="loggedIn"><router-link :to="{name: 'dashboard'}" @click="hideOverLay">Dashboard</router-link></li>
          </ul>
        </div>

        <!-- sidebar footer -->
        <footer class="sidebar-footer">
          <div>
            <a href=""><i class="fab fa-facebook-f"></i></a>
            <a href=""><i class="fab fa-instagram"></i></a>
            <a href=""><i class="fab fa-twitter"></i></a>
          </div>

          <small>&copy {{ new Date().getFullYear() }} Trust Tech BD Blog</small>
        </footer>
      </div>

      <!-- Menu Button -->
      <div class="menuButton" @click="showOverLay()">
        <div class="bar"></div>
        <div class="bar"></div>
        <div class="bar"></div>
      </div>
      <!-- main -->
      <main class="container">
        <router-view @update-sidebar="updateSidebar"></router-view>
      </main>

      <!-- Main footer -->
      <Footer></Footer>
    </div>
</template>

<script>
import Footer from './pages/Footer.vue';
export default{
  data() {
    return {
      overLayVisibility: false,
      loggedIn: false,
    }
  },

  components: {
    Footer,
  },
  methods: {
    showOverLay() {
      this.overLayVisibility = true;
    },
    hideOverLay() {
      this.overLayVisibility = false;
    },
    updateSidebar() {
      this.loggedIn = !this.loggedIn;
    }
  },
  mounted() {
    if(localStorage.getItem('authenticated')) {
      this.loggedIn = true;
    } else {
      this.loggedIn = false;
    }
  }
}

</script>

<style scoped>
.overLay {
  width: 100%;
  z-index: 5;
}
</style>
