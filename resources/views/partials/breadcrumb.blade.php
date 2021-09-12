<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        @foreach ($breadcrumb as $item)
            @if ($item['current'] == 'Y')
                <li class="breadcrumb-item active">{{$item['title']}}</li>
            @else
                <li class="breadcrumb-item"><a href="{{$item['url']}}">{{$item['title']}}</a></li>
            @endif
        @endforeach
    </ol>
  </nav>