<template>
    <router-link :to="{name: 'ThoughtDetail',query: {thought_id: post.id}}" active-class="active" tag="a"
                 class="dropdown-item">
        <div class="widget-user-image" style="top: 21px;">
            <img v-if="post.image != null"
                 :src="getFollowerImage(post.image)" alt="User Avatar"
                 class="elevation-2"
                 style="width: 45px; height: auto;">
            <!--<i class="fa fa-user-plus" style="width: 25px; height: auto;"></i>-->
            <strong>{{voter.name}} </strong>Liked
            your Thought.
            <small>{{liked_time | notificationTime}}</small>
        </div>
    </router-link>

</template>

<script>
    export default {
        props: ['voter', 'post', 'liked_time'],

        methods: {
            getFollowerImage(image) {
                let photo = 'Backend/ThoughtsImages/' + image;
                return photo;
            }
        }
    }
</script>

<style scoped>
    small {
        float: right;
    }

</style>