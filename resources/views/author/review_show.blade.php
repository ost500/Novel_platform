<div id="comment_list">
    <div class="padding-top-10">
        <h4>리뷰 {{ $groups_reviews->count() }}</h4></div>


    <div class="novel-review">
        {{--<div class="review-write pad-all">--}}
        {{--<textarea id="demo-textarea-input" rows="4" class="form-control inline"--}}
        {{--style="width:50%" placeholder="댓글"></textarea>--}}
        {{--<button class="btn btn-primary inline"--}}
        {{--style="width:100px;height:83px; vertical-align:top;">등록--}}
        {{--</button>--}}

        {{--</div>--}}


        @foreach($groups_reviews as $comment)


            <div class="review">

                <div>
                    <span class="nick">{{ $comment->users->name }}</span> {{ $comment->created_at }}
                    <button class="btn btn-xs btn-pink">N</button>
                    <button class="btn  btn-xs btn-danger"
                            onclick="javascript:app4_index.reviewDestroy( {{$comment->id .','.$comment->novels->novel_group_id}} )">
                        X
                    </button>
                </div>
                <div class="content">
                    <span class="inning">{{ $comment->novels->inning }} 회</span> {{ $comment->review }}
                </div>
                <div class="button">

                    <button class="btn btn-xs btn-danger">신고</button>
                </div>

            </div>

        @endforeach

    </div>
</div>

