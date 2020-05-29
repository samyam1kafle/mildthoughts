import Dashboard from '../components/Backend/dashboard.vue'
import Roles from '../components/Backend/Roles/index.vue'
import Users from '../components/Backend/User/index.vue'
import Thoughts from '../components/Backend/Thoughts/index.vue'
import ThoughtsCategory from '../components/Backend/ThoughtsCategory/index.vue'

import Profile from '../components/Backend/profile.vue'

export default [

    {path: '/dashboard', component: Dashboard, name: 'Dashboard'},
    {path: '/roles', component: Roles, name: 'Roles'},
    {path: '/users', component: Users, name: 'Users'},
    {path: '/thoughts', component: Thoughts, name: 'Thoughts'},
    {path: '/thoughtsCategories', component: ThoughtsCategory, name: 'Thoughts-Categories'},
    {path: '/profile', component: Profile, name: 'BackendProfile'},


];