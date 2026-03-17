import { defineStore } from 'pinia'
import { ref } from 'vue'

export const useAuthStore = defineStore('auth', () => {
  const isLoading = ref(false)
  const error = ref<string | null>(null)
  const isAuthenticated = ref(!!localStorage.getItem('token'))
  const userEmail = ref<string | null>(localStorage.getItem('userEmail'))
  const userRole = ref<string | null>(localStorage.getItem('userRole'))

  async function login(email: string, password: string): Promise<boolean> {
    isLoading.value = true
    error.value = null

    try {
      // Simulasi API call – ganti dengan real API endpoint
      await new Promise((resolve) => setTimeout(resolve, 1500))

      // Simulasi: login berhasil jika password minimal 6 karakter
      if (password.length >= 6) {
        const mockToken = 'mock-token-' + Math.random().toString(36).substr(2)
        localStorage.setItem('token', mockToken)
        localStorage.setItem('userEmail', email)
        isAuthenticated.value = true
        userEmail.value = email
        // Simulasi role: super_admin jika email mengandung superadmin, psychologists jika mengandung psikolog, sisanya patient
        let role = 'patient'
        if (email.includes('superadmin')) {
          role = 'super_admin'
        } else if (email.includes('psikolog')) {
          role = 'psychologist'
        }
        userRole.value = role
        localStorage.setItem('userRole', role)
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
    localStorage.removeItem('token')
    localStorage.removeItem('userEmail')
    localStorage.removeItem('userRole')
    isAuthenticated.value = false
    userEmail.value = null
    userRole.value = null
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
    userRole,
    login,
    logout,
    clearError,
  }
})
