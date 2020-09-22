<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class FileTypeTableSeeder extends Seeder
{
    /**
     * Auto generated seed file.
     *
     * @return void
     */
    public function run()
    {
        DB::table('file_type')->delete();

        DB::table('file_type')->insert([
            0 => [
                'id' => 1,
                'label' => 'Attachment',
                'value' => 'Attachment',
                'name' => 'Attachment',
                'description' => 'Contact attachment',
                'is_default' => 1,
                'is_reserved' => 0,
                'is_active' => 1,
                'deleted_at' => null,
                'remember_token' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            1 => [
                'id' => 2,
                'label' => 'Schedule',
                'value' => 'Schedule',
                'name' => 'Schedule',
                'description' => 'Retreat schedule',
                'is_default' => 0,
                'is_reserved' => 0,
                'is_active' => 1,
                'deleted_at' => null,
                'remember_token' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            2 => [
                'id' => 3,
                'label' => 'Evaluation',
                'value' => 'Evaluation',
                'name' => 'Evaluation',
                'description' => 'Retreat evaluation',
                'is_default' => 0,
                'is_reserved' => 0,
                'is_active' => 1,
                'deleted_at' => null,
                'remember_token' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            3 => [
                'id' => 4,
                'label' => 'Contract',
                'value' => 'Contract',
                'name' => 'Contract',
                'description' => 'Event contract',
                'is_default' => 0,
                'is_reserved' => 0,
                'is_active' => 1,
                'deleted_at' => null,
                'remember_token' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            4 => [
                'id' => 5,
                'label' => 'Photo',
                'value' => 'Photo',
                'name' => 'Photo',
                'description' => 'Retreat group photo',
                'is_default' => 0,
                'is_reserved' => 0,
                'is_active' => 1,
                'deleted_at' => null,
                'remember_token' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            5 => [
                'id' => 6,
                'label' => 'Avatar',
                'value' => 'Avatar',
                'name' => 'Avatar',
                'description' => 'Contact avatar',
                'is_default' => 0,
                'is_reserved' => 0,
                'is_active' => 1,
                'deleted_at' => null,
                'remember_token' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            6 => [
                'id' => 7,
                'label' => 'Event attachment',
                'value' => 'Event attachment',
                'name' => 'Event attachment',
                'description' => 'Event attachment',
                'is_default' => 0,
                'is_reserved' => 0,
                'is_active' => 1,
                'deleted_at' => null,
                'remember_token' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            7 => [
                'id' => 8,
                'label' => 'Signature',
                'value' => 'Signature',
                'name' => 'Signature',
                'description' => 'Signature',
                'is_default' => 0,
                'is_reserved' => 0,
                'is_active' => 1,
                'deleted_at' => null,
                'remember_token' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            8 => [
                'id' => 9,
                'label' => 'Asset',
                'value' => 'Asset',
                'name' => 'Asset',
                'description' => 'Picture of asset',
                'is_default' => 0,
                'is_reserved' => 0,
                'is_active' => 1,
                'deleted_at' => null,
                'remember_token' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            9 => [
                'id' => 10,
                'label' => 'Asset attachment',
                'value' => 'Asset attachment',
                'name' => 'Asset attachment',
                'description' => 'Asset attachment',
                'is_default' => 0,
                'is_reserved' => 0,
                'is_active' => 1,
                'deleted_at' => null,
                'remember_token' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}