import { ref } from 'vue'
import api from './api'

export function useUpdate(model: string) {
    const loading = ref(false)
    const error = ref<string | null>(null)

    const update = async (id: string | number, payload: any) => {
        loading.value = true
        error.value = null
        try {
            const response = await api.put(`/${model}/${id}`, payload)
            return response.data
        } catch (err: any) {
            error.value = err.response?.data?.message || 'Gagal memperbarui data'
            console.error(`Error updating ${model}:`, err)
            throw err
        } finally {
            loading.value = false
        }
    }

    return { loading, error, update }
}
