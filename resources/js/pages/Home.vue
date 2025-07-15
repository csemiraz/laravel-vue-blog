<template>
   <div>
    <header class="header">
        <div class="header-text">
          <h1>Trust Tech Blog</h1>
          <h4>Home of verified news...</h4>
        </div>
        <div class="overlay"></div>
      </header>

  <h2 class="header-title">Latest Blog Posts</h2>
        <section class="cards-blog latest-blog">
          <div v-for="(post,index) in posts" :key="post.id" class="card-blog-content">
            <img :src="post.photo" style="height: 400px; width: 100%;" alt="" />
            <p>
              {{ post.created_at }}
              <span style="float: right">Written By {{ post.user }}</span>
            </p>
            <h4 style="font-weight: bolder">
              <router-link :to="{ name: 'singleBlog', params: {slug: post.slug}}">{{ post.title }}</router-link>
            </h4>
          </div>
        </section>
   </div>
</template>

<script>
export default {
  data() {
    return {
      posts: [],
    }
  },
  methods: {
    fetchPost()
    {
      axios.get('/api/posts/all')
        .then((response) => {
          this.posts = response.data.data;
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
