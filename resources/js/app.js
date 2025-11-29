

import { library } from '@fortawesome/fontawesome-svg-core'
import { fas } from '@fortawesome/free-solid-svg-icons'

import { FontAwesomeIcon } from '@fortawesome/vue-fontawesome'
library.add(fas)

import Toast from "vue-toastification";
import "vue-toastification/dist/index.css";

import Swal from 'sweetalert2'
window.Swal = Swal

import { createApp } from 'vue';
import router from './router'

import cards from './components/contents/cards.vue'
import dashboard from './components/contents/dashboard.vue'



createApp({})
.component('cards', cards)
.component('dashboard', dashboard)
.component('fas', FontAwesomeIcon )
.use(router)
.use(Toast)
.mount('#app')






