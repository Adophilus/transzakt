import { createApp } from "vue";
import app from './app.vue';
import router from './router'
import './assets/main.css'

createApp(app).use(router).mount("#app");
