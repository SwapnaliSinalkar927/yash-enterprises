<ul>
    @foreach($children as $child)
        <li>
            <input type="checkbox" id="{{ $child->id }}" name="permissions[]" value="{{ $child->id }}" @if(in_array($child->id, old('permissions', $permission_ids))) checked @endif>
            {{ $child->name }}
            @if($child->children->count() > 0)
                @include('admin.roles.partials.edit_permission_children', ['children' => $child->children, 'permission_ids'   => $permission_ids])
            @endif
        </li>
    @endforeach
</ul>
