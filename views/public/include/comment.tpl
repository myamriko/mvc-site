<div class="comments-area">
    <div class="comment-list">
        <div class="single-comment justify-content-between d-flex">
            <div class="user justify-content-between d-flex">
                <div class="thumb">
                    <img src="/public/pic/avatar/anonimus.png">
                </div>
                <div class="desc">
                    <p class="comment">
                        {$comment['mess']}
                    </p>
                </div>
            </div>
        </div>
        <div class="d-flex justify-content-between">
            <div class="d-flex align-items-center">
                <h5>
                    <em style="color: #607e89;"><b>{$comment['username']}</b></em>
                </h5>
                <p class="date">{$comment['date']|date_format:"%D о %H:%M"} </p>
            </div>
            <div class="reply-btn">
                <a href="#" class="btn-reply text-uppercase">reply</a>
            </div>
        </div>
    </div>
</div>