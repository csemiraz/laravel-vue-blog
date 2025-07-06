import './bootstrap';
import { createApp } from 'vue';
import App from './App.vue';
import router from './router';
import '../css/app.css'
//import axios from 'axios';

const app = createApp(App);

//axios.defaults.baseURL = 'http://127.0.0.1:8000';
//axios.defaults.withCredentials = true;

app.use(router);
app.mount('#app');
