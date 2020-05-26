function markNotificationsAsRead(count, user) {
    if (count !== '0') {
        $.get('api/markAsRead/' + user.id);
    }
}