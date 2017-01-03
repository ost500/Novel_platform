<table class="table table-bordered" id="novel_group">
    <tbody>
    @foreach($novels as $novel)
        @if(!checkPublishNovel($novel->id,$publish_novel_group_id,$company_id))
        <tr>
            <td class="text-center col-md-1">{{ $novel->inning }}회</td>
            <td class="col-md-8"><a href="#">{{ $novel->title }}</a>
                @if($novel->adult != 0)
                <button class="btn btn-xs btn-danger btn-circle" >
                    19금
                </button>
                @endif
            </td>
            <td class="text-center">
                <button class="btn btn-info" onclick="app.storePublishNovel({{$novel->id.','.$publish_novel_group_id.','.$company_id.','.$publish_company_id}})">공개</button>
                {{--<a href="/author/update_inning/"@{{ novel.id }}>--}}
                <a>
                    <button class="btn btn-success">수정</button>
                </a>
                <button class="btn btn-warning">삭제</button>
            </td>
        </tr>
        @endif
    @endforeach


    </tbody>
</table>