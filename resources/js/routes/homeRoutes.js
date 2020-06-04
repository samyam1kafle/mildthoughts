import Profile from '../components/FrontEnd/profile.vue'
import Home from '../components/FrontEnd/index.vue'
export default [
    {path: '/', component: Home ,name: 'Index'},
    {path: '/user/profile', component: Profile ,name: 'FrontProfile'}
];