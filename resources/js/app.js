import {createApp} from 'vue'
import {createPinia} from 'pinia'
import router from '@/router'
import Toast from "vue-toast-notification";
import App from './App.vue'
import '../css/app.css'
import 'vue-toast-notification/dist/theme-bootstrap.css';
import moment from "moment";

const pinia = createPinia()
import ToastService from 'primevue/toastservice';


const app = createApp(App)
    .use(router)
    .use(pinia)
    .use(Toast)
    .use(ToastService);

app.config
    .globalProperties.$formatDate = (date, formatStr) => moment(date).format(formatStr);

app.mount('#app')

const defaultDocumentTitle = 'Dorba App'

router.afterEach((to) => {
    document.title = to.meta?.title
        ? `${to.meta.title} — ${defaultDocumentTitle}`
        : defaultDocumentTitle
})

