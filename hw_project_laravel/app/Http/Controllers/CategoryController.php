<?php

namespace App\Http\Controllers;

use App\Balance;
use App\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories_arr = [];
        $categories = Category::all();
        foreach ($categories as $category){
            if(!isset($categories_arr[$category->accounting->id])){
                $categories_arr[$category->accounting->id] = [];
            }
            array_push($categories_arr[$category->accounting->id], [
                'id' => $category->id,
                'name' => $category->name
            ]);
        }
        return $categories_arr;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Balance  $balance
     * @return \Illuminate\Http\Response
     */
    public function show(Balance $balance)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Balance  $balance
     * @return \Illuminate\Http\Response
     */
    public function edit(Balance $balance)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Balance  $balance
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Balance $balance)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Balance  $balance
     * @return \Illuminate\Http\Response
     */
    public function destroy(Balance $balance)
    {
        //
    }

    public function categoryByAccounting(Request $request){
        $this->validate( $request, [ 'id' => 'required|exists:accountings,id' ] );
        $categories = Category::where('accounting_id', $request->get('id'))->get();
        $output = [];
        foreach ($categories as $category) {
            $output[$category->id] = $category->name;
        }
        return $output;
    }
}
