import { createRouter, createWebHistory } from "vue-router";


const router = createRouter({
    history: createWebHistory(),
    routes: [
      {
        path: '/home',
        name: 'dashboard',
        component: () => import('../components/Home.vue')
      },
      {
        path: '/add',
        name: 'ajouter absence',
        component: () => import('../components/Add.vue')
      },
      {
          path: '/just',
          name: 'justfier absences',
          component: () => import('../components/Just.vue')
        },
        {
          path: '/SearchByDate',
          name: 'Recherche par Date',
          component: () => import('../components/SearchByDate.vue')
        },
        {
          path: '/detail',
          name: 'details de class',
          component: () => import('../components/detail.vue')
        },
        {
          path: '/Profile',
          name: 'Profile',
          component: () => import('../components/Admin/profile.vue')
        },
        {
          path: '/User',
          name: 'Update users',
          component: () => import('../components/Admin/aboutUsers.vue')
        },
        {
          path: '/addUser',
          name: 'add users',
          component: () => import('../components/Admin/addUser.vue')
        },
        {
          path: '/editUser/:id',
          name: 'editUsers',
          component: () => import('../components/Admin/editUser.vue')
        },
        {
          path: '/stagiaire/:id',
          name: 'Stagiaire',
          component: () => import('../components/Stagiaire.vue'),
          
        },
        {
          path: '/editEtat',
          name: 'Etat Edit',
          component: () => import('../components/Admin/editEtat.vue')
        },
        { path: '/Estg',
          name: 'Update stagiares',
          component: () => import('../components/Admin/editStgiaire.vue')
        },
        { path: '/settings',
          name: 'Settings',
          component: () => import('../components/Admin/settings.vue')
        },
        { path: '/addStag',
          name: 'Ajouter stagiaire',
          component: () => import('../components/Admin/addStag.vue')
        },
        { path: '/impressions',
          name: 'impressions',
          component: () => import('../components/Admin/impressions.vue')
        },
    ]
})
  
export default router