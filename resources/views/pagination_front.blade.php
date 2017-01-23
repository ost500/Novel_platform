<div class="page-nav">
    <nav>
        <ul>
            {{-- $collection->render() --}}
            @if($collection->currentPage() >= 2)
                <li class="prev-page">
                    <a href="{{url($url."page=".($collection->currentPage()-1))}}">
                        &lt;</a>
                </li>
            @endif
            @if($collection->currentPage() >= 5)
                <li>
                    <a href="{{url($url."page=".($collection->currentPage()-4))}}">{{$collection->currentPage()-4}}</a>
                </li>
            @endif
            @if($collection->currentPage() >= 4)
                <li>
                    <a href="{{url($url."page=".($collection->currentPage()-3))}}">{{$collection->currentPage()-3}}</a>
                </li>
            @endif
            @if($collection->currentPage() >= 3)
                <li>
                    <a href="{{url($url."page=".($collection->currentPage()-2))}}">{{$collection->currentPage()-2}}</a>
                </li>
            @endif
            @if($collection->currentPage() >= 2)
                <li>
                    <a href="{{url($url."page=".($collection->currentPage()-1))}}">{{$collection->currentPage()-1}}</a>
                </li>
            @endif

            <li><a class="current-page" href="#">{{ $collection->currentPage()}}</a>
            </li>

            @if($collection->lastPage()-1 >= $collection->currentPage())
                <li>
                    <a href="{{url($url."page=".($collection->currentPage()+1))}}">{{$collection->currentPage()+1}}</a>
                </li>
            @endif
            @if($collection->lastPage()-2 >= $collection->currentPage())
                <li>
                    <a href="{{url($url."page=".($collection->currentPage()+2))}}">{{$collection->currentPage()+2}}</a>
                </li>
            @endif
            @if($collection->lastPage()-3 >= $collection->currentPage())
                <li>
                    <a href="{{url($url."page=".($collection->currentPage()+3))}}">{{$collection->currentPage()+3}}</a>
                </li>
            @endif
            @if($collection->lastPage()-4 >= $collection->currentPage())
                <li>
                    <a href="{{url($url."page=".($collection->currentPage()+3))}}">{{$collection->currentPage()+4}}</a>
                </li>
            @endif

            @if($collection->lastPage()-1 >= $collection->currentPage())
                <li class="next-page">
                    <a href="{{url($url."page=".($collection->currentPage()+1))}}">
                        &gt;</a>
                </li>
            @endif


        </ul>
    </nav>
</div>



