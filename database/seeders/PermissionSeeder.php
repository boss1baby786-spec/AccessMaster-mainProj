<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //

       $pages=['users','roles','permissions'];
       $actions=['create','index','delete','edit'];
       foreach($pages as $page)
        {
            foreach($actions as $action)
                {
Permission::firstOrCreate(
                       [
                     'name'=>"$page.$action",
                    "guard_name"=>"web"
                   ]
);
                }
        }
        

    }
}
