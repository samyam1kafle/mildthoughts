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
                                            <li><a href="#"><i class="fas fa-pen"></i> {{user.roles.role}}</a></li>
                                        </ul>
                                        <ul class="author-into-list">
                                            <li v-if="user.email.length < 15"><a href="#"><i class="fa fa-envelope"></i>{{user.email}}</a>
                                            </li>
                                            <li v-else><a href="#"><i class="fa fa-envelope"></i>{{user.email.slice(0,15)+'..'}}</a>
                                            </li>
                                        </ul>
                                        <ul class="author-into-list">
                                            <li><a href="#"><i class="fa fa-heart"></i> Followers
                                                ({{user.followers_count}})
                                            </a></li>
                                        </ul>
                                        <ul class="author-into-list">
                                            <li><a href="#"><i class="fa fa-heartbeat"></i> Followings
                                                ({{user.followings_count}})</a></li>
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
                        <div v-if="thoughts.length > 0" class="card mt-2" v-for="thought in thoughts" :key="thought.id">
                            <!-- post title start -->
                            <div class="post-title d-flex align-items-center">
                                <!-- profile picture end -->
                                <div class="profile-thumb">
                                    <a href="#">
                                        <div class="profile-thumb-middle">
                                            <img :src="getUserImage(thought.user.display_image)" alt="profile picture">
                                        </div>
                                    </a>
                                </div>
                                <!-- profile picture end -->

                                <div class="posted-author">
                                    <h6 class="author"><a href="">{{thought.user.name}}</a></h6>
                                    <span class="post-time">{{thought.created_at | notificationTime}}</span>
                                </div>

                                <div class="post-settings-bar">
                                    <ul>
                                        <li>
                                            <router-link :to="{name: 'ThoughtDetail',query: {thought_id: thought.id}}"
                                                         active-class="active" tag="a"><i class="fa fa-eye red"></i>

                                            </router-link>
                                        </li>
                                    </ul>

                                </div>

                            </div>
                            <!-- post title start -->
                            <div class="post-content">

                                <div class="container-fluid" style="margin-top: 1px">
                                    <strong class="col-xs-12">
                                        <i class="fa fa-pen blue"> Title: </i> <u>{{thought.title}}</u>
                                    </strong>
                                    <div class="col-xs-1"><br></div>
                                    <strong class="col-xs-12">
                                        <i class="fa fa-tag indigo"> Tag: </i> <u>{{thought.category.category_name}}</u>
                                    </strong>
                                </div>

                                <div class="post-thumb-gallery img-gallery">
                                    <div class="row no-gutters" v-if="thought.image != null">
                                        <div class="col-12">
                                            <div class="post-thumb">
                                                <a class="gallery-selector" :href="getThoughtImage(thought.image)">
                                                    <img :src="getThoughtImage(thought.image)" alt="post image">
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="container-fluid">
                                    <strong>
                                        <p>
                                            {{thought.thought}}
                                        </p>

                                    </strong>


                                </div>

                                <div class="post-meta col-md-0">
                                    <like-comment :key="thought.id" :post_id="thought.id"
                                    ></like-comment>

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
                    <div class="col-lg-3 order-3">
                        <aside class="widget-area">
                            <!-- By Tags start -->
                            <div class="card widget-item">
                                <h4 class="widget-title">Browse By thoughts tags</h4>
                                <div class="widget-body">
                                    <ul class="like-page-list-wrapper">
                                        <li class="unorder-list" v-for="tag in tags" :key="tag.id">
                                            <!-- profile picture end -->
                                            <div class="profile-thumb">
                                                <i class="fa fa-tags"></i>
                                            </div>
                                            <!-- profile picture end -->

                                            <div class="unorder-list-info">
                                                <h3 class="list-title">
                                                    <router-link tag="a" :to="{name: 'ViewByTags',query: {id: tag.id}}">
                                                        {{tag.category_name}}
                                                    </router-link>
                                                </h3>
                                            </div>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <!-- By tags end -->
                        </aside>
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
                tags: {}
            }
        },
        methods: {
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
            }, getUserCoverImage(image) {
                if (image == null || image == undefined) {
                    let photo = 'images/cover.jpg';
                    return photo;
                } else {
                    let photo = 'Backend/UserCoverImages/' + image;
                    return photo;
                }
            },
            viewProfile() {
                axios.get('Auth_profile').then((response) => {
                    this.user = response.data.user_data;
                    this.thoughts = response.data.thoughts;
                    this.tags = response.data.tags;
                }).catch(() => {
                    Toast.fire({
                        icon: 'error',
                        title: 'There occurred an error while loading your profile.'
                    });
                });
            },
        },
        created() {
            this.viewProfile();
        }
    }
</script>

<style>
    .profile-banner-large {
        height: 150px;
        margin: 70px;
        padding: 1px;
    }

    .profile-picture-box {
        position: absolute;
        transform: translateY(calc(-50% - 10px));
        background-color: #f7f3f300;
        z-index: 1;
    }

    figure {
        margin: 0 33px -1rem;
    }

    .profile-picture:before {
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        content: '';
        position: absolute;
        pointer-events: none;
        border: 3px solid currentColor;
    }
</style>

<style scoped>
    .container-fluid {
        width: 100%;
        padding-right: 15px;
        padding-left: 5px;
        margin-right: auto;
        margin-top: 25px;
        margin-bottom: 25px;
        margin-left: auto;
    }
</style>


