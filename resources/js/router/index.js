import { createRouter, createWebHistory } from "vue-router";
import Home from '../pages/Home.vue';
import About from '../pages/About.vue';
import Contact from '../pages/Contact.vue';
import Blog from '../pages/Blog.vue';
import SingleBlog from '../pages/SingleBlog.vue';
import Login from '../pages/Login.vue';
import Register from '../pages/Register.vue';
import Dashboard from '../pages/Dashboard.vue';

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
    component: Login
  },
  {
    path: '/register',
    name: 'register',
    component: Register
  },
  {
    path: '/dashboard',
    name: 'dashboard',
    component: Dashboard
  },
];

const router = createRouter({
  history: createWebHistory(),
  routes
});

export default router;
