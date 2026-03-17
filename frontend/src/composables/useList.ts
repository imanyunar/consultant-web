import { ref } from 'vue'
import api from './api'

export function useList(model: string) {
    const data = ref<any[]>([])
    const loading = ref(false)
    const error = ref<string | null>(null)
    const pagination = ref({
        current_page: 1,
        last_page: 1,
        total: 0,
        per_page: 10
    })

    const fetchList = async (params = {}) => {
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
            console.error(`Error fetching list ${model}:`, err)
        } finally {
            loading.value = false
        }
    }

    return { data, loading, error, pagination, fetchList }
}
