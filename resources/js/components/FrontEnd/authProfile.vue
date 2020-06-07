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
                                            <!--<li><a href="">Settings</a></li>-->
                                        </ul>
                                    </nav>
                                </div>
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
                                            <li><a href="#"><i class="bi bi-heart-beat"></i>{{user.roles.role}}</a></li>
                                        </ul>
                                        <ul class="author-into-list">
                                            <li><a href="#"><i class="bi bi-envelop"></i>{{user.email}}</a></li>
                                        </ul>
                                        <ul class="author-into-list">
                                            <li><a href="#"><i class="bi bi-heart-beat"></i>Follower :
                                                {{user.followers_count}}</a></li>
                                        </ul>
                                        <ul class="author-into-list">
                                            <li><a href="#"><i class="bi bi-heart-beat"></i>Following:
                                                {{user.followings_count}}</a></li>
                                        </ul>

                                    </div>
                                </div>
                            </div>


                        </aside>
                    </div>

                    <div class="col-lg-6 order-1 order-lg-2">

                        <div class="card card-small callout callout-info">
                            <div class="share-box-inner" role="alert">
                                To post or update your profile please visit Your dashboard !
                            </div>
                        </div>

                        <!-- post status start -->
                        <div v-if="thoughts.length > 0" class="card mt-2" v-for="thought in thoughts">
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
                                <div class="post-meta">
                                    <button class="post-meta-like">
                                        <i class="bi bi-heart-beat"></i>
                                        <span>You and 207 people like this</span>
                                        <strong>207</strong>
                                    </button>
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
                        <div class="card callout callout-info" v-show="thoughts.length == 0">
                            <div class="post-content">
                                <p class="post-desc">
                                    You have not posted any
                                    Thoughts.
                                    <strong>Visit your dashboard now to post what is on your mind.</strong>
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
                thoughts: {}
            }
        },
        methods: {
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
                axios.get('Auth_profile').then((response) => {
                    this.user = response.data.user_data;
                    this.thoughts = response.data.thoughts;
                }).catch(() => {

                });
            },
        },
        created() {
            this.viewProfile();
        }
    }
</script>
