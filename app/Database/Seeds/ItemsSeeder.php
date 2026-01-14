<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;
use Faker\Factory;

class ItemsSeeder extends Seeder
{
    public function run()
    {
        $faker = Factory::create();

        $images = [
            'halwa1.jpg',
            'halwa2.jpg',
            'halwa3.jpg',
            'halwa4.jpg',
            'halwa5.jpg',
            'halwa6.jpg',
            'halwa7.jpg',
            'halwa8.jpg'
        ];

        for ($i = 1; $i <= 50; $i++) {

            $data = [
                'added_by'   => 1, // admin user
                'created_at' => $faker->dateTimeBetween('-1 month', 'now')
                                      ->format('Y-m-d H:i:s'),
                'status'     => 0, // active
                'name'       => $faker->randomElement([
                                    'Kozhikodan Black Halwa',
                                    'Badam Halwa',
                                    'Coconut Halwa',
                                    'Banana Halwa',
                                    'Anar Halwa',
                                    'Dry Fruit Halwa',
                                    'Arabian Halwa',
                                    'Classic Red Halwa',
                                    'Green Halwa'
                                ]),
                'quantity'   => $faker->numberBetween(0, 10),
                'amount'     => $faker->numberBetween(180, 350),
                'image'      => time() . '_' . $faker->randomElement($images),
                'category'   => $faker->numberBetween(1, 15),
            ];

            $this->db->table('tbl_items')->insert($data);
        }
    }
}
