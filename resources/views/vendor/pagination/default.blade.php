@if ($paginator->total())
    <div class="pagination-wrapper">
        <div class="pagination-description">
            @php
                $from = ($paginator->perPage() * $paginator->currentPage()) - ($paginator->perPage() - 1);

                if (($paginator->perPage() * $paginator->currentPage()) > $paginator->total()) {
                    $to = $paginator->total();
                } else {
                    $to = $paginator->perPage() * $paginator->currentPage();
                }

                if ($paginator->total() > $paginator->perPage()) {
                    echo 'Exibindo do <strong>' . $from . '</strong> ao <strong>' . $to . '</strong> de <strong>' . $paginator->total() . '</strong> registros encontrados';
                } else {
                    echo $paginator->total() . ($paginator->total() > 1 ? ' registros encontrados' : ' registro encontrado');
                }
            @endphp
        </div>

        @if ($paginator->hasPages())
            <ul class="pagination pagination-sm">
                {{-- Previous Page Link --}}
                @if ($paginator->onFirstPage())
                    <li class="disabled"><span>Primeira</span></li>
                    <li class="disabled"><span>Anterior</span></li>
                @else
                    <li><a href="{{ $paginator->url(1) }}" rel="last">Primeira</a></li>
                    <li><a href="{{ $paginator->previousPageUrl() }}" rel="prev">Anterior</a></li>
                @endif

                {{-- Pagination Elements --}}
                @foreach ($elements as $element)
                    {{-- "Three Dots" Separator --}}
                    @if (is_string($element))
                        <li class="disabled hidden-xs"><span>{{ $element }}</span></li>
                    @endif

                    {{-- Array Of Links --}}
                    @if (is_array($element))
                        @foreach ($element as $page => $url)
                            @if ($page == $paginator->currentPage())
                                <li class="active hidden-xs"><span>{{ $page }}</span></li>
                            @else
                                <li class="hidden-xs"><a href="{{ $url }}">{{ $page }}</a></li>
                            @endif
                        @endforeach
                    @endif
                @endforeach

                {{-- Next Page Link --}}
                @if ($paginator->hasMorePages())
                    <li><a href="{{ $paginator->nextPageUrl() }}" rel="next">Próxima</a></li>
                    <li><a href="{{ $paginator->url($paginator->lastPage()) }}" rel="last">Última</a></li>
                @else
                    <li class="disabled"><span>Próxima</span></li>
                    <li class="disabled"><span>Última</span></li>
                @endif
            </ul>
        @endif
    </div>
@endif
