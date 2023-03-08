<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Admin\AdminController as AdminController;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use Carbon\Carbon;
use App\Models\Admin\Fruit;
use App\Models\Admin\Nutrition;
use Session;

class SyncController extends AdminController
{
    /**
     * Display a listing of the resource.
     */

    public function index()
    {
        return view('admin.fruits.sync');
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

        Session::flash('message', 'Fruit synchronization has been done!');
        return redirect()->route('dashboard');
        //return view('admin.posts.index');
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


    /**
     * Display the specified resource.
     */
}
