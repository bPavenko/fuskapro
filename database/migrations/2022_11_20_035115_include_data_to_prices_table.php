<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\Price;

class IncludeDataToPricesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Price::insert([
            [
                'service' => '{"ua":"Вартість VIP","en":"VIP cost","cz":"VIP cena"}',
                'cost' => 10
            ],
            [
                'service' => '{"ua":"Вартість відклику","en":"Response cost","cz":"Náklady na odezvu"}',
                'cost' => 5
            ],
            [
                'service' => '{"ua":"Вартість перегляду контактів","en":"View contacts cost","cz":"Zobrazit náklady na kontakty"}',
                'cost' => 10
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
        Schema::table('prices', function (Blueprint $table) {
            //
        });
    }
}
