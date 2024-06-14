import {defineStore} from 'pinia';
import * as userApi from "@/services/api/v1/userApi.js";


function saveUser(payload) {
    localStorage.setItem('auth', JSON.stringify(payload));
}

function clearUser() {
    localStorage.removeItem('auth');
}

function getAuthData() {
    return JSON.parse(localStorage.getItem('auth'))
}

function getUser() {
    return getAuthData() ? getAuthData().user : null;
}

function getToken() {
    return getAuthData() ? getAuthData().token : null;
}

export const useMainStore = defineStore('auth', {
    state: () => ({
        user: getUser(),
        token: getToken(),
        menuCollapse: true
    }),
    getters: {
        isAuthenticated(state) {
            return !!state.token;
        },
    },
    actions: {
        collapseMenu(val) {
            return this.menuCollapse = val
        },
        setUser(payload) {
            saveUser(payload)


            this.user = payload.user;
            this.token = payload.user;
        },
        async logout() {
            try {
                await userApi.logout();
                clearUser();
                return {success: true};
            } catch (error) {
                console.error('Logout failed:', error);
                return {success: false, error};
            }
        },
        async login({email, password}) {
            try {
                const response = await userApi.login(email, password);

                if (response.token) {
                    this.setUser({
                        user: response.user,
                        token: response.token
                    });

                    this.token = response.token

                    return true;
                }
            } catch (error) {
                console.error('Login failed:', error);
                return false;
            }
        },
    },
});