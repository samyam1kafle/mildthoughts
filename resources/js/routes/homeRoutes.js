import Profile from '../components/FrontEnd/profile.vue'
import Authprofile from '../components/FrontEnd/authProfile.vue'
import Home from '../components/FrontEnd/index.vue'
import Followings from '../components/FrontEnd/Followings.vue'
import Followers from '../components/FrontEnd/Followers.vue'


export default [
    {path: '/', component: Home ,name: 'Index'},
    {path: '/user_profile', component: Profile ,name: 'FrontProfile'},
    {path: '/auth_profile', component: Authprofile ,name: 'UserProfile'},
    {path: '/user_followings', component: Followings ,name: 'UserFollowings'},
    {path: '/user_followers', component: Followers ,name: 'UserFollowers'}
];