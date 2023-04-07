import { createApp } from 'vue'
import app from './app.vue'
import './assets/main.css'
import router from './router'

createApp(app).use(router).mount('#app')
