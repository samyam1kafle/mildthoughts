<template>
    <main>
        <div class="main-wrapper pt-80">
            <div class="container">
                <div class="row">
                    <div class="col-lg-3 order-2 order-lg-1">
                        <aside class="widget-area">
                            <!-- widget single item start -->
                            <div class="card card-profile widget-item p-0">
                                <div class="profile-banner">
                                    <figure class="profile-banner-small">
                                        <router-link tag="a" :to="{name: 'UserProfile'}"
                                                     active-class="active" v-if=" user !='null'
                                      " class="profile-thumb-2">
                                            <img :src="getUserImage(user.display_image)"
                                                 alt="Display Image">
                                        </router-link>
                                        <a href="#" v-else class="profile-thumb-2">
                                            <img :src="getAnonymousImage()"
                                                 alt="Display Image">
                                        </a>
                                    </figure>
                                    <div class="profile-desc text-center">
                                        <h6 class="author" v-if="user != 'null'">
                                            <router-link active-class="active" tag="a" :to="{name: 'UserProfile'}"
                                            >{{user.name}}
                                            </router-link>
                                        </h6>
                                        <h6 class="author" v-else><a href="profile.html"
                                        >Anonymous</a>
                                        </h6>
                                        <p v-if="user != 'null'"><strong>Joined Date/Time : </strong>
                                            {{user.created_at | cleanTime}}</p>
                                        <p v-else><strong>Be a part of our family.</strong><br>
                                            Register Now</p>
                                    </div>
                                </div>
                            </div>
                            <!-- widget single item start -->

                            <!-- widget single item start -->
                            <div class="card widget-item">
                                <h4 class="widget-title">Browse Through Categories Tags</h4>
                                <div class="widget-body">
                                    <ul class="like-page-list-wrapper">
                                        <li class="unorder-list" v-for="tag in tags">

                                            <div class="unorder-list-info">
                                                <h3 class="list-title">
                                                    <i class="fa fa-tags"></i>
                                                    <router-link tag="a" :to="{name: 'ViewByTags',query: {id: tag.id}}">
                                                        {{tag.category_name}}
                                                    </router-link>
                                                </h3>
                                            </div>

                                        </li>

                                    </ul>
                                </div>
                            </div>
                            <!-- widget single item end -->
                        </aside>
                    </div>

                    <div class="col-lg-6 order-1 order-lg-2">

                        <!-- post status start -->
                        <div class="card mt-1" v-if="(thoughts.length > 0)" v-for="post in thoughts"
                             :key="post.id">
                            <!-- post title start -->
                            <div class="post-title d-flex align-items-center">
                                <!-- profile picture end -->
                                <div class="profile-thumb">
                                    <a href="#">
                                        <div class="profile-thumb-middle">
                                            <img :src="getUserImage(post.user.display_image)"
                                                 alt="profile picture">
                                        </div>
                                    </a>
                                </div>
                                <!-- profile picture end -->

                                <div class="posted-author">
                                    <h6 class="author">
                                        <router-link :to="{name: 'FrontProfile' , query: {id: post.user.id}}" tag="a"
                                                     active-class="active">{{post.user.name}}
                                        </router-link>

                                    </h6>

                                    <span class="post-time">{{post.created_at | notificationTime}}</span>
                                </div>

                                <div class="post-settings-bar">
                                    <ul>
                                        <li>
                                            <router-link :to="{name: 'ThoughtDetail',query: {thought_id: post.id}}"
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
                                        <i class="fa fa-pen blue"> Title: </i> <u>{{post.title}}</u>
                                    </strong>
                                    <div class="col-xs-1"><br></div>
                                    <strong class="col-xs-12">
                                        <i class="fa fa-tag indigo"> Tag: </i> <u>{{post.category.category_name}}</u>
                                    </strong>
                                </div>


                                <div class="post-thumb-gallery" v-if="post.image != null">
                                    <div class="post-thumb img-popup">
                                        <a href="">
                                            <img :src="getPostImage(post.image)"
                                                 alt="post image">
                                        </a>
                                    </div>
                                </div>
                                <div class="container-fluid">
                                    <strong>
                                        <p>
                                            {{post.thought}}
                                        </p>

                                    </strong>


                                </div>

                                <div class="post-meta col-md-0">
                                    <like-comment :key="post.id" :post_id="post.id"
                                    ></like-comment>

                                    <comment-page :id="post.id"
                                                  :comment_count="post.comment_count"></comment-page>

                                </div>
                                <add-comment-page :post="post"></add-comment-page>
                            </div>
                        </div>
                        <div class="card mt-2 callout callout-danger" v-show="thoughts.length == 0">
                            <div class="post-content">
                                <p class="post-desc">
                                    You have not followed any user please follow some user to see their
                                    Thoughts.
                                    <strong>Feel Free To Explore The World Of thoughts.</strong>
                                </p>

                            </div>
                        </div>

                        <!-- post status end -->


                    </div>

                    <div class="col-lg-3 order-3">
                        <aside class="widget-area">

                            <!-- widget single item start -->
                            <div class="card widget-item">
                                <h4 class="widget-title">Authors You may like</h4>
                                <div class="widget-body">
                                    <ul class="like-page-list-wrapper">
                                        <li class="unorder-list" v-for="author in authorYouMayKnow"
                                            :key="author.id">
                                            <!-- profile picture end -->
                                            <div class="profile-thumb">
                                                <router-link :to="{name: 'FrontProfile' , query: {id: author.id}}"
                                                             tag="a"
                                                             active-class="active">
                                                    <figure class="profile-thumb-small">
                                                        <img :src="getUserImage(author.display_image)"
                                                             alt="profile picture">
                                                    </figure>
                                                </router-link>
                                            </div>
                                            <!-- profile picture end -->

                                            <div class="unorder-list-info">
                                                <h3 class="list-title">
                                                    <router-link
                                                            :to="{name: 'FrontProfile' , query: {id: author.id}}"
                                                            tag="a"
                                                            active-class="active">{{author.name}}
                                                    </router-link>
                                                </h3>
                                                <p class="list-subtitle">
                                                    <router-link :to="{name: 'FrontProfile' , query: {id: author.id}}"
                                                                 tag="a"
                                                                 active-class="active">{{author.email}}
                                                    </router-link>
                                                </p>
                                            </div>

                                        </li>
                                        <li v-show="authorYouMayKnow.length == 0"
                                            class="unorder-list callout callout-info"> No Authors available right now.
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <!-- widget single item end -->
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
                followings: {},
                followingUsers: {},
                thoughts: {},
                authorYouMayKnow: {},
                tags: {},

            }
        },
        methods: {
            getPostImage(image) {
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
            getAnonymousImage() {
                let anonypp = 'images/user.png';
                return anonypp;
            },
            followerThoughts() {
                let thought = [];
                this.followings.forEach((value) => {
                    thought.push(value.id);
                });
                axios.get('thoughts/', {
                    params: {
                        query: thought
                    }
                }).then((response) => {
                    this.followingUsers = response.data.following;
                    this.thoughts = response.data.thoughts;
                    this.tags = response.data.tags;
                }).catch(() => {
                    Toast.fire({
                        icon: 'error',
                        title: 'There occurred an error while liking the Thought.'
                    });
                });
            },
            authUser() {
                axios.get('user/').then((response) => {
                    this.user = response.data.userdetail;
                    this.followings = response.data.followings;
                    this.authorYouMayKnow = response.data.Author;
                    if (this.user !== 'null') {
                        this.followerThoughts();
                    }
                }).catch(() => {
                    Toast.fire({
                        icon: 'error',
                        title: 'There occurred an error while loading the feed.'
                    });
                });
            },

        },
        mounted() {
            this.authUser();
            setInterval(() => {
                this.authUser();
            }, 50000);
        }
    }
</script>

<style scoped>
    figure {
        margin: 0 0 1rem;
    }

    .p-0 {
        padding: 2px !important;
    }

    .profile-desc {
        padding: 30px;
        margin-top: 59px;
    }

    .profile-thumb-2 {
        width: 80px;
        height: 80px;
        display: block;
        border-radius: 50%;
        overflow: hidden;
        bottom: -83px;
        left: 0;
        right: 0;
        position: absolute;
        margin: auto;
    }

    .profile-banner-small:before {
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        content: '';
        position: absolute;
        pointer-events: none;
        border: 10px solid rgba(251, 251, 251, 0.3);
    }

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

<style>
    .card-comments {
        background: #ffffff00;
    }
</style>