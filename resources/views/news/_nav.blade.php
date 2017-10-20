@if ($currentPage > 0)
    <a href="{{route('news.index', ['page' => $currentPage - 1])}}" class="btn btn-primary">Previous</a>
@else
    <a href="#" disabled class="btn btn-primary">Previous</a>
@endif
    <a href="{{route('news.index', ['page' => $currentPage + 1])}}" class="btn btn-primary">Next</a>
