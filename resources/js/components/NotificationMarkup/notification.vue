<template>
    <!-- Notifications Dropdown Menu -->
    <li class="nav-item dropdown">
        <a class="nav-link" data-toggle="dropdown" href="#">
            <i class="fas fa-bullhorn"></i>
            <span class="badge badge-warning navbar-brand">{{(unreadNotifications == 0 || unreadNotifications == undefined || unreadNotifications == null) ? '0' : unreadNotifications}}</span>
        </a>
        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">

            <notification-item v-for="allnotification in allNotifications" :key="allnotification.id"
                               :singleNotification="allnotification"></notification-item>

            <div class="dropdown-divider"></div>
            <a href="#" class="dropdown-item dropdown-footer">See All
                Notifications</a>
            <div class="dropdown-divider"></div>
            <a href="#"
               @click="markNotificationsAsRead(user)"
               class="dropdown-item dropdown-footer" v-if="(unreadNotifications !== 0)">Mark all as read</a>
            <div class="dropdown-divider"
                 v-if="(allNotifications.length == 0 || allNotifications.length == null)"></div>
            <a href="#"
               class="dropdown-item dropdown-footer"
               v-if="(allNotifications.length == 0 || allNotifications.length == null)">No any notifications</a>
        </div>
    </li>
</template>

<script>
    import notificationItem from './notificationItem.vue'

    export default {
        props: ['unreads', 'userid', 'allnotifications'],
        data() {
            return {
                unreadNotifications: this.unreads,
                allNotifications: this.allnotifications,
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
                            let full_type = notification.type;
                            let type = full_type.split('\\').pop();
                            if (type == 'follower') {
                                let newUnreadNotifications = {
                                    type: notification.type,
                                    data: {
                                        follower: notification.follower,
                                        following: notification.following
                                    },
                                    read_at: notification.read_at,
                                    created_at: notification.created_at
                                };
                                this.unreadNotifications++;
                                this.allNotifications.pop();
                                this.allNotifications.unshift(newUnreadNotifications);
                                Fire.$emit('notificationEvent');
                            } else if (type == 'unfollower') {
                                let newUnreadNotifications = {
                                    type: notification.type,
                                    data: {
                                        unfollower: notification.unfollower,
                                        user: notification.user
                                    }
                                };
                                this.unreadNotifications++;
                                this.allNotifications.pop();
                                this.allNotifications.unshift(newUnreadNotifications);
                                Fire.$emit('notificationEvent');

                            } else if (type == 'postLiked') {
                                let newUnreadNotifications = {
                                    type: notification.type,
                                    data: {
                                        voter: notification.voter,
                                        post: notification.post,
                                        notified: notification.notified
                                    }
                                };
                                this.unreadNotifications++;
                                this.allNotifications.pop();
                                this.allNotifications.unshift(newUnreadNotifications);
                                Fire.$emit('notificationEvent');
                            }
                            else {
                                console.log('Error');
                            }
                        }
                    );
            },

            markNotificationsAsRead(id) {
                if (this.allNotifications.length !== '0') {
                    axios.get('api/markAsRead/' + id).then((response) => {
                        this.unreadNotifications = 0;
                        this.allNotifications = response.data.notifications;
                        Toast.fire({
                            icon: 'success',
                            title: 'All Notifications Are Marked As Read.'
                        })
                    }).catch(() => {
                        Toast.fire({
                            icon: 'error',
                            title: "You Don't have any Notifications to mark as read"
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

<style>
    .dropdown-menu {
        position: absolute;
        top: 100%;
        left: 0;
        z-index: 1000;
        display: none;
        float: left;
        min-width: 21rem;
        padding: 0.5rem 0;
        margin: 0.125rem 0 0;
        font-size: 0.9rem;
        color: #212529;
        text-align: left;
        list-style: none;
        background-color: #fff;
        background-clip: padding-box;
        border: 1px solid rgba(0, 0, 0, 0.15);
        border-radius: 0.25rem;
    }
</style>
