<?php

namespace Database\Seeders;

use App\Models\Sitecontent;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SitecontentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    { 
        Sitecontent::create([

'name'=> 'banner', 
"content"=> json_encode([
'title' => 'EVERY CHILD YEARNS TO LEARN',  
'subtitle' => 'Making Your Childs World Better', 
'desc' => "Replenish seasons may male hath fruit beast were seas saw you arrie said man beast whales his void unto last session for bite. Set have great you'll male grass yielding yielding man"  

]) 

        ]) ;

}
}
