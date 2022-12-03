<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\ApplicationsLink;

class FillApplicationsLinksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        ApplicationsLink::insert([
            [
                'name' => 'App Store',
                'url' => 'https://www.apple.com/ua/app-store/'
            ],
            [
                'name' => 'Google play',
                'url' => 'https://play.google.com/store/games'
            ]
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
