// src/router/index.js
import { createRouter, createWebHistory } from 'vue-router';
import Home from '../views/LandingPage.vue';
import Dashboard from '../views/DashboardPage.vue';
import Login from '../views/LoginPage.vue';
import SignUp from '../views/SignUpPage.vue';
import Roadmap from '../views/RoadmapPage.vue';

const routes = [
  {
    path: '/',
    redirect: '/login', // Redirect root path to login
  },
  {
    path: '/login',
    name: 'Login',
    component: Login,
  },
  {
    path: '/dashboard',
    name: 'Dashboard',
    component: Dashboard,
  },

  {
    path: '/signup',
    name: 'Sign Up',
    component: SignUp,
  },
  {
    path: '/roadmap',
    name: 'Roadmap',
    component: Roadmap,
  },
  {
    path: '/home',
    name: 'Home',
    component: Home,
    meta: { requiresAuth: true }, // Protect this route
  },
];

const router = createRouter({
  history: createWebHistory(),
  routes,
});

export default router;
