<script setup lang="ts">
import { onMounted } from 'vue'
import { useApi } from '@/composables/useApi'

const { data: appointments, loading, error, fetchAll } = useApi('appointments')

onMounted(() => {
  fetchAll()
})

const formatDate = (dateStr: string) => {
  return new Date(dateStr).toLocaleDateString('id-ID', {
    day: 'numeric',
    month: 'long',
    year: 'numeric'
  })
}
</script>

<template>
  <div class="appointments-view">
    <header class="top-bar">
      <div class="user-info">
        <div class="welcome">
          <h1 class="text-xl font-bold">Janji Temu</h1>
          <p class="text-sm text-muted">Kelola semua jadwal pertemuan Anda di sini.</p>
        </div>
      </div>
      <div class="actions">
        <button class="btn-primary">Buat Janji Baru</button>
      </div>
    </header>

    <div class="content-card">
      <div class="table-header">
        <div class="filters">
          <span class="filter-chip active">Semua</span>
          <span class="filter-chip">Mendatang</span>
          <span class="filter-chip">Selesai</span>
        </div>
      </div>

      <div v-if="loading" class="loading-state">
        <div class="spinner"></div>
        <p>Memuat data...</p>
      </div>

      <div v-else-if="error" class="error-state">
        <p>{{ error }}</p>
        <button @click="fetchAll()" class="btn-small">Coba Lagi</button>
      </div>

      <div v-else-if="appointments.length > 0" class="table-container">
        <table class="data-table">
          <thead>
            <tr>
              <th>Pasien</th>
              <th>Psikolog</th>
              <th>Tanggal</th>
              <th>Waktu</th>
              <th>Status</th>
              <th>Aksi</th>
            </tr>
          </thead>
          <tbody>
            <tr v-for="appt in appointments" :key="appt.id">
              <td>{{ appt.patient?.name || '-' }}</td>
              <td>{{ appt.psychologist?.name || '-' }}</td>
              <td>{{ formatDate(appt.appointment_date) }}</td>
              <td>{{ appt.appointment_time }}</td>
              <td>
                <span :class="['status-badge', appt.status]">
                  {{ appt.status }}
                </span>
              </td>
              <td>
                <button class="btn-icon">👁️</button>
              </td>
            </tr>
          </tbody>
        </table>
      </div>

      <div v-else class="empty-state">
        <div class="empty-icon">📅</div>
        <h3>Belum ada janji temu</h3>
        <p>Anda belum memiliki jadwal janji temu saat ini.</p>
      </div>
    </div>
  </div>
</template>

<style scoped>
.top-bar {
  display: flex;
  justify-content: space-between;
  align-items: center;
  margin-bottom: 2rem;
}

.text-muted {
  color: #94a3b8;
}

.btn-primary {
  background: #6366f1;
  color: white;
  border: none;
  padding: 0.75rem 1.5rem;
  border-radius: 0.75rem;
  font-weight: 600;
  cursor: pointer;
  transition: all 0.2s;
}

.btn-primary:hover {
  background: #4f46e5;
}

.content-card {
  background: #1e293b;
  border-radius: 1.25rem;
  padding: 1.5rem;
  min-height: 400px;
}

.table-header {
  margin-bottom: 2rem;
}

.filters {
  display: flex;
  gap: 0.75rem;
}

.filter-chip {
  padding: 0.5rem 1rem;
  border-radius: 2rem;
  background: rgba(255, 255, 255, 0.05);
  font-size: 0.85rem;
  color: #94a3b8;
  cursor: pointer;
}

.filter-chip.active {
  background: rgba(99, 102, 241, 0.2);
  color: #818cf8;
}

/* Table Styles */
.table-container {
  overflow-x: auto;
}

.data-table {
  width: 100%;
  border-collapse: collapse;
  text-align: left;
}

.data-table th {
  padding: 1rem;
  border-bottom: 1px solid rgba(255, 255, 255, 0.05);
  color: #94a3b8;
  font-weight: 500;
  font-size: 0.9rem;
}

.data-table td {
  padding: 1.25rem 1rem;
  border-bottom: 1px solid rgba(255, 255, 255, 0.02);
  font-size: 0.95rem;
}

.status-badge {
  padding: 0.25rem 0.75rem;
  border-radius: 2rem;
  font-size: 0.8rem;
  font-weight: 600;
  text-transform: capitalize;
}

.status-badge.scheduled { background: rgba(59, 130, 246, 0.1); color: #60a5fa; }
.status-badge.completed { background: rgba(16, 185, 129, 0.1); color: #34d399; }
.status-badge.cancelled { background: rgba(244, 63, 94, 0.1); color: #fb7185; }

.btn-icon {
  background: none;
  border: none;
  cursor: pointer;
  font-size: 1.2rem;
}

/* Loading/Error States */
.loading-state, .error-state, .empty-state {
  display: flex;
  flex-direction: column;
  align-items: center;
  justify-content: center;
  padding: 4rem 1rem;
  color: #94a3b8;
}

.spinner {
  width: 40px;
  height: 40px;
  border: 4px solid rgba(255, 255, 255, 0.1);
  border-left-color: #6366f1;
  border-radius: 50%;
  animation: spin 1s linear infinite;
  margin-bottom: 1rem;
}

@keyframes spin {
  to { transform: rotate(360deg); }
}

.empty-icon {
  font-size: 3rem;
  margin-bottom: 1rem;
}

.empty-state h3 {
  color: #f1f5f9;
  margin-bottom: 0.5rem;
}
</style>
