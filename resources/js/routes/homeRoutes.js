import Profile from '../components/FrontEnd/profile.vue'
import Authprofile from '../components/FrontEnd/authProfile.vue'
import Home from '../components/FrontEnd/index.vue'
export default [
    {path: '/', component: Home ,name: 'Index'},
    {path: '/user_profile', component: Profile ,name: 'FrontProfile'},
    {path: '/auth_profile', component: Authprofile ,name: 'UserProfile'},
];