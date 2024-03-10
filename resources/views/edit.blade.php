@extends('app')

@section('content')
    <div class="row">
         <div class="col-lg-12">
            <div class="pull-left">
                <h2 style="font-size:lrem;">商品情報編集画面</h2>
            </div>
            <div class="pull-right">
                <a class="btn btn-success" href="{{ url('/products')}}">戻る</a>
            </div>
         </div>
    </div>

    <div style="text-align:right;">
        <form action="{{ route('product.update',$product->id)}}" enctype='multipart/form-data' method="POST">
        @method('PUT')
           @csrf
             <div class="row">
                <div class="col-12 md-2 mt-2">
                    <div class="from-group">
                    <span class="from-required" style="color:red;">*</span>
                        <input type="text" name="product_name" value="{{ $product->product_name }}" class="from-control" placeholder="名前">
                        @error('product_name')
                        <span style="color:red;">名前を２０文字以内で入力してください</span>
                        @enderror
                    </div>
                </div>
                <div class="col-12 md-2 mt-2">
                    <div class="from-group">
                    <span class="from-required" style="color:red;">*</span>
                    <select name="company_id" class="from-select">
                        <option>メーカーを選択してください</option>
                        @foreach ($companies as $company)
                        <option value="{{ $company->id }}" @if($company->id==$product->company_id) selected @endif>{{ $company->company_name }}</option>
                        @endforeach
                    </select>
                        @error('company_id')
                        <span style="color:red;">メーカーを選択してください</span>
                        @enderror
                    </div>
                </div>
                <div class="col-12 md-2 mt-2">
                    <div class="from-group">
                    <span class="from-required" style="color:red;">*</span>
                        <input type="text" name="price" value="{{ $product->price }}" class="from-control" placeholder="価格">
                        @error('price')
                        <span style="color:red;">価格を入力してください</span>
                        @enderror
                    </div>
                </div>
                <div class="col-12 md-2 mt-2">
                    <div class="from-group">
                    <span class="from-required" style="color:red;">*</span>
                        <input type="text" name="stock" value="{{ $product->stock }}" class="from-control" placeholder="在庫数">
                        @error('stock')
                        <span style="color:red;">在庫を入力してください</span>
                        @enderror
                    </div>
                </div>
                <div class="col-12 md-2 mt-2">
                    <div class="from-group">
                        <textarea class="from-control" style="height:100px" name="comment"  placeholder="コメント">{{ $product->comment }}</textarea>
                    </div>
                </div>
                <div class="col-12 md-2 mt-2">
                    <div class="from-group">
                        <input type="file" name="img_path" accept=".jpg,.png,image/gif,image/jpeg,image/png">
                    </div>
                </div>
                
                    


            
                <div class="col-12 md-2 mt-2">
                        <button type="submit" class="btn btn-primary w-100">更新

                        </button>
                </div>
            </div>
        </form>

        @endsection