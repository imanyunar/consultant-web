import { defineStore } from 'pinia'
import { ref } from 'vue'

export const useAuthStore = defineStore('auth', () => {
  const isLoading = ref(false)
  const error = ref<string | null>(null)
  const isAuthenticated = ref(false)
  const userEmail = ref<string | null>(null)

  async function login(email: string, password: string): Promise<boolean> {
    isLoading.value = true
    error.value = null

    try {
      // Simulasi API call – ganti dengan real API endpoint
      await new Promise((resolve) => setTimeout(resolve, 1500))

      // Simulasi: login berhasil jika password minimal 6 karakter
      if (password.length >= 6) {
        isAuthenticated.value = true
        userEmail.value = email
        return true
      } else {
        error.value = 'Email atau password salah. Silakan coba lagi.'
        return false
      }
    } catch (err) {
      error.value = 'Terjadi kesalahan. Silakan coba lagi nanti.'
      return false
    } finally {
      isLoading.value = false
    }
  }

  function logout() {
    isAuthenticated.value = false
    userEmail.value = null
    error.value = null
  }

  function clearError() {
    error.value = null
  }

  return {
    isLoading,
    error,
    isAuthenticated,
    userEmail,
    login,
    logout,
    clearError,
  }
})
