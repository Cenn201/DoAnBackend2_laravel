@extends('dashboard')
@section('content')
<section style="background-color: #eee;">
    <div class="container py-5">
        <div class="row">
            @if(!empty($datas) && $datas->count())

            @foreach($datas as $data)
            <div class="col-md-3 col-lg-3 col-12 py-5 frames">
                <div class='col-product'>
                    <a href="{{ route('showProductDetail',['id'=> $data->id]) }}" class="product__item">
                        <img src="{{ asset ('/uploads/'.$data->hinhanh) }}" class="auto-size-img-product" />
                        <div class="product__name">{{ $data->tensp }}</div>
                        <div class="product__price">{{ number_format($data->gia) }}VND</div>
                </div>
                </a>
            </div>
            @endforeach
            @else
            <tr>
                <td colspan="10">There are no data.</td>
            </tr>
            @endif
        </div>
    </div>
    </div>
</section>
{!! $datas->links() !!}
@endsection