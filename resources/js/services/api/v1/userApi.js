import createAxiosInstance from '@/helpers/axios-wrapper.js';

const AxiosWrapper = createAxiosInstance();

export const find = async (uuid) => await AxiosWrapper.get(`ticket/${uuid}`)
export const activate = async (uuid) => await AxiosWrapper.get(`ticket/activate/${uuid}`)



