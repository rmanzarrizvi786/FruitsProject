<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Admin\AdminController as AdminController;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use Carbon\Carbon;
use App\Models\Admin\Fruit;
use App\Models\Admin\Nutrition;
use Session;

class FruitsController extends AdminController
{
    /**
     * Display a listing of the resource.
     */

    public function index()
    {
        return view('admin.fruits.index');
    }
    public function fruitsSync()
    {
        $apiData = file_get_contents("https://fruityvice.com/api/fruit/all");
        $apiData = json_decode($apiData);
        //echo '<pre>';
        //print_r($apiData);
        //exit;
        foreach ($apiData as $fruit) {
            // echo $fruit->nutritions->carbohydrates;
            $fruitCount = Fruit::where('name', $fruit->name)->count();
            if ($fruitCount == 0) {
                $fruitData = [
                    'genus' => $fruit->genus,
                    'name' => $fruit->name,
                    'family' => $fruit->family,
                    'order' => $fruit->order,

                ];
                //exit;
                $objFruits = new Fruit;
                $objFruits = $objFruits->fill($fruitData);
                $objFruits->save();

                //------------ Nutrition Data--

                $nutritionData = [
                    //'fruit_id' => $fruit->fruit_id,
                    'carbohydrates' => $fruit->nutritions->carbohydrates,
                    'protein' => $fruit->nutritions->protein,
                    'fat' => $fruit->nutritions->fat,
                    'calories' => $fruit->nutritions->calories,
                    'sugar' => $fruit->nutritions->sugar,
                ];
                $objNutritions = new Nutrition;
                $objNutritions = $objNutritions->fill($nutritionData);

                //echo '<pre>';
                //print_r($objNutritions);
                //exit;

                $objFruits->nutritions()->save($objNutritions);
            } else {
                echo 'Fruit with name ' . "<b>$fruit->name</b> already exists";
                echo "<br>";
            }
        }

        Session::flash('message', 'Fruit has been deleted!');
        return redirect()->route('fruits');
        //return view('admin.posts.index');
    }
    public function getFruits()
    {

        $fruitsList = Fruit::select('*')

            //->join('specialties as spe', 'leads.Specialty', '=', 'spe.spe_id')
            //->where('post_status', '!=', 'Trashed')
            ->get();

        return Datatables::of($fruitsList)

            ->addColumn('action', function ($list) {
                $action = '<div class="action">' .
                    '<button id="updateFruit" class="btn btn-primary" data-id="' . $list->id . '" data-toggle="modal" data-target="#updateModal"><i class="nav-icon fa fa-edit"></i></button>' .
                    //'<button id="updateFruit" class="btn btn-info" data-id="' . $list->id . '" data-bs-toggle="modal" data-bs-target="#updateModal"><i class="nav-icon fa fa-eye"></i></button>' .
                    '<button id="deleteFruit" class="btn btn-danger deleteFruit" data-id="' . $list->id . '"><i class="nav-icon fa fa-trash"></i></button>' .
                    '<button class="delete-modal btn btn-success farouriteFruit" data-id="' . $list->id . '" ><i class="nav-icon fa fa-heart"></i></button>' .
                    //'<a href="' . url("#") . '/' . $list->id . '" class="action"><button class="delete-modal btn btn-success" ><i class="nav-icon fa fa-heart"></i></button></a>' .
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

        //saveToFruityVice($request);
        //exit;
        // echo '<pre>';
        // print_r($arraySave);
        // exit;
        $fruitData = [
            'genus' => $request->input('genus'),
            'name' => $request->input('name'),
            'family' => $request->input('family'),
            'order' => $request->input('order'),

        ];
        //exit;
        $objFruits = new Fruit;
        $objFruits = $objFruits->fill($fruitData);
        $objFruits->save();

        //------------ Nutrition Data--

        $nutritionData = [
            //'fruit_id' => $request->input->fruit_id,
            'carbohydrates' => $request->input('carbohydrates'),
            'protein' => $request->input('protein'),
            'fat' => $request->input('fat'),
            'calories' => $request->input('calories'),
            'sugar' => $request->input('sugar'),
        ];
        $objNutritions = new Nutrition;
        $objNutritions = $objNutritions->fill($nutritionData);

        //echo '<pre>';
        //print_r($objNutritions);
        //exit;


        $objFruits->nutritions()->save($objNutritions);
    }

    /**
     * Display the specified resource.
     */
    public function getFruitData(Request $request)
    {


        ## Read POST data 
        $id = $request->post('id');

        $fruitData = Fruit::find($id);

        $response = array();
        if (!empty($fruitData)) {

            $response['genus'] = $fruitData->genus;
            $response['name'] = $fruitData->name;
            $response['family'] = $fruitData->family;
            $response['order'] = $fruitData->order;

            $response['success'] = 1;
        } else {
            $response['success'] = 0;
        }

        return response()->json($response);
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
    public function update(Request $request)
    {
        //return '666';
        ## Read POST data
        $id = $request->post('id');

        $fruit = Fruit::find($id);

        $response = array();
        if (!empty($fruit)) {
            $fruitData = [
                'genus' => $request->post('genus'),
                'name' => $request->post('name'),
                'family' => $request->post('family'),
                'order' => $request->post('order'),

            ];

            if ($fruit->update($fruitData)) {
                $response['success'] = 1;
                $response['msg'] = 'Update successfully';
            } else {
                $response['success'] = 0;
                $response['msg'] = 'Record not updated';
            }
        } else {
            $response['success'] = 0;
            $response['msg'] = 'Invalid ID.';
        }

        return response()->json($response);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {

        $objFruits = new Fruit;
        if ($objFruits->destroy($request->id)) {
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
