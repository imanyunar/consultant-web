<script setup lang="ts">
import { useAuthStore } from '@/stores/auth'
import { useRouter } from 'vue-router'
import PatientHome from '@/components/dashboard/PatientHome.vue'
import PsychologistHome from '@/components/dashboard/PsychologistHome.vue'

const authStore = useAuthStore()
const router = useRouter()

function handleLogout() {
  authStore.logout()
  router.push('/login')
}
</script>

<template>
  <div class="home-container">
    <PatientHome v-if="authStore.userRole === 'patient'" />
    <PsychologistHome v-else-if="authStore.userRole === 'psychologist'" />
    <div v-else class="admin-home">
      <header class="top-bar">
        <div class="user-info">
          <div class="welcome">
            <h1 class="text-xl font-bold">Admin Dashboard</h1>
            <p class="text-sm text-muted">Selamat datang di panel kontrol administratif.</p>
          </div>
        </div>
      </header>
      
      <div class="admin-content">
        <div class="stats-grid">
          <div class="stat-card">
            <h3>Total Users</h3>
            <p class="value">150</p>
          </div>
          <div class="stat-card">
            <h3>Appointments Today</h3>
            <p class="value">24</p>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<style scoped>
.home-container {
  width: 100%;
}

.top-bar {
  display: flex;
  justify-content: space-between;
  align-items: center;
  margin-bottom: 2.5rem;
}

.text-muted {
  color: #94a3b8;
}

.stats-grid {
  display: grid;
  grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
  gap: 1.5rem;
}

.stat-card {
  background: #1e293b;
  padding: 1.5rem;
  border-radius: 1rem;
  border: 1px solid rgba(255, 255, 255, 0.05);
}

.stat-card h3 {
  color: #94a3b8;
  font-size: 0.9rem;
  margin-bottom: 0.5rem;
}

.stat-card .value {
  font-size: 1.5rem;
  font-weight: 700;
  color: #818cf8;
}
</style>
