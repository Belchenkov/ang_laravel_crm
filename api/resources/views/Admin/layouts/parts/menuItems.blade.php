@foreach($items as $item)
    <li class="nav-item">
        <a href="{{ $item->url() }}" class="nav-link">
            <p>
                {{ $item->title }}
            </p>
            @if($item->hasChildren())
               <i class="fas fa-angle-left right"></i>
            @endif
        </a>
        @if($item->hasChildren())
            <ul class="nav nav-treeview" style="margin-left: 10px">
                @include('Admin::layouts.parts.menuItems', ['items' => $item->children()])
            </ul>
        @endif
    </li>
@endforeach
