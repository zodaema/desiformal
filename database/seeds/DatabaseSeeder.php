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

        $portfolio = new \App\Model\Admincp\Portfolio();
        $portfolio->name = 'ผลงานที่1';
        $portfolio->client = 'ลูกค้า1';
        $portfolio->link = 'ลิงค์1';
        $portfolio->smallpic = 'Fls8LXgAqq.png';
        $portfolio->fullpic = 'sMs2JUIvrV.png';
        $portfolio->save();

        $portfolio->name = 'ผลงานที่2';
        $portfolio->client = 'ลูกค้า2';
        $portfolio->link = 'ลิงค์2';
        $portfolio->smallpic = '7Ug0bsmxTV.jpg';
        $portfolio->fullpic = '934XPpaHqD.jpg';
        $portfolio->save();

        $portfolio->name = 'ผลงานที่3';
        $portfolio->client = 'ลูกค้า3';
        $portfolio->link = 'ลิงค์3';
        $portfolio->smallpic = 'twKIn978jM.jpeg';
        $portfolio->fullpic = 'RGbEM8wS8v.jpeg';
        $portfolio->save();

        $portfolio->name = 'ผลงานที่4';
        $portfolio->client = 'ลูกค้า4';
        $portfolio->link = 'ลิงค์4';
        $portfolio->smallpic = 'sxhn2lskXG.jpeg';
        $portfolio->fullpic = 'qP3kUR023j.jpeg';
        $portfolio->save();

        $portfolio->name = 'ผลงานที่5';
        $portfolio->client = 'ลูกค้า5';
        $portfolio->link = 'ลิงค์5';
        $portfolio->smallpic = 'brQ7HLPV74.png';
        $portfolio->fullpic = 'U0KxqWoDZq.png';
        $portfolio->save();
    }
}
