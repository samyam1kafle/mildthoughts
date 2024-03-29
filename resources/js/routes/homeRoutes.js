import Profile from '../components/FrontEnd/profile.vue'
import Authprofile from '../components/FrontEnd/authProfile.vue'
import Home from '../components/FrontEnd/index.vue'
import Followings from '../components/FrontEnd/Followings.vue'
import Followers from '../components/FrontEnd/Followers.vue'
import BrowseByTag from '../components/FrontEnd/TagsPage/BrowseByTag.vue'
import ThoughtDetail from '../components/FrontEnd/thought/Thoughtdetail.vue'


export default [
    {path: '/', component: Home, name: 'Index'},
    {path: '/user_profile', component: Profile, name: 'FrontProfile'},
    {path: '/auth_profile', component: Authprofile, name: 'UserProfile'},
    {path: '/user_followings', component: Followings, name: 'UserFollowings'},
    {path: '/user_followers', component: Followers, name: 'UserFollowers'},
    {path: '/tags', component: BrowseByTag, name: 'ViewByTags'},
    {path: '/thought', component: ThoughtDetail, name: 'ThoughtDetail'},
];