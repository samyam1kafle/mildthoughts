<template>
    <div class="mt-1">
        <div  v-if="(singleNotification.read_at == undefined || singleNotification.read_at == null)"
             style="background-color: #288ee2">
            <new-follower v-if="(type == 'follower')" :follower="singleNotification.data.follower"
                          :followed_time="singleNotification.created_at"></new-follower>

            <un-follower v-if="(type == 'unfollower')" :unfollower="singleNotification.data.unfollower"
                         :unfollowed_time="singleNotification.created_at">

            </un-follower>
            <post-liked v-if="(type == 'postLiked')" :voter="singleNotification.data.voter"
                        :post="singleNotification.data.post" :liked_time="singleNotification.created_at"></post-liked>
            <div class="dropdown-divider"></div>
        </div>
        <div v-else>
            <new-follower v-if="(type == 'follower')" :follower="singleNotification.data.follower"
                          :followed_time="singleNotification.created_at"></new-follower>

            <un-follower v-if="(type == 'unfollower')" :unfollower="singleNotification.data.unfollower"
                         :unfollowed_time="singleNotification.created_at">

            </un-follower>

            <post-liked v-if="(type == 'postLiked')" :voter="singleNotification.data.voter"
                        :post="singleNotification.data.post" :liked_time="singleNotification.created_at"></post-liked>

            <div class="dropdown-divider"></div>
        </div>

    </div>


</template>

<script>
    import newFollower from './followed.vue'
    import unFollower from './unfollowed.vue'
    import postLiked from './postLiked.vue'

    export default {
        props: ['singleNotification'],
        components: {
            newFollower,
            unFollower,
            postLiked
        },
        data() {
            return {
                notificationType: this.singleNotification.type,
                type: ''
            }
        },
        methods: {
            notificationsType() {
                let string = this.notificationType;
                let head = string.split('\\').pop();
                this.type = head;

            },
        },
        mounted() {
            this.notificationsType();
        }

    }
</script>

<style scoped>

</style>