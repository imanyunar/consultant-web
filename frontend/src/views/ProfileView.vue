<script setup lang="ts">
import { useAuthStore } from '@/stores/auth'

const authStore = useAuthStore()
</script>

<template>
  <div class="profile-view">
    <header class="top-bar">
      <div class="user-info">
        <div class="welcome">
          <h1 class="text-xl font-bold">Profil Saya</h1>
          <p class="text-sm text-muted">Informasi akun dan pengaturan personal.</p>
        </div>
      </div>
      <div class="actions">
        <button class="btn-outline">Edit Profil</button>
      </div>
    </header>

    <div class="profile-grid">
      <div class="profile-card">
        <div class="profile-header">
          <div class="avatar-large">
             <img src="https://api.dicebear.com/7.x/avataaars/svg?seed=Lucky" alt="Avatar" />
          </div>
          <div class="profile-info">
             <h2>{{ authStore.userEmail?.split('@')[0] }}</h2>
             <p>{{ authStore.userRole?.toUpperCase() }}</p>
          </div>
        </div>
        
        <div class="details-list">
          <div class="detail-item">
            <span class="label">Email</span>
            <span class="value">{{ authStore.userEmail }}</span>
          </div>
          <div class="detail-item">
            <span class="label">Telepon</span>
            <span class="value">0812-XXXX-XXXX</span>
          </div>
        </div>
      </div>

      <div class="settings-card">
        <h3>Pengaturan Keamanan</h3>
        <div class="setting-item">
           <span>Ubah Kata Sandi</span>
           <button class="btn-small">Update</button>
        </div>
        <div class="setting-item">
           <span>Autentikasi Dua Faktor</span>
           <button class="btn-small">Aktifkan</button>
        </div>
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

.btn-outline {
  background: transparent;
  color: #818cf8;
  border: 1px solid #818cf8;
  padding: 0.75rem 1.5rem;
  border-radius: 0.75rem;
  font-weight: 600;
  cursor: pointer;
}

.profile-grid {
  display: grid;
  grid-template-columns: 1fr 1fr;
  gap: 2rem;
}

.profile-card, .settings-card {
  background: #1e293b;
  padding: 2rem;
  border-radius: 1.25rem;
  border: 1px solid rgba(255, 255, 255, 0.05);
}

.profile-header {
  display: flex;
  align-items: center;
  gap: 1.5rem;
  margin-bottom: 2.5rem;
}

.avatar-large img {
  width: 100px;
  height: 100px;
  border-radius: 50%;
  border: 4px solid #334155;
}

.profile-info h2 {
  font-size: 1.5rem;
  margin-bottom: 0.25rem;
}

.profile-info p {
  color: #818cf8;
  font-weight: 600;
  letter-spacing: 0.05em;
}

.details-list {
  display: flex;
  flex-direction: column;
  gap: 1.5rem;
}

.detail-item {
  display: flex;
  flex-direction: column;
  gap: 0.5rem;
}

.label {
  font-size: 0.85rem;
  color: #94a3b8;
}

.value {
  font-weight: 500;
}

.settings-card h3 {
  margin-bottom: 1.5rem;
}

.setting-item {
  display: flex;
  justify-content: space-between;
  align-items: center;
  padding: 1rem 0;
  border-bottom: 1px solid rgba(255, 255, 255, 0.05);
}

.btn-small {
  padding: 0.5rem 1rem;
  background: rgba(255, 255, 255, 0.05);
  border: none;
  border-radius: 0.5rem;
  color: #94a3b8;
  font-size: 0.8rem;
  cursor: pointer;
}
</style>
