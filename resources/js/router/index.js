import { createRouter, createWebHistory } from "vue-router";
import Home from '../pages/Home.vue';
import About from '../pages/About.vue';
import Contact from '../pages/Contact.vue';
import Blog from '../pages/Blog.vue';
import SingleBlog from '../pages/SingleBlog.vue';
import Login from '../pages/Login.vue';
import Register from '../pages/Register.vue';
import Dashboard from '../pages/Dashboard.vue'; 
import CreateCategory from '../pages/category/CreateCategory.vue';
import AllCategory from '../pages/category/AllCategory.vue';
import EditCategory from '../pages/category/EditCategory.vue';
import CreatePost from '../pages/post/CreatePost.vue';
import AllPost from '../pages/post/AllPost.vue';
import EditPost from '../pages/post/EditPost.vue';

const routes = [
  {path: '/', name: 'home', component: Home},
  {path: '/blog', name: 'blog', component: Blog},
  {path: '/about', name: 'about', component: About},
  {path: '/contact', name: 'contact', component: Contact},
  {
    path: '/blog/:slug',
    name: 'singleblog',
    component: SingleBlog
  },
  {
    path: '/login',
    name: 'login',
    component: Login,
    meta: { requiresGuest: true }
  },
  {
    path: '/register',
    name: 'register',
    component: Register,
    meta: { requiresGuest: true }
  },
  {
    path: '/dashboard',
    name: 'dashboard',
    component: Dashboard,
    meta: { requiresAuth: true }
  },
  {
    path: '/categories/create',
    name: 'CreateCategory',
    component: CreateCategory,
    meta: { requiresAuth: true }
  },
  {
    path: '/categories/view',
    name: 'ViewCategory',
    component: AllCategory,
    meta: { requiresAuth: true }
  },
  {
    path: '/categories/edit/:id', 
    name: 'EditCategory',
    component: EditCategory,
    meta: { requiresAuth: true },
    props: true
  },
   {
    path: '/posts/create',
    name: 'CreatePost',
    component: CreatePost,
    meta: { requiresAuth: true }
  },
  {
    path: '/posts/view',
    name: 'AllPost',
    component: AllPost,
    meta: { requiresAuth: true }
  },
   {
    path: '/posts/edit/:id',
    name: 'EditPost',
    component: EditPost,
    meta: { requiresAuth: true },
    props: true
  },


];

const router = createRouter({
  history: createWebHistory(),
  routes
});

router.beforeEach((to, from) => {
    const authenticated = localStorage.getItem("authenticated");

    if (to.meta.requiresGuest && authenticated) {
        return {
            name: "dashboard",
        };
    } else if (to.meta.requiresAuth && !authenticated) {
        return {
            name: "login",
        };
    }
});


export default router;
