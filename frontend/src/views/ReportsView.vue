<script setup lang="ts">
import { useAuthStore } from '@/stores/auth'

const authStore = useAuthStore()
</script>

<template>
  <div class="reports-view">
    <header class="top-bar">
      <div class="user-info">
        <div class="welcome">
          <h1 class="text-xl font-bold">Laporan & Statistik</h1>
          <p class="text-sm text-muted">Analisis performa dan riwayat konsultasi bulanan.</p>
        </div>
      </div>
    </header>

    <div class="stats-overview">
       <div class="report-grid">
          <div class="chart-placeholder card">
             <h3>Ringkasan Aktivitas</h3>
             <div class="placeholder-content">
                <svg viewBox="0 0 400 200">
                   <rect x="50" y="150" width="30" height="50" fill="#6366f1" />
                   <rect x="100" y="130" width="30" height="70" fill="#6366f1" />
                   <rect x="150" y="100" width="30" height="100" fill="#6366f1" />
                   <rect x="200" y="80" width="30" height="120" fill="#6366f1" />
                   <rect x="250" y="110" width="30" height="90" fill="#6366f1" />
                   <rect x="300" y="60" width="30" height="140" fill="#6366f1" />
                </svg>
             </div>
          </div>
          
          <div class="growth-card card">
             <h3>Pertumbuhan Pasien</h3>
             <p class="growth-value">+15%</p>
             <p class="text-muted">Dibandingkan bulan lalu</p>
          </div>
       </div>
    </div>
  </div>
</template>

<style scoped>
.top-bar {
  margin-bottom: 2rem;
}

.text-muted {
  color: #94a3b8;
}

.report-grid {
  display: grid;
  grid-template-columns: 2fr 1fr;
  gap: 1.5rem;
}

.card {
  background: #1e293b;
  padding: 1.5rem;
  border-radius: 1.25rem;
  border: 1px solid rgba(255, 255, 255, 0.05);
}

.chart-placeholder {
  min-height: 300px;
}

.placeholder-content {
  display: flex;
  align-items: center;
  justify-content: center;
  height: 200px;
}

.growth-value {
  font-size: 3rem;
  font-weight: 700;
  color: #10b981;
  margin: 1rem 0;
}
</style>
