<?php

use Illuminate\Database\Seeder;
use App\Model\Item;

class ItemSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $pizza_names = ["marguerita",
        "napolitana",
        "pepperoni",
        "four_cheeses",
        "four_seasons",
        "diavola",
        "carbonara",
        "funghi",
        "vegetarian"];
        $rates = ["marguerita" => 1.3,
        "napolitana" => 1.3,
        "pepperoni" => 1.2,
        "four_cheeses" => 1.6,
        "four_seasons" => 1.6,
        "diavola" => 1.6,
        "carbonara" => 1.3,
        "funghi" => 1.3,
        "vegetarian" => 1.4];
        $base_prices = [
          "marguerita" => 9,
          "napolitana" => 9,
          "pepperoni" => 8,
          "four_cheeses" => 12,
          "four_seasons" => 12,
          "diavola" => 13,
          "carbonara" => 9,
          "funghi" => 9,
          "vegetarian" => 10
        ];
        foreach($pizza_names as $p_name){
          $pizza_prices[$p_name] = [];
          $i = 0;
          foreach(Item::sizes() as $size){
            $pizza_prices[$p_name][$size] = $i === 0 ? $base_prices[$p_name] : $base_prices[$p_name]*pow($rates[$p_name], $i); 
            $i++;
          }
        }
        foreach(Item::sizes() as $size ){

          DB::table('items')->insert([
              'name' => "Marguerita",
              'ingredients' => "Tomato sauce, mozzarella, basil, oregano and olive oil.",
              'size' => $size,
              'price' => $pizza_prices["marguerita"][$size],
              'image_url' => 'https://pizza-test.s3.us-east-2.amazonaws.com/itemsFiles/thumbs_medium/VZkEl06VX7xqwYaz9hBnBF30LDNOG5ZQCA8TOsvS.jpeg',
              'created_at' => now(),
              'updated_at' => now()
          ]);
          DB::table('items')->insert([
              'name' => "Napolitana",
              'ingredients' =>
              "Tomato sauce, mozzarella, anchovies, oregano, capers and olive oil.",
              'size' => $size,
              'price' => $pizza_prices["napolitana"][$size],
              'image_url' => 'https://pizza-test.s3.us-east-2.amazonaws.com/itemsFiles/thumbs_medium/UGV3DFCz9YGkgn0UT5mAB6kQqODtohBFMstD2DTM.jpeg',
              'created_at' => now(),
              'updated_at' => now()
          ]);
            DB::table('items')->insert([
              'name' => "Pepperoni",
              'ingredients' => "Tomato sauce, mozzarella, salami pepperoni.",
              'size' => $size,
              'price' => $pizza_prices["pepperoni"][$size],
              'image_url' => 'https://pizza-test.s3.us-east-2.amazonaws.com/itemsFiles/thumbs_medium/VFp0W1MNfdyeaLXh5ScZ7wCw7G6xUNttQFHQokuI.jpeg',
              'created_at' => now(),
              'updated_at' => now()
            ]);
            DB::table('items')->insert([
              'name' => "Four cheeses",
              'ingredients' => "Tomato sauce, mozzarella, fontina,  gorgonzola, parmesan.",
              'size' => $size,
              'price' => $pizza_prices["four_cheeses"][$size],
              'image_url' => 'https://pizza-test.s3.us-east-2.amazonaws.com/itemsFiles/thumbs_medium/yR6JXBxSiUOjl5mXnlfJCKdAyLWPuuQfs9dphTf2.jpeg',
              'created_at' => now(),
              'updated_at' => now()
            ]);
            DB::table('items')->insert([
              'name' => "Four Seasons",
              'ingredients' =>
              "Tomato sauce, Artichokes, olives with tomato and basil, mushrooms, Serrano ham.",
              'size' => $size,
              'price' => $pizza_prices["four_seasons"][$size],
              'image_url' => 'https://pizza-test.s3.us-east-2.amazonaws.com/itemsFiles/thumbs_medium/bpAYs4dta2RbDxD0CzhqkX0e6t02avNVA2VJOyeF.jpeg',
              'created_at' => now(),
              'updated_at' => now()
              ]);
            DB::table('items')->insert([
              'name' => "Diávola",
              'ingredients' =>
              "Tomato sauce, chorizo, salami, spicy chili and a generous quantity of cheese.",
              'size' => $size,
              'price' => $pizza_prices["diavola"][$size],
              'image_url' => 'https://pizza-test.s3.us-east-2.amazonaws.com/itemsFiles/thumbs_medium/dERIxLkzOCkM4izczkovc2QjX9hcdaLNTpfF3Str.jpeg',
              'created_at' => now(),
              'updated_at' => now()
              ]);
            
            DB::table('items')->insert([
              'name' => "Carbonara",
              'ingredients' => "egg, parmesan cheese, onion, bacon, salt and pepper.",
              'size' => $size,
              'price' => $pizza_prices["carbonara"][$size],
              'image_url' => 'https://pizza-test.s3.us-east-2.amazonaws.com/itemsFiles/thumbs_medium/eXrrhUpgbAKvsdXfKzdE2Evh0bD0gMNfTpKZmVEO.jpeg',
              'created_at' => now(),
              'updated_at' => now()
            ]);
            DB::table('items')->insert([
              'name' => "Funghi",
              'ingredients' => "Tomato sauce, mozzarella and Portobello's mushrooms.",
              'price' => $pizza_prices["funghi"][$size],
              'size' => $size,
              'image_url' => 'https://pizza-test.s3.us-east-2.amazonaws.com/itemsFiles/thumbs_medium/LeDRgQUYKfoJ5aCT0cJ0U4uIpdNstRHF5G9jL1fL.jpeg',
              'created_at' => now(),
              'updated_at' => now()
            ]);
            DB::table('items')->insert([
              'name' => "Vegetarian",
              'ingredients' => "Mushrooms, zucchini, sweet yellow pepper, sweet red pepper, onions",
              'size' => $size,
              'price' => $pizza_prices["vegetarian"][$size],
              'image_url' => 'https://pizza-test.s3.us-east-2.amazonaws.com/itemsFiles/thumbs_medium/FKetYQZP95RdNcYZhHDaYIlDIDCRrZGeBUwTFaYS.jpeg',
              'created_at' => now(),
              'updated_at' => now()
            ]);
          }
          

    }
}
