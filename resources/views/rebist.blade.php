@extends('app')

@section('content')
    <div class="row">
         <div class="col-lg-12">
            <div class="pull-left">
                <h2 style="font-size:lrem;">商品新規登録画面</h2>
            </div>
            <div class="pull-right">
                <a class="btn btn-success" href="{{ url('/products')}}">戻る</a>
            </div>
         </div>
    </div>

    <div style="text-align:right;">
        <form action="{{ route('product.store') }}" enctype='multipart/form-data' method="POST" >
           @csrf
             <div class="row">
                <div class="col-12 md-2 mt-2">
                    <div class="from-group">
                    <label class="col-sm-2 col-form-label">商品名</label>
                    <span class="from-required" style="color:red;">*</span>
                        <input type="text" name="product_name" class="from-control" placeholder="名前">
                        @error('product_name')
                        <span style="color:red;">商品名を２０文字以内で入力してください</span>
                        @enderror
                    </div>
                </div>

                <div class="col-12 md-2 mt-2">
                    <div class="from-group">
                    <label class="col-sm-2 col-form-label">メーカー名</label>
                    <span class="from-required" style="color:red;">*</span>
                        <select name="company_id" class="from-select">
                            <option value=''>メーカー名を選択してください</option>
                            @foreach ($companies as $company)
                                <option value="{{ $company->id }}">{{ $company->company_name }}</option>
                            @endforeach
                        </select> 
                        @error('company_id')
                        <span style="color:red;">商品名を２０文字以内で入力してください</span>
                        @enderror
                    </div>
                </div>
                


                <div class="col-12 md-2 mt-2">
                    <div class="from-group">
                    <label class="col-sm-2 col-form-label">価格</label>
                    <span class="from-required" style="color:red;">*</span>
                        <input type="text" name="price" class="from-control" placeholder="価格">
                        @error('price')
                        <span style="color:red;">価格を入力してください</span>
                        @enderror
                    </div>
                </div>
                <div class="col-12 md-2 mt-2">
                    <div class="from-group">
                    <label class="col-sm-2 col-form-label">在庫数</label>
                    <span class="from-required" style="color:red;">*</span>
                        <input type="text" name="stock" class="from-control" placeholder="在庫数">
                        @error('stock')
                        <span style="color:red;">在庫を入力してください</span>
                        @enderror
                    </div>
                </div>
                <div class="col-12 md-2 mt-2">
                    <div class="from-group">
                    <label class="col-sm-2 col-form-label">コメント</label>
                        <textarea class="from-control" style="height:100px" name="comment"  placeholder="コメント"></textarea>
                    </div>
                </div>

                <div class="col-12 md-2 mt-2">
                <label class="col-sm-2 col-form-label">商品画像</label>
                        <input type="file" name="img_path" accept=".jpg,.png,image/gif,image/jpeg,image/png">   
                </div>
                
                    


            
                <div class="col-12 md-2 mt-2">
                        <button type="submit" class="btn btn-primary w-100">新規登録

                        </button>
                </div>
            </div>
        </form>
    </div>

@endsection