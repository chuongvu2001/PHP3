<form action="{{route('login')}}" method="post">
    @csrf
    <div>
        <label for="">Email</label>
        <input type="text"
            @isset($email)
                value="{{$email}}"
            @endisset
            name="email">
    </div>
    <div>
        <label for="">Password</label>
        <input type="password" name="password">
    </div>
    @isset($msg)
    <div>
        <span style="color: red">{{$msg}}</span>
    </div>
    @endisset
    <div>
        <button type="submit">Login</button>
    </div>
</form>