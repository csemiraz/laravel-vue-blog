<template>
  <div class="categories-list">
    <h1>Categories List</h1>
    <!-- success message -->
    <div class="success-msg" v-if="success">
      <i class="fa fa-check"></i>
      {{ message }}
    </div> 
    <div
      class="item"
      v-for="(category, index) in categories"
      :key="category.id"
    >
      <span>{{ index + 1 }}</span>
      <p>{{ category.category_name }}</p>
      <div>
        <router-link :to="{ name: 'EditCategory', params: {id:category.id} }" class="edit-link">Edit</router-link>
      </div>

      <input
        type="button"
        value="Delete"
        @click="destroyCategory(category.id)"
        class="delete-btn"
      />
    </div>
    <div class="index-categories">
      <router-link :to="{ name: 'CreateCategory' }"
        >Create Categories<span>&#8594;</span></router-link
      >
    </div>
  </div>
</template>

<script>
export default {
  data() {
    return {
      categories: [],
      success: false,
      message: ''
    }
  },
  methods: {
    fetchCategory() {
      axios.get("/api/categories/view")
        .then((response) => {
          this.categories = response.data.data;
          //console.log(this.categories);
        })
        .catch(error => {
          console.log(error);
      })
  },
  destroyCategory(id) {
    axios.delete('/api/categories/delete/' + id)
      .then((response) => {
        this.fetchCategory();
        this.message = response.data.message;
        this.success = true;

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
    this.fetchCategory();
  }


}
</script>

<style scoped>
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
