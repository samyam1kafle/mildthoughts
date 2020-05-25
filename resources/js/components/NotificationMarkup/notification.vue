<template>
    <!-- Notifications Dropdown Menu -->
    <li class="nav-item dropdown">
        <a class="nav-link" data-toggle="dropdown" href="#">
            <i class="fas fa-bullhorn"></i>
            <span class="badge badge-warning navbar-brand">{{(unreadNotifications.length == null) ? '0' : unreadNotifications.length}}</span>
        </a>
        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
            <notification-item v-for="unreads in unreadNotifications" :key="unreads.id"
                               :unreads="unreads" style="background: #E4E9F2"></notification-item>
            <div class="dropdown-divider"></div>
            <a href="#" class="dropdown-item dropdown-footer" v-if="(unreadNotifications.length !== 0)">See All
                Notifications</a>
            <div class="dropdown-divider"></div>
            <a href="#"
               @click="markNotificationsAsRead(user)"
               class="dropdown-item dropdown-footer" v-if="(unreadNotifications.length !== 0)">Mark all as read</a>
            <div class="dropdown-divider"></div>
            <a href="#" class="dropdown-item dropdown-footer" v-if="(unreadNotifications.length == 0)">No Unread
                Notifications</a>
        </div>
    </li>
</template>

<script>
    import notificationItem from './notificationItem.vue'

    export default {
        props: ['unreads', 'userid'],
        data() {
            return {
                unreadNotifications: this.unreads,
                user: this.userid
            }
        },
        components: {
            notificationItem
        },
        methods: {
            loadData() {
                Echo.private('App.User.' + this.userid)
                    .notification((notification) => {
                        let newUnreadNotifications = {
                            data: {
                                follower: notification.follower,
                                following: notification.following
                            }
                        };
                        this.unreadNotifications.push(newUnreadNotifications);
                        Fire.$emit('notificationEvent');
                    });
            },

            markNotificationsAsRead(id) {
                if (this.unreadNotifications.length !== '0') {
                    axios.get('api/markAsRead/' + id).then(() => {
                        this.unreadNotifications = unreads;
                        Toast.fire({
                            icon: 'success',
                            title: 'All Notifications Are Marked As Read.'
                        })
                    }).catch(() => {
                        Toast.fire({
                            icon: 'error',
                            title: 'Something Went Wrong Please try Again.'
                        })
                    });
                }
            }
        },
        mounted() {
            this.loadData();
            Fire.$on('notificationEvent', () => {
                Toast.fire({
                    icon: 'info',
                    title: 'You got a new Notification.'
                })
            });


        }
    }
</script>
