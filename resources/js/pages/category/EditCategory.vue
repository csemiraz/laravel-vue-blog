<template>
  <div id="create-categories">
    <div id="contact-us">
      <h1>Edit Category!</h1>
      <!-- success message -->
      <div class="success-msg" v-if="success">
        <i class="fa fa-check"></i>
        {{ message }}
      </div>
      <div class="contact-form">
        <form @submit.prevent="updateCategory">
          <label for="name"><span>Name</span></label> 
          <input type="text" id="name"  v-model="fields.category_name"/>
          <span class="error" v-if="errors.category_name">{{ errors.category_name[0] }}</span>
          <input type="submit" value="Submit" />
        </form>
      </div>
      <div class="create-categories">
        <router-link :to="{ name: 'ViewCategory'}">Categories List <span>&#8594;</span></router-link>
      </div>
    </div>
  </div>
</template>

<script>
import axios from 'axios';

export default {
  props: ['id'],
  data() {
    return {
      fields: {},
      success: false,
      message: '',
      number: 14,
      errors: {}
    }
  },

  methods: {
    updateCategory() {
      axios
        .put("/api/categories/update/" + this.id, this.fields)
        .then((response) => {
          this.fields = {};
          this.errors = {};
          this.success = true;
          this.message = response.data.message,

          setInterval(() => {
            this.success = false;
          }, 5000);
        })
        .catch((error) => {
          this.errors = error.response.data.errors;
        });
    },
  },
  
  mounted() {
    axios.get('/api/categories/show/' + this.id)
      .then((response) => {
        this.fields = response.data.data;
        //console.log(response);
      })
      .catch((error) => {
        console.log(error);
      })
  }
  
   
}

</script>

<style scoped>
#create-categories {
  background-color: #f3f4f6;
  height: 90vh;
  padding: 50px;
}
</style>
