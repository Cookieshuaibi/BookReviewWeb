    function fetchUnreadNotifications() {
        $.ajax({
            url: '/notifications/unread-count',
            type: 'GET',
            dataType: 'json',
            success: function(data) {
                const unreadCount = data.unreadCount;
                $('#unreadNotificationsCount').text(unreadCount);
                if (unreadCount > 0) {
                    $('#navbarDropdownNotifications').addClass('notification-unread');
                } else {
                    $('#navbarDropdownNotifications').removeClass('notification-unread');
                }
                fetchNotifications();
            },
            error: function(error) {
                console.error('Error fetching unread notifications:', error);
            }
        });
    }

    function fetchNotifications() {
        $.ajax({
            url: '/notifications/top',
            type: 'GET',
            dataType: 'json',
            success: function(data) {
                const notifications = data.notifications;
                const listElement = $('#notificationsList');
                listElement.empty(); // 清空现有列表

                // 插入前3条消息
                notifications.slice(0, 3).forEach(function(notification) {
                    var message = notification.data.reviews_content;
                    var url = "/notifications/" + notification.id;
                    listElement.append(
                        `<div class="dropdown-item"><a href="${url}" class="text-dark font-weight-bold text-decoration-none">
                           ${message}
                        </a></div>`
                    );
                });

                // 如果消息数量超过3条，显示消息数量
                if (notifications.length > 3) {
                    listElement.append(
                        `<div class="dropdown-item text-center">
                            <a href="${url('/notifications')}">View all ${notifications.length} notifications</a>
                        </div>`
                    );
                }
            },
            error: function(error) {
                console.error('Error fetching notifications:', error);
            }
        });
    }

    fetchUnreadNotifications();
    setInterval(fetchUnreadNotifications, 60000); // 每60秒检查一次