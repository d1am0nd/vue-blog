<template>
  <div class="images">
    <h1>Hip Hop Blog Images</h1>

    <div class="row" v-for="image in images">
      <div class="col-md-12">
        <router-link :to="{ name: 'editImage', params: { id: image.id } }">
          <img :src="image.path">
        </router-link>
      </div>
    </div>
  </div>
</template>

<script>
import Errors from '@/errors'
import images from '@/services/db/images'

export default {
  name: 'images',
  data () {
    return {
      images: []
    }
  },
  created () {
    this.fetchData()
  },
  methods: {
    fetchData () {
      images.getImages()
      .then((res) => {
        this.images = res.body
      })
      .catch((err) => {
        Errors.newErrRes(err)
      })
    }
  }
}
</script>
