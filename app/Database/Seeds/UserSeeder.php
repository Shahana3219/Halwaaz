<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;
use Faker\Factory;

class UserSeeder extends Seeder
{
    public function run()
    {
        $faker = Factory::create('en_IN');

        $data = [];

        for ($i = 1; $i <= 30; $i++) {
            $data[] = [
                'added_by'   => 1, // admin user id
                'status'     => 1,
                'name'       => $faker->name,
                'username'   => $faker->unique()->userName,
                'email'      => $faker->unique()->safeEmail,
                'password'   => password_hash('123456', PASSWORD_DEFAULT),
                'role'       => $faker->randomElement([1, 2]), // 1=Admin,2=User
                'address'    => $faker->address,
                'phone'      => $faker->numerify('9#########'),
                'created_at' => date('Y-m-d H:i:s')
            ];
        }

        $this->db->table('tbl_users')->insertBatch($data);
    }
}
