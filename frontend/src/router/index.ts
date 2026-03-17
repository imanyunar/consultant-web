import { createRouter, createWebHistory } from 'vue-router'
import LoginView from '@/views/LoginView.vue'
import HomeView from '@/views/HomeView.vue'
import { useAuthStore } from '@/stores/auth'

const router = createRouter({
  history: createWebHistory(import.meta.env.BASE_URL),
  routes: [
    {
      path: '/',
      component: () => import('@/views/MainLayout.vue'),
      meta: { requiresAuth: true },
      children: [
        {
          path: '',
          name: 'home',
          component: () => import('@/views/HomeView.vue'),
          meta: { title: 'Dashboard – AppointEase' }
        },
        {
            path: 'appointments',
            name: 'appointments',
            component: () => import('@/views/AppointmentsView.vue'),
            meta: { title: 'Janji Temu – AppointEase' }
        },
        {
            path: 'medical-records',
            name: 'medical-records',
            component: () => import('@/views/MedicalRecordsView.vue'),
            meta: { title: 'Rekam Medis – AppointEase' }
        },
        {
            path: 'profile',
            name: 'profile',
            component: () => import('@/views/ProfileView.vue'),
            meta: { title: 'Profil Saya – AppointEase' }
        },
        {
            path: 'patients',
            name: 'patients',
            component: () => import('@/views/PatientsView.vue'),
            meta: { title: 'Daftar Pasien – AppointEase' }
        },
        {
            path: 'reports',
            name: 'reports',
            component: () => import('@/views/ReportsView.vue'),
            meta: { title: 'Laporan – AppointEase' }
        },
      ]
    },
    {
      path: '/login',
      name: 'login',
      component: LoginView,
      meta: { title: 'Login – AppointEase' },
    },
  ],
})

router.beforeEach((to, from, next) => {
  const authStore = useAuthStore()
  
  // Set title
  if (to.meta.title) {
    document.title = to.meta.title as string
  }

  if (to.meta.requiresAuth && !authStore.isAuthenticated) {
    next('/login')
  } else if (to.path === '/login' && authStore.isAuthenticated) {
    next('/')
  } else {
    next()
  }
})

export default router
