<div class="pag_wrap">
    <div class="paging">
        @if($collection->currentPage() >= 2)
      <a href="{{url($url."page=".($collection->currentPage()-1))}}" class="pbtn prev">이전페이지</a>
        @endif

            @if($collection->currentPage() >= 5)

                    <a href="{{url($url."page=".($collection->currentPage()-4))}}" class="num">{{$collection->currentPage()-4}}</a>

            @endif
            @if($collection->currentPage() >= 4)

                    <a href="{{url($url."page=".($collection->currentPage()-3))}}" class="num">{{$collection->currentPage()-3}}</a>

            @endif
            @if($collection->currentPage() >= 3)

                    <a href="{{url($url."page=".($collection->currentPage()-2))}}" class="num">{{$collection->currentPage()-2}}</a>

            @endif
            @if($collection->currentPage() >= 2)

                    <a href="{{url($url."page=".($collection->currentPage()-1))}}" class="num">{{$collection->currentPage()-1}}</a>

            @endif

            <a href="#" class="num on">{{ $collection->currentPage()}}</a>


            @if($collection->lastPage()-1 >= $collection->currentPage())

                    <a href="{{url($url."page=".($collection->currentPage()+1))}}" class="num">{{$collection->currentPage()+1}}</a>

            @endif
            @if($collection->lastPage()-2 >= $collection->currentPage())

                    <a href="{{url($url."page=".($collection->currentPage()+2))}}" class="num">{{$collection->currentPage()+2}}</a>

            @endif
            @if($collection->lastPage()-3 >= $collection->currentPage())

                    <a href="{{url($url."page=".($collection->currentPage()+3))}}" class="num">{{$collection->currentPage()+3}}</a>

            @endif
            @if($collection->lastPage()-4 >= $collection->currentPage())

                <a href="{{url($url."page=".($collection->currentPage()+3))}}" class="num">{{$collection->currentPage()+4}}</a>

            @endif

            @if($collection->lastPage()-1 >= $collection->currentPage())
         <a href="{{url($url."page=".($collection->currentPage()+1))}}" class="pbtn next">다음페이지</a>
            @endif
    </div>
</div>