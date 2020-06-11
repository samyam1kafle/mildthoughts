<template>
    <router-link :to="{name: 'FrontProfile' , query: {id: follower.id}}" tag="a"
                 active-class="active" class="dropdown-item">
        <div class="widget-user-image" style="top: 21px;">
            <img
                    :src="getFollowerImage(follower.display_image)" alt="User Avatar"
                    class="img-circle elevation-2"
                    style="width: 40px; height: auto;">
            <!--<i class="fa fa-user-plus" style="width: 25px; height: auto;"></i>-->
            <strong>{{follower.name}} </strong>started
            following you.
            <small>{{followed_time | notificationTime}}</small>
        </div>
    </router-link>

</template>

<script>
    export default {
        props: ['follower', 'followed_time'],

        methods: {
            getFollowerImage(image) {
                if (image == null || image == undefined) {
                    let photo = 'images/user.png';
                    return photo;
                } else {
                    let photo = 'Backend/ProfileImages/' + image;
                    return photo;
                }
            }
        }
    }
</script>

<style scoped>
    small {
        float: right;
    }
</style>