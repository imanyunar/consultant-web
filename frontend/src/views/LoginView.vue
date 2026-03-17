<script setup lang="ts">
import { ref, reactive, computed } from 'vue'
import { useRouter } from 'vue-router'
import { useAuthStore } from '@/stores/auth'

const router = useRouter()
const authStore = useAuthStore()

// Form state
const form = reactive({
  email: '',
  password: '',
})

const showPassword = ref(false)
const touched = reactive({
  email: false,
  password: false,
})

// Validation
const emailError = computed(() => {
  if (!touched.email) return ''
  if (!form.email) return 'Email wajib diisi'
  const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/
  if (!emailRegex.test(form.email)) return 'Format email tidak valid'
  return ''
})

const passwordError = computed(() => {
  if (!touched.password) return ''
  if (!form.password) return 'Password wajib diisi'
  if (form.password.length < 6) return 'Password minimal 6 karakter'
  return ''
})

const isFormValid = computed(() => {
  return (
    form.email &&
    form.password &&
    !emailError.value &&
    !passwordError.value
  )
})

// Submit
async function handleSubmit() {
  touched.email = true
  touched.password = true

  if (!isFormValid.value) return

  const success = await authStore.login(form.email, form.password)
  if (success) {
    router.push('/')
  }
}

function handleEmailBlur() {
  touched.email = true
}

function handlePasswordBlur() {
  touched.password = true
}

function handleInput() {
  if (authStore.error) authStore.clearError()
}
</script>

