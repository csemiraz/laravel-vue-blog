<template>
  <main class="create-post">
    <div class="container">
       <h3>
        <router-link :to="{ name: 'AllPost' }"
          >Posts List <span>&#8594;</span></router-link
        ></h3>
      <h1>Create Posts!</h1>
      <!-- success message -->
      <div class="success-msg" v-if="success">
        <i class="fa fa-check"></i>
        {{ message }}
      </div>
      <!-- Contact Form -->
      <div class="contact-form">
        <form @submit.prevent="submitPost">
          <!-- Title -->
          <label for="title"><span>Title</span></label>
          <input type="text" id="title" v-model="fields.title"/>
          <span class="error" v-if="errors.title">{{ errors.title[0] }}</span>
          <br />

          <!-- Image -->
          <label for="image"><span>Image</span></label>
          <input type="file" id="image" @input="grabFile" ref="fields.photo"/>
          <span class="error" v-if="errors.photo">{{ errors.photo[0] }}</span>
          <div class="preview">
            <img :src="url" alt="" />
          </div>
          <br />

          <!-- Drop down -->
          <label for="categories"><span>Choose a category:</span></label>
          <select id="categories" v-model="fields.category_id">
            <option disabled value="">Select option</option>
            <option v-for="category in categories" :key="category.id" :value="category.id">{{ category.category_name }}</option>
          </select>
          <span class="error" v-if="errors.category_id">{{ errors.category_id[0] }}</span>
          <br />

          <!-- Body-->
          <label for="body"><span>Description</span></label>
          <textarea id="body" v-model="fields.description"></textarea>
          <span class="error" v-if="errors.description">{{ errors.description[0] }}</span>
          <!-- Button -->
          <input class="add-post-btn" type="submit" value="Submit" />
        </form>
      </div>
    </div>
  </main>
</template>

<script>
import axios from 'axios';
export default {
  data() {
    return {
      fields: {},
      errors: {},
      success: false,
      message: '',
      url: "",
      categories: []
    }
  },
  methods: {
    grabFile(event) {
      const file = event.target.files[0];
      this.fields.photo = file;
      this.url = URL.createObjectURL(file);
      URL.revokeObjectURL(file);
    },

    submitPost() {
      axios
        .post("/api/posts/store", this.fields, {
          headers: { "content-type": "multipart/form-data" },
        })
        .then((response) => {
          this.fields = {},
          this.url = null,
          this.success = true,
          this.errors = {},
          this.message = response.data.message;

          setInterval(() => {
            this.success = false;
          }, 5000);
        })
        .catch((error) => {
          this.errors = error.response.data.errors;
        })
    }
  },
  mounted() {
    axios.get("/api/categories/view")
      .then((response) => {
        //console.log(response.data.data);
        this.categories = response.data.data
      })
      .catch((error) => {
        console.log(error);
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
