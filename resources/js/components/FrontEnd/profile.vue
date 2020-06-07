<template>
    <main>

        <div class="main-wrapper">
            <div class="profile-banner-large bg-img" data-bg="assets/images/banner/profile-banner.jpg"
                 style="background-image: url('../../../../public/Frontend/assets/images/banner/profile-banner.jpg');">
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
                            <div class="profile-edit-panel" v-if="!self_profile" v-show="!self_profile">
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
            <div class="container">
                <div class="row">
                    <div class="col-lg-3 order-2 order-lg-1">
                        <aside class="widget-area profile-sidebar">
                            <!-- widget single item start -->
                            <div class="card widget-item">
                                <h4 class="widget-title">{{user.name}}</h4>
                                <div class="widget-body">
                                    <div class="about-author">
                                        <ul class="author-into-list">
                                            <li><a href="#"><i class="fas fa-pen"></i>{{user.roles.role}}</a></li>
                                        </ul>
                                        <ul class="author-into-list">
                                            <li><a href="#"><i class="fa fa-brain"></i>Thoughts
                                                ({{user.thoughts.length}})</a>
                                            </li>
                                        </ul>
                                        <ul class="author-into-list">
                                            <li><a href="#"><i class="fa fa-envelope"></i>{{user.email}}</a></li>
                                        </ul>
                                        <ul class="author-into-list">
                                            <li><a href="#"><i class="fa fa-heart"></i>
                                                Followers ({{user.followers_count}})</a></li>
                                        </ul>
                                        <ul class="author-into-list">
                                            <li><a href="#"><i class="fa fa-heartbeat"></i>
                                                Followings ({{user.followings_count}})</a></li>
                                        </ul>

                                    </div>
                                </div>
                            </div>


                        </aside>
                    </div>

                    <div class="col-lg-6 order-1 order-lg-2">
                        <div class="card card-small alert alert-primary" v-if="self_profile">
                            <div class="share-box-inner" role="alert">
                                <i class="fa fa-info">
                                ) To manage your profile please visit Your dashboard !
                            </i>

                            </div>
                        </div>
                        <!-- post status start -->
                        <div class="card" v-if="thoughts.length > 0" v-for="thought in thoughts">
                            <!-- post title start -->
                            <div class="post-title d-flex align-items-center">
                                <!-- profile picture end -->
                                <div class="profile-thumb">
                                    <a href="#">
                                        <figure class="profile-thumb-middle">
                                            <img :src="getUserImage(thought.user.display_image)" alt="profile picture">
                                        </figure>
                                    </a>
                                </div>
                                <!-- profile picture end -->

                                <div class="posted-author">
                                    <h6 class="author"><a href="">{{thought.user.name}}</a></h6>
                                    <span class="post-time">{{thought.created_at | notificationTime}}</span>
                                </div>

                                <div class="post-settings-bar">
                                    <span></span>
                                    <span></span>
                                    <span></span>
                                    <div class="post-settings arrow-shape">
                                        <ul>
                                            <li>
                                                <button>copy link to adda</button>
                                            </li>
                                            <li>
                                                <button>edit post</button>
                                            </li>
                                            <li>
                                                <button>embed adda</button>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <!-- post title start -->
                            <div class="post-content">
                                <p class="post-desc">
                                    {{thought.thought}}
                                </p>
                                <div class="post-thumb-gallery img-gallery">
                                    <div class="row no-gutters" v-if="thought.image != null">
                                        <div class="col-12">
                                            <figure class="post-thumb">
                                                <a class="gallery-selector" :href="getThoughtImage(thought.image)">
                                                    <img :src="getThoughtImage(thought.image)" alt="post image">
                                                </a>
                                            </figure>
                                        </div>
                                    </div>
                                </div>
                                <div class="post-meta col-lg-12">
                                    <div class="col-sm-8">
                                        <ul class="comment-share-meta">
                                            <li>
                                                <button class="post-meta-like">
                                                    <i class="fa fa-star"></i>

                                                </button>
                                                <button class="post-share">
                                                    <span>201 people like this</span>
                                                </button>
                                            </li>

                                        </ul>
                                    </div>

                                    <ul class="comment-share-meta">
                                        <li>
                                            <button class="post-comment">
                                                <i class="bi bi-chat-bubble"></i>
                                                <span>41</span>
                                            </button>
                                        </li>
                                        <li>
                                            <button class="post-share">
                                                <i class="bi bi-share"></i>
                                                <span>07</span>
                                            </button>
                                        </li>
                                    </ul>

                                </div>

                            </div>
                        </div>
                        <div class="card callout callout-info" v-if="!self_profile" v-show="thoughts.length == 0">
                            <div class="post-content">
                                <p class="post-desc">
                                    User have not posted any
                                    Thoughts.

                                </p>

                            </div>
                        </div>
                        <!-- post status end -->

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
                self_profile: false,
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

            getThoughtImage(image) {
                let photo = 'Backend/ThoughtsImages/' + image;
                return photo;
            },
            getUserImage(image) {
                if(image == null || image == undefined){
                    let photo = 'images/user.png';
                    return photo;
                }else{
                    let photo = 'Backend/ProfileImages/' + image;
                    return photo;
                }
            },
            viewProfile() {
                axios.get('profile/' + this.id).then((response) => {
                    this.user = response.data.user_data;
                    this.thoughts = response.data.thoughts;
                    this.isFollowing = response.data.isFollowing;
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