<template>
  <div class="login-page">
    <!-- Left Panel: Branding -->
    <div class="login-left">
      <div class="left-content">
        <div class="brand">
          <div class="brand-icon">
            <svg viewBox="0 0 40 40" fill="none" xmlns="http://www.w3.org/2000/svg">
              <rect width="40" height="40" rx="12" fill="url(#grad)" />
              <path d="M20 8C13.373 8 8 13.373 8 20s5.373 12 12 12 12-5.373 12-12S26.627 8 20 8zm0 4a8 8 0 110 16A8 8 0 0120 12zm-1 4v5l4 2.4-1 1.6-5-3V16h2z" fill="white"/>
              <defs>
                <linearGradient id="grad" x1="0" y1="0" x2="40" y2="40" gradientUnits="userSpaceOnUse">
                  <stop stop-color="#6366f1"/>
                  <stop offset="1" stop-color="#06b6d4"/>
                </linearGradient>
              </defs>
            </svg>
          </div>
          <span class="brand-name">AppointEase</span>
        </div>

        <div class="left-hero">
          <h1 class="hero-title">Kelola Janji Temu<br />dengan Mudah</h1>
          <p class="hero-desc">
            Platform manajemen appointment terpadu. Atur jadwal, pantau kehadiran,
            dan tingkatkan produktivitas tim Anda.
          </p>
        </div>

        <div class="features">
          <div class="feature-item">
            <div class="feature-dot"></div>
            <span>Penjadwalan otomatis & pengingat real-time</span>
          </div>
          <div class="feature-item">
            <div class="feature-dot"></div>
            <span>Dashboard analitik yang komprehensif</span>
          </div>
          <div class="feature-item">
            <div class="feature-dot"></div>
            <span>Integrasi kalender multi-platform</span>
          </div>
        </div>
      </div>

      <!-- Decorative blobs -->
      <div class="blob blob-1"></div>
      <div class="blob blob-2"></div>
      <div class="blob blob-3"></div>
    </div>

    <!-- Right Panel: Login Form -->
    <div class="login-right">
      <div class="form-wrapper">
        <!-- Mobile Logo -->
        <div class="mobile-brand">
          <div class="brand-icon">
            <svg viewBox="0 0 40 40" fill="none" xmlns="http://www.w3.org/2000/svg">
              <rect width="40" height="40" rx="12" fill="url(#grad2)" />
              <path d="M20 8C13.373 8 8 13.373 8 20s5.373 12 12 12 12-5.373 12-12S26.627 8 20 8zm0 4a8 8 0 110 16A8 8 0 0120 12zm-1 4v5l4 2.4-1 1.6-5-3V16h2z" fill="white"/>
              <defs>
                <linearGradient id="grad2" x1="0" y1="0" x2="40" y2="40" gradientUnits="userSpaceOnUse">
                  <stop stop-color="#6366f1"/>
                  <stop offset="1" stop-color="#06b6d4"/>
                </linearGradient>
              </defs>
            </svg>
          </div>
          <span class="brand-name">AppointEase</span>
        </div>

        <div class="form-header">
          <h2 class="form-title">Selamat Datang Kembali</h2>
          <p class="form-subtitle">Masuk ke akun Anda untuk melanjutkan</p>
        </div>

        <form @submit.prevent="handleSubmit" class="login-form" novalidate>
          <!-- API Error -->
          <Transition name="shake">
            <div v-if="authStore.error" class="alert alert-error" role="alert">
              <svg viewBox="0 0 20 20" fill="currentColor">
                <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/>
              </svg>
              <span>{{ authStore.error }}</span>
            </div>
          </Transition>

          <!-- Email Field -->
          <div class="form-group" :class="{ 'has-error': emailError }">
            <label for="email" class="form-label">Email</label>
            <div class="input-wrapper">
              <div class="input-icon">
                <svg viewBox="0 0 20 20" fill="currentColor">
                  <path d="M2.003 5.884L10 9.882l7.997-3.998A2 2 0 0016 4H4a2 2 0 00-1.997 1.884z"/>
                  <path d="M18 8.118l-8 4-8-4V14a2 2 0 002 2h12a2 2 0 002-2V8.118z"/>
                </svg>
              </div>
              <input
                id="email"
                v-model="form.email"
                type="email"
                class="form-input"
                placeholder="nama@perusahaan.com"
                autocomplete="email"
                :disabled="authStore.isLoading"
                @blur="handleEmailBlur"
                @input="handleInput"
              />
            </div>
            <Transition name="fade-down">
              <span v-if="emailError" class="error-msg">{{ emailError }}</span>
            </Transition>
          </div>

          <!-- Password Field -->
          <div class="form-group" :class="{ 'has-error': passwordError }">
            <div class="label-row">
              <label for="password" class="form-label">Password</label>
              <a href="#" class="forgot-link">Lupa Password?</a>
            </div>
            <div class="input-wrapper">
              <div class="input-icon">
                <svg viewBox="0 0 20 20" fill="currentColor">
                  <path fill-rule="evenodd" d="M5 9V7a5 5 0 0110 0v2a2 2 0 012 2v5a2 2 0 01-2 2H5a2 2 0 01-2-2v-5a2 2 0 012-2zm8-2v2H7V7a3 3 0 016 0z" clip-rule="evenodd"/>
                </svg>
              </div>
              <input
                id="password"
                v-model="form.password"
                :type="showPassword ? 'text' : 'password'"
                class="form-input"
                placeholder="Minimal 6 karakter"
                autocomplete="current-password"
                :disabled="authStore.isLoading"
                @blur="handlePasswordBlur"
                @input="handleInput"
              />
              <button
                type="button"
                class="toggle-password"
                :aria-label="showPassword ? 'Sembunyikan password' : 'Tampilkan password'"
                tabindex="-1"
                @click="showPassword = !showPassword"
              >
                <svg v-if="!showPassword" viewBox="0 0 20 20" fill="currentColor">
                  <path d="M10 12a2 2 0 100-4 2 2 0 000 4z"/>
                  <path fill-rule="evenodd" d="M.458 10C1.732 5.943 5.522 3 10 3s8.268 2.943 9.542 7c-1.274 4.057-5.064 7-9.542 7S1.732 14.057.458 10zM14 10a4 4 0 11-8 0 4 4 0 018 0z" clip-rule="evenodd"/>
                </svg>
                <svg v-else viewBox="0 0 20 20" fill="currentColor">
                  <path fill-rule="evenodd" d="M3.707 2.293a1 1 0 00-1.414 1.414l14 14a1 1 0 001.414-1.414l-1.473-1.473A10.014 10.014 0 0019.542 10C18.268 5.943 14.478 3 10 3a9.958 9.958 0 00-4.512 1.074l-1.78-1.781zm4.261 4.26l1.514 1.515a2.003 2.003 0 012.45 2.45l1.514 1.514a4 4 0 00-5.478-5.478z" clip-rule="evenodd"/>
                  <path d="M12.454 16.697L9.75 13.992a4 4 0 01-3.742-3.741L2.335 6.578A9.98 9.98 0 00.458 10c1.274 4.057 5.065 7 9.542 7 .847 0 1.669-.105 2.454-.303z"/>
                </svg>
              </button>
            </div>
            <Transition name="fade-down">
              <span v-if="passwordError" class="error-msg">{{ passwordError }}</span>
            </Transition>
          </div>

          <!-- Submit Button -->
          <button
            id="btn-login"
            type="submit"
            class="btn-submit"
            :disabled="authStore.isLoading"
          >
            <span v-if="!authStore.isLoading">Masuk</span>
            <span v-else class="loading-state">
              <span class="spinner"></span>
              <span>Memverifikasi...</span>
            </span>
          </button>
        </form>

        <p class="register-hint">
          Belum punya akun?
          <a href="#">Daftar sekarang</a>
        </p>
      </div>
    </div>
  </div>
