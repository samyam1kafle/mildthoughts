<template>
    <div>
        <div v-if="(singleNotification.read_at == undefined || singleNotification.read_at == null)"
             style="background: #E4E9F2">
            <new-follower v-if="(type == 'follower')" :follower="singleNotification.data.follower"
                          :followed_time="singleNotification.created_at"></new-follower>

            <un-follower v-if="(type == 'unfollower')" :unfollower="singleNotification.data.unfollower"
                         :unfollowed_time="singleNotification.created_at">

            </un-follower>
            <div class="dropdown-divider"></div>
        </div>
        <div v-else>
            <new-follower v-if="(type == 'follower')" :follower="singleNotification.data.follower"
                          :followed_time="singleNotification.created_at"></new-follower>

            <un-follower v-if="(type == 'unfollower')" :unfollower="singleNotification.data.unfollower"
                         :unfollowed_time="singleNotification.created_at">

            </un-follower>
            <div class="dropdown-divider"></div>
        </div>

    </div>


</template>

<script>
    import newFollower from './followed.vue'
    import unFollower from './unfollowed.vue'

    export default {
        props: ['singleNotification'],
        components: {
            newFollower,
            unFollower
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