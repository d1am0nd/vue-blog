<template>
  <div class="hello">
    <h1>Hip Hop Blog</h1>

    <div class="row" v-for="post in posts">
      <div class="col-md-12">
        <QuickPost :post="post"></QuickPost>
      </div>
    </div>
  </div>
</template>

<script>
import QuickPost from '@/components/partials/post/QuickPostRender'
import Errors from '@/errors'
import posts from '@/services/db/posts'

export default {
  name: 'hello',
  components: {
    QuickPost: QuickPost
  },
  data () {
    return {
      posts: []
    }
  },
  created () {
    this.fetchData()
  },
  methods: {
    fetchData () {
      posts.getPublished()
      .then((res) => {
        this.posts = res.body
      })
      .catch((err) => {
        Errors.newErrRes(err)
      })
    }
  }
}
</script>
