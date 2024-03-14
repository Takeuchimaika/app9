<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
//use App\Http\Controllers\Controller;

use App\Models\Product;
use App\Models\Company;


class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

        //入力される値nameの中身を定義する
        $searchWord = $request->input('searchWord'); //商品名の値
        $companyId = $request->input('companyId'); //カテゴリの値
        
        
        $query = Product::query();
        //商品名が入力された場合、productsテーブルから一致する商品を$queryに代入
        if (isset($searchWord)) {
            $query->where('product_name', 'like', '%' . self::escapeLike($searchWord) . '%');
        }
        //カテゴリが選択された場合、companiesテーブルからcompany_idが一致する商品を$queryに代入
        if (isset($companyId)) {
            $query->where('company_id', $companyId);
        }

        //$queryをcompany_idの昇順に並び替えて$productsに代入
        $products = $query->orderBy('id', 'asc')->paginate(15);

        //companiesテーブルからgetLists();関数でcompany_nameとidを取得する
        $company = new Company;
        $companies = $company->getLists();

        return view('index', [
            'products' => $products,
            'companies' => $companies,
            'searchWord' => $searchWord,
            'companyId' => $companyId
        ]);



        $products = Product::latest()->paginate(5);

        return view('index',compact('products'))
           ->with('i',(request()->input('page',1)-1)*5);
        //
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Product $Product)
    {
        try {
        $request->validate([
            'img_path'=> 'image|mimes:jpeg,png,jpg,gif', // 画像のバリデーションルールを設定
            'product_name'=>'required|max:20',
            'company_id'=>'required|integer',
            'price'=>'required|integer',
            'stock'=>'required|integer',
            'comment'=>'max:140',
        ]);
        $product = new Product;
        // 画像が提供されている場合のみ処理を行う
        if ($request->hasFile('img_path')) {
        $img = $request->file('img_path');
        $path = $img->store('img','public');
        $product->img_path = $path;
        }

        $product->product_name = $request->input(["product_name"]);
        $product->company_id = $request->input(["company_id"]);
        $product->price = $request->input(["price"]);
        $product->stock = $request->input(["stock"]);
        $product->comment = $request->input(["comment"]);
        // 商品情報を保存
        $product->save();
        //リダイレクト
        return redirect()->route('products.index');

        } catch (QueryException $e) {
             // エラーが発生した場合の処理

       
         //リダイレクト
        return redirect()->route('products.index');
        }
    }
        //
    

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */

     /*==================================
    検索フォームのみ表示(show)
    ==================================*/
    public function show(Request $request)
    {
        $product = new Product;
        $companies = Company::all();

        //フォームを機能させるために各情報を取得し、viewに返す
        $company = new Company;
        $companies = $company->getLists();
        $searchWord = $request->input('searchWord');
        $companyId = $request->input('companyId');

        return view('index', [
            'companies' => $companies,
            'searchWord' => $searchWord,
            'companyId' => $companyId
        ]);
        return view('show',compact('product'))
        ->with('companies',$companies);
    }


    /*==================================
    検索メソッド(search)
    ==================================*/
    public function search(Request $request)
    {
        //入力される値nameの中身を定義する
        $searchWord = $request->input('searchWord'); //商品名の値
        $companyId = $request->input('companyId'); //カテゴリの値

        $query = Product::query();
        //商品名が入力された場合、productsテーブルから一致する商品を$queryに代入
        if (isset($searchWord)) {
            $query->where('product_name', 'like', '%' . self::escapeLike($searchWord) . '%');
        }
        //カテゴリが選択された場合、companiesテーブルからcompany_idが一致する商品を$queryに代入
        if (isset($companyId)) {
            $query->where('company_id', $companyId);
        }
        
            

        //$queryをcompany_idの昇順に並び替えて$productsに代入
        $products = $query->orderBy('id', 'asc')->paginate(15);

        //companiesテーブルからgetLists();関数でcompany_nameとidを取得する
        $company = new Company;
        $companies = $company->getLists();

        return view('index', [
            'products' => $products,
            'companies' => $companies,
            'searchWord' => $searchWord,
            'companyId' => $companyId
        ]);
    }

    //「\\」「%」「_」などの記号を文字としてエスケープさせる
    public static function escapeLike($str)
    {
        return str_replace(['\\', '%', '_'], ['\\\\', '\%', '\_'], $str);
    }
    
    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        $companies = Company::all();
        return view('edit',compact('product'))
            ->with('companies',$companies);
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Product $product)
    {
        try {
        $request->validate([
            'img_path' => 'image|mimes:jpeg,png,jpg,gif',
            'product_name'=>'required|max:20',
            'company_id'=>'required|integer',
            'price'=>'required|integer',
            'stock'=>'required|integer',
            'comment'=>'max:140',
        ]);
        //画像フォームでリクエストした画像情報を取得
        $img = $request->file('img_path');
        //画面情報がセットされていれば、保存処理を実行
        if (isset($img)) {
        // storage > public > img配下に画像が保存される
        $path = $img->store('img','public');
        // store処理が実行できたらDBに保存処理が実行
        if ($path) {
            //DBに登録する処理
            $product->img_path = $path;

        }
        }

        $product->product_name = $request->input("product_name");
        $product->company_id = $request->input("company_id");
        $product->price = $request->input("price");
        $product->stock = $request->input("stock");
        $product->comment = $request->input("comment");
        $product->save();
        return redirect()->route('products.index');
        } catch (QueryException $e) {
        // エラーが発生した場合の処理
        return redirect()->route('products.index')->with('success','商品を更新いたしました');
        } 
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
       try {
        //アイテムテーブルから指定のIDのレコード一件を取得
        $product = Product::find($id);
        //レコードを削除
        $product->delete();
        //削除したら一覧画面にリダイレクト
        return redirect()->route('products.index');

        // リダイレクトなどの処理
    } catch (QueryException $e) {
        // エラーが発生した場合の処理
        return redirect()->route('products.index');
    }

        //
    }

    public function detail(Product $product)
     {
        $companies = Company::all();
        return view('detail',compact('product'))
            ->with('companies',$companies);

     }


    //新規登録
    public function rebist()
     {
        $companies = Company::all();
        return view('rebist')
           ->with('companies',$companies);

     }

    
}
