<div id="comment_list">
    <div class="padding-top-10">
        <h4>댓글 3</h4></div>


    <div class="novel-review">
        <div class="review-write pad-all">
                                        <textarea id="demo-textarea-input" rows="4" class="form-control inline"
                                                  style="width:50%" placeholder="댓글"></textarea>
            <button class="btn btn-primary inline"
                    style="width:100px;height:83px; vertical-align:top;">등록
            </button>

        </div>


        @foreach($groups_comments as $comment)


            <div class="review">

                <div>
                    <span class="nick">{{ $comment[0]->users->name }}</span> {{ $comment[0]->created_at }}
                    <button class="btn btn-xs btn-pink">N</button>
                </div>
                <div class="content">
                    <span class="inning">{{ $comment[0]->novels->novel_group_id }} 회</span> {{ $comment[0]->comment }}
                </div>
                <div class="button">
                    <button class="btn btn-xs btn-mint">답변</button>
                    <button class="btn btn-xs btn-danger">신고</button>
                </div>

            </div>
            @foreach($comment['children'] as $child)
                <div class="review reply" v-for="children in my_comment.children">
                    <div>
                        <span class="nick">{{ $child->users->name }}</span> {{ $child->created_at }}
                        <button class="btn btn-xs btn-pink">N</button>
                    </div>
                    <div class="content">
                        <span class="inning">{{ $child->novels->novel_group_id }}회</span> {{ $child->comment }}
                    </div>
                    <div class="button">
                        <button class="btn btn-xs btn-mint">답변</button>
                        <button class="btn btn-xs btn-danger">신고</button>
                    </div>
                </div>
            @endforeach

        @endforeach

    </div>
</div>
</div>