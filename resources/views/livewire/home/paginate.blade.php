@if($paginator->hasPages())
<div class="row">
    <div class="col-12 mt-2 mt-md-4">
        <ul class="pagination pagination_style1 justify-content-center">
            @if($paginator->onFirstPage())
            <li class="page-item disabled"><a class="page-link" tabindex="-1"><i class="linearicons-arrow-left"></i></a></li>
            @else
            <li class="page-item"><a class="page-link" href="{{ $paginator->previousPageUrl() }}"><i class="linearicons-arrow-left"></i></a></li>
            @endif
            @foreach ($elements as $element)
            @if(is_array($element))
            @foreach ($element as $page => $url)

            @if($page == $paginator->currentPage())
            <li class="page-item active"><a class="page-link" href="{{ $url }}">{{ $page }}</a></li>
            @else
            <li class="page-item"><a class="page-link" href="{{ $url }}">{{ $page }}</a></li>
            @endif

            @endforeach
            @endif
            @endforeach
            @if($paginator->hasMorePages())
            <li class="page-item"><a class="page-link" href="{{ $paginator->nextPageUrl() }}"><i class="linearicons-arrow-right"></i></a></li>
            @else
            <li class="page-item disabled"><a class="page-link" tabindex="-1"><i class="linearicons-arrow-right"></i></a></li>
            @endif
        </ul>
    </div>
</div>
@endif


