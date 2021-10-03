/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');
window.VueRouter = require('vue-router');

import routes from "./router"

import axios from "axios"
import ElementPlus from 'element-plus'
import RootComponent from "./components/App.vue"

const router = VueRouter.createRouter({
    history: VueRouter.createWebHashHistory(),
    routes,
})

const app = Vue.createApp(RootComponent)

app.config.globalProperties.$http=axios

app.use(router)
    .use(ElementPlus);

app.mount('#app')

