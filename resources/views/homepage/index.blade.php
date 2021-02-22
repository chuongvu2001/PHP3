@php
$product_arr = $products->toArray();
$random_keys = array_rand($product_arr, 4);
@endphp

<ul>
    @foreach ($random_keys as $randomIndex)
        <li>{{$products[$randomIndex]->name}}</li>
    @endforeach
</ul>