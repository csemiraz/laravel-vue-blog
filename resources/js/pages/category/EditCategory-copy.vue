<template>
  <div id="create-categories">
    <div id="contact-us">
      <h1>Edit Category!</h1> - {{ id }}
      <!-- success message -->
      <div class="success-msg" v-if="success">
        <i class="fa fa-check"></i>
        Updated successfully
      </div>
      <div class="contact-form">
        <form @submit.prevent="updateCategory">
          <label for="name"><span>Name</span></label> 
          <input type="text" id="name"  v-model="fields.category_name"/>
          <span class="error"></span>

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
    }
  },

  methods: {
    updateCategory() {
      axios.put("/api/categories/update/" + this.id, this.fields)
        .then((response) => {
          this.fields = {},
          this.errors = {},
          this.success = true,
          setInterval(() => {
            this.success = false;
          }, 5000)
          //console.log(response);
        })
        .catch((error) => {
          console.log(error);
        })
    }
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
