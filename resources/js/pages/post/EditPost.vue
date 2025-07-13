<template>
  <main class="create-post">
    <div class="container">
      <h3>
        <router-link :to="{ name: 'AllPost' }"
          >Posts List <span>&#8594;</span></router-link
        ></h3>
      <h1>Edit Post!</h1>
      <!-- success message -->
      <div class="success-msg" v-if="success">
        <i class="fa fa-check"></i>
        Post updated successfully
      </div>
      <!-- Contact Form -->
      <div class="contact-form">
        <form @submit.prevent="updatePost" enctype="multipart/form-data">
          <!-- Title -->
          <label for="title"><span>Title</span></label>
          <input type="text" id="title" v-model="fields.title" />
          <span v-if="errors.title" class="error">{{ errors.title[0] }}</span>
          <br />

          <!-- Image -->
          <label for="image"><span>Image</span></label>
          <input type="file" id="image" @input="grabFile" />
          <span v-if="errors.photo" class="error">{{ errors.photo[0] }}</span>
          <div class="preview">
            <img :src="url" alt="" />
          </div>
          <br />

          <!-- Drop down -->
          <label for="categories"><span>Choose a category:</span></label>
          <select v-model="fields.category_id" id="categories">
            <option disabled value="">Select option</option>
            <option v-for="(category,index) in categories" :key="index" :value="category.id">{{ category.category_name }}</option>
          </select>
          <span v-if="errors.category_id" class="error">{{
            errors.category_id[0]
          }}</span>
          <br />
          <!-- Body-->
          <label for="body"><span>Body</span></label>
          <textarea id="body" v-model="fields.description"></textarea>
          <span v-if="errors.description" class="error">{{ errors.description[0] }}</span>
          <!-- Button -->
          <input class="add-post-btn" type="submit" value="Submit" />
        </form>
      </div>
    </div>
  </main>
</template>

<script>
export default {
  props: ['id'],
  data() {
    return {
      fields: {},
      errors: {},
      success: false,
      url: "",
      categories: [],
    }
  },
  methods: {
    grabFile(event) {
      const file = event.target.files[0];
      this.fields.photo = file;
      this.url = URL.createObjectURL(file);
      URL.revokeObjectURL(file);
    },
    updatePost() {
      const fd = new FormData();
      fd.append("title", this.fields.title);
      if(this.fields.photo) {
        fd.append("photo", this.fields.photo)
      }
      fd.append("category_id", this.fields.category_id);
      fd.append("description", this.fields.description);

      fd.append("_method", "PUT");

      axios.post(`/api/posts/update/${this.id}`, fd, {
        headers: { 'content-type': 'multipart/form-data' }
      })
        .then(() => {
          this.$emit('showEditSuccess');
          this.$router.push({name: 'AllPost'});
        })
        .catch((error) => {
          this.errors = error.response.data.errors;
        })

    }
  },

  mounted() {
    axios.get("/api/categories/view")
      .then((response) => {
        this.categories = response.data.data;
        //console.log(this.categories);
      })
      .catch((error) => {
        console.log(error);
      });

      axios.get("/api/posts/show/" + this.id) 
        .then((response) => {
          this.fields = response.data.data;
          this.url = response.data.data.photo
        })
        .catch((error) => {
          console.log(response);
        })
  }


}
</script>

<style scoped>
.create-post {
  background-color: #fff;
  padding: 0 3vw;
}
.container input,
textarea,
select {
  width: 100%;
  padding: 10px;
  border: 1px solid #ccc;
  border-radius: 4px;
  box-sizing: border-box;
  margin-top: 6px;
  margin-bottom: 20px;
  font-size: 16px;
}
h1 {
  text-align: center;
  padding: 60px 0 50px 0;
}

.add-post-btn {
  background-color: black;
  color: white;
  border: none;
  cursor: pointer;
  transition: 0.3s ease;
}

.add-post-btn:hover {
  transform: translateY(-4px);
}

.preview img {
  max-width: 100%;
  max-height: 120px;
}
</style>
