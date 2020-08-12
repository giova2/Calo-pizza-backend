<?php

use Illuminate\Database\Seeder;

class ItemSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('items')->insert([
            'name' => "Marguerita",
            'ingredients' => "Tomato sauce, mozzarella, basil, oregano and olive oil.",
            'price' => 10,
            'created_at' => now(),
            'updated_at' => now()
        ]);
        DB::table('items')->insert([
            'name' => "Napolitana",
            'ingredients' =>
              "Tomato sauce, mozzarella, anchovies, oregano, capers and olive oil.",
            'price' => 10,
            'created_at' => now(),
            'updated_at' => now()
        ]);
          DB::table('items')->insert([
            'name' => "Pepperoni",
            'ingredients' => "Tomato sauce, mozzarella, salami pepperoni.",
            'price' => 8,
            'created_at' => now(),
            'updated_at' => now()
          ]);
          DB::table('items')->insert([
            'name' => "Four cheeses",
            'ingredients' => "Tomato sauce, mozzarella, fontina,  gorgonzola, parmesan.",
            'price' => 12,
            'created_at' => now(),
            'updated_at' => now()
          ]);
          DB::table('items')->insert([
            'name' => "Four Seasons",
            'ingredients' =>
              "Tomato sauce, Artichokes, olives with tomato and basil, mushrooms, Serrano ham.",
            'price' => 12,
            'created_at' => now(),
            'updated_at' => now()
            ]);
          DB::table('items')->insert([
            'name' => "Diávola",
            'ingredients' =>
              "Tomato sauce, chorizo, salami, spicy chili and a generous quantity of cheese.",
            'price' => 10,
            'created_at' => now(),
            'updated_at' => now()
            ]);
          
          DB::table('items')->insert([
            'name' => "Carbonara",
            'ingredients' => "egg, parmesan cheese, onion, bacon, salt and pepper.",
            'price' => 9,
            'created_at' => now(),
            'updated_at' => now()
          ]);
          DB::table('items')->insert([
            'name' => "Funghi",
            'ingredients' => "Tomato sauce, mozzarella and Portobello's mushrooms.",
            'price' => 10,
            'created_at' => now(),
            'updated_at' => now()
          ]);
          DB::table('items')->insert([
            'name' => "Mexican",
            'ingredients' => "Tomato sauce, mozzarella, beans, chorizo ​​and jalapeños",
            'price' => 10,
            'created_at' => now(),
            'updated_at' => now()
          ]);
    }
}
