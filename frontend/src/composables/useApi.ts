import { ref } from 'vue'
import axios, { type InternalAxiosRequestConfig } from 'axios'

const api = axios.create({
    baseURL: 'http://localhost:8000/api',
})

// Add a request interceptor to include the token
api.interceptors.request.use((config: any) => {
    const token = localStorage.getItem('token')
    if (token) {
        config.headers.Authorization = `Bearer ${token}`
    }
    return config
})

export function useApi(model: string) {
    const data = ref<any[]>([])
    const item = ref<any>(null)
    const loading = ref(false)
    const error = ref<string | null>(null)
    const pagination = ref({
        current_page: 1,
        last_page: 1,
        total: 0,
        per_page: 10
    })

    const fetchAll = async (params = {}) => {
        loading.value = true
        error.value = null
        try {
            const response = await api.get(`/${model}`, { params })
            if (response.data.success) {
                // Handling generic index structure
                if (response.data.data && response.data.data.data) {
                    data.value = response.data.data.data
                    pagination.value = {
                        current_page: response.data.data.current_page,
                        last_page: response.data.data.last_page,
                        total: response.data.data.total,
                        per_page: response.data.data.per_page
                    }
                } else {
                    data.value = response.data.data
                }
            }
        } catch (err: any) {
            error.value = err.response?.data?.message || 'Gagal mengambil data'
            console.error(`Error fetching ${model}:`, err)
        } finally {
            loading.value = false
        }
    }

    const fetchOne = async (id: string | number) => {
        loading.value = true
        error.value = null
        try {
            const response = await api.get(`/${model}/${id}`)
            if (response.data.success) {
                item.value = response.data.data
            }
        } catch (err: any) {
            error.value = err.response?.data?.message || 'Gagal mengambil detail data'
            console.error(`Error fetching ${model} detail:`, err)
        } finally {
            loading.value = false
        }
    }

    const executeAction = async (id: string | number, action: string, params = {}) => {
        loading.value = true
        error.value = null
        try {
            const response = await api.get(`/${model}/${id}/${action}`, { params })
            return response.data
        } catch (err: any) {
            error.value = err.response?.data?.message || `Gagal menjalankan aksi ${action}`
            throw err
        } finally {
            loading.value = false
        }
    }

    return {
        data,
        item,
        loading,
        error,
        pagination,
        fetchAll,
        fetchOne,
        executeAction
    }
}
