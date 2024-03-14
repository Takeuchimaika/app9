@extends('app')

@section('content')

<main>
  <div class="container">
    <div class="mx-auto">
      <br>
      <h2 class="text-center">商品一覧画面</h2>
      <br>
      <div class="text-right">
      <a class="btn btn-success text-right mb-2 mt-2" href="{{ route('product.rebist')}}">新規登録</a>
        </div>
      <!--検索フォーム-->
      <div class="search">
        <div class="col-sm">
          <form method="GET" action="{{ route('index')}}">
          
            <div class="form-group row">
              <label class="col-sm-2 col-form-label">検索キーワード</label>
              <!--入力-->
              <div class="col-sm-5">
                <input type="text" class="form-control" name="searchWord" value="{{ $searchWord }}">
              </div>
              <div class="col-sm-auto">
                <button type="submit" class="btn btn-primary ">検索</button>
              </div>
            </div>     
            <!--プルダウンカテゴリ選択-->
            <div class="form-group row">
              <label class="col-sm-2">メーカー名</label>
              <div class="col-sm-3">
                <select name="companyId" class="form-control" value="{{ $companyId }}">
                  <option value="">メーカー名</option>

                  @foreach($companies as $id => $company_name)
                  <option value="{{ $id }}">
                    {{ $company_name }}
                  </option>  
                  @endforeach
                </select>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>

      <!--検索結果テーブル 検索された時のみ表示する-->
      @if (!empty($products))
    <div class= "productTable">
      
      <table class="table table-hover">
        <thead style="background-color: #ffd900">
          <tr>

            <th>ID</th>
            <th>商品画像</th>
            <th style="width:50%">商品名</th>
            <th>価格</th>
            <th>在庫数</th>
            <th>メーカー名</th>
            <th></th>
            <th></th>

          </tr>
        </thead>
        @foreach($products as $product)
        <tr>
          <td style="text-align:right">{{ $product->id }}</td>
            <td>
                <img src="{{asset('storage/' . $product->img_path)}}" style="text-align:left"  class="img-fluid">
            </td>
            <td style="text-align:left">{{ $product->product_name  }}</a></td>
            <td style="text-align:right">¥{{ $product->price }}</td>
            <td style="text-align:right">{{ $product->stock }}</td>
            <td style="text-align:right">
            @if($product->company)
            {{ $product->company->company_name }}
            @endif 
          </td>

          <td><a href="{{ route('product.detail',$product->id) }}" class="btn btn-primary btn-sm">詳細</a></td>
          <td style="text-align:center">
                <form action="{{ route('product.destroy',$product->id) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">削除</button>
                </form>
            </td>
        </tr>
        @endforeach   
      </table>
    </div>
    <!--テーブルここまで-->
    <!--ページネーション-->
    {!! $products->links('pagination::bootstrap-5') !!}
    <!--ページネーションここまで-->
    @endif
  </div>
</main>


  </div>
</main>

@endsection