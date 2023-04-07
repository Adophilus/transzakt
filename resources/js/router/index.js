import { createRouter, createWebHistory } from 'vue-router'
import Dashboard from '../views/dashboard.vue'
import Home from '../views/home.vue'
import Transactions from '../views/transactions.vue'
import Users from '../views/users.vue'

const routes = [
  {
    path: '/',
    component: Dashboard,
    children: [
      {
        path: 'dashboard',
        name: 'dashboard',
        component: Home
      },
      {
        path: 'users',
        name: 'users',
        component: Users
      },
      {
        path: 'transactions',
        name: 'transactions',
        component: Transactions
      }
    ]
  }
]


const router = createRouter({
  history: createWebHistory(),
  routes
})

export default router
