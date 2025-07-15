<template> 
<div>
  <section class="single-blog-post">
        <h1>{{ post.title }}</h1>

        <p class="time-and-author">
          {{ post.created_at }}
          <span>Written By {{ post.user }}</span>
        </p>

        <div class="single-blog-post-ContentImage" data-aos="fade-left">
          <img :src="post.photo" alt="" />
        </div>

        <div class="about-text">
          <p>
            {{ post.description }}
          </p>
        </div>
      </section>
      <section class="recommended">
        <p>Related</p>
        <div class="recommended-cards">
          <router-link v-for="post in relatedPosts" :key="post.id" :to="{ name: 'singleBlog', params: {slug: post.slug}}">
            <div class="recommended-card">
              <img :src="post.photo" style="height: 250px; width: 100%;" alt="" loading="lazy" />
              <h4>
                {{ post.title }}
              </h4>
            </div>
          </router-link>
        </div>
      </section>
  </div>
</template>

<script>
export default {
  props: ['slug'],
  data() {
    return {
      post: {},
      relatedPosts: [],
    }
  },
  methods: {
    fetchSinglePost() {
      axios.get('/api/posts/detail/' + this.slug)
        .then((response) => {
          this.post = response.data.data;
        })
        .catch((error) => {
          console.log(error);
        })
    },
    fetchRelatedPost() {
      axios.get('/api/posts/related/' + this.slug)
        .then((response) => {
          this.relatedPosts = response.data.data;
        })
        .catch((error) => {
          console.log(error);
        })
    }
  },
  mounted() {
    this.fetchSinglePost();
    this.fetchRelatedPost();
  }
}
</script>
