<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CivicrmParticipantStatusTypeTableSeeder extends Seeder
{
    /**
     * Auto generated seed file.
     *
     * @return void
     */
    public function run()
    {
        DB::table('civicrm_participant_status_type')->delete();

        DB::table('civicrm_participant_status_type')->insert([
            0 => [
                'id' => 1,
                'name' => 'Registered',
                'label' => 'Registered',
                'class' => 'Positive',
                'is_reserved' => 1,
                'is_active' => 1,
                'is_counted' => 1,
                'weight' => 1,
                'visibility_id' => 1,
            ],
            1 => [
                'id' => 2,
                'name' => 'Attended',
                'label' => 'Attended',
                'class' => 'Positive',
                'is_reserved' => 0,
                'is_active' => 1,
                'is_counted' => 1,
                'weight' => 2,
                'visibility_id' => 2,
            ],
            2 => [
                'id' => 3,
                'name' => 'No-show',
                'label' => 'No-show',
                'class' => 'Negative',
                'is_reserved' => 0,
                'is_active' => 1,
                'is_counted' => 0,
                'weight' => 3,
                'visibility_id' => 2,
            ],
            3 => [
                'id' => 4,
                'name' => 'Canceled',
                'label' => 'Canceled',
                'class' => 'Negative',
                'is_reserved' => 1,
                'is_active' => 1,
                'is_counted' => 0,
                'weight' => 4,
                'visibility_id' => 2,
            ],
            4 => [
                'id' => 5,
                'name' => 'Pending from pay later',
            'label' => 'Pending (pay later)',
                'class' => 'Pending',
                'is_reserved' => 1,
                'is_active' => 1,
                'is_counted' => 1,
                'weight' => 5,
                'visibility_id' => 2,
            ],
            5 => [
                'id' => 6,
                'name' => 'Pending from incomplete transaction',
            'label' => 'Pending (incomplete transaction)',
                'class' => 'Pending',
                'is_reserved' => 1,
                'is_active' => 1,
                'is_counted' => 0,
                'weight' => 6,
                'visibility_id' => 2,
            ],
            6 => [
                'id' => 7,
                'name' => 'On waitlist',
                'label' => 'On waitlist',
                'class' => 'Waiting',
                'is_reserved' => 1,
                'is_active' => 1,
                'is_counted' => 0,
                'weight' => 7,
                'visibility_id' => 2,
            ],
            7 => [
                'id' => 8,
                'name' => 'Awaiting approval',
                'label' => 'Awaiting approval',
                'class' => 'Waiting',
                'is_reserved' => 1,
                'is_active' => 1,
                'is_counted' => 1,
                'weight' => 8,
                'visibility_id' => 2,
            ],
            8 => [
                'id' => 9,
                'name' => 'Pending from waitlist',
                'label' => 'Pending from waitlist',
                'class' => 'Pending',
                'is_reserved' => 1,
                'is_active' => 1,
                'is_counted' => 1,
                'weight' => 9,
                'visibility_id' => 2,
            ],
            9 => [
                'id' => 10,
                'name' => 'Pending from approval',
                'label' => 'Pending from approval',
                'class' => 'Pending',
                'is_reserved' => 1,
                'is_active' => 1,
                'is_counted' => 1,
                'weight' => 10,
                'visibility_id' => 2,
            ],
            10 => [
                'id' => 11,
                'name' => 'Rejected',
                'label' => 'Rejected',
                'class' => 'Negative',
                'is_reserved' => 1,
                'is_active' => 1,
                'is_counted' => 0,
                'weight' => 11,
                'visibility_id' => 2,
            ],
            11 => [
                'id' => 12,
                'name' => 'Expired',
                'label' => 'Expired',
                'class' => 'Negative',
                'is_reserved' => 1,
                'is_active' => 1,
                'is_counted' => 0,
                'weight' => 12,
                'visibility_id' => 2,
            ],
            12 => [
                'id' => 13,
                'name' => 'Pending in cart',
                'label' => 'Pending in cart',
                'class' => 'Pending',
                'is_reserved' => 1,
                'is_active' => 1,
                'is_counted' => 0,
                'weight' => 13,
                'visibility_id' => 2,
            ],
            13 => [
                'id' => 14,
                'name' => 'Course Completed',
                'label' => 'Course Completed',
                'class' => 'Positive',
                'is_reserved' => null,
                'is_active' => 1,
                'is_counted' => 0,
                'weight' => 14,
                'visibility_id' => 2,
            ],
            14 => [
                'id' => 15,
                'name' => 'Withdrew',
                'label' => 'Withdrew',
                'class' => 'Positive',
                'is_reserved' => null,
                'is_active' => 1,
                'is_counted' => 0,
                'weight' => 15,
                'visibility_id' => 2,
            ],
            15 => [
                'id' => 16,
                'name' => 'Ongoing Retreat',
                'label' => 'Ongoing Retreatant',
                'class' => 'Positive',
                'is_reserved' => null,
                'is_active' => 1,
                'is_counted' => 0,
                'weight' => 16,
                'visibility_id' => 2,
            ],
            16 => [
                'id' => 17,
                'name' => 'Partially paid',
                'label' => 'Partially paid',
                'class' => 'Positive',
                'is_reserved' => 1,
                'is_active' => 1,
                'is_counted' => 1,
                'weight' => 17,
                'visibility_id' => 2,
            ],
            17 => [
                'id' => 18,
                'name' => 'Pending refund',
                'label' => 'Pending refund',
                'class' => 'Positive',
                'is_reserved' => 1,
                'is_active' => 1,
                'is_counted' => 1,
                'weight' => 18,
                'visibility_id' => 2,
            ],
            18 => [
                'id' => 19,
                'name' => 'Transferred',
                'label' => 'Transferred',
                'class' => 'Negative',
                'is_reserved' => 1,
                'is_active' => 1,
                'is_counted' => 0,
                'weight' => 16,
                'visibility_id' => 2,
            ],
        ]);
    }
}
