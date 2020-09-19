<?php

namespace App\Http\Controllers\Backoffice;

use App\Http\Controllers\Controller;
use App\Product;
use App\Theme;
use Illuminate\Http\Request;

class ProductController extends Controller
{

    public function __construct()
    {
        $this->checkPermissionAnd404('products');
    }

    protected function beautyBag($allMessages)
    {
        $messages = null;
        if (count($allMessages) >= 1) {
            foreach ($allMessages as $key => $message) {
                if ($key + 1 == count($allMessages)) {
                    $messages = $messages . $message;
                } else {
                    $messages = $messages . $message . ', ';
                }
            }
        } else {
            $messages = $allMessages[0];
        }
        return $messages;
    }

    public function index()
    {
        $products = Product::orderBy('id', 'DESC')->get();
        return view('backoffice.products.productsList', compact('products'));
    }

    public function create()
    {
        $themes = Theme::where('status', '!=', 'disabled')->get();
        return view('backoffice.products.productsCreate', compact('themes'));
    }

    public function store(Request $request)
    {
        try {
            $rules = [
                'SKU' => 'required|unique:products|min:3',
                'code' => 'required|unique:products|min:3',
            ];

            $customMessages = [
                'required' => ':attribute can not blank',
                'unique' => ':attribute is exist',
                'min' => ':attribute minimal 3 character',
            ];

            $this->validate($request, $rules, $customMessages);

            $product = Product::create($request->except('theme_id'));

            if ($request->theme_id) {
                $product->theme_id = $request->theme_id;
                $product->save();
            }

            $request->session()->flash('alert-success', "Product {$request->name} created!");
            return redirect()->route('admin.product.index');
        } catch (\Exception $e) {
            $request->flash();
            if ($e->validator) {
                $request->session()->flash('alert-error', $this->beautyBag($e->validator->messages()->all()));
            } else {
                $request->session()->flash('alert-error', $e->getMessage());
            }
            return redirect()->route('admin.product.create');
        }
    }

    public function show(Product $product)
    {
        //
    }

    public function edit(Product $product)
    {
        $themes = Theme::where('status', '!=', 'disabled')->get();
        return view('backoffice.products.productsUpdate', compact('product', 'themes'));
    }

    public function update(Request $request, Product $product)
    {
        try {

            $rules = [
                'SKU' => 'unique:products',
                'code' => 'unique:products',
            ];

            $customMessages = [
                'required' => ':attribute can not blank',
                'unique' => ':attribute is exist',
            ];

            $this->validate($request, $rules, $customMessages);

            if ($request->SKU) {
                $product->SKU = $request->SKU;
            }

            if ($request->code) {
                $product->name = $request->name;
            }

            if ($request->theme_id) {
                $product->theme_id = $request->theme_id;
            } else {
                $product->theme_id = null;
            }

            $product->name = $request->name;
            $product->type = $request->type;
            $product->price = $request->price;
            $product->description = $request->description;
            $product->subscription_period_number = $request->subscription_period_number;
            $product->subscription_period_date = $request->subscription_period_date;
            $product->status = $request->status;
            $product->save();

            $request->session()->flash('alert-success', "Product {$request->name} updated!");
            return redirect()->route('admin.product.index');
        } catch (\Exception $e) {
            $request->flash();
            $request->session()->flash('alert-error', $this->beautyBag($e->validator->messages()->all()));
            return redirect()->route('admin.product.edit', $product->id);
        }
    }

    public function destroy(Product $product, Request $request)
    {
        try {
            $product->delete();
            $request->session()->flash('alert-success', "Product {$product->name} deleted!");
            return redirect()->route('admin.product.index');
        } catch (\Exception $e) {
            $request->session()->flash('alert-error', $e->getMessage());
            return redirect()->route('admin.product.index');
        }
    }
}