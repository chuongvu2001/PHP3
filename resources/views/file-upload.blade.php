<form action="{{route('up.load')}}" method="POST" enctype="multipart/form-data">
    @csrf
    <input type="file" name="image">
    <button type="submit">upload</button>
</form>