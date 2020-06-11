<template>
    <div class="col-xs-12" v-show="commentOpen">
        <div class="card-comments">
            <div class="card-comment" v-if="post.comment.length > 0" v-for="comment in comments" :key="comment.id">
                <!-- User image -->
                <img class="img-circle img-sm" src="" alt="User Image">

                <div class="comment-text">
                    <span class="username">
                      Maria Gonzales
                      <span class="text-muted float-right">{{comment.created_at | notificationTime}}</span>
                    </span><!-- /.username -->
                    {{comment.comment}}
                </div>
                <!-- /.comment-text -->
            </div>
            <div class="card-comment" v-else>
                <!-- User image -->


                <div class="comment-text">
                    No Comments
                </div>
                <!-- /.comment-text -->
            </div>

        </div>
        <!-- /.card-footer -->
        <div class="card-footer" style="display: block;">
            <form @submit.prevent="createNewComment(post.id)">

                <img class="img-fluid img-circle img-sm"
                     :src="getUserImage(post.user.display_image)" alt="Alt Text">
                <!-- .img-push is used to add margin to elements next to floating images -->
                <div class="img-push">
                    <input placeholder="Your Comment text" v-model="form.comment" type="text" name="comment"
                           class="form-control"
                           :class="{ 'is-invalid': form.errors.has('comment') }">
                    <has-error :form="form" field="comment"></has-error>
                </div>
                <div class="form-group mt-2">
                    <button type="submit" style="float:right" class="col-xs-12"><i
                            class="fas fa-reply blue"></i> Comment
                    </button>
                </div>

            </form>
        </div>
    </div>
</template>

<script>
    import {userEvent} from '../../../app.js'

    export default {
        props: ['post'],
        data() {
            return {
                comments: this.post.comment,
                commentOpen: false,
                form: new Form({
                    postId: '',
                    comment: ''
                })
            }
        },
        methods: {
            createNewComment(postId) {
                this.form.post('comment/' + postId).then((response) => {
                    this.comments = response.data.comments;
                }).catch(() => {

                });
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
        },
        created() {
            userEvent.$on('openComment', (data) => {
                this.commentOpen = data;
            })
        }
    }
</script>

<style scoped>

</style>