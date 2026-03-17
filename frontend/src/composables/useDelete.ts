import { ref } from 'vue'
import api from './api'

export function useDelete(model: string) {
    const loading = ref(false)
    const error = ref<string | null>(null)

    const destroy = async (id: string | number) => {
        loading.value = true
        error.value = null
        try {
            const response = await api.delete(`/${model}/${id}`)
            return response.data
        } catch (err: any) {
            error.value = err.response?.data?.message || 'Gagal menghapus data'
            console.error(`Error deleting ${model}:`, err)
            throw err
        } finally {
            loading.value = false
        }
    }

    return { loading, error, destroy }
}
