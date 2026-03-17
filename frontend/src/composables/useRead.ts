import { ref } from 'vue'
import api from './api'

export function useRead(model: string) {
    const item = ref<any>(null)
    const loading = ref(false)
    const error = ref<string | null>(null)

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
            console.error(`Error fetching detail ${model}:`, err)
        } finally {
            loading.value = false
        }
    }

    return { item, loading, error, fetchOne }
}
