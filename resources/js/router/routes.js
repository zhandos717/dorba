export default [
    {
        meta: {
            title: 'Главная'
        },
        path: '/',
        name: 'home',
        component: () => import('@/views/HomeView.vue')
    },
    {
        path: '/login',
        name: 'Login',
        component: () => import('@/views/LoginView.vue')
    },
]
