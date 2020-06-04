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
                                        <a href="profile.html">
                                            <img :src="getCoverImage()"
                                                 alt="">
                                        </a>

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
                                <h4 class="widget-title">page you may like</h4>
                                <div class="widget-body">
                                    <ul class="like-page-list-wrapper">
                                        <li class="unorder-list">
                                            <!-- profile picture end -->
                                            <div class="profile-thumb">
                                                <a href="#">
                                                    <figure class="profile-thumb-small">
                                                        <img src=""
                                                             alt="profile picture">
                                                    </figure>
                                                </a>
                                            </div>
                                            <!-- profile picture end -->

                                            <div class="unorder-list-info">
                                                <h3 class="list-title"><a href="#">Travel The World</a></h3>
                                                <p class="list-subtitle"><a href="#">adventure</a></p>
                                            </div>
                                            <button class="like-button active">
                                                <img class="heart"
                                                     src=""
                                                     alt="">
                                                <img class="heart-color"
                                                     src=""
                                                     alt="">
                                            </button>
                                        </li>
                                        <li class="unorder-list">
                                            <!-- profile picture end -->
                                            <div class="profile-thumb">
                                                <a href="#">
                                                    <figure class="profile-thumb-small">
                                                        <img src=""
                                                             alt="profile picture">
                                                    </figure>
                                                </a>
                                            </div>
                                            <!-- profile picture end -->

                                            <div class="unorder-list-info">
                                                <h3 class="list-title"><a href="#">Foodcort Nirala</a></h3>
                                                <p class="list-subtitle"><a href="#">food</a></p>
                                            </div>
                                            <button class="like-button">
                                                <img class="heart"
                                                     src=""
                                                     alt="">
                                                <img class="heart-color"
                                                     src=""
                                                     alt="">
                                            </button>
                                        </li>
                                        <li class="unorder-list">
                                            <!-- profile picture end -->
                                            <div class="profile-thumb">
                                                <a href="#">
                                                    <figure class="profile-thumb-small">
                                                        <img src=""
                                                             alt="profile picture">
                                                    </figure>
                                                </a>
                                            </div>
                                            <!-- profile picture end -->

                                            <div class="unorder-list-info">
                                                <h3 class="list-title"><a href="#">Rolin Theitar</a></h3>
                                                <p class="list-subtitle"><a href="#">drama</a></p>
                                            </div>
                                            <button class="like-button">
                                                <img class="heart"
                                                     src=""
                                                     alt="">
                                                <img class="heart-color"
                                                     src=""
                                                     alt="">
                                            </button>
                                        </li>
                                        <li class="unorder-list">
                                            <!-- profile picture end -->
                                            <div class="profile-thumb">
                                                <a href="#">
                                                    <figure class="profile-thumb-small">
                                                        <img src=""
                                                             alt="profile picture">
                                                    </figure>
                                                </a>
                                            </div>
                                            <!-- profile picture end -->

                                            <div class="unorder-list-info">
                                                <h3 class="list-title"><a href="#">Active Mind</a></h3>
                                                <p class="list-subtitle"><a href="#">fitness</a></p>
                                            </div>
                                            <button class="like-button">
                                                <img class="heart"
                                                     src=""
                                                     alt="">
                                                <img class="heart-color"
                                                     src=""
                                                     alt="">
                                            </button>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <!-- widget single item end -->
                        </aside>
                    </div>

                    <div class="col-lg-6 order-1 order-lg-2">
                        <!-- share box start -->
                        <div class="card card-small">
                            <div class="share-box-inner">
                                <!-- profile picture end -->
                                <div class="profile-thumb">
                                    <a href="#">
                                        <figure class="profile-thumb-middle">
                                            <img v-if="user != 'null'" :src="getUserImage(user.display_image)"
                                                 alt="profile picture">
                                            <img v-else :src="getAnonymousImage()"
                                                 alt="profile picture">
                                        </figure>
                                    </a>
                                </div>
                                <!-- profile picture end -->

                                <!-- share content box start -->
                                <div class="share-content-box w-100">
                                    <form class="share-text-box">
                                    <textarea name="share" class="share-text-field" aria-disabled="true"
                                              placeholder="Say Something" data-toggle="modal" data-target="#textbox"
                                              id="email"></textarea>
                                        <button class="btn-share" type="submit">share</button>
                                    </form>
                                </div>
                                <!-- share content box end -->

                                <!-- Modal start -->
                                <div class="modal fade" id="textbox" aria-labelledby="textbox">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title">Share Your Mood</h5>
                                                <button type="button" class="close" data-dismiss="modal"
                                                        aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body custom-scroll">
                                            <textarea name="share" class="share-field-big custom-scroll"
                                                      placeholder="Say Something"></textarea>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="post-share-btn" data-dismiss="modal">cancel
                                                </button>
                                                <button type="button" class="post-share-btn">post</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- Modal end -->
                            </div>
                        </div>
                        <!-- share box end -->

                        <!-- post status start -->
                        <div class="card" v-if="user.followings.length > 0" v-for="post in thoughts">
                            <!-- post title start -->
                            <div class="post-title d-flex align-items-center">
                                <!-- profile picture end -->
                                <div class="profile-thumb">
                                    <a href="#">
                                        <figure class="profile-thumb-middle">
                                            <img :src="getUserImage(post.user.display_image)"
                                                 alt="profile picture">
                                        </figure>
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
                                    {{post.thought}}
                                </p>
                                <div class="post-thumb-gallery" v-if="post.image != null">
                                    <figure class="post-thumb img-popup">
                                        <a href="">
                                            <img :src="getPostImage(post.image)"
                                                 alt="post image">
                                        </a>
                                    </figure>
                                </div>
                                <div class="post-meta col-lg-12">
                                    <div class="col-sm-8">
                                        <ul class="comment-share-meta">
                                            <li>
                                                <button @click="likeUnlike(post.id)" class="post-meta-like">
                                                    <i class="bi bi-heart-beat"></i>
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
                                                                        <!--<button class="post-meta-like">-->
                                    <!--<i class="bi bi-heart-beat"></i>-->
                                    <!--<span>201 people like this</span>-->
                                    <!--</button>-->

                                </div>
                            </div>
                        </div>
                        <div class="card" v-else>
                            <div class="post-content">
                                <p class="post-desc">
                                    You have not followed any user please follow some user to see their
                                    post.
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
                                <h4 class="widget-title">Friends Zone</h4>
                                <div class="widget-body">
                                    <ul class="like-page-list-wrapper">
                                        <li class="unorder-list">
                                            <!-- profile picture end -->
                                            <div class="profile-thumb">
                                                <a href="#">
                                                    <figure class="profile-thumb-small">
                                                        <img src=""
                                                             alt="profile picture">
                                                    </figure>
                                                </a>
                                            </div>
                                            <!-- profile picture end -->

                                            <div class="unorder-list-info">
                                                <h3 class="list-title"><a href="#">Ammeya Jakson</a></h3>
                                                <p class="list-subtitle"><a href="#">10 mutual</a></p>
                                            </div>
                                            <button class="like-button">
                                                <img class="heart"
                                                     src=""
                                                     alt="">
                                                <img class="heart-color"
                                                     src=""
                                                     alt="">
                                            </button>
                                        </li>
                                        <li class="unorder-list">
                                            <!-- profile picture end -->
                                            <div class="profile-thumb">
                                                <a href="#">
                                                    <figure class="profile-thumb-small">
                                                        <img src=""
                                                             alt="profile picture">
                                                    </figure>
                                                </a>
                                            </div>
                                            <!-- profile picture end -->

                                            <div class="unorder-list-info">
                                                <h3 class="list-title"><a href="#">Jashon Muri</a></h3>
                                                <p class="list-subtitle"><a href="#">2 mutual</a></p>
                                            </div>
                                            <button class="like-button active">
                                                <img class="heart"
                                                     src=""
                                                     alt="">
                                                <img class="heart-color"
                                                     src=""
                                                     alt="">
                                            </button>
                                        </li>
                                        <li class="unorder-list">
                                            <!-- profile picture end -->
                                            <div class="profile-thumb">
                                                <a href="#">
                                                    <figure class="profile-thumb-small">
                                                        <img src=""
                                                             alt="profile picture">
                                                    </figure>
                                                </a>
                                            </div>
                                            <!-- profile picture end -->

                                            <div class="unorder-list-info">
                                                <h3 class="list-title"><a href="#">Rolin Theitar</a></h3>
                                                <p class="list-subtitle"><a href="#">drama</a></p>
                                            </div>
                                            <button class="like-button">
                                                <img class="heart"
                                                     src=""
                                                     alt="">
                                                <img class="heart-color"
                                                     src=""
                                                     alt="">
                                            </button>
                                        </li>
                                        <li class="unorder-list">
                                            <!-- profile picture end -->
                                            <div class="profile-thumb">
                                                <a href="#">
                                                    <figure class="profile-thumb-small">
                                                        <img src=""
                                                             alt="profile picture">
                                                    </figure>
                                                </a>
                                            </div>
                                            <!-- profile picture end -->

                                            <div class="unorder-list-info">
                                                <h3 class="list-title"><a href="#">Active Mind</a></h3>
                                                <p class="list-subtitle"><a href="#">fitness</a></p>
                                            </div>
                                            <button class="like-button">
                                                <img class="heart"
                                                     src=""
                                                     alt="">
                                                <img class="heart-color"
                                                     src=""
                                                     alt="">
                                            </button>
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
                thoughts: {}
            }
        },
        methods: {
            getPostImage(image) {
                let photo = 'Backend/ThoughtsImages/' + image;
                return photo;
            },
            getUserImage(image) {
                let photo = 'Backend/ProfileImages/' + image;
                return photo;
            },
            getCoverImage() {
                let cp = 'images/cover.jpg';
                return cp;
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
                    if (this.user !== 'null' && this.user.followings.length > 0) {
                        this.followerThoughts();
                    }
                }).catch(() => {
                    Toast.fire({
                        icon: 'error',
                        title: 'There occurred an error while loading the feed.'
                    });
                });
            },
            likeUnlike(postId) {
                axios.put('api/like_unlike/' + postId).then((response)=>{
                    console.log(response);
                }).catch(()=>{
                    Toast.fire({
                        icon: 'error',
                        title: 'There occurred an error while liking the Thought.'
                    });
                });
            }
        },
        mounted() {
            this.authUser();

        }
    }
</script>

<style scoped>

</style>