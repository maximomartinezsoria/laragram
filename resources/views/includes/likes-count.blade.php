@if (count($image->likes) == 1)
    <p class="m-0 font-weight-bold">{{ count($image->likes) }} like</p>
@else
    <p class="m-0 font-weight-bold">{{ count($image->likes) }} likes</p>
@endif