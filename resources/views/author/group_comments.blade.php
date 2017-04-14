<div id="comment_list" xmlns:v-on="http://www.w3.org/1999/xhtml">
    <div id="novel_list">
        <div class="padding-top-10">
            <h4>댓글 {{ $comments_count }}</h4></div>

        <div class="novel-review">

            @foreach($groups_comments as $comment)


                <div class="review">

                    <div>
                        <span class="nick">{{ $comment->users->nickname }}</span> {{ $comment->created_at }}

                        {{--<button class="btn  btn-xs btn-danger" id="comment_destroy{{$comment->id}}"--}}
                        {{--onclick="destroyComment({{$comment->id}})">X--}}
                        {{--</button>--}}

                    </div>
                    <div class="content">
                        <span class="inning">{{ $comment->novels['inning']}} 회</span> {{ $comment->comment }}
                    </div>
                    <div class="button">
                        <button id="reply_button{{$comment->id}}" class="btn btn-xs btn-mint">답변</button>
                        <button class="btn btn-xs btn-danger">신고</button>
                    </div>


                </div>
                @foreach($comment['children'] as $child)
                    <div class="review reply">
                        <div>
                            <span class="nick">{{ $child->users->nickname }}</span> {{ $child->created_at }}
                            <button class="btn  btn-xs btn-danger" id="comment_destroy{{$child->id}}"
                                    onclick="destroyComment({{$child->id}})">X
                            </button>
                        </div>
                        <div class="content">
                            <span class="inning">{{ $child->novels['inning'] }}회</span> {{ $child->comment }}
                        </div>
                        <div class="button">

                            <button class="btn btn-xs btn-danger">신고</button>
                        </div>
                    </div>
                @endforeach
                <form id="comment_form{{$comment->id}}" action="{{ route('comments.store') }}" hidden>
                    <div class="review-of pad-all">
                        <input type="hidden" name="_token" id="token" value="{{ csrf_token() }}">
                        <input hidden name="parent_id" value="{{$comment->id}}">
                        <input hidden name="novel_id" value="{{$comment->novels['id']}}">
                        <input hidden name="comment_secret" value="0">
                        <textarea name="comment" hidden id="demo-textarea-input" rows="2" class="form-control inline"
                                  style="width:50%" placeholder="댓글"></textarea>
                        <button id="reply_post_btn{{$comment->id}}" class="btn btn-primary inline"
                                style="width:100px;height:48px; vertical-align:top;">등록
                        </button>
                    </div>
                </form>

                <div hidden id="error_bar{{$comment->id}}" class="alert alert-danger">
                    <ul>
                        <li>
                            <div id="error_message{{$comment->id}}"></div>
                        </li>
                    </ul>
                </div>




                <script type="text/javascript">



                    $("#reply_button{{$comment->id}}").click(function () {

                        $("#comment_form{{$comment->id}}").show();
                    });

                    $("#reply_post_btn{{$comment->id}}").click(function (e) {

                        e.preventDefault();
                        $.ajax({
                            url: '{{ route('comments.store') }}',
                            type: 'POST',
                            data: $('#comment_form{{$comment->id}}').serializeArray(),
                            headers: {'X-CSRF-TOKEN': window.Laravel.csrfToken},
                            success: function (data) {

                                if (data.error == 1) {
                                    /* $("#error_bar{{$comment->id}}").show();
                                     $("#error_message{{$comment->id}}").html(data.message);*/
                                    location.reload();
                                } else {

                                    app4_index.commentsDisplay_after_commenting("{{ $comment->novels['novel_group_id'] }}");
                                }

                            },
                            error: function (data) {

                                $("#error_bar{{$comment->id}}").show();
                                $("#error_message{{$comment->id}}").html(data.responseJSON.comment);
                            }
                        });

                    });

                    function destroyComment(comment_id) {
                        bootbox.confirm({
                            message: "삭제 하시겠습니까?",
                            buttons: {
                                confirm: {
                                    label: "삭제"
                                },
                                cancel: {
                                    label: '취소'
                                }
                            },
                            callback: function (result) {
                                if (result) {
                                    $.ajax({
                                        type: 'DELETE',
                                        url: '{{ url('comments') }}/' + comment_id,
                                        headers: {
                                            'X-CSRF-TOKEN': window.Laravel.csrfToken
                                        },
                                        success: function (response) {
                                            app4_index.commentsDisplay_after_commenting("{{ $comment->novels['novel_group_id'] }}");
                                        }, error: function (data2) {
                                        }
                                    });
                                }
                            }
                        })
                    }

                </script>

            @endforeach


        </div>
    </div>
    <script>

        $(function () {
            //about page
            if (parseInt("{{ $groups_comments->currentPage() }}") > 1) {
                app4_index.comment_page.page_first = true;
            } else {
                app4_index.comment_page.page_first = false;
            }

            if (parseInt("{{ $groups_comments->currentPage() }}") >= 2) {
                app4_index.comment_page.page_pre = true;

            }
            if (parseInt("{{ $groups_comments->lastPage() }}") - 1 >= parseInt("{{ $groups_comments->currentPage() }}")) {
                app4_index.comment_page.page_next = true;
            } else {
                app4_index.comment_page.page_next = false;
            }
            if (parseInt("{{ $groups_comments->lastPage() }}") != parseInt("{{ $groups_comments->currentPage() }}")) {
                app4_index.comment_page.page_last = true;
            } else {
                app4_index.comment_page.page_last = false;
            }
            //store current page value


            app4_index.comment_page.current_page = parseInt("{{ $groups_comments->currentPage() }}");
            app4_index.comment_page.from = parseInt("{{ $groups_comments->firstItem() }}");
            app4_index.comment_page.last_page = parseInt("{{ $groups_comments->lastPage() }}");

            console.log(app4_index.comment_page);
        });
    </script>
</div>
