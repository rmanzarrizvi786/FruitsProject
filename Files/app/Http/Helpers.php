<?php





use App\User;
use App\Models\Admin\Fruit;
use App\Models\Admin\Favourite;
use App\Models\Admin\Nutrition;

function getTotalNutritions($fruit_id)
{
    $nutritions = Nutrition::where('id', $fruit_id)->first();
    $totalNutritions = ($nutritions->carbohydrates) + ($nutritions->protein) + ($nutritions->fat) + ($nutritions->calories) + ($nutritions->sugar);
    return round($totalNutritions, 1);
}
function totalLocalDB()
{
    return Fruit::count();
}
function totalFavourites()
{
    return Favourite::count();
}
function totalFruityviceDB()
{
    return 20;
    $apiData = file_get_contents("https://fruityvice.com/api/fruit/all");
    $apiData = json_decode($apiData);
    return count($apiData);
}
function saveToFruityVice($request)
{

    $arraySave =  array(
        'genus' => $request->input('genus'),
        'name' => $request->input('name'),
        'family' => $request->input('family'),
        'order' => $request->input('order'),
        'nutritions' =>
        array(
            'carbohydrates' => $request->input('carbohydrates'),
            'protein' => $request->input('protein'),
            'fat' => $request->input('fat'),
            'calories' => $request->input('calories'),
            'sugar' => $request->input('sugar'),
        ),
    );

    $arraySave  = json_encode($arraySave);

    $url = "https://fruityvice.com/api/fruit";

    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "PUT");

    $updateArray = $arraySave;
    curl_setopt($ch, CURLOPT_POSTFIELDS, $updateArray);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

    $headers = [];
    $headers[] = 'Content-Type:application/json';
    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
    $result = curl_exec($ch);
    $result = json_decode($result);
    curl_close($ch);
    print_r($result);
}








/*

 * 

 */
