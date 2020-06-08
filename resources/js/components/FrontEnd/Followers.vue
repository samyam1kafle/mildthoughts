<template>
    <main>

        <div class="main-wrapper">
            <div class="profile-banner-large bg-img" :data-bg="getUserCoverImage(user.cover_image)">
                <img :src="getUserCoverImage(user.cover_image)" alt="Cover Image">
            </div>
            <div class="profile-menu-area bg-white">
                <div class="container">
                    <div class="row align-items-center">
                        <div class="col-lg-3 col-md-3">
                            <div class="profile-picture-box">
                                <figure class="profile-picture">
                                    <a href="#">
                                        <img :src="getUserImage(user.display_image)" alt="profile picture">
                                    </a>
                                </figure>
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6 offset-lg-1">
                            <div class="profile-menu-wrapper">
                                <div class="main-menu-inner header-top-navigation">
                                    <nav>
                                        <ul class="main-menu">
                                            <li>
                                                <router-link tag="a" :to="{name: 'FrontProfile' , query: {id: user.id}}"
                                                             active-class="active">timeline
                                                </router-link>
                                            </li>
                                            <li>
                                                <router-link :to="{name: 'UserFollowers' , query: {id: user.id}}"
                                                             tag="a"
                                                             active-class="active">Followers
                                                </router-link>
                                            </li>
                                            <li>
                                                <router-link tag="a"
                                                             :to="{name: 'UserFollowings' , query: {id: user.id}}"
                                                             active-class="active">Following
                                                </router-link>
                                            </li>
                                        </ul>
                                    </nav>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-2 col-md-3 d-none d-md-block">
                            <div class="profile-edit-panel" v-show="!self_profile">
                                <button v-if="!isFollowing" @click="followUser(user.id)" class="edit-btn">Follow
                                    {{user.name}}
                                </button>
                                <button v-else @click="unfollowUser(user.id)" class="edit-btn">Un-follow {{user.name}}
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="menu-secondary">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="secondary-menu-wrapper secondary-menu-2 bg-white">

                                <div class="filter-menu">
                                    <button class="active" data-filter="*">Followers ({{user.followers_count}})</button>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
                <hr>
                <div class="container">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="card card-small callout callout-info" v-if="self_profile"
                                 v-show="(user.followers.length) == 0">
                                <div class="share-box-inner" role="alert">
                                    <i class="fa fa-info"> )
                                        You have no followers yet. Publish your thoughts and let them know about you.
                                    </i></div>
                            </div>
                            <div class="card card-small callout callout-info" v-if="!self_profile"
                                 v-show="(user.followers.length) == 0">
                                <div class="share-box-inner" role="alert">
                                    <i class="fa fa-info"> )
                                        {{user.name}} have no followers yet.
                                    </i></div>
                            </div>

                            <div class="card card-small callout callout-info" v-if="self_profile">
                                <div class="share-box-inner" role="alert">
                                    <i class="fa fa-info">
                                        ) To manage your profile please visit Your dashboard !
                                    </i></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="friends-section mt-20">
                <div class="container">
                    <div class="row">
                        <div class="col-12">
                            <div class="content-box friends-zone">
                                <div class="row mt--20 friends-list" style="position: relative; height: 1150px;">
                                    <div v-for="followers in user.followers" :key="followers.id"
                                         class="col-lg-3 col-sm-6 recently request"
                                         style="left: 0px; top: 0px;">
                                        <div class="friend-list-view">
                                            <!-- profile picture end -->
                                            <div class="profile-thumb">
                                                <router-link :to="{name: 'FrontProfile' , query: {id: followers.id}}"
                                                             tag="a"
                                                             active-class="active">
                                                    <div class="profile-thumb-middle">
                                                        <img :src="getUserImage(followers.display_image)"
                                                             alt="profile picture">
                                                    </div>
                                                </router-link>
                                            </div>
                                            <!-- profile picture end -->

                                            <div class="posted-author">
                                                <h6 class="author">
                                                    <router-link
                                                            :to="{name: 'FrontProfile' , query: {id: followers.id}}"
                                                            tag="a"
                                                            active-class="active">{{followers.name}}
                                                    </router-link>
                                                </h6>
                                                <div v-if="!self_profile">
                                                    <button disabled v-if="!isFollowing" class="add-frnd">User not
                                                        followed
                                                    </button>
                                                    <button disabled v-else v-show="(followers.id != auth_id)"
                                                            class="add-frnd">User Followed
                                                    </button>
                                                    <button disabled v-show="(followers.id == auth_id)"
                                                            class="add-frnd">Own Profile
                                                    </button>
                                                </div>
                                                <div v-show="self_profile">
                                                    <router-link
                                                            :to="{name: 'FrontProfile' , query: {id: followers.id}}"
                                                            tag="button"
                                                            active-class="active"
                                                            class="add-frnd"><strong>Visit Profile</strong>
                                                    </router-link>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>


    </main>
</template>

<script>
    export default {
        data() {
            return {
                user: {},
                thoughts: {},
                isFollowing: false,
                auth_id: '',
                self_profile: false
            }
        },
        methods: {
            followUser(id) {
                axios.put('api/follow/' + id).then((response) => {
                    this.$Progress.start();
                    Fire.$emit('ProfileEvent');
                    Toast.fire({
                        icon: 'success',
                        title: 'You started following ' + this.user.name
                    });
                    this.$Progress.finish();
                }).catch(() => {
                    Toast.fire({
                        icon: 'error',
                        title: 'There was a problem following' + this.user.name
                    });
                    this.$Progress.fail();
                });
            },
            unfollowUser(id) {
                axios.put('api/unfollow/' + id).then(() => {
                    this.$Progress.start();
                    Fire.$emit('ProfileEvent');
                    Toast.fire({
                        icon: 'info',
                        title: 'You un-followed ' + this.user.name + 'successfully.'
                    });
                    this.$Progress.finish();
                }).catch(() => {
                    Toast.fire({
                        icon: 'error',
                        title: 'There was a problem while un-following' + this.user.name
                    });
                    this.$Progress.fail();
                });
            },
            getUserCoverImage(image) {
                if (image == null || image == undefined) {
                    let photo = 'images/cover.jpg';
                    return photo;
                } else {
                    let photo = 'Backend/UserCoverImages/' + image;
                    return photo;
                }
            },
            getThoughtImage(image) {
                let photo = 'Backend/ThoughtsImages/' + image;
                return photo;
            },
            getUserImage(image) {
                if (image == null || image == undefined) {
                    let photo = 'images/user.png';
                    return photo;
                } else {
                    let photo = 'Backend/ProfileImages/' + image;
                    return photo;
                }
            },
            viewProfile() {
                axios.get('profile/' + this.id).then((response) => {
                    this.user = response.data.user_data;
                    this.thoughts = response.data.thoughts;
                    this.isFollowing = response.data.isFollowing;
                    this.auth_id = response.data.auth_id;
                    this.self_profile = response.data.own_profile;

                }).catch(() => {
                    Toast.fire({
                        icon: 'error',
                        title: 'There occurred an error while loading the users profile.'
                    });
                });
            },
        },
        computed: {
            id() {
                return this.$route.query.id;
            },
        },
        mounted() {
            this.viewProfile();
            Fire.$on('ProfileEvent', () => {
                this.viewProfile();
            })
        }
    }
</script>
