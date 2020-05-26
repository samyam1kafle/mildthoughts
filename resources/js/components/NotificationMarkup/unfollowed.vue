<template>
    <a href="#" class="dropdown-item">
        <div class="widget-user-image" style="top: 21px;">
            <!--<img-->
            <!--:src="getUnFollowerImage(unfollower.display_image)" alt="User Avatar"-->
            <!--class="img-circle elevation-2"-->
            <!--style="width: 40px; height: auto;">-->
            <i class="fa fa-user-minus" style="width: 25px; height: auto;"></i>
            <strong> {{unfollower.name}} </strong>Unfollowed you.
            <small>{{unfollowed_time | notificationTime}}</small>
        </div>
    </a>

</template>

<script>
    export default {
        props: ['unfollower', 'unfollowed_time'],

        methods: {
            getUnFollowerImage(image) {
                let photo = 'Backend/ProfileImages/' + image;
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