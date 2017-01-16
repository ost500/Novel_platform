<table class="table table-bordered" id="novel_group">
    <tbody>
    @foreach($novels as $novel)
        {{--  @if(!checkPublishNovel($novel->id,$publish_novel_group_id,$company_id))--}}
        <tr>
            <td class="text-center col-md-1">{{ $novel->inning }}회</td>
            <td class="col-md-6"><a href="#">{{ $novel->title }} </a>
                @if($novel->adult != 0)
                    <button class="btn btn-xs btn-danger btn-circle">
                        19금
                    </button>
                @endif

               {{-- <span class="glyphicon glyphicon-download-alt" ></span>--}}
            </td>
            <td class="col-md-2 text-center" >@if(count($novel->publish_novels) >0 )
                    {{$novel->publish_novels->updated_at}}
                @else

                    <span class="text-danger">   {{ $publish_array[$novel->id] }} </span>

                    {{--   @php echo Carbon\Carbon::today(); @endphp--}}
                @endif
            </td>
            <td class="col-md-1 text-center" >  @if(count($novel->publish_novels) >0 )
                    {{$novel->publish_novels->status}}
                @endif
            </td>
            <td class="col-md-1 text-center">
                @if(count($novel->publish_novels) == 0 && $publish_array[$novel->id] != '')
                    <button class="btn btn-info"
                            onclick="app.storePublishNovel({{$novel->id.','.$publish_novel_group_id.','.$company_id.','.$publish_company_id.','.$novel->novel_group_id}})">
                        회차 심사
                    </button>
               @elseif(count($novel->publish_novels) != 0 &&  $novel->publish_novels->status == '재심사' )
                    <button class="btn btn-mint"
                            onclick="app.updatePublishNovel({{$novel->publish_novels->id.','.$publish_novel_group_id.','.$company_id.','.$publish_company_id.','.$novel->novel_group_id}})">
                        Republish
                    </button>
                @elseif(count($novel->publish_novels) != 0 && $novel->publish_novels->status != '거절' && $novel->publish_novels->status != '승인')
                    <button class="btn btn-danger"
                            onclick="app.removePublishNovel({{$novel->publish_novels->id.','.$publish_novel_group_id.','.$company_id.','.$publish_company_id.','.$novel->novel_group_id}})">
                        Cancel
                    </button>
                @endif
            </td>

        </tr>
        {{-- @endif--}}
    @endforeach


    </tbody>
</table>