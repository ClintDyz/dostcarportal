@if ($paginator->hasPages())
<div class="d-flex flex-row">
    <div class="p-2">
        <label class="black-text" style="font-size: 0.9em;">
            Showing {{($paginator->currentpage()-1)*$paginator->perpage()+1}} to 
            {{$paginator->currentpage() * $paginator->perpage()}} of {{$paginator->total()}} entries
        </label>
    </div>
</div>

<div class="d-flex flex-row-reverse" style="overflow: auto;">
    <div class="p-2">
        <div class="black-text">
            <ul class="pagination">

                {{-- Previous Page Link --}}
                @if ($paginator->currentPage() == 1)
                    <li class="paginate_button page-item previous disabled" id="dtBasicExample_previous">
                        <a aria-controls="dtBasicExample" 
                           data-dt-idx="0" tabindex="0" class="page-link">
                            Previous
                        </a>
                    </li>
                @else
                    <li class="paginate_button page-item previous" id="dtBasicExample_previous">
                        <a onclick="$(this).generateNextPrev('{{ $paginator->previousPageUrl() }}', 
                                                             '{{ $contentID }}');"
                           aria-controls="dtBasicExample" data-dt-idx="0" tabindex="0" class="page-link">
                            Previous
                        </a>
                    </li>
                @endif

                

                {{-- Next Page Link --}}
                @if ($paginator->hasMorePages())
                    <li class="paginate_button page-item next" id="dtBasicExample_next">
                        <a onclick="$(this).generateNextPrev('{{ $paginator->nextPageUrl() }}', 
                                                             '{{ $contentID }}');"
                           aria-controls="dtBasicExample" data-dt-idx="7" tabindex="0" 
                           class="page-link">Next</a>
                    </li>
                @else
                    <li class="paginate_button page-item next disabled" id="dtBasicExample_next">
                        <a onclick="$(this).generateNextPrev('{{ $paginator->nextPageUrl() }}', 
                                                             '{{ $contentID }}');" 
                           aria-controls="dtBasicExample" data-dt-idx="7" tabindex="0" 
                           class="page-link">Next</a>
                    </li>
                @endif

            </ul>
        </div>
    </div>
</div>    
@endif