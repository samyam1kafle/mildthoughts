import Dashboard from '../components/Backend/dashboard.vue'
import Roles from '../components/Backend/Roles/index.vue'
import Users from '../components/Backend/User/index.vue'

import Profile from '../components/Backend/profile.vue'

export const routes = [
    {path: '/dashboard', component: Dashboard, name: 'Dashboard'},
    {path: '/roles', component: Roles, name: 'Roles'},
    {path: '/users', component: Users, name: 'Users'},

    {path: '/profile', component: Profile, name: 'BackendProfile'}
];