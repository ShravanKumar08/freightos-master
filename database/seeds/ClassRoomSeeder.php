<?php

use App\ClassRoom;
use Illuminate\Database\Seeder;

class ClassRoomSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $classes = [
            [
                'name' => 'Class A',
                'days' => [1, 3],
                'capacity' => '10',
                'start_time' => '02:00:00',
                'end_time' => '20:00:00'
            ],[
                'name' => 'Class B',
                'days' => [1, 4, 6],
                'capacity' => '15',
                'start_time' => '02:00:00',
                'end_time' => '20:00:00'
            ],[
                'name' => 'Class C',
                'days' => [2, 5, 6],
                'capacity' => '7',
                'start_time' => '02:00:00',
                'end_time' => '24:00:00'
            ]
        ];

        foreach ($classes as $class) {
            $model = new ClassRoom();
            $model->fill($class);
            $model->save();
        }
    }
}
