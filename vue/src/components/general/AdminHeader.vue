<template>
  <section class="admin-header">
    <div class="row">
      <div class="six columns">
        <ul>
          <li v-if="auth.check"><router-link :to="{ name: 'newPost' }">New post</router-link></li>
        </ul>
      </div>
      <div class="six columns">
        <ul>
          <li v-for="post in myPosts">
            <router-link :to="{ name: 'post', params: { slug: post.slug } }">{{ post.title }}</router-link>
          </li>
        </ul>
      </div>
    </div>
  </section>
</template>

<script>
import auth from '@/auth/auth'
import Errors from '@/errors'
import posts from '@/services/db/posts'

export default {
  name: 'Header',
  data () {
    return {
      auth: this.$root.auth,
      myPosts: []
    }
  },
  methods: {
    logout () {
      auth.logout()
    },
    refreshAuth () {
      auth.refresh()
    },
    checkAuth () {
      return auth.checkAuth()
    }
  },
  created () {
    posts.getMine()
    .then((res) => {
      console.log(res.body)
      this.myPosts = (res.body)
    })
    .catch((err) => {
      Errors.newErrRes(err)
    })
  }
}
</script>
