<div id="comment_list">
    <div class="padding-top-10">
        <h4>댓글 {{ $comments_count }}</h4></div>


    <div class="novel-review">
        {{--<div class="review-write pad-all">--}}
                {{--<textarea id="demo-textarea-input" rows="4" class="form-control inline"--}}
                          {{--style="width:50%" placeholder="댓글"></textarea>--}}
            {{--<button class="btn btn-primary inline"--}}
                    {{--style="width:100px;height:83px; vertical-align:top;">등록--}}
            {{--</button>--}}

        {{--</div>--}}


        @foreach($groups_comments as $comment)


            <div class="review">

                <div>
                    <span class="nick">{{ $comment[0]->users->name }}</span> {{ $comment[0]->created_at }}
                    <button class="btn btn-xs btn-pink">N</button>
                </div>
                <div class="content">
                    <span class="inning">{{ $comment[0]->novels->id }} 회</span> {{ $comment[0]->comment }}
                </div>
                <div class="button">
                    <button id="reply_button{{$loop->index}}" class="btn btn-xs btn-mint">답변</button>
                    <button class="btn btn-xs btn-danger">신고</button>
                </div>


                <form id="comment_form{{$loop->index}}" action="" hidden>
                    <div class="review-of pad-all">
                        <textarea hidden id="demo-textarea-input" rows="2" class="form-control inline"
                                  style="width:50%" placeholder="댓글"></textarea>
                        <button class="btn btn-primary inline"
                                style="width:100px;height:48px; vertical-align:top;">등록
                        </button>
                    </div>
                </form>

                <script type="text/javascript">


                        $("#reply_button{{$loop->index}}").click(function () {

                            $("#comment_form{{$loop->index}}").show();
                        });

                </script>

            </div>
            @foreach($comment['children'] as $child)
                <div class="review reply">
                    <div>
                        <span class="nick">{{ $child->users->name }}</span> {{ $child->created_at }}
                        <button class="btn btn-xs btn-pink">N</button>
                    </div>
                    <div class="content">
                        <span class="inning">{{ $child->novels->novel_group_id }}회</span> {{ $child->comment }}
                    </div>
                    <div class="button">

                        <button class="btn btn-xs btn-danger">신고</button>
                    </div>
                </div>
            @endforeach

        @endforeach


    </div>
</div>

