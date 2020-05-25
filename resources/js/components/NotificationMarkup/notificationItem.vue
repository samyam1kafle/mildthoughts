<template>
    <div>
        <new-follower v-if="type == 'follower'" :follower="unreads.data.follower"
                      :followed_time="unreads.created_at"></new-follower>
    </div>


</template>

<script>
    import newFollower from './followed.vue'

    export default {
        props: ['unreads'],
        components: {
            newFollower
        },
        data() {
            return {
                notificationType: this.unreads.type,
                type: ''
            }
        },
        methods: {
            notificationsType() {
                // let newNotificationType
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