<ul class="pagination">

    {{-- $collection->render() --}}
    <li class="page-first  @if($collection->currentPage() ==1)  disabled @endif">
        <a href=" @if($collection->currentPage() ==1)  #  @else {{url($url."?page=1")}} @endif">
            &lt;&lt;</a>
    </li>
    @if($collection->currentPage() >= 2)
        <li class="page-pre"><a
                    href="{{url($url."?page=".($collection->currentPage()-1))}}">
                &lt;</a></li>
    @endif
    @if($collection->currentPage() >= 5)
        <li class="page-pre"><a
                    href="{{url($url."?page=".($collection->currentPage()-4))}}">{{$collection->currentPage()-4}}</a>
        </li>
    @endif
    @if($collection->currentPage() >= 4)
        <li class="page-pre"><a
                    href="{{url($url."?page=".($collection->currentPage()-3))}}">{{$collection->currentPage()-3}}</a>
        </li>
    @endif
    @if($collection->currentPage() >= 3)
        <li class="page-pre"><a
                    href="{{url($url."?page=".($collection->currentPage()-2))}}">{{$collection->currentPage()-2}}</a>
        </li>
    @endif
    @if($collection->currentPage() >= 2)
        <li class="page-pre"><a
                    href="{{url($url."?page=".($collection->currentPage()-1))}}">{{$collection->currentPage()-1}}</a>
        </li>
    @endif

    <li class="page-number active"><a href="#">{{ $collection->currentPage()}}</a>
    </li>

    @if($collection->lastPage()-1 >= $collection->currentPage())
        <li class="page-number"><a
                    href="{{url($url."?page=".($collection->currentPage()+1))}}">{{$collection->currentPage()+1}}</a>
        </li>
    @endif
    @if($collection->lastPage()-2 >= $collection->currentPage())
        <li class="page-number"><a
                    href="{{url($url."?page=".($collection->currentPage()+2))}}">{{$collection->currentPage()+2}}</a>
        </li>
    @endif
    @if($collection->lastPage()-3 >= $collection->currentPage())
        <li class="page-number"><a
                    href="{{url($url."?page=".($collection->currentPage()+3))}}">{{$collection->currentPage()+3}}</a>
        </li>
    @endif
    @if($collection->lastPage()-4 >= $collection->currentPage())
        <li class="page-number"><a
                    href="{{url($url."?page=".($collection->currentPage()+3))}}">{{$collection->currentPage()+4}}</a>
        </li>
    @endif

    @if($collection->lastPage()-1 >= $collection->currentPage())
        <li class="page-next"><a
                    href="{{url($url."?page=".($collection->currentPage()+1))}}">
                &gt;</a></li>
    @endif

    <li class="page-last  @if($collection->currentPage() == $collection->lastPage())  disabled @endif">
        <a href=" @if($collection->currentPage() ==$collection->lastPage())  #  @else{{url($url."?page=".($collection->lastPage()))}} @endif">
            &gt;&gt;</a>
    </li>
</ul>




