<template>
  <div class="categories-list">
    <h1>Posts List</h1> 
    <!-- success message -->
    <div class="success-msg" v-if="success">
      <i class="fa fa-check"></i>
      Post deleted successfully 
    </div>
    <div class="success-msg" v-if="editSuccess">
      <i class="fa fa-check"></i>
      Post edited successfully 
    </div>
    <div class="item" v-for="(post,index) in posts" :key="post.id">
      <span>{{ index + 1 }}</span>
      <p>{{ post.title }}</p>
      <img style="height: 70px; width: 70px; margin-bottom: 5px;" :src="post.photo" alt="">
      <div>
        <router-link
          class="edit-link"
          :to="{name:'EditPost', params: {id: post.id}}"
          >Edit</router-link
        >
      </div>

      <input
        type="button"
        value="Delete"
        class="delete-btn"
        @click="deletePost(post.id)"
      />
    </div>
    <div class="index-categories">
      <router-link :to="{ name: 'CreatePost' }"
        >Create post<span>&#8594;</span></router-link
      >
    </div>
  </div>
 
</template>
<script>
export default {
  props: ["editSuccess"],
  emits: ["showEditSuccess"],
  data() {
    return {
      success: false,
      message: "",
      posts: [],
    }
  },
  methods: {
    fetchPost() {
      axios.get("/api/posts/view")
        .then((response) => {
          this.posts = response.data.posts;
          //console.log(response.data.posts);
        })
        .catch((error) => {
          console.log(error);
        })
    },
    deletePost(id) {
      axios.delete("/api/posts/delete/" + id)
        .then((response) => {
          this.fetchPost();
          this.success = true;
          this.message = response.data.message;

          setInterval(() => {
            this.success = false;
          }, 5000);
        })
        .catch((error) => {
          console.log(error);
        })
    }
  },
  mounted() {
    this.fetchPost();
  }
}

</script>

<style scoped >
.categories-list {
  min-height: 100vh;
  background: #fff;
}

.categories-list h1 {
  font-weight: 300;
  padding: 50px 0 30px 0;
  text-align: center;
}

.categories-list .item {
  display: flex;
  justify-content: right;
  align-items: center;
  max-width: 300px;
  margin: 0 auto !important;
}

.categories-list .item p {
  font-size: 16px;
}

.categories-list .item p,
.categories-list .item div,
.categories-list .item {
  margin: 15px 8px;
}

.categories ul li {
  list-style: none;
  background-color: #494949;
  margin: 20px 5px;

  border-radius: 15px;
}

.categories ul {
  display: flex;
  justify-content: center;
}

.categories a {
  color: white;
  padding: 10px 20px;
  display: inline-block;
}

.create-categories a,
.index-categories a {
  all: revert;
  margin: 20px 0;
  display: inline-block;
  text-decoration: none;
}

.create-categories a span,
.index-categories a span {
  font-size: 22px;
}

.index-categories {
  text-align: center;
}
</style>
