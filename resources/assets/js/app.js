"use strict";

/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

/**
 * Font Awesome 5
 */
import fontawesome from '@fortawesome/fontawesome';
import solid from '@fortawesome/fontawesome-free-solid';
import regular from '@fortawesome/fontawesome-free-regular';
import brands from '@fortawesome/fontawesome-free-brands';
fontawesome.library.add(solid);
fontawesome.library.add(regular);
fontawesome.library.add(brands);

/**
 * Vue Avatar
 */

import Avatar from 'vue-avatar';
Vue.component('avatar', Avatar);

/**
 * Algolia Instant Search
 */

import InstantSearch from 'vue-instantsearch';
Vue.use(InstantSearch);

/**
 * Search Component
 */
Vue.component('search', require('./components/SearchComponent'));

import StarRating from 'vue-star-rating';
Vue.component('star-rating',StarRating);

import VueResource from 'vue-resource';
Vue.use(VueResource);

Vue.component('comment-area',require('./components/CommentComponents/CommentArea'));
Vue.component('comment-text',require('./components/CommentComponents/CommentText'));
Vue.component('rating',require('./components/RatingComponents/RatingComponent'));

Vue.http.headers.common['X-CSRF-TOKEN'] = document.querySelector('meta[name=csrf-token]').getAttribute('content');

const app = new Vue({
    el: '#app'
});
