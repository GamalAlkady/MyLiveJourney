<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DistrictsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('districts')->truncate();
        DB::table('placetypes')->truncate();
        DB::table('places')->truncate();

      // 🏙️ Districts
        DB::table('districts')->insert([
            ['id' => 1, 'name' => 'Riyadh', 'created_at' => now(), 'updated_at' => now()],
            ['id' => 2, 'name' => 'Jeddah', 'created_at' => now(), 'updated_at' => now()],
            ['id' => 3, 'name' => 'AlUla', 'created_at' => now(), 'updated_at' => now()],
            ['id' => 4, 'name' => 'Abha', 'created_at' => now(), 'updated_at' => now()],
            ['id' => 5, 'name' => 'Al Khobar', 'created_at' => now(), 'updated_at' => now()],
        ]);

        // 🏷️ Place Types
        DB::table('placetypes')->insert([
            ['id' => 1, 'name' => 'Historical', 'created_at' => now(), 'updated_at' => now()],
            ['id' => 2, 'name' => 'Natural', 'created_at' => now(), 'updated_at' => now()],
            ['id' => 3, 'name' => 'Cultural', 'created_at' => now(), 'updated_at' => now()],
            ['id' => 4, 'name' => 'Entertainment', 'created_at' => now(), 'updated_at' => now()],
            ['id' => 5, 'name' => 'Religious', 'created_at' => now(), 'updated_at' => now()],
        ]);

        // 🏛️ Places
        DB::table('places')->insert([
            [
                'name' => 'Riyadh Boulevard',
                'district_id' => 1,
                'placetype_id' => 4,
                'description' => 'One of the most popular entertainment zones in Riyadh, featuring events, restaurants, and live shows.',
                'image' => '2025-10-11-68ea90d474d74.jpg',
                'user_id' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Masmak Fortress',
                'district_id' => 1,
                'placetype_id' => 1,
                'description' => 'A historical fortress located in the old city of Riyadh, symbolizing the unification of Saudi Arabia.',
                'image' => 'places/masmak.jpg',
                'user_id' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Jeddah Corniche',
                'district_id' => 2,
                'placetype_id' => 2,
                'description' => 'A beautiful seafront promenade in Jeddah with beaches, parks, and cafes.',
                'image' => 'places/jeddah_corniche.jpg',
                'user_id' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Hegra (Madain Saleh)',
                'district_id' => 3,
                'placetype_id' => 1,
                'description' => 'A UNESCO World Heritage site featuring Nabataean tombs carved into rock formations in AlUla.',
                'image' => 'places/hegra.jpg',
                'user_id' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Elephant Rock',
                'district_id' => 3,
                'placetype_id' => 2,
                'description' => 'A naturally shaped rock resembling an elephant, one of AlUla’s most iconic landmarks.',
                'image' => 'places/elephant_rock.jpg',
                'user_id' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Jabal Sawda',
                'district_id' => 4,
                'placetype_id' => 2,
                'description' => 'The highest mountain in Saudi Arabia, located in the Asir region with stunning scenic views.',
                'image' => 'places/jabal_sawda.jpg',
                'user_id' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Abha Museum',
                'district_id' => 4,
                'placetype_id' => 3,
                'description' => 'A museum that displays the traditional heritage and arts of the Asir region.',
                'image' => 'places/abha_museum.jpg',
                'user_id' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Al Rashid Mall',
                'district_id' => 5,
                'placetype_id' => 4,
                'description' => 'A modern shopping mall in Al Khobar featuring international brands and restaurants.',
                'image' => 'places/alrashid_mall.jpg',
                'user_id' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Half Moon Bay',
                'district_id' => 5,
                'placetype_id' => 2,
                'description' => 'A crescent-shaped beach area known for swimming, camping, and water sports.',
                'image' => 'places/halfmoon_bay.jpg',
                'user_id' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
