import './bootstrap';
import { createApp } from 'vue';
import routes from './routes/routes';
import App from './components/App.vue';
createApp(App).use(routes).mount('#app')