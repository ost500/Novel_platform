<div id="comment_list">
    <div class="padding-top-10">
        <h4>��� 3</h4></div>


    <div class="novel-review">
        <div class="review-write pad-all">
                                        <textarea id="demo-textarea-input" rows="4" class="form-control inline"
                                                  style="width:50%" placeholder="���"></textarea>
            <button class="btn btn-primary inline"
                    style="width:100px;height:83px; vertical-align:top;">���
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
                        <button class="btn btn-xs btn-mint">�亯</button>
                        <button class="btn btn-xs btn-danger">�Ű�</button>
                    </div>

                </div>

                <div class="review reply">
                    <div>
                        <span class="nick">{{-- children.users.name --}}</span> {{-- children.created_at--}}
                        <button class="btn btn-xs btn-pink">N</button>
                    </div>
                    <div class="content">
                        <span class="inning">{{-- children.novels.novel_group_id --}}ȸ</span>{{-- children.comment --}}
                    </div>
                    <div class="button">
                        <button class="btn btn-xs btn-mint">�亯</button>
                        <button class="btn btn-xs btn-danger">�Ű�</button>
                    </div>
                </div>

            </div>
        @endforeach
    </div>
</div>

