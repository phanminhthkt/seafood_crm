@if ($paginator->hasPages())
<div class="row">
  <div class="col-sm-12 col-md-7">
     <div class="dataTables_paginate paging_simple_numbers text-center" id="basic-datatable_paginate">
        <ul class="pagination pagination-rounded">
            @if ($paginator->onFirstPage())
            <li class="paginate_button page-item previous disabled">
                <a href="#" class="page-link"><i class="mdi mdi-chevron-left"></i></a>
            </li>
            @else
            <li class="paginate_button page-item previous">
                <a href="{{$paginator->previousPageUrl()}}" class="page-link"><i class="mdi mdi-chevron-left"></i></a>
            </li>           
            @endif

            @foreach ($elements as $element)
                @if (is_string($element))
                    <li class="page-item disabled"><span class="page-link">{{ $element }}</span></li>
                @endif

                {{-- Array Of Links --}}
                @if (is_array($element))
                    @foreach ($element as $page => $url)
                        @if ($page == $paginator->currentPage())
                            <li class="paginate_button page-item active"><span class="page-link">{{ $page }}</span></li>
                        @else
                            <li class="paginate_button page-item"><a class="page-link" href="{{ $url }}">{{ $page }}</a></li>
                        @endif
                    @endforeach
                @endif
            @endforeach

            
                           
            {{-- Next Page Link --}}
            @if ($paginator->hasMorePages())
                <li class="paginate_button page-item"><a class="page-link" href="{{ $paginator->nextPageUrl() }}" rel="next"><i class="mdi mdi-chevron-right"></i></a></li>
            @else
                <li class="page-item disabled"><span class="page-link"><i class="mdi mdi-chevron-right"></i></span></li>
            @endif
        </ul>
     </div>
  </div>
</div>
@endif