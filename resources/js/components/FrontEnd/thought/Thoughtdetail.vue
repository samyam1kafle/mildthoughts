<template>
    <main>
        <div class="main-wrapper pt-80">
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
                        <!-- Box Comment -->
                        <div class="card card-widget">
                            <div class="card-header">
                                <div class="user-block">
                                    <img class="img-circle" :src="getUserImage(user.display_image)"
                                         alt="User Image">
                                    <span class="username"><router-link
                                            :to="{name: 'FrontProfile' , query: {id: user.id}}" tag="a"
                                            active-class="active">{{user.name}}</router-link></span>
                                    <span class="description">{{thought.created_at | notificationTime}}</span>
                                </div>

                            </div>
                            <!-- /.card-header -->
                            <div class="card-body" style="display: block;">
                                <div class="container-fluid" style="margin-top: 1px">
                                    <strong class="col-xs-12">
                                        <i class="fa fa-pen blue"> Title: </i> <u>{{thought.title}}</u>
                                    </strong>
                                    <div class="col-xs-1"><br></div>
                                    <strong class="col-xs-12">
                                        <i class="fa fa-tag indigo"> Tag: </i> <u>{{category.category_name}}</u>
                                    </strong>
                                </div>
                                <img v-show="thought.image" class="img-fluid pad" :src="getThoughtImage(thought.image)"
                                     alt="Photo">
                                <div class="container-fluid">
                                    <strong>
                                        <pre>{{thought.thought}}</pre>
                                    </strong>
                                </div>

                                <button v-if="liked" @click.prevent="likeUnlike(thought.id)" type="button"
                                        class="btn btn-default btn-sm"><i
                                        class="fa fa-heartbeat" style="color: #e25050"></i>
                                    unlike
                                </button>
                                <button v-else type="button" @click.prevent="likeUnlike(thought.id)"
                                        class="btn btn-default btn-sm"><i
                                        class="fa fa-heartbeat"></i>
                                    Like
                                </button>
                                <span @click="votersModel" v-if="!liked && thought.voters_count >0" class="float-right"
                                      style="cursor: pointer">
                                    {{thought.voters_count}} likes</span>
                                <span v-else-if="thought.voters_count == 0" class="float-right text-muted"
                                      style="cursor:wait">
                                    No likes</span>
                                <span @click="votersModel" v-else v-show="liked && thought.voters_count > 1"
                                      class="float-right" style="cursor: pointer">
                                    You and {{thought.voters_count -1 }} other like the thought</span>
                            </div>

                        </div>
                        <!-- /.card -->
                    </div>
                    <div class="col-lg-3 order-3 mt-20">
                        <aside class="widget-area">
                            <!-- /.card-body -->
                            <div class="card-footer card-comments" style="display: block;">
                                <div class="card-comment">
                                    <!-- User image -->
                                    <img class="img-circle img-sm" src="" alt="User Image">

                                    <div class="comment-text">
                    <span class="username">
                      Maria Gonzales
                      <span class="text-muted float-right">8:03 PM Today</span>
                    </span><!-- /.username -->
                                        It is a long established fact that a reader will be distracted
                                        by the readable content of a page when looking at its layout.
                                    </div>
                                    <!-- /.comment-text -->
                                </div>
                                <!-- /.card-comment -->
                                <div class="card-comment">
                                    <!-- User image -->
                                    <img class="img-circle img-sm" src="" alt="User Image">

                                    <div class="comment-text">
                    <span class="username">
                      Luna Stark
                      <span class="text-muted float-right">8:03 PM Today</span>
                    </span><!-- /.username -->
                                        It is a long established fact that a reader will be distracted
                                        by the readable content of a page when looking at its layout.
                                    </div>
                                    <!-- /.comment-text -->
                                </div>
                                <!-- /.card-comment -->
                            </div>
                            <!-- /.card-footer -->
                            <div class="card-footer" style="display: block;">
                                <form action="#" method="post">
                                    <img class="img-fluid img-circle img-sm" src="" alt="Alt Text">
                                    <!-- .img-push is used to add margin to elements next to floating images -->
                                    <div class="img-push">
                                        <input type="text" class="form-control form-control-sm"
                                               placeholder="Press enter to post comment">
                                    </div>
                                </form>
                            </div>
                            <!-- /.card-footer -->
                        </aside>
                    </div>
                    <!-- /.col -->
                </div>
            </div>
        </div>
        <!--Likers Model-->
        <div class="modal fade" id="votersModel" tabindex="-1" role="dialog"
             aria-labelledby="votersModelCenterTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLongTitle">Liked By</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="card-body table-responsive p-0" style="height: 300px;">
                            <table class="table table-head-fixed">
                                <th>all({{thought.voters_count}})</th>
                                <tbody>
                                <tr v-for="voter in thought.voters" :key="voter.id">
                                    <td>
                                        <div class="post-title d-flex align-items-center">
                                            <!-- profile picture end -->
                                            <div class="profile-thumb">
                                                <a href="#">
                                                    <div class="profile-thumb-middle text-muted">
                                                        <img :src="getUserImage(voter.display_image)"
                                                             alt="profile picture">
                                                    </div>
                                                </a>
                                            </div>
                                            <!-- profile picture end -->

                                            <div class="posted-author">
                                                <h6 class="author">
                                                    <a href="#">{{voter.name}}
                                                    </a>

                                                </h6>
                                            </div>

                                        </div>

                                    </td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>
        <!--Likers Model-->
    </main>

</template>

<script>
    export default {
        data() {
            return {
                thought: {},
                liked: {},
                user: {},
                tags: {},
                category: {},
            }
        },
        methods: {
            votersModel() {
                $('#votersModel').modal('show');
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
            loadPostDetail() {
                axios.get('thoughts/' + this.id).then((response) => {
                    this.thought = response.data.thought;
                    this.liked = response.data.liked;
                    this.tags = response.data.tags;
                    this.user = this.thought.user;
                    this.category = this.thought.category;
                }).catch();
            },
            likeUnlike(postId) {
                axios.put('api/like_unlike/' + postId).then((response) => {
                    Echo.channel('like-unlike')
                        .listen('likeUnlike', (event) => {
                            this.thought.voters_count = event.voters_count;
                            this.thought.voters = event.voters;
                        });
                    this.liked = response.data.liked;
                }).catch(() => {
                    Toast.fire({
                        icon: 'error',
                        title: 'There occurred an error while liking the Thought.'
                    });
                });
            },
        },
        computed: {
            id() {
                return this.$route.query.thought_id;
            }
        },
        watch: {
            id() {
                this.loadPostDetail();
            }
        },
        mounted() {
            this.loadPostDetail();
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

    .dropdown-item:active {
        color: #fff;
        text-decoration: none;
        background-color: #288ee2;

    }

    .card-header {
        padding: 0.75rem 0.25rem;
        margin-bottom: 2px;
        background-color: rgba(247, 240, 240, 0.03);
        border-bottom: 1px solid rgb(78, 140, 148);
    }
</style>