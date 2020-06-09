<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ThoughtCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $tags = array([
            'category_name' => 'Poem', 'description' => 'It is a section where an author can write his/her poem to express their heart.', 'created_at' => \Carbon\Carbon::now()

        ], ['category_name' => 'Quotation', 'description' => 'A place where an author can write their own quotes to reach other peoples.', 'created_at' => \Carbon\Carbon::now()]);
        DB::table('thoughts_categories')->insert($tags);
    }
}
