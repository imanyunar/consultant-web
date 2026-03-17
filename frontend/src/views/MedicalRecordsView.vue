<script setup lang="ts">
import { onMounted } from 'vue'
import { useApi } from '@/composables/useApi'

const { data: records, loading, error, fetchAll } = useApi('payments') // Using payments for now as medical records proxy

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
  <div class="medical-records-view">
    <header class="top-bar">
      <div class="user-info">
        <div class="welcome">
          <h1 class="text-xl font-bold">Rekam Medis & Pembayaran</h1>
          <p class="text-sm text-muted">Akses riwayat medis dan status pembayaran Anda.</p>
        </div>
      </div>
    </header>

    <div class="content-card">
      <div class="search-bar">
        <input type="text" placeholder="Cari berdasarkan tanggal atau status..." class="search-input">
      </div>

      <div v-if="loading" class="loading-state">
        <div class="spinner"></div>
        <p>Memuat data...</p>
      </div>

      <div v-else-if="error" class="error-state">
        <p>{{ error }}</p>
        <button @click="fetchAll()" class="btn-small">Coba Lagi</button>
      </div>

      <div v-else-if="records.length > 0" class="table-container">
        <table class="data-table">
          <thead>
            <tr>
              <th>ID Referensi</th>
              <th>Jumlah</th>
              <th>Metode</th>
              <th>Status</th>
              <th>Terakhir Diperbarui</th>
              <th>Aksi</th>
            </tr>
          </thead>
          <tbody>
            <tr v-for="record in records" :key="record.id">
              <td>#{{ record.id }}</td>
              <td>Rp {{ parseFloat(record.amount).toLocaleString('id-ID') }}</td>
              <td>{{ record.payment_method || '-' }}</td>
              <td>
                <span :class="['status-badge', record.status]">
                  {{ record.status }}
                </span>
              </td>
              <td>{{ formatDate(record.updated_at) }}</td>
              <td>
                <button class="btn-icon">👁️</button>
              </td>
            </tr>
          </tbody>
        </table>
      </div>

      <div v-else class="empty-state">
        <div class="empty-icon">📂</div>
        <h3>Tidak ada data ditemukan</h3>
        <p>Belum ada riwayat rekam medis atau pembayaran yang tersedia.</p>
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

.content-card {
  background: #1e293b;
  border-radius: 1.25rem;
  padding: 1.5rem;
  min-height: 400px;
}

.search-bar {
  margin-bottom: 2rem;
}

.search-input {
  width: 100%;
  padding: 0.75rem 1rem;
  background: rgba(255, 255, 255, 0.05);
  border: 1px solid rgba(255, 255, 255, 0.1);
  border-radius: 0.75rem;
  color: white;
  outline: none;
}

.search-input:focus {
  border-color: #6366f1;
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

.status-badge.pending { background: rgba(245, 158, 11, 0.1); color: #fbbf24; }
.status-badge.completed { background: rgba(16, 185, 129, 0.1); color: #34d399; }
.status-badge.failed { background: rgba(244, 63, 94, 0.1); color: #fb7185; }

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
