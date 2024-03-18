import 'bootstrap';
import 'bootstrap/dist/css/bootstrap.min.css';import { createApp } from 'vue'
import App from './App.vue'
import router from './router'
import { createApp } from 'vue';
import store from './store'; // J'importe le store que je viens de créer

createApp(App).use(router).mount('#app')

const app = createApp(App);

app.use(store); // J'utilise le store dans mon application Vue

app.mount('#app');