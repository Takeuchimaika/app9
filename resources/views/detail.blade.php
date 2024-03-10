@extends('app')

@section('content')
    <div class="row">
         <div class="col-lg-12">
            <div class="pull-left">
                <h2 style="font-size:lrem;">商品詳細画面</h2>
            </div>
            <div class="pull-right">
                <a class="btn btn-success" href="{{ url('/products')}}">戻る</a>
            </div>
         </div>
    </div>

    <div style="text-align:left;">
            
        <div class="col-12 md-2 mt-2">
            <div class="boxContainer">
            <label for="inputEmail3" class="col-sm-2 col-form-label">ID</label>
                <div class="col-sm-10">
                    {{ $product->id }}
                </div>  
            </div>
            <div class="col-12 md-2 mt-2">
            <label class="col-sm-2 col-from-label">商品画像</label>
            
                <div class="from-group">
                <td>
                <img src="{{asset('storage/' . $product->img_path)}}" style="text-align:left"  class="img-fluid">
            </td>
                </div>
            </div>
            <div class="col-12 md-2 mt-2">
            <tr>商品名</tr>
                <div class="from-group">
                    {{ $product->product_name }}
                </div>
            </div>
            <div class="col-12 md-2 mt-2">
            <tr>メーカー</tr>
                <div class="from-group">
                    @foreach ($companies as $company)
                        @if($company->id==$product->company_id) {{ $company->company_name }} @endif
                    @endforeach
                </div>
            </div>
            <div class="col-12 md-2 mt-2">
            <tr>価格</tr>
                <div class="from-group">
                    ￥{{ $product->price }}
                </div>
            </div>
            <div class="col-12 md-2 mt-2">
            <tr>在庫数</tr>
                <div class="from-group">
                    {{ $product->stock }}
                </div>
            </div>
            
            <div class="col-12 md-2 mt-2">
            <tr>コメント</tr>
                <div class="from-group">
                    {{ $product->comment }}
                </div>
            </div>
            <td style="text-align::center">
                <a class="btn btn-primary" href="{{ route('product.edit',$product->id) }}">編集</a>
            </td>
        </tr>
        </div>       
    </div>

@endsection