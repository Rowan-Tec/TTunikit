import './bootstrap';
import Alpine from 'alpinejs';
import '@tabler/icons-webfont/dist/tabler-icons.min.css';
import axios from 'axios';
window.axios = axios;

window.axios.defaults.headers.common['X-CSRF-TOKEN'] = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

window.Alpine = Alpine;

Alpine.start();
