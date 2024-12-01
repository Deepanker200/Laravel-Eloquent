<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\File;

use App\Models\citizen;

class CitizenSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $json = File::get('database/json/person.json');
        $persons= collect(json_decode($json));
        
        $persons->each(function($person){          //Model
            citizen::create([
            'name' => $person->name,
            'email' => $person->email,
            'age' => $person->age, 
            'city' => $person->city,
    
            ]);
        });
    }
}
