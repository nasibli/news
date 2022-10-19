<template>
  <div class="row">
    <div class="col-lg-10 m-auto">
      <news-card :id="$route.params.id" />
    </div>
    <div class="col-lg-10 m-auto">
      <news-comments :news-id="$route.params.id" />
    </div>
  </div>
</template>

<script>
// import axios from 'axios'
import NewsCard from '../components/NewsCard'
import NewsComments from '../components/NewsComments'
export default {
  components: { NewsComments, NewsCard },
  middleware: 'auth'
}
</script>
