<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CodeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $codes = [
            [
                'code'  => "BB3576CC10001",
                'value' => 1,
            ],
            [
                'code'  => "BB3576CC10002",
                'value' => 1,
            ],
            [
                'code'  => "BB3576CC20001",
                'value' => 2,
            ],
            [
                'code'  => "BB3576CC20002",
                'value' => 2,
            ],
            [
                'code'  => "BB3576CC40001",
                'value' => 4,
            ],
            [
                'code'  => "BB3576FM20001",
                'value' => 2,
            ],
            [
                'code'  => "BB3576FM20002",
                'value' => 2,
            ],
            [
                'code'  => "BB3576FM60001",
                'value' => 6,
            ],
            [
                'code'  => "BB3576FM60002",
                'value' => 6,
            ],
            [
                'code'  => "BB3576FM120001",
                'value' => 12,
            ],
        ];

        foreach($codes as $code){
            \App\Models\LatestCode::create($code);
        }
    }
}
