@if($paginator->hasPages())
    <ul class="flex justify-between">
        @if($paginator->onFirstPage())
            <li class="w-16 px-2 py-1 text-center rounded border shadow bg-gray-200 text-gray-600">Prev</li>
        @else
            <li class="w-16 px-2 py-1 text-center rounded border bg-white cursor-pointer" wire:click="previousPage">
                Prev
            </li>
        @endif


        <div class="flex">
            @foreach ($elements as $element)
                @if (is_array($element))
                    @foreach ($element as $page => $url)
                        @if ($page == $paginator->currentPage())
                            <li class="w-16 mx-2 px-2 py-1 text-center rounded border shadow bg-blue-500 text-white"
                                aria-current="page"><span class="page-link">{{ $page }}</span></li>
                        @else
                            <li class="w-16 mx-2 px-2 py-1 text-center rounded border shadow bg-white cursor-pointer">
                                <button type="button" class="page-link"
                                        wire:click="gotoPage({{ $page }})">{{ $page }}</button>
                            </li>
                        @endif
                    @endforeach
                @endif
            @endforeach
        </div>


        @if($paginator->hasMorePages())
            <li class="w-16 px-2 py-1 text-center rounded border shadow bg-white cursor-pointer" wire:click="nextPage">
                Next
            </li>
        @else
            <li class="w-16 px-2 py-1 text-center rounded border bg-gray-200 text-gray-600">Next</li>
        @endif
    </ul>
@endif
