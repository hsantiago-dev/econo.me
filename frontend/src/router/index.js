import Vue from 'vue'
import VueRouter from 'vue-router'
import Login from '../components/Login'
import Home from '../components/Home'

Vue.use(VueRouter)

const routes = [
  {
    path: '',
    name: 'Login',
    component: Login
  },
  {
    path: '/redirect-me',
    redirect: { name: 'Login' } },
  {
    path: '/home',
    name: 'Home',
    component: Home,
  },
]

const router = new VueRouter({
  routes
})

export default router
