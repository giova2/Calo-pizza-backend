/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

import { createApp } from 'vue/dist/vue.esm-bundler';


import { postMethods } from "./postMethods.js";
/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))

// Vue.component(
//     "example-component",
//     require("./components/ExampleComponent.vue").default
// );

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

document.addEventListener("DOMContentLoaded", event => {
    let selectItems = {};
    document.body.querySelectorAll(".item-status").forEach(elem => {    
        selectItems[elem.id] = elem.value;
    });
    let selectOrders = {};
    document.body.querySelectorAll(".order-status").forEach(elem => {
        selectOrders[elem.id] = elem.value;
    });
    
    var data = {
        csrfToken: document.querySelector('meta[name="csrf-token"]').content,
        ...selectItems,
        ...selectOrders
    };

    const app = createApp({
        data() {
            return data;
        },
        methods: { ...postMethods }
    });
    
    app.mount('#app');
});
