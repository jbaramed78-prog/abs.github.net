import { library } from '@fortawesome/fontawesome-svg-core'
import { fas } from '@fortawesome/free-solid-svg-icons'

import { FontAwesomeIcon } from '@fortawesome/vue-fontawesome'
library.add(fas)
import LoginRoot from "./components/LoginRoot";
import { createApp } from 'vue';

createApp(LoginRoot)
.component('fas', FontAwesomeIcon )
.mount('#login')
// let Xmas95 = new Date('December 25, 1995 13:30:45');
// let hours = Xmas95.getHours();
// let minutes = Xmas95.getMinutes()
// console.log(hours); // 23
// console.log(hours+minutes/60);
