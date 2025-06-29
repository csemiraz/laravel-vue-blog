import { createRouter, createWebHistory } from "vue-router";
import Home from '../pages/Home.vue';
import About from '../pages/About.vue';
import Contact from '../pages/Contact.vue';
import Blog from '../pages/Blog.vue';
import SingleBlog from '../pages/SingleBlog.vue';

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
];

const router = createRouter({
  history: createWebHistory(),
  routes
});

export default router;
