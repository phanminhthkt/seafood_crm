/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue').default;
import VueRouter from 'vue-router';
Vue.use(VueRouter);
import routes from './router'
import bus from './bus'
Vue.use(bus)
/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))
Vue.component('template-component', require('./components/DashboardComponent.vue').default);
/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */



const router = new VueRouter({
    mode: 'history',
    routes,
});
const app = new Vue({
	data: {
	    user: window.__user__,
        baseUrl:window.__baseUrl__,
	    permission: window.__user__.permission,
	},
  router
}).$mount('#app')

// router.beforeEach((to, from, next) => {
//     let user = window.__user__
//     if (to.meta.requiredRole.includes(user.role)) {
//         next();
//     }else{
//         next({path: '/'})
//     }
// })
Vue.directive('check', {
    inserted(el, binding, vnode) {
        let action = binding.value.action;
        let component = binding.value.component;
        let permission = window.__user__.permission;
        let bool = false;
        for(let value in permission) {
		  if(permission[value].action === action && permission[value].module === component){
            bool = true;
		  }
		}
        if(bool == false){vnode.elm.parentElement.removeChild(vnode.elm);}
    }
});
