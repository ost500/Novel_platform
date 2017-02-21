<table class="table table-bordered" id="novel_group">
    <tbody>
    @foreach($novels as $novel)
        {{--  @if(!checkPublishNovel($novel->id,$publish_novel_group_id,$company_id))--}}
        <tr>
            <td class="text-center col-md-1">{{ $novel->inning }}회</td>
            <td class="col-md-8"><a href="#">{{ $novel->title }}</a>
                @if($novel->adult != 0)
                    <button class="btn btn-xs btn-danger btn-circle">
                        19금
                    </button>
                @endif
                <span style="margin-left:1%;cursor: pointer;"  class="glyphicon glyphicon-download-alt" onclick="app.downloadNovel_ePub({{$novel->id}})" ></span>
            </td>
            {{--            <td>@if(count($novel->publish_novels) >0 )
                                {{$novel->publish_novels->updated_at}}
                            @else

                                <span class="text-danger">   {{ $publish_array[$novel->id] }} </span>

                                --}}{{--   @php echo Carbon\Carbon::today(); @endphp--}}{{--
                            @endif
                        </td>--}}
            <td>  @if(count($novel->publish_novels) >0 )
                    {{$novel->publish_novels->status}}
                @endif
            </td>
            <td class="text-center">
                @if(count($novel->publish_novels) >0 )
                    @if($novel->publish_novels->status == '거절' )
                        <button class="btn btn-info"
                                onclick="app.updatePublishNovel({{$novel->publish_novels->id.','.$publish_novel_group_id.','.$company_id.','.$publish_company_id.','.$novel->novel_group_id}})">
                            재심사 신청
                        </button>
                    @endif
                @endif
            </td>

        </tr>
        {{-- @endif--}}
    @endforeach


    </tbody>
</table>