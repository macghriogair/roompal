/**
 * @date:    2017-03-13
 * @file:    main.js
 * @author:  Patrick Mac Gregor <pmacgregor@3pc.de>
 */

import Vue from 'vue'
import App from './App.vue'

Vue.config.productionTip = false

/* eslint-disable no-new */
window.app = new Vue({
  el: '#app',
  render: h => h(App)
})
