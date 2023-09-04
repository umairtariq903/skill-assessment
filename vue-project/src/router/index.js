import { createRouter, createWebHistory } from 'vue-router'
import login from '../pages/Login.vue'
import QuoteView from '../pages/Quote.vue'
import FavoriteQuotes from '../pages/FavoriteQuotes.vue'

const router = createRouter({
  history: createWebHistory(import.meta.env.BASE_URL),
  routes: [
    {
      path: '/',
      name: 'login',
      component: login
    },
    {
      path: '/Quote',
      name: 'Quote',
      component: QuoteView
    },
    {
      path: '/FavoriteQuotes',
      name: 'FavoriteQuotes',
      component: FavoriteQuotes
    },
  ]
})

export default router
