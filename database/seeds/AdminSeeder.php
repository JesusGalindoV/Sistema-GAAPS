<?php

use Illuminate\Database\Seeder;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        if (! DB::table('admin_users')->count())
        {

            DB::table('admin_users')->insert([
                'name' => 'Demo de biblioteca',
                'lastname' => 'Demo de biblioteca',
                'email' => 'demo_biblioteca@unisierra.edu.mx',
                'password' => bcrypt("demo"),
                'area_id' => 3,
                'first_time' => 1,
                'is_departament' => 1
            ]);

            $out = new \Symfony\Component\Console\Output\ConsoleOutput();
            $out->writeln("<info>Admin users created</info>");
        }
        else
        {
            $out = new \Symfony\Component\Console\Output\ConsoleOutput();
            $out->writeln("<warning>nothing to create</warning>");
        }
    }
}
