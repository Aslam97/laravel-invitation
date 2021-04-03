import Vue from 'vue'

import Select from 'element-ui/lib/select'
import Option from 'element-ui/lib/option'

import locale from 'element-ui/lib/locale'
import id from 'element-ui/lib/locale/lang/id'

import 'element-ui/lib/theme-chalk/icon.css'
import 'element-ui/lib/theme-chalk/select.css'
import 'element-ui/lib/theme-chalk/option.css'

Vue.use(Select)
Vue.use(Option)

locale.use(id)
