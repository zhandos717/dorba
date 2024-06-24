import axios from "axios";
import Toast from 'primevue/toast';
import {useToast} from "primevue/usetoast";

function createAxiosInstance(API_URL = '/api/v1/') {

    const AxiosInstance = axios.create({
        baseURL: API_URL,
        headers: {
            "Content-Type": "application/json",
        },
    });


    AxiosInstance.interceptors.response.use(response => response, async (error) => {
        const toast = useToast();


        // if (error.response && error.response.status === 401) {
        //     const authStore = useMainStore();
        //
        //     await authStore.logout()
        // }

        if (error.response && error.response.data.errors) {
            Object.entries(error.response.data.errors).forEach(([field, messages]) => {

                console.log(messages);

                if (toast) {

                    toast.add({severity: 'error', summary: 'Ошибка', detail: messages.join(', '), life: 3000});

                } else {
                    alert(`Ошибки валидации: ${messages.join(', ')}`);
                }
            });

        } else if (error.response && error.response.data.message) {

            console.log(error.response.data.message);

            if (toast) {

                toast.add({severity: 'error', summary: 'Ошибка', detail: error.response.data.message, life: 3000});

            } else {
                alert(error.response.data.message);
            }
        }

        return Promise.reject(error);
    });


    return {
        get: async (endpoint, params = {}, headers = {}) => {
            const response = await AxiosInstance.get(endpoint, {params, headers});
            return response.data;
        },
        post: async (endpoint, data = {}, headers = {}) => {
            const response = await AxiosInstance.post(endpoint, data, {headers});
            return response.data;
        },
        put: async (endpoint, data = {}, headers = {}) => {
            const response = await AxiosInstance.put(endpoint, data, {headers});
            return response.data;
        },
        patch: async (endpoint, data = {}, headers = {}) => {
            const response = await AxiosInstance.patch(endpoint, data, {headers});
            return response.data;
        },
        delete: async (endpoint, headers = {}) => {
            const response = await AxiosInstance.delete(endpoint, {headers});
            return response.data;
        },
        getFile: async (endpoint, data = {}, headers = {}) => {
            const response = await AxiosInstance.post(endpoint, data, {headers, responseType: 'blob'});
            return response.data;
        },
    };
}

export default createAxiosInstance;
