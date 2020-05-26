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
               class="dropdown-item dropdown-footer" v-if="(unreadNotifications.length !== 0)">Mark all as read</a>
            <div class="dropdown-divider"></div>
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
                            console.log(notification.data);
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
                                this.allNotifications.push(newUnreadNotifications);
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
                                this.allNotifications.push(newUnreadNotifications);
                                Fire.$emit('notificationEvent');

                            } else {
                                console.log('Fuck There is a Mistake Dude');
                            }
                        }
                    );
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
