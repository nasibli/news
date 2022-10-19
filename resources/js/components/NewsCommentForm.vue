<template>
  <div class="row">
    <div id="form-comment">
      <div class="col-12">
        <textarea v-model="content" rows="4" />
      </div>
      <div class="col-12">
        <button type="button"
                class="btn btn-success btn-sm mb-2 me-2 float-end"
                @click="cancel">Отменить</button>
        <button type="button"
                class="btn btn-success btn-sm mb-2 me-2 float-end"
                :disabled="content === ''"
                @click="save">Сохранить</button>
      </div>
    </div>
  </div>
</template>

<script>

import axios from 'axios'

export default {
  name: 'news-comment-form',
  props: {
    parentId: {
      type: Number,
      default: undefined
    },
    newsId: {
      type: Number,
      required: true
    },
  },
  data () {
    return {
      content: ''
    }
  },
  methods: {
    async save () {
      if (this.content === '') {
        return false
      }
      let path = `/api/news/${this.newsId}/comments`
      if (this.parentId) {
        path += '/' + this.parentId
      }
      axios.post(path, { content: this.content })
        .then(response => {
          const data = response.data
          this.content = ''
          this.$emit('saved', data)
        })
        .catch(error => {
          console.log(error)
        })
    },
    cancel () {
      this.content = ''
      this.$emit('cancelled')
    }
  }
}
</script>

<style scoped>
  textarea {
    width: 100%;
  }

  #form-comment {
    position: fixed;
    width: 90%;
    bottom: 0;
    left:0;
    background-color: #e2e8f0;
  }
</style>
