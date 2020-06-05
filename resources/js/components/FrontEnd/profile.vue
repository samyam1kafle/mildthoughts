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
                                            <li class="active"><a href="#">timeline</a></li>
                                            <li><a href="about.html">about</a></li>
                                            <li><a href="photos.html">photos</a></li>
                                            <li><a href="friends.html">friends</a></li>
                                            <li><a href="about.html">more</a></li>
                                            <!-- <li class="d-inline-block d-md-none"><a href="profile.html">edit profile</a></li> -->
                                        </ul>
                                    </nav>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-2 col-md-3 d-none d-md-block">
                            <div class="profile-edit-panel">
                                <button v-if="!isFollowing" @click="followUser(user.id)" class="edit-btn">Follow {{user.name}}</button>
                                <button v-else @click="unfollowUser(user.id)" class="edit-btn">Un-follow {{user.name}}</button>
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


                            <!--&lt;!&ndash; widget single item start &ndash;&gt;-->
                            <!--<div class="card widget-item">-->
                            <!--<h4 class="widget-title">page you may like</h4>-->
                            <!--<div class="widget-body">-->
                            <!--<ul class="like-page-list-wrapper">-->
                            <!--<li class="unorder-list">-->
                            <!--&lt;!&ndash; profile picture end &ndash;&gt;-->
                            <!--<div class="profile-thumb">-->
                            <!--<a href="#">-->
                            <!--<figure class="profile-thumb-small">-->
                            <!--<img src="assets/images/profile/profile-small-33.jpg"-->
                            <!--alt="profile picture">-->
                            <!--</figure>-->
                            <!--</a>-->
                            <!--</div>-->
                            <!--&lt;!&ndash; profile picture end &ndash;&gt;-->

                            <!--<div class="unorder-list-info">-->
                            <!--<h3 class="list-title"><a href="#">Travel The World</a></h3>-->
                            <!--<p class="list-subtitle"><a href="#">adventure</a></p>-->
                            <!--</div>-->
                            <!--<button class="like-button active">-->
                            <!--<img class="heart" src="assets/images/icons/heart.png" alt="">-->
                            <!--<img class="heart-color" src="assets/images/icons/heart-color.png"-->
                            <!--alt="">-->
                            <!--</button>-->
                            <!--</li>-->
                            <!--<li class="unorder-list">-->
                            <!--&lt;!&ndash; profile picture end &ndash;&gt;-->
                            <!--<div class="profile-thumb">-->
                            <!--<a href="#">-->
                            <!--<figure class="profile-thumb-small">-->
                            <!--<img src="assets/images/profile/profile-small-30.jpg"-->
                            <!--alt="profile picture">-->
                            <!--</figure>-->
                            <!--</a>-->
                            <!--</div>-->
                            <!--&lt;!&ndash; profile picture end &ndash;&gt;-->

                            <!--<div class="unorder-list-info">-->
                            <!--<h3 class="list-title"><a href="#">Foodcort Nirala</a></h3>-->
                            <!--<p class="list-subtitle"><a href="#">food</a></p>-->
                            <!--</div>-->
                            <!--<button class="like-button">-->
                            <!--<img class="heart" src="assets/images/icons/heart.png" alt="">-->
                            <!--<img class="heart-color" src="assets/images/icons/heart-color.png"-->
                            <!--alt="">-->
                            <!--</button>-->
                            <!--</li>-->
                            <!--<li class="unorder-list">-->
                            <!--&lt;!&ndash; profile picture end &ndash;&gt;-->
                            <!--<div class="profile-thumb">-->
                            <!--<a href="#">-->
                            <!--<figure class="profile-thumb-small">-->
                            <!--<img src="assets/images/profile/profile-small-5.jpg"-->
                            <!--alt="profile picture">-->
                            <!--</figure>-->
                            <!--</a>-->
                            <!--</div>-->
                            <!--&lt;!&ndash; profile picture end &ndash;&gt;-->

                            <!--<div class="unorder-list-info">-->
                            <!--<h3 class="list-title"><a href="#">Rolin Theitar</a></h3>-->
                            <!--<p class="list-subtitle"><a href="#">drama</a></p>-->
                            <!--</div>-->
                            <!--<button class="like-button">-->
                            <!--<img class="heart" src="assets/images/icons/heart.png" alt="">-->
                            <!--<img class="heart-color" src="assets/images/icons/heart-color.png"-->
                            <!--alt="">-->
                            <!--</button>-->
                            <!--</li>-->
                            <!--<li class="unorder-list">-->
                            <!--&lt;!&ndash; profile picture end &ndash;&gt;-->
                            <!--<div class="profile-thumb">-->
                            <!--<a href="#">-->
                            <!--<figure class="profile-thumb-small">-->
                            <!--<img src="assets/images/profile/profile-small-29.jpg"-->
                            <!--alt="profile picture">-->
                            <!--</figure>-->
                            <!--</a>-->
                            <!--</div>-->
                            <!--&lt;!&ndash; profile picture end &ndash;&gt;-->

                            <!--<div class="unorder-list-info">-->
                            <!--<h3 class="list-title"><a href="#">Active Mind</a></h3>-->
                            <!--<p class="list-subtitle"><a href="#">fitness</a></p>-->
                            <!--</div>-->
                            <!--<button class="like-button">-->
                            <!--<img class="heart" src="assets/images/icons/heart.png" alt="">-->
                            <!--<img class="heart-color" src="assets/images/icons/heart-color.png"-->
                            <!--alt="">-->
                            <!--</button>-->
                            <!--</li>-->
                            <!--</ul>-->
                            <!--</div>-->
                            <!--</div>-->
                            <!--&lt;!&ndash; widget single item end &ndash;&gt;-->
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
                                            <img :src="getUserImage(user.display_image)" alt="profile picture">
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
                                                    <span aria-hidden="true">×</span>
                                                </button>
                                            </div>
                                            <div class="modal-body custom-scroll ps">
                                                <textarea name="share" class="share-field-big custom-scroll ps"
                                                          placeholder="Say Something"><div class="ps__rail-x"
                                                                                           style="left: 0px; bottom: 3px;"><div
                                                        class="ps__thumb-x" tabindex="0"
                                                        style="left: 0px; width: 0px;"></div></div><div
                                                        class="ps__rail-y" style="top: 0px; right: 2px;"><div
                                                        class="ps__thumb-y" tabindex="0"
                                                        style="top: 0px; height: 0px;"></div></div></textarea>
                                                <div class="ps__rail-x" style="left: 0px; bottom: 3px;">
                                                    <div class="ps__thumb-x" tabindex="0"
                                                         style="left: 0px; width: 0px;"></div>
                                                </div>
                                                <div class="ps__rail-y" style="top: 0px; right: 2px;">
                                                    <div class="ps__thumb-y" tabindex="0"
                                                         style="top: 0px; height: 0px;"></div>
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="post-share-btn" data-dismiss="modal">
                                                    cancel
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
                        <div class="card" v-for="thought in thoughts">
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
                isFollowing: false
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
                let photo = 'Backend/ProfileImages/' + image;
                return photo;
            },
            viewProfile() {
                axios.get('profile/' + this.id).then((response) => {
                    this.user = response.data.user_data;
                    this.thoughts = response.data.thoughts;
                    this.isFollowing = response.data.isFollowing;
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
