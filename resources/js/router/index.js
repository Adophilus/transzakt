import { createRouter, createWebHistory } from 'vue-router'
import Dashboard from '../views/dashboard.vue'
import Home from '../views/home.vue'
import Users from '../views/users.vue'

const routes = [
  {
    path: '/', component: Dashboard,
    children: [
      {
        path: '',
        component: Home
      },
      {
        path: 'users',
        component: Users
      }
    ]
  }
]


const router = createRouter({
  history: createWebHistory(),
  routes
})

export default router
