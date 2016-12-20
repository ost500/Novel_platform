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

                    <button class="btn  btn-xs btn-danger" id="comment_destroy{{$comment[0]->id}}">X</button>

                </div>
                <div class="content">
                    <span class="inning">{{ $comment[0]->novels->inning }} 회</span> {{ $comment[0]->comment }}
                </div>
                <div class="button">
                    <button id="reply_button{{$comment[0]->id}}" class="btn btn-xs btn-mint">답변</button>
                    <button class="btn btn-xs btn-danger">신고</button>
                </div>


            </div>
            @foreach($comment['children'] as $child)
                <div class="review reply">
                    <div>
                        <span class="nick">{{ $child->users->name }}</span> {{ $child->created_at }}
                        <button class="btn btn-xs btn-pink">N</button>
                    </div>
                    <div class="content">
                        <span class="inning">{{ $child->novels->inning }}회</span> {{ $child->comment }}
                    </div>
                    <div class="button">

                        <button class="btn btn-xs btn-danger">신고</button>
                    </div>
                </div>
            @endforeach
            <form id="comment_form{{$comment[0]->id}}" action="{{ route('comments.store') }}" hidden>
                <div class="review-of pad-all">
                    <input type="hidden" name="_token" id="token" value="{{ csrf_token() }}">
                    <input hidden name="parent_id" value="{{$comment[0]->id}}">
                    <input hidden name="novel_id" value="{{$comment[0]->novels->id}}">
                        <textarea name="comment" hidden id="demo-textarea-input" rows="2" class="form-control inline"
                                  style="width:50%" placeholder="댓글"></textarea>
                    <button id="reply_post_btn{{$comment[0]->id}}" class="btn btn-primary inline"
                            style="width:100px;height:48px; vertical-align:top;">등록
                    </button>
                </div>
            </form>

            <div hidden id="error_bar{{$comment[0]->id}}" class="alert alert-danger">
                <ul>
                    <li>
                        <div id="error_message{{$comment[0]->id}}"></div>
                    </li>
                </ul>
            </div>


            <script type="text/javascript">

                $("#reply_button{{$comment[0]->id}}").click(function () {

                    $("#comment_form{{$comment[0]->id}}").show();
                });

                $("#reply_post_btn{{$comment[0]->id}}").click(function (e) {
                    console.log($('#comment_form{{$comment[0]->id}}').serializeArray());
                    e.preventDefault();
                    $.ajax({
                        url: '{{ route('comments.store') }}',
                        type: 'POST',
                        data: $('#comment_form{{$comment[0]->id}}').serializeArray(),
                        headers: {'X-CSRF-TOKEN': window.Laravel.csrfToken},
                        success: function (e) {


                            app4_index.commentsDisplay_after_commenting("{{ $comment[0]->novels->novel_group_id }}");

                        },
                        error: function (data) {

                            $("#error_bar{{$comment[0]->id}}").show();
                            $("#error_message{{$comment[0]->id}}").html(data.responseJSON.comment);
                        }
                    });

                });
                $("#comment_destroy{{$comment[0]->id}}").click(function () {

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
                                    url: '{{ route('comments.destroy',['id'=>$comment[0]->id]) }}',
                                    headers: {
                                        'X-CSRF-TOKEN': window.Laravel.csrfToken
                                    },
                                    success: function (response) {

                                        commonAlertBox("comment_delete");
                                        app4_index.commentsDisplay_after_commenting("{{ $comment[0]->novels->novel_group_id }}");

                                    }, error: function (data2) {
                                        console.log(data2);
                                    }
                                });
                            }
                        }
                    })

                });

            </script>

        @endforeach


    </div>
</div>
