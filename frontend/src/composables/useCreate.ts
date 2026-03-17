import { ref } from 'vue'
import api from './api'

export function useCreate(model: string) {
    const loading = ref(false)
    const error = ref<string | null>(null)

    const create = async (payload: any) => {
        loading.value = true
        error.value = null
        try {
            const response = await api.post(`/${model}`, payload)
            return response.data
        } catch (err: any) {
            error.value = err.response?.data?.message || 'Gagal menambah data'
            console.error(`Error creating ${model}:`, err)
            throw err
        } finally {
            loading.value = false
        }
    }

    return { loading, error, create }
}
