<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Admin\AdminController as AdminController;
use App\Models\Admin\Favourite;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use Carbon\Carbon;
use App\Models\Admin\Fruit;
use App\Models\Admin\Nutrition;
use Illuminate\Support\Facades\Session;
use Auth;

class FavouritesController extends AdminController
{
    /**
     * Display a listing of the resource.
     */

    public function index()
    {
        return view('admin.fruits.favourites');
    }

    public function getFavourites()
    {

        $fruitsList = Favourite::select('*')

            ->join('fruits as fruit', 'fruit_id', '=', 'fruit.id')
            //->join('nutrition as nutrition', 'nutrition.fruit_id', '=', 'fruit_id')
            //->where('post_status', '!=', 'Trashed')
            ->get();

        return Datatables::of($fruitsList)
            
            ->addColumn('carbohydrates', function ($list) {
                return $carbohydrates = $list->nutritions->carbohydrates;
            })
            ->addColumn('protein', function ($list) {
                return $protein = $list->nutritions->protein;
            })
            ->addColumn('fat', function ($list) {
                return  $fat = $list->nutritions->fat;
            })
            ->addColumn('calories', function ($list) {
                return $calories = $list->nutritions->calories;
            })
            ->addColumn('sugar', function ($list) {
                return $sugar = $list->nutritions->sugar;
            })
            ->addColumn('total', function ($list) {
                return $total = getTotalNutritions($list->id);
            })

            ->addColumn('action', function ($list) {
                $action = '<div class="action">' .
                    $action = '<div class="action">' .
                    '<button id="deleteFruit" class="btn btn-danger deleteFruit" data-id="' . $list->id . '"><i class="nav-icon fa fa-trash"></i></button>' .
                    '</div>';
                return $action;
            })

            ->addColumn('date', function ($list) {
                $date = Carbon::parse($list->created_at)->format('d-m-Y');
                return $date;
            })

            //->rawColumns(['post_name', 'post_description', 'action'])
            ->make(true);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $count = Favourite::where('fruit_id', $request->input('id'))->count();

        //return $request->input('id');

        if ($count == 0) {
            $fruitData = [
                'fruit_id' => $request->input('id'),
                'user_id' => Auth::user()->id,
            ];
            //exit;
            $objFavourites = new Favourite;
            $objFavourites = $objFavourites->fill($fruitData);
            $objFavourites->save();
            return 'success';
        } else {
            return 'Fruit already exists in favourites list';
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {

        $objFavourites = new Favourite;
        if ($objFavourites->where('fruit_id', $request->id)->delete()) {
            $response['success'] = 1;
            $response['msg'] = 'Record deleted successfully';
        } else {
            $response['success'] = 0;
            $response['msg'] = 'Invalid ID.';
        }

        //return $objFruits;

        //Session::flash('message', 'Fruit has been deleted!');
        return response()->json($response);
    }
}
