<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UsersTableSeeder::class);
        $user = new \App\User();
        $user->name = 'Admin';
        $user->email = 'admin@desiformal.com';
        $user->password = Hash::make('123456');
        $user->save();

        \App\Model\Admincp\Portfolio::create([
            'name' => 'ผลงานที่1',
            'client' => 'ลูกค้า1',
            'link' => 'ลิงค์1',
            'smallpic' => 'Fls8LXgAqq.png',
            'fullpic' => 'sMs2JUIvrV.png'
        ]);

        \App\Model\Admincp\Portfolio::create([
            'name' => 'ผลงานที่2',
            'client' => 'ลูกค้า2',
            'link' => 'ลิงค์2',
            'smallpic' => '7Ug0bsmxTV.jpg',
            'fullpic' => '934XPpaHqD.jpg'
        ]);

        \App\Model\Admincp\Portfolio::create([
            'name' => 'ผลงานที่3',
            'client' => 'ลูกค้า3',
            'link' => 'ลิงค์3',
            'smallpic' => 'twKIn978jM.jpeg',
            'fullpic' => 'RGbEM8wS8v.jpeg'
        ]);

        \App\Model\Admincp\Portfolio::create([
            'name' => 'ผลงานที่4',
            'client' => 'ลูกค้า4',
            'link' => 'ลิงค์4',
            'smallpic' => 'sxhn2lskXG.jpeg',
            'fullpic' => 'qP3kUR023j.jpeg'
        ]);

        \App\Model\Admincp\Portfolio::create([
            'name' => 'ผลงานที่5',
            'client' => 'ลูกค้า5',
            'link' => 'ลิงค์5',
            'smallpic' => 'brQ7HLPV74.png',
            'fullpic' => 'U0KxqWoDZq.png'
        ]);
    }
}
