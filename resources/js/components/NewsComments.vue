<template>
  <div>
    <h4>
      Comments
      <span v-if="commentsCount > 0"> ({{commentsCount}}) </span>
    </h4>
    <div v-for="comment in comments"
         :key="comment.id"
         class="row">
      <div class="col-3"> {{ getUserName(comment) }} </div>
      <div class="col-9"> <p class="text-end"> {{ comment.created_at | dateFull }} </p></div>
      <div class="col-12">
        {{ comment.content }}
      </div>
      <div v-if="subComments[comment.id]">
        <div v-for="subComment in subComments[comment.id]"
             :key="subComment.id"
             class="row ms-5 mt-1 mb-1">
          <div class="col-3"> {{ getUserName(subComment) }} </div>
          <div class="col-9"> <p class="text-end"> {{ subComment.created_at | dateFull }} </p></div>
          <div class="col-12">
            {{ subComment.content }}
          </div>
          <hr />
        </div>
      </div>
      <div class="row justify-content-end">
        <div class="col-1">
          <button type="button"
                  class="btn btn-success btn-sm mb-2 me-2"
                  @click="respond(comment)">Ответить</button>
        </div>
      </div>
      <hr />
    </div>
    <div class="row justify-content-end">
      <div class="col-1">
        <button type="button"
                class="btn btn-success btn-sm mb-2 me-2"
                @click="respond">Ответить</button>
      </div>
    </div>
    <news-comment-form v-if="showForm"
                       :news-id="newsId"
                       :parent-id="parentId"
                       @saved="onSaved"
                       @cancelled="onCancelled"/>
  </div>
</template>

<script>
import axios from 'axios'
import { mapGetters } from 'vuex'
import NewsCommentForm from './NewsCommentForm'

export default {
  name: 'NewsComments',
  components: { NewsCommentForm },
  props: {
    newsId: {
      Type: Number,
      required: true
    }
  },
  data () {
    return {
      comments: [],
      subComments: {},
      showForm: false,
      parentId: undefined
    }
  },
  mounted () {
    this.load()
  },
  computed: {
    commentsCount () {
      let subCommentsCount = 0
      for (const key in this.subComments) {
        subCommentsCount += this.subComments[key].length
      }
      return this.comments.length + subCommentsCount
    },
    ...mapGetters({
      user: 'auth/user'
    })
  },
  methods: {
    async load () {
      const { data } = await axios.get(`/api/news/${this.newsId}/comments`)
      this.comments = data.newsComments
      this.subComments = data.subComments
    },
    getUserName (comment) {
      return comment.user_id === this.user.id ? 'Вы' : comment.user_name
    },
    respond (comment) {
      if (comment) {
        this.parentId = comment.id
      }
      this.showForm = true
    },
    onSaved (comment) {
      if (comment.parent_id) {
        if (this.subComments[comment.parent_id] === undefined) {
          this.subComments[comment.parent_id] = []
        }
        this.subComments[comment.parent_id].push(comment)
      } else {
        this.comments.push(comment)
      }
      this.parentId = undefined
      this.showForm = false
    },
    onCancelled () {
      this.parentId = undefined
      this.showForm = false
    }
  }
}
</script>

<style scoped>

</style>
