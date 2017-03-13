/**
 * @date:    2017-03-13
 * @file:    main.js
 * @author:  Patrick Mac Gregor <pmacgregor@3pc.de>
 */

const Moment = require('moment');
const MomentRange = require('moment-range');

window.moment = MomentRange.extendMoment(Moment);

import Vue from 'vue'

import App from './App.vue'

Vue.config.productionTip = false
Vue.use(require('vue-resource'))



/* eslint-disable no-new */
new Vue({
  el: '#app',
  render: h => h(App),
  data: {
    clientId: window.App.clientId
  }
})
