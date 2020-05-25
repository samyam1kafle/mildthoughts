<template>
    <a href="#" class="dropdown-item">

        <div class="widget-user-image" style="top: 21px;">
            <img
                    :src="getFollowerImage(follower.display_image)" alt="User Avatar"
                    class="img-circle elevation-2"
                    style="width: 40px; height: auto;">
            <strong>{{follower.name}} </strong>started
            following you.
            <small>{{followed_time | notificationTime}}</small>
        </div>
    </a>

</template>

<script>
    export default {
        props: ['follower', 'followed_time'],

        methods: {
            getFollowerImage(image) {
                let photo = 'Backend/ProfileImages/' + image;
                return photo;
            }
        }
    }
</script>

<style scoped>
    small{
        float: right;
    }
</style>