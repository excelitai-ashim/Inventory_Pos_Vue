require('./bootstrap');

import Vue from 'vue'
import VueRouter from 'vue-router'

Vue.use(VueRouter)

// routes import
import {routes} from './routes';

// User import
import User from './Helper/User';
window.User=User

// User import
import Notification from './Helper/Notification';
window.Notification=Notification

// sweetalert2 import
import Swal from 'sweetalert2'

window.Swal=Swal

const Toast = Swal.mixin({
  toast: true,
  position: 'top-end',
  showConfirmButton: false,
  timer: 3000,
  timerProgressBar: true,
  didOpen: (toast) => {
    toast.addEventListener('mouseenter', Swal.stopTimer)
    toast.addEventListener('mouseleave', Swal.resumeTimer)
  }
})
window.Toast=Toast



// Toast.fire({
//   icon: 'success',
//   title: 'Signed in successfully'
// })


// sweetalert2 End

//for window relode 
window.Reload=new Vue();





const router = new VueRouter({
    routes ,
    mode:'history'
    
  })


const app = new Vue({
    el: '#app',
    router
});
