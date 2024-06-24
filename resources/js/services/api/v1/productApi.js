import createAxiosInstance from '@/helpers/axios-wrapper.js';

const AxiosWrapper = createAxiosInstance();

export const search = async (search) => await AxiosWrapper.get(`products/search`, {
    search: search
})

