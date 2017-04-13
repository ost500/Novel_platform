<div id="comment_list">
    <div id="novel_list">
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
                        <a href="{{ route('reader_reco.detail', ['id' => $comment->id]) }}"><span
                                    class="nick">  {{ $comment->title }}</span></a>
                    </div>
                    <div class="content">
                        <span class="">{{ $comment->users->nickname }}</span> | {{ $comment->created_at }}
                        {{--<button class="btn  btn-xs btn-danger"--}}
                        {{--onclick="javascript:app4_index.reviewDestroy( {{$comment->id .','.$comment->novel_groups->id}} )">--}}
                        {{--X--}}
                        {{--</button>--}}
                    </div>

                    <div class="button">

                        <button class="btn btn-xs btn-danger">신고</button>
                    </div>

                </div>

            @endforeach

        </div>
    </div>
    <script type="text/javascript">

        $(function () {

            //about page
            if (parseInt("{{ $groups_reviews->currentPage() }}") > 1) {
                app4_index.review_page.page_first = true;
            } else {
                app4_index.review_page.page_first = false;
            }

            if (parseInt("{{ $groups_reviews->currentPage() }}") >= 2) {
                app4_index.review_page.page_pre = true;

            }
            if (parseInt("{{ $groups_reviews->lastPage() }}") - 1 >= parseInt("{{ $groups_reviews->currentPage() }}")) {
                app4_index.review_page.page_next = true;
            } else {
                app4_index.review_page.page_next = false;
            }
            if (parseInt("{{ $groups_reviews->lastPage() }}") != parseInt("{{ $groups_reviews->currentPage() }}")) {
                app4_index.review_page.page_last = true;
            } else {
                app4_index.review_page.page_last = false;
            }
            //store current page value


            app4_index.review_page.current_page = parseInt("{{ $groups_reviews->currentPage() }}");
            app4_index.review_page.from = parseInt("{{ $groups_reviews->firstItem() }}");
            app4_index.review_page.last_page = parseInt("{{ $groups_reviews->lastPage() }}");

            console.log(app4_index.review_page);

        });
    </script>
</div>

