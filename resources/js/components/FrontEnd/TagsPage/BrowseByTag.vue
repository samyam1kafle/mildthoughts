<template>
    <main>
        <div class="main-wrapper pt-80">
            <div class="container">
                <div class="callout callout-info mt-2">
                    <strong>You are currently viewing thoughts under {{Tagscategory.category_name}} tags.</strong>
                </div>
            </div>
            <div class="container">
                <div class="row">
                    <div class="col-lg-3 order-2 order-lg-1">
                        <aside class="widget-area">
                            <div class="card widget-item">
                                <h4 class="widget-title">Browse Through Categories Tags</h4>
                                <div class="widget-body">
                                    <ul class="like-page-list-wrapper">
                                        <li class="unorder-list" v-for="tag in tags" :key="tag.id">

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
                        </aside>
                    </div>
                    <div class="col-lg-6 order-1 order-lg-2">

                        <!-- Browse By Tags start -->
                        <div class="card mt-1" v-for="post in thoughts" :key="post.id">


                            <div class="post-title d-flex align-items-center">
                                <!-- profile picture end -->
                                <div class="profile-thumb">
                                    <router-link tag="a" :to="{name: 'FrontProfile' , query: {id: post.user.id}}"
                                                 active-class="active">
                                        <div class="profile-thumb-middle">
                                            <img :src="getUserImage(post.user.display_image)"
                                                 alt="profile picture">
                                        </div>
                                    </router-link>
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

                            <!-- Browse By Tags start -->
                            <div class="post-content mt-1">
                                <strong class="col-xs-12">
                                    <i class="fa fa-pen blue"> Title: </i> <u>{{post.title}}</u>
                                </strong>

                                <hr>

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

                        <div class="card mt-2 callout callout-danger" v-show="thoughts.length == 0">
                            <div class="post-content">
                                <p class="post-desc">
                                    There are currently no any thoughts posted under {{Tagscategory.category_name}}
                                    tags.
                                    <br>
                                    <strong>Come back later to see what are posted under
                                        {{Tagscategory.category_name}}.</strong>
                                </p>

                            </div>
                        </div>


                        <!-- Browse By Tags end -->


                    </div>

                    <div class="col-lg-3 order-3">
                        <aside class="widget-area">

                            <!-- Author You May Know -->
                            <div class="card widget-item">
                                <h4 class="widget-title">Authors You may like</h4>
                                <div class="widget-body">
                                    <ul class="like-page-list-wrapper">
                                        <li class="unorder-list" v-for="author in authorYouMayKnow" :key="author.id">
                                            <!-- profile picture end -->
                                            <div class="profile-thumb">
                                                <router-link :to="{name: 'FrontProfile' , query: {id: author.id}}"
                                                             tag="a"
                                                             active-class="active">
                                                    <div class="profile-thumb-small">
                                                        <img :src="getUserImage(author.display_image)"
                                                             alt="profile picture">
                                                    </div>
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
                            <!-- Author You May Know -->
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
                tags: {},
                authorYouMayKnow: {},
                thoughts: {},
                Tagscategory: {},
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
            getDataByTags() {
                axios.get('tags/' + this.id).then((response) => {
                    this.authorYouMayKnow = response.data.authorYouMayKnow;
                    this.tags = response.data.tags;
                    this.thoughts = response.data.thoughts;
                    this.Tagscategory = response.data.tagscategory;
                }).catch(() => {
                    Toast.fire({
                        icon: 'error',
                        title: 'There occurred an error while loading the Tags Page .'
                    });
                });
            }
        },
        computed: {
            id() {
                return this.$route.query.id;
            }
        },
        watch: {
            id() {
                this.getDataByTags();
            }
        },
        mounted() {
            this.getDataByTags();
        }
    }
</script>

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