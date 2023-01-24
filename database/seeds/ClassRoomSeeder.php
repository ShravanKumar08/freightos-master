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
                'days' => [1, 3]
            ],[
                'name' => 'Class B',
                'days' => [1, 4, 6]
            ],[
                'name' => 'Class C',
                'days' => [2, 5, 6]
            ]
        ];

        foreach ($classes as $class) {
            $model = new ClassRoom();
            $model->fill($class);
            $model->save();
        }
    }
}
