import './bootstrap';

import CreateLinkComponent from './components/CreateLink.vue';

Vue.component('create-link', CreateLinkComponent);

const app = new Vue({
    el: '#root'
});
