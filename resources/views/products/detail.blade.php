@extends('layouts.main')
@section('page-title', 'Danh sách sản phẩm')
    
@section('content')

<p>{{$product->name}}</p>
<img src="{{asset($product->image)}}" width="150">
<p id="viewNumber">{{$totalViews}}</p>

@endsection
@section('page-script')
<script>
    let increaseViewUrl = "{{route('product.tangView')}}";
    const data = {
        id: {{$product->id}},
        _token: "{{csrf_token()}}"
    };

    setTimeout(() => {
        fetch(increaseViewUrl, {
            method: "POST",
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify(data)
        })
        .then(responseData => responseData.json())
        .then(productObj => {
            console.log(productObj);
        })
    }, 2000);
</script>
    
@endsection