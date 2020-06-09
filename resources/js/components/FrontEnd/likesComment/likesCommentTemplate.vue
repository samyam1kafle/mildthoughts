<template>
    <div class="col-xs-8">
        <ul class="comment-share-meta">
            <li>
                <a type="button" @click.prevent="likeUnlike(postId)" class="post-meta-like">
                    <i class="fa fa-heartbeat" v-if="liked" style="color: #e25050"></i>
                    <i class="fa fa-heartbeat" v-else style="color: #ab9595;"></i>
                </a>
                <button class="post-share">
                    <span v-if="(postVotersCount == 0)">No likes yet.</span>
                    <span v-else-if="liked && (postVotersCount <= 1)"><strong
                            @click="openModel">You liked the thought</strong></span>
                    <span v-else-if="!liked && (postVotersCount > 0)"><strong @click="openModel">Likes :{{postVotersCount}}</strong></span>
                    <span v-else v-show="liked && postVotersCount > 1"><strong @click="openModel">You and {{postVotersCount - 1}} others like the thought.</strong></span>
                </button>
            </li>

        </ul>
        <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog"
             aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
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
                                <th>all({{postVotersCount}})</th>
                                <tbody>
                                <tr v-for="voter in allVoters" :key="voter.id">
                                    <td>
                                        <div class="post-title d-flex align-items-center">
                                            <!-- profile picture end -->
                                            <div class="profile-thumb">
                                                <a href="#">
                                                    <div class="profile-thumb-middle">
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
    </div>
</template>

<script>
    export default {
        props: ['post_id'],
        data() {
            return {
                postId: this.post_id,
                allVoters: {},
                postVotersCount: {},
                liked: false
            }
        },
        methods: {
            likeUnlike(postId) {
                axios.put('api/like_unlike/' + postId).then((response) => {
                    Echo.channel('like-unlike')
                        .listen('likeUnlike', (event) => {
                            this.postVotersCount = event.voters_count;
                            this.allVoters = event.voters;
                        });
                    this.liked = response.data.liked;
                }).catch(() => {
                    Toast.fire({
                        icon: 'error',
                        title: 'There occurred an error while liking the Thought.'
                    });
                });
            },
            loadLikes() {
                axios.get('api/like_unlike_count/' + this.postId).then((response) => {
                    this.liked = response.data.liked;
                    this.allVoters = response.data.voters;
                    this.postVotersCount = response.data.count;
                }).catch(() => {
                    Toast.fire({
                        icon: 'error',
                        title: 'There occurred an error while fetching the data.'
                    });
                });
            },
            openModel() {
                $('#exampleModalCenter').modal('show');
            },

            getUserImage(image) {
                if (image == null || image == undefined) {
                    let photo = 'images/user.png';
                    return photo;
                } else {
                    let photo = 'Backend/ProfileImages/' + image;
                    return photo;
                }
            }
        },

        mounted() {
            this.loadLikes();
        }
    }
</script>

<style scoped>

</style>