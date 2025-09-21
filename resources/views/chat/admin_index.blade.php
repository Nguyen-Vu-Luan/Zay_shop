<h2>Danh sách User</h2>
<ul>
    @foreach($users as $u)
        <li><a href="{{ route('admin.chat.user', $u->id) }}">{{ $u->name }}</a></li>
    @endforeach
</ul>
