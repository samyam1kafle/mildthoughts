<template>
    <ul class="comment-share-meta">
        <li @click="status">
            <button class="post-comment">
                <i class="fas fa-comments"></i>
                <span>{{countComment}}</span>
            </button>
        </li>
    </ul>

</template>

<script>
    import {userEvent} from '../../../app.js'

    export default {
        props: ['comment_count', 'id'],
        data() {
            return {
                countComment: this.comment_count,
                post_id: this.id,
                commentOpen: false
            }
        },
        methods: {
            status() {
                this.commentOpen = !this.commentOpen;
                userEvent.$emit('openComment', this.commentOpen);
            }
        },


    }
</script>

<style scoped>

</style>