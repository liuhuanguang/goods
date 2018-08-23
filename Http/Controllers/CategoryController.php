<?php

namespace Modules\Goods\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index(Request $request)
    {
        $id = $request->input('id');
        $cat_list = DB::table('goods_category')->where('goods_category_pid', 0)->where('is_show', 1)->where('is_del', 1)->orderBy('id', 'desc')->get()->map(function ($value) {
            return (array)$value;
        })->toArray();;
        if (!empty($id)) {
            $next_cat = DB::table('goods_category')->where('goods_category_pid', $id)->where('is_show', 1)->where('is_del', 1)->orderBy('id', 'desc')->get();
        } else {
            $next_cat = DB::table('goods_category')->where('goods_category_pid', $cat_list[0]['id'])->where('is_show', 1)->where('is_del', 1)->orderBy('id', 'desc')->get();
        }
        return view('goods::category', ['cat_list' => $cat_list, 'next_cat' => $next_cat, 'id' => $id]);
    }

    /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function create()
    {
        return view('goods::create');
    }

    /**
     * Store a newly created resource in storage.
     * @param  Request $request
     * @return Response
     */
    public function store(Request $request)
    {
    }

    /**
     * Show the specified resource.
     * @return Response
     */
    public function show()
    {
        return view('goods::show');
    }

    /**
     * Show the form for editing the specified resource.
     * @return Response
     */
    public function edit()
    {
        return view('goods::edit');
    }

    /**
     * Update the specified resource in storage.
     * @param  Request $request
     * @return Response
     */
    public function update(Request $request)
    {
    }

    /**
     * Remove the specified resource from storage.
     * @return Response
     */
    public function destroy()
    {
    }
}
