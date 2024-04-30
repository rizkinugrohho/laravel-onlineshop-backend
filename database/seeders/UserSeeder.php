<?php
    namespace Database\Seeders;

    use illuminate\Database\Console\Seeds\WithoutModelEvents;
    use illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

    class UserSeeder extends Seeder
    {
        /**
         * Run the database seeds
         */
        public function run(): void
        {
            \App\Models\User::factory(9)->create();

            $user = \App\Models\User::factory()->create([
                'name' => 'admin rizki',
                'email' => 'rizkynhg@gmail.com',
                'password' => Hash::make('rizkyindah12'),
                'phone' => '081586261383',
                'roles' => 'ADMIN',
            ]);
        }
    }
?>
