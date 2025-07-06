<template>
  <div id="create-categories">
    <div id="contact-us"> 
      <h1>Create New Category!</h1>
      <!-- success message -->
      <div class="success-msg" v-if="success">
        <i class="fa fa-check"></i>
        {{ successMessage }}
      </div>
      <div class="contact-form">
        <form @submit.prevent="submitForm">
          <label for="name"><span>Category Name</span></label>
          <input type="text" id="name" v-model="fields.category_name"/>
          <span class="error" v-if="errors.category_name">{{ errors.category_name[0] }}</span>

          <input type="submit" value="Submit" />
        </form>
      </div>
      <div class="create-categories">
        <router-link :to="{ name: 'ViewCategory' }"
          >Categories List <span>&#8594;</span></router-link
        >
      </div>
    </div>
  </div>
</template>

<script>
export default {
  data() {
    return {
      fields: {},
      errors: {},
      success: false,
      successMessage: '',
    }
  },
  methods: {
    submitForm() {
      axios.post('/api/categories/store', this.fields)
        .then((response) => {
          this.fields = {};
          this.errors = {},
          this.successMessage = response.data.message;
          this.success = true;
          setInterval(() => {
            this.success = false;
          }, 5000)

        })
        .catch((error) => {
          this.errors = error.response.data.errors;
        })
    }
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
