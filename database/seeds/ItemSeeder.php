<?php

use Illuminate\Database\Seeder;
use Faker\Generator as Faker;

class ItemSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker)
    {
        DB::table('items')->insert([
            'name' => "Marguerita",
            'ingredients' => "Tomato sauce, mozzarella, basil, oregano and olive oil.",
            'size' => 'medium',
            'price' => 10,
            'image_url' => 'https://pizza-test.s3.us-east-2.amazonaws.com/itemsFiles/thumbs_medium/VZkEl06VX7xqwYaz9hBnBF30LDNOG5ZQCA8TOsvS.jpeg',
            'created_at' => now(),
            'updated_at' => now()
        ]);
        DB::table('items')->insert([
            'name' => "Napolitana",
            'ingredients' =>
            "Tomato sauce, mozzarella, anchovies, oregano, capers and olive oil.",
            'size' => 'medium',
            'price' => 10,
            'image_url' => 'https://pizza-test.s3.us-east-2.amazonaws.com/itemsFiles/thumbs_medium/UGV3DFCz9YGkgn0UT5mAB6kQqODtohBFMstD2DTM.jpeg',
            'created_at' => now(),
            'updated_at' => now()
        ]);
          DB::table('items')->insert([
            'name' => "Pepperoni",
            'ingredients' => "Tomato sauce, mozzarella, salami pepperoni.",
            'size' => 'medium',
            'price' => 8,
            'image_url' => 'https://pizza-test.s3.us-east-2.amazonaws.com/itemsFiles/thumbs_medium/VFp0W1MNfdyeaLXh5ScZ7wCw7G6xUNttQFHQokuI.jpeg',
            'created_at' => now(),
            'updated_at' => now()
          ]);
          DB::table('items')->insert([
            'name' => "Four cheeses",
            'ingredients' => "Tomato sauce, mozzarella, fontina,  gorgonzola, parmesan.",
            'size' => 'medium',
            'price' => 12,
            'image_url' => 'https://pizza-test.s3.us-east-2.amazonaws.com/itemsFiles/thumbs_medium/yR6JXBxSiUOjl5mXnlfJCKdAyLWPuuQfs9dphTf2.jpeg',
            'created_at' => now(),
            'updated_at' => now()
          ]);
          DB::table('items')->insert([
            'name' => "Four Seasons",
            'ingredients' =>
            "Tomato sauce, Artichokes, olives with tomato and basil, mushrooms, Serrano ham.",
            'size' => 'medium',
            'price' => 12,
            'image_url' => 'https://pizza-test.s3.us-east-2.amazonaws.com/itemsFiles/thumbs_medium/bpAYs4dta2RbDxD0CzhqkX0e6t02avNVA2VJOyeF.jpeg',
            'created_at' => now(),
            'updated_at' => now()
            ]);
          DB::table('items')->insert([
            'name' => "Diávola",
            'ingredients' =>
            "Tomato sauce, chorizo, salami, spicy chili and a generous quantity of cheese.",
            'size' => 'medium',
            'price' => 10,
            'image_url' => 'https://pizza-test.s3.us-east-2.amazonaws.com/itemsFiles/thumbs_medium/dERIxLkzOCkM4izczkovc2QjX9hcdaLNTpfF3Str.jpeg',
            'created_at' => now(),
            'updated_at' => now()
            ]);
          
          DB::table('items')->insert([
            'name' => "Carbonara",
            'ingredients' => "egg, parmesan cheese, onion, bacon, salt and pepper.",
            'size' => 'medium',
            'price' => 9,
            'image_url' => 'https://pizza-test.s3.us-east-2.amazonaws.com/itemsFiles/thumbs_medium/eXrrhUpgbAKvsdXfKzdE2Evh0bD0gMNfTpKZmVEO.jpeg',
            'created_at' => now(),
            'updated_at' => now()
          ]);
          DB::table('items')->insert([
            'name' => "Funghi",
            'ingredients' => "Tomato sauce, mozzarella and Portobello's mushrooms.",
            'price' => 10,
            'size' => 'medium',
            'image_url' => 'https://pizza-test.s3.us-east-2.amazonaws.com/itemsFiles/thumbs_medium/LeDRgQUYKfoJ5aCT0cJ0U4uIpdNstRHF5G9jL1fL.jpeg',
            'created_at' => now(),
            'updated_at' => now()
          ]);
          DB::table('items')->insert([
            'name' => "Vegetarian",
            'ingredients' => "Mushrooms, zucchini, sweet yellow pepper, sweet red pepper, onions",
            'size' => 'medium',
            'price' => 10,
            'image_url' => 'https://pizza-test.s3.us-east-2.amazonaws.com/itemsFiles/thumbs_medium/FKetYQZP95RdNcYZhHDaYIlDIDCRrZGeBUwTFaYS.jpeg',
            'created_at' => now(),
            'updated_at' => now()
          ]);
    }
}
