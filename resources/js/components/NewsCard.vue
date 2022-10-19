<template>
  <div>
    <h3>
      {{ news.title }}
    </h3>
    <p>
      {{ news.content }}
    </p>
  </div>
</template>

<script>
import axios from 'axios'
export default {
  name: 'news-card',
  props: {
    id: {
      Type: Number,
      required: true
    }
  },
  data () {
    return {
      news: {}
    }
  },
  mounted () {
    this.load()
  },
  methods: {
    async load () {
      const { data } = await axios.get(`/api/news/${this.id}`)
      this.news = data
      console.dir(data)
    }
  }
}
</script>

<style scoped>

</style>
