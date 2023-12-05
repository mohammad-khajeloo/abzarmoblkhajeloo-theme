@if($lastPage != 1)
    <nav aria-label="Page navigation">
        <ul class="pagination">
            <?php
            $url = "/" . Request::path() . "?";
            $url .= 'page';
            ?>
            @if($currentPage > 2)
                <li class="page-item">
                    <a class="page-link numerical-data" href="{{$url}}=1">1</a>
                </li>
                @if($currentPage >= 4)
                    <li class="page-item">
                        <a>...</a>
                    </li>
                @endif
            @endif
            @for($i= max([$currentPage-1, 1]); $i <= min([$currentPage+1, $lastPage]); $i++)
                @if($i == $currentPage)
                    <li class="page-item current">
                        <a class="page-link numerical-data" href="#">{{$i}}</a>
                    </li>
                @else
                    <li class="page-item">
                        <a class="page-link numerical-data" href="{{$url}}={{$i}}">{{$i}}</a>
                    </li>
                @endif
            @endfor
            @if($currentPage < $lastPage-1)
                @if($currentPage <= $lastPage-3)
                    <li class="page-item">
                        <a>...</a>
                    </li>
                @endif
                <li class="page-item">
                    <a class="page-link numerical-data" href="{{$url}}={{$lastPage}}">{{$lastPage}}</a>
                </li>
            @endif
        </ul>
    </nav>
@endif