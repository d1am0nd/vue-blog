import Vue from 'vue'
import auth from '@/auth/auth'
import Router from 'vue-router'
import Home from '@/components/pages/show/Home'
import Post from '@/components/pages/show/Post'
import Login from '@/components/pages/auth/Login'
import NewPost from '@/components/pages/write/NewPost'
import EditPost from '@/components/pages/write/EditPost'
import Register from '@/components/pages/auth/Register'

Vue.use(Router)

var router = new Router({
  // mode: 'history',
  routes: [
    {
      path: '/',
      name: 'home',
      component: Home
    },
    {
      path: '/register',
      name: 'register',
      component: Register
    },
    {
      path: '/login',
      name: 'login',
      component: Login
    },
    {
      path: '/admin/posts/write',
      name: 'newPost',
      component: NewPost
    },
    {
      path: '/admin/posts/edit/:slug',
      name: 'editPost',
      component: EditPost
    },
    {
      path: '/posts/:slug',
      name: 'post',
      component: Post
    }
  ]
})

export default router

var authRoutes = [
  'newPost'
]
var guestRoutes = [
  'register',
  'login'
]

router.beforeEach((to, from, next) => {
  if (guestRoutes.indexOf(to.name) !== -1 && auth.check) {
    router.push({name: 'home'})
  } else if (authRoutes.indexOf(to.name) !== -1 && !auth.check) {
    router.push({name: 'login'})
  } else {
    next()
  }
})
