import 'bootstrap/dist/css/bootstrap.min.css'
import 'bootstrap'

import { createApp } from 'vue'
import vuetify from './plugins/vuetify'
import router from './router'
import App from './App.vue'

import './assets/style.css'
import 'vue3-toastify/dist/index.css';

import Vue3PersianDatetimePicker from 'vue3-persian-datetime-picker'
// import { VuelidatePlugin } from '@vuelidate/core'

const app = createApp(App)

app.use(vuetify)
app.use(router)
// app.use(VuelidatePlugin)

app.component('date-picker', Vue3PersianDatetimePicker)

app.mount('#app')
