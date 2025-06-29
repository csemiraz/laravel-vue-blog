<template>
  <div class="sidebar" :class="{overLay: overLayVisibility}">
        <span class="closeButton" @click="hideOverLay">&times;</span>
        <p class="brand-title"><a href="">Alphayo Blog</a></p>

        <div class="side-links">
          <ul>
            <li><router-link :to="{name: 'home'}" @click="hideOverLay">Home</router-link></li>
            <li><router-link :to="{name:'blog'}" @click="hideOverLay">Blog</router-link></li>
            <li><router-link :to="{name: 'about'}" @click="hideOverLay">About</router-link></li>
            <li><router-link :to="{name: 'contact'}" @click="hideOverLay">Contact</router-link></li>
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
</template>

<script>
export default {
  data() {
    return {
      overLayVisibility: false,
    }
  },
  methods: {
    showOverLay() {
      this.overLayVisibility = true;
    },
    hideOverLay() {
      this.overLayVisibility = false;
    },

  }
}

</script>

<style scoped>
.overLay {
  width: 100%;
  z-index: 5;
}

</style>
