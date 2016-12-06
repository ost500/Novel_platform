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
        @foreach($novels_data as $novel)
            <div>

                <div class="review">

                    <div>
                        <span class="nick">{{ $novel->comments->comment }}</span>{{ $novel->comments->created_at }}
                        <button class="btn btn-xs btn-pink">N</button>
                    </div>
                    <div class="content">
                        <span class="inning">{{ $novel->title }}</span> {{ $novel->comments->comment }}
                    </div>
                    <div class="button">
                        <button class="btn btn-xs btn-mint">답변</button>
                        <button class="btn btn-xs btn-danger">신고</button>
                    </div>

                </div>

                <div class="review reply">
                    <div>
                        <span class="nick">{{-- children.users.name --}}</span> {{-- children.created_at--}}
                        <button class="btn btn-xs btn-pink">N</button>
                    </div>
                    <div class="content">
                        <span class="inning">{{-- children.novels.novel_group_id --}}회</span>{{-- children.comment --}}
                    </div>
                    <div class="button">
                        <button class="btn btn-xs btn-mint">답변</button>
                        <button class="btn btn-xs btn-danger">신고</button>
                    </div>
                </div>

            </div>
        @endforeach
    </div>
</div>

