<template>
  <div id="backend-view">
    <div class="logout"><a href="#" @click="logout">Log out</a></div>
    <h1 class="heading">Dashboard</h1>
    <span>{{ name }}</span>
    <div class="links">
      <ul>
        <li>
          <router-link :to="{name: 'CreatePost'}">Create Posts</router-link>
        </li>
        <li>
          <router-link :to="{name: 'AllPost'}">Posts List</router-link>
        </li>
        <li>
          <router-link :to="{name: 'CreateCategory'}">Create Categories</router-link>
        </li>
        <li>
          <router-link :to="{name: 'ViewCategory'}">Categories List</router-link>
        </li>
      </ul>
    </div>
  </div>
</template>

<script>
export default {
  data() {
    return {
      name: ''
    }
  },
  methods: {
    logout() {
      axios
      .post("/api/logout")
      .then((response) => {
          this.$router.push({ name: "home" });
          localStorage.removeItem("authenticated");
          this.$emit("updateSidebar");
        })
      .catch((error) => {
        console.log(error);
      })
    }
  },
  mounted() {
    axios
      .get("/api/user")
      .then((response) => (this.name = response.data.name))
      .catch((error) => {
        if(error.response.status === 401) {
          localStorage.removeItem("authenticated");
          this.$router.push({name: 'login'});
          this.$emit("updateSidebar");
        }
       //console.log(error);
      })
  }
}
</script>


<style scoped>
/* dashboard */
#backend-view {
  text-align: center;
  background-color: #f3f4f6;
  height: 100vh;
  padding-top: 15vh;
}

.logout {
  position: absolute;
  top: 30px;
  right: 40px;
}
.heading {
  margin-bottom: 5px;
}
.links {
  margin-top: 30px;
  margin-left: auto;
  margin-right: auto;
  background: #ffffff;
  max-width: 500px;
  padding: 15px;
  border-radius: 15px;
}
.links ul {
  list-style: none;
}
.links a {
  all: revert;
  font-size: 26px;
  display: inline-block;
  margin: 10px 0;
}
</style>
