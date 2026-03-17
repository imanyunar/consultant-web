<script setup lang="ts">
import { useAuthStore } from '@/stores/auth'

const authStore = useAuthStore()
</script>

<template>
  <div class="patient-home">
    <header class="top-bar">
      <div class="user-info">
        <div class="welcome">
          <h1 class="text-xl font-bold">Halo, {{ authStore.userEmail?.split('@')[0] }}!</h1>
          <p class="text-sm text-muted">Bagaimana kondisi kesehatanmu hari ini?</p>
        </div>
      </div>
      <div class="actions">
        <div class="notification-badge">
          <svg viewBox="0 0 20 20" fill="currentColor"><path d="M10 2a6 6 0 00-6 6v3.586l-.707.707A1 1 0 004 14h12a1 1 0 00.707-1.707L16 11.586V8a6 6 0 00-6-6zM10 18a3 3 0 01-3-3h6a3 3 0 01-3 3z"/></svg>
        </div>
        <div class="avatar">
          <img src="https://api.dicebear.com/7.x/avataaars/svg?seed=Lucky" alt="Avatar" />
        </div>
      </div>
    </header>

    <section class="hero-section">
      <div class="hero-card">
        <div class="hero-text">
          <h2>Konsultasi Online<br />Kapan Saja</h2>
          <p>Dapatkan pelayanan medis terbaik dari dokter spesialis kami.</p>
          <button class="btn-primary">Buat Janji Sekarang</button>
        </div>
        <div class="hero-image">
           <svg viewBox="0 0 200 200" xmlns="http://www.w3.org/2000/svg">
              <circle cx="100" cy="100" r="80" fill="#6366f1" opacity="0.1" />
              <path d="M100 40 L160 160 L40 160 Z" fill="#6366f1" />
           </svg>
        </div>
      </div>
    </section>

    <section class="quick-actions">
      <div class="section-header">
        <h3>Layanan Cepat</h3>
      </div>
      <div class="action-grid">
        <div class="action-card">
          <div class="action-icon icon-blue">🩺</div>
          <span>Chat Dokter</span>
        </div>
        <div class="action-card">
          <div class="action-icon icon-purple">💊</div>
          <span>Toko Kesehatan</span>
        </div>
        <div class="action-card">
          <div class="action-icon icon-cyan">📅</div>
          <span>Buat Janji</span>
        </div>
        <div class="action-card">
          <div class="action-icon icon-rose">🔬</div>
          <span>Hasil Lab</span>
        </div>
      </div>
    </section>

    <section class="upcoming">
      <div class="section-header">
        <h3>Janji Temu Mendatang</h3>
        <a href="#" class="view-all">Lihat Semua</a>
      </div>
      <div class="empty-state">
        <p>Belum ada janji temu aktif.</p>
      </div>
    </section>
  </div>
</template>

<style scoped>
.top-bar {
  display: flex;
  justify-content: space-between;
  align-items: center;
  margin-bottom: 2.5rem;
}

.actions {
  display: flex;
  align-items: center;
  gap: 1.25rem;
}

.notification-badge {
  color: #94a3b8;
  cursor: pointer;
}

.avatar img {
  width: 40px;
  height: 40px;
  border-radius: 50%;
  border: 2px solid #818cf8;
}

.text-muted {
  color: #94a3b8;
}

/* Hero Section */
.hero-card {
  background: linear-gradient(135deg, #4338ca 0%, #312e81 100%);
  border-radius: 1.5rem;
  padding: 2.5rem;
  display: flex;
  justify-content: space-between;
  align-items: center;
  margin-bottom: 2.5rem;
  position: relative;
  overflow: hidden;
}

.hero-text h2 {
  font-size: 2rem;
  line-height: 1.2;
  margin-bottom: 1rem;
}

.hero-text p {
  color: rgba(255, 255, 255, 0.8);
  margin-bottom: 1.5rem;
  max-width: 300px;
}

.btn-primary {
  background: #f1f5f9;
  color: #4338ca;
  border: none;
  padding: 0.75rem 1.5rem;
  border-radius: 0.75rem;
  font-weight: 600;
  cursor: pointer;
}

/* Action Grid */
.section-header {
  display: flex;
  justify-content: space-between;
  align-items: center;
  margin-bottom: 1.5rem;
}

.action-grid {
  display: grid;
  grid-template-columns: repeat(auto-fit, minmax(150px, 1fr));
  gap: 1.5rem;
  margin-bottom: 2.5rem;
}

.action-card {
  background: #1e293b;
  padding: 1.5rem;
  border-radius: 1.25rem;
  display: flex;
  flex-direction: column;
  align-items: center;
  gap: 1rem;
  cursor: pointer;
  transition: transform 0.2s;
}

.action-card:hover {
  transform: translateY(-4px);
  background: #334155;
}

.action-icon {
  font-size: 2rem;
  width: 60px;
  height: 60px;
  display: flex;
  align-items: center;
  justify-content: center;
  border-radius: 1rem;
}

.icon-blue { background: rgba(59, 130, 246, 0.1); }
.icon-purple { background: rgba(168, 85, 247, 0.1); }
.icon-cyan { background: rgba(6, 182, 212, 0.1); }
.icon-rose { background: rgba(244, 63, 94, 0.1); }

/* Empty State */
.empty-state {
  background: rgba(255, 255, 255, 0.02);
  border: 2px dashed rgba(255, 255, 255, 0.05);
  border-radius: 1.25rem;
  padding: 3rem;
  text-align: center;
  color: #94a3b8;
}

.view-all {
  color: #818cf8;
  text-decoration: none;
  font-size: 0.9rem;
}
</style>
