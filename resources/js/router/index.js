import {createRouter, createWebHistory} from 'vue-router';
import {useMainStore} from "@/stores/mainStore.js";
import routes from "@/router/routes.js";

const router = createRouter({
    history: createWebHistory(),
    routes,
    scrollBehavior(to, from, savedPosition) {
        return savedPosition || {top: 0};
    }
});

// router.beforeEach((to, from, next) => {
//     const authStore = useMainStore();
//
// });

export default router;
