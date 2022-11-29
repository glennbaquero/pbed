<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

use Illuminate\Support\Arr;

use App\Helpers\GeneratorHelper;
use App\Models\Users\User;

class UsersTableSeeder extends Seeder
{
    protected $users;
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $items = [
            [
                'name' => 'Web User',
                'user_classification_id' => 1,
                // 'image_path' => GeneratorHelper::randomFile(),
                'email' => 'user@app.com',
                'password' => 'password',
                'position' => 'password',
            ],
        ];

        foreach($items as $item) {
            $item['password'] = Hash::make($item['password']);
            $item['email_verified_at'] = now();
            
            User::create($item);
        }
    }
}