</template>

<style scoped>
/* ========================
   Layout
======================== */
.login-page {
  display: flex;
  min-height: 100vh;
  background: var(--color-bg);
}

/* ========================
   Left Panel
======================== */
.login-left {
  flex: 1;
  position: relative;
  overflow: hidden;
  background: linear-gradient(135deg, #0f0f1a 0%, #1a1a2e 40%, #16213e 100%);
  display: flex;
  align-items: center;
  justify-content: center;
  padding: 3rem;
}

.left-content {
  position: relative;
  z-index: 2;
  max-width: 440px;
  animation: fadeSlideIn 0.7s ease forwards;
}

.brand {
  display: flex;
  align-items: center;
  gap: 0.75rem;
  margin-bottom: 3.5rem;
}

.brand-icon {
  width: 44px;
  height: 44px;
  flex-shrink: 0;
}

.brand-icon svg {
  width: 100%;
  height: 100%;
}

.brand-name {
  font-size: 1.25rem;
  font-weight: 700;
  background: linear-gradient(135deg, #818cf8, #06b6d4);
  -webkit-background-clip: text;
  -webkit-text-fill-color: transparent;
  background-clip: text;
}

.hero-title {
  font-size: 2.6rem;
  font-weight: 800;
  line-height: 1.2;
  margin-bottom: 1.25rem;
  background: linear-gradient(135deg, #f1f5f9 0%, #94a3b8 100%);
  -webkit-background-clip: text;
  -webkit-text-fill-color: transparent;
  background-clip: text;
}

.hero-desc {
  font-size: 1rem;
  color: var(--color-text-muted);
  line-height: 1.75;
  margin-bottom: 2.5rem;
}

.features {
  display: flex;
  flex-direction: column;
  gap: 0.9rem;
}

.feature-item {
  display: flex;
  align-items: center;
  gap: 0.875rem;
  color: var(--color-text-muted);
  font-size: 0.9rem;
}

.feature-dot {
  width: 8px;
  height: 8px;
  border-radius: 50%;
  background: linear-gradient(135deg, #6366f1, #06b6d4);
  flex-shrink: 0;
  box-shadow: 0 0 8px rgba(99, 102, 241, 0.6);
}

/* Decorative blobs */
.blob {
  position: absolute;
  border-radius: 50%;
  filter: blur(80px);
  opacity: 0.15;
  pointer-events: none;
}

.blob-1 {
  width: 350px;
  height: 350px;
  background: #6366f1;
  top: -100px;
  right: -100px;
}

.blob-2 {
  width: 250px;
  height: 250px;
  background: #06b6d4;
  bottom: 50px;
  left: -80px;
}

.blob-3 {
  width: 180px;
  height: 180px;
  background: #f43f5e;
  bottom: 150px;
  right: 80px;
}

/* ========================
   Right Panel
======================== */
.login-right {
  width: 480px;
  display: flex;
  align-items: center;
  justify-content: center;
  background: var(--color-surface);
  padding: 3rem 2rem;
  box-shadow: -10px 0 60px rgba(0, 0, 0, 0.4);
}

.form-wrapper {
  width: 100%;
  max-width: 380px;
  animation: fadeSlideIn 0.7s ease 0.1s forwards;
  opacity: 0;
}

/* Mobile brand (hidden on desktop) */
.mobile-brand {
  display: none;
  align-items: center;
  gap: 0.75rem;
  margin-bottom: 2rem;
  justify-content: center;
}

.form-header {
  margin-bottom: 2rem;
}

.form-title {
  font-size: 1.75rem;
  font-weight: 700;
  color: var(--color-text);
  margin-bottom: 0.4rem;
}

.form-subtitle {
  color: var(--color-text-muted);
  font-size: 0.925rem;
}

/* ========================
   Form Elements
======================== */
.login-form {
  display: flex;
  flex-direction: column;
  gap: 1.25rem;
}

.form-group {
  display: flex;
  flex-direction: column;
  gap: 0.5rem;
}

.label-row {
  display: flex;
  align-items: center;
  justify-content: space-between;
}

.form-label {
  font-size: 0.875rem;
  font-weight: 500;
  color: var(--color-text-muted);
}

.forgot-link {
  font-size: 0.8rem;
  color: var(--color-primary-light);
  transition: color var(--transition-fast);
}

.forgot-link:hover {
  color: var(--color-primary);
}

.input-wrapper {
  position: relative;
  display: flex;
  align-items: center;
}

.input-icon {
  position: absolute;
  left: 0.875rem;
  width: 18px;
  height: 18px;
  color: var(--color-text-subtle);
  pointer-events: none;
  transition: color var(--transition-fast);
}

.input-icon svg {
  width: 100%;
  height: 100%;
}

.form-input {
  width: 100%;
  background: rgba(255, 255, 255, 0.04);
  border: 1.5px solid var(--color-border);
  border-radius: var(--radius-sm);
  color: var(--color-text);
  font-size: 0.925rem;
  padding: 0.75rem 2.75rem 0.75rem 2.75rem;
  outline: none;
  transition:
    border-color var(--transition-fast),
    background var(--transition-fast),
    box-shadow var(--transition-fast);
}

.form-input::placeholder {
  color: var(--color-text-subtle);
}

.form-input:focus {
  border-color: var(--color-primary);
  background: rgba(99, 102, 241, 0.06);
  box-shadow: 0 0 0 3px rgba(99, 102, 241, 0.15);
}

.form-input:focus + .input-icon,
.input-wrapper:focus-within .input-icon {
  color: var(--color-primary-light);
}

.form-input:disabled {
  opacity: 0.6;
  cursor: not-allowed;
}

.has-error .form-input {
  border-color: var(--color-error);
}

.has-error .form-input:focus {
  box-shadow: 0 0 0 3px rgba(244, 63, 94, 0.15);
}

.toggle-password {
  position: absolute;
  right: 0.875rem;
  background: none;
  border: none;
  cursor: pointer;
  color: var(--color-text-subtle);
  width: 20px;
  height: 20px;
  padding: 0;
  display: flex;
  align-items: center;
  transition: color var(--transition-fast);
}

.toggle-password svg {
  width: 100%;
  height: 100%;
}

.toggle-password:hover {
  color: var(--color-text-muted);
}

.error-msg {
  font-size: 0.8rem;
  color: var(--color-error);
  display: flex;
  align-items: center;
  gap: 0.25rem;
}

/* ========================
   Alert
======================== */
.alert {
  display: flex;
  align-items: center;
  gap: 0.625rem;
  padding: 0.75rem 1rem;
  border-radius: var(--radius-sm);
  font-size: 0.875rem;
}

.alert svg {
  width: 18px;
  height: 18px;
  flex-shrink: 0;
}

.alert-error {
  background: rgba(244, 63, 94, 0.1);
  border: 1px solid rgba(244, 63, 94, 0.3);
  color: #fb7185;
}

/* ========================
   Submit Button
======================== */
.btn-submit {
  width: 100%;
  background: linear-gradient(135deg, #6366f1, #4f46e5);
  color: white;
  border: none;
  border-radius: var(--radius-sm);
  font-size: 0.95rem;
  font-weight: 600;
  padding: 0.875rem;
  cursor: pointer;
  margin-top: 0.5rem;
  transition:
    transform var(--transition-fast),
    box-shadow var(--transition-fast),
    opacity var(--transition-fast);
  box-shadow: 0 4px 15px rgba(99, 102, 241, 0.4);
  position: relative;
  overflow: hidden;
}

.btn-submit::before {
  content: '';
  position: absolute;
  inset: 0;
  background: linear-gradient(135deg, rgba(255,255,255,0.15), transparent);
  opacity: 0;
  transition: opacity var(--transition-fast);
}

.btn-submit:hover:not(:disabled)::before {
  opacity: 1;
}

.btn-submit:hover:not(:disabled) {
  transform: translateY(-1px);
  box-shadow: 0 6px 25px rgba(99, 102, 241, 0.55);
}

.btn-submit:active:not(:disabled) {
  transform: translateY(0);
}

.btn-submit:disabled {
  opacity: 0.7;
  cursor: not-allowed;
}

.loading-state {
  display: flex;
  align-items: center;
  justify-content: center;
  gap: 0.625rem;
}

.spinner {
  width: 18px;
  height: 18px;
  border: 2.5px solid rgba(255, 255, 255, 0.3);
  border-top-color: white;
  border-radius: 50%;
  animation: spin 0.8s linear infinite;
  flex-shrink: 0;
}

/* ========================
   Register Hint
======================== */
.register-hint {
  text-align: center;
  color: var(--color-text-muted);
  font-size: 0.875rem;
  margin-top: 1.75rem;
}

.register-hint a {
  color: var(--color-primary-light);
  font-weight: 500;
}

.register-hint a:hover {
  color: var(--color-primary);
}

/* ========================
   Animations
======================== */
@keyframes fadeSlideIn {
  from {
    opacity: 0;
    transform: translateY(16px);
  }
  to {
    opacity: 1;
    transform: translateY(0);
  }
}

@keyframes spin {
  to {
    transform: rotate(360deg);
  }
}

/* Transition: fade-down */
.fade-down-enter-active,
.fade-down-leave-active {
  transition: all 0.2s ease;
}
.fade-down-enter-from,
.fade-down-leave-to {
  opacity: 0;
  transform: translateY(-4px);
}

/* Transition: shake */
.shake-enter-active {
  animation: shake 0.4s ease;
}
@keyframes shake {
  0%, 100% { transform: translateX(0); }
  20% { transform: translateX(-6px); }
  40% { transform: translateX(6px); }
  60% { transform: translateX(-4px); }
  80% { transform: translateX(4px); }
}

/* ========================
   Responsive
======================== */
@media (max-width: 768px) {
  .login-page {
    flex-direction: column;
  }

  .login-left {
    display: none;
  }

  .login-right {
    width: 100%;
    min-height: 100vh;
    padding: 2.5rem 1.5rem;
    box-shadow: none;
  }

  .mobile-brand {
    display: flex;
  }

  .form-title {
    font-size: 1.5rem;
    text-align: center;
  }

  .form-subtitle {
    text-align: center;
  }
}
</style>
