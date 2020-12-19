import Vue from 'vue'
import Router from 'vue-router'
import Home from '@/components/Home'
import PokemonDetail from '@/components/PokemonDetail'
import signup from '@/components/signup'
import signin from '@/components/signin'
import team from '@/components/Team'

Vue.use(Router)

const router = new Router({
  mode: 'history',
  routes: [
    {
      path: '/',
      name: 'Home',
      component: Home
    },
    {
      path: '/pokemon/:id',
      name: 'PokemonDetail',
      component: PokemonDetail
    },
    {
      path: '/signup',
      name: 'signup',
      component: signup
    },
    {
      path: '/signin',
      name: 'signin',
      component: signin
    },
    {
      path: '/team',
      name: 'team',
      component: team
    }
  ]
})

export default router
