$(function () {
    $('#reviewForm').on('submit', function (event) {
        event.preventDefault(); // 阻止默认提交
        $.ajax({
            url: $(this).attr('action'), // AJAX 请求的 URL
            method: 'POST',
            data: $(this).serialize(), // 表单数据
            success: function (response) {
                if (response.success) {
                    // 插入新评论到页面
                    var review = response.data;
                    var newCard = '<div class="review-card mb-3 p-3 bg-light rounded shadow-sm">' +
                        '<div class="d-flex justify-content-between align-items-center">' +
                        '<div class="review-content">' +
                        '<a href="' + review.user_url + '" class="text-decoration-none">' +
                        '<h6 class="mb-1">' + review.user_name + '</h6>' +
                        '</a>' +
                        '<p class="mb-1"><strong>Rating:</strong> ' + review.rating + '</p>' +
                        '<p class="mb-1"><strong>Comment:</strong> ' + review.comment + '</p>' +
                        '</div>' +
                        '<small class="text-muted">' + review.created_at + '</small>' +
                        '</div>' +
                        '</div>';
                    $(".reviews-container").prepend(newCard);
                    // 更新平均评分
                    $('#average-rating').text(response.average_rating);
                    var reviews = $(".reviews-container .review-card").length;
                    if (reviews > 10) {
                        $(".reviews-container .review-card:last").remove();
                    }
                    // 重置表单
                    $('#reviewForm')[0].reset();
                } else {
                    alert(response.message); // 显示失败消息
                }
            },
            error: function (xhr, status, error) {
                alert('An error occurred. Please try again.');
            }
        });
    });
});
