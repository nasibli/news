import Vue from 'vue'
import store from '~/store'
import router from '~/router'
import i18n from '~/plugins/i18n'
import App from '~/components/App'

import '~/plugins'
import '~/components'

import dateFullFilter from '~/filters/date-full'

Vue.config.productionTip = false
Vue.filter('dateFull', dateFullFilter)
/* eslint-disable no-new */
new Vue({
  i18n,
  store,
  router,
  ...App
})
