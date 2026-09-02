<ul>
    @foreach($children as $child)
        <li>
            <input type="checkbox" id="{{ $child->id }}" name="permissions[]" value="{{ $child->id }}" @if(in_array($child->id, old('permissions', []))) checked @endif>
            {{ $child->name }}
            @if($child->children->count() > 0)
                @include('admin.roles.partials.create_permission_children', ['children' => $child->children])
            @endif
        </li>
    @endforeach
</ul>
