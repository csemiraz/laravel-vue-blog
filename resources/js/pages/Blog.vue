<template>
  <div>
  <h2 class="header-title">All Blog Posts</h2>
      <div class="searchbar">
        <form action="">
          <input type="text" placeholder="Search..." name="search" v-model="search" />

          <button type="submit">
            <i class="fa fa-search"></i>
          </button>

        </form>
      </div>
      <div class="categories">
        <ul>
          <li v-for="category in categories" :key="category.id"><a href="#" @click="fetchPostByCategory(category.id)">{{ category.category_name }}</a></li>
        </ul>
      </div>
      <section class="cards-blog latest-blog">
        <div v-for="post in posts" :key="post.id" class="card-blog-content">
          <img :src="post.photo" style="height: 350px; width: 100%;" alt="" />
          <p>
            {{ post.created_at }}
            <span>Written By {{ post.user }}</span>
          </p>
          <h4>
            <router-link :to="{name: 'singleBlog', params: { slug: post.slug }}">{{ post.title }}</router-link>
          </h4>
        </div>
        
        <h3 v-if="!posts.length">No Post Found!</h3>
        <br>
        <!-- pagination -->
        <!-- <div class="pagination" id="pagination">
          <a href="">&laquo;</a>
          <a class="active" href="">1</a>
          <a href="">2</a>
          <a href="">3</a>
          <a href="">4</a>
          <a href="">5</a>
          <a href="">&raquo;</a>
        </div> -->

        <div v-if="!posts.length" class="pagination" id="pagination">
          <a href="#" 
            v-for="(link,index) in links" 
            :key="index" 
            v-html="link.label"
            :class="{ active: link.active, disabled: !link.url }"
            @click="changePage(link)"
          ></a>
        </div>
      </section>
    </div>
</template>

<script>
export default {
  data() {
    return {
      posts: [],
      categories: [],
      search: "",
      links: []
    }
  },
  methods: {
    fetchBlogPost() {
      axios.get('/api/posts/blog-post')
        .then((response) => {
          this.posts = response.data.data;
          this.links = response.data.meta.links;
          //console.log(response);
        })
        .catch((error) => {
          console.log(error);
        })
    },
    fetchCategories() {
      axios.get('/api/categories/all/')
        .then((response) => {
          this.categories = response.data.data;
        })
        .catch((error) => {
          console.log(error);
        })
    },
    fetchPostByCategory(category)
    {
      axios.get('/api/posts-by-category/' + category)
        .then((response) => {
          this.posts = response.data.data;
          //this.links = response.data.meta.links;
        })
        .catch((error) => {
          console.log(error);
        })
    },
    changePage(link)
    {
      if (!link.url || link.active) {
        retun;
      }
      axios.get(link.url) 
        .then((response) => {
          this.posts = response.data.data;
          this.links = response.data.meta.links;
        })
        .catch((error) => {
          console.log(error);
        })
    }
  },
  mounted() {
    this.fetchBlogPost();
    this.fetchCategories();
  },
  watch: {
    search() {
      axios.get("/api/search", {
        params: { search: this.search }
      })
        .then((response) => {
          this.posts = response.data.data;
           //this.links = response.data.meta.links;
          //console.log(response);
        })
        .catch((error) => {
          console.log(error);
        })
    }
  }
}

</script>

<style scoped>
h3 {
  font-size: 30px;
  text-align: center;
  margin: 50px 0;
  color: red;
}

.disabled {
  pointer-events: none;
}
</style>
