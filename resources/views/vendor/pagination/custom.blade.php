@if ($paginator->hasPages())
    <ul class="pagination" style="margin-left: 50%;">
        @if ($paginator->onFirstPage())
            <li class="prev disabled" style=" border:1px solid black;padding: 10px;"><a href="javascript:void(0);"> <i style="color:#0056b3" class="fas fa-backward"></i> </a></li>
        @else
            <li class="prev" style=" border:1px solid black;padding: 10px;"><a href="{{ $paginator->previousPageUrl() }}"><i style="color:#0056b3" class="fas fa-backward"></i></a></li>
        @endif
        
        @foreach ($elements as $element)
           
            @if (is_string($element))
                <li class="disabled" style=" border:1px solid black;padding: 10px;"><span><a href="javascript:void(0);">{{ $element }}</a></span></li>
            @endif


           
            @if (is_array($element))
                @foreach ($element as $page => $url)
                    @if ($page == $paginator->currentPage())
                        <li class="active my-active" style=" border:1px solid black;padding: 10px;"><span><a href="javascript:void(0);">{{ $page }}</a></span></li>
                    @else
                        <li style="border:1px solid black;padding: 10px;"><a href="{{ $url }}">{{ $page }}</a></li>
                    @endif
                @endforeach
            @endif
        @endforeach
<!-- 9799832163  (preeti) -->
        @if ($paginator->hasMorePages())
            <li class="next" style=" border:1px solid black;padding: 10px;"><a href="{{ $paginator->nextPageUrl() }}" rel="next"><i style="color:#0056b3" class="fas fa-forward"></i></a></li>
        @else
            <li class="disabled" style=" border:1px solid black;padding: 10px;"><span><a href="javascript:void(0);"><i style="color:#0056b3" class="fas fa-forward"></i> </a></span></li>
        @endif

         
    </ul>
@endif