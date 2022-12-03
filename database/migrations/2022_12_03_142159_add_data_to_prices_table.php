<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\Price;

class AddDataToPricesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Price::where('id' , 2)->update(['service' => '{"ua":"Вартість оголошення","en":"Order cost","cz":"Náklady na reklamu"}']);
        Price::where('id' , 3)->update(['service' => '{"ua":"Вартість перегляду контактів користувачів","en":"User contacts cost","cz":"Cena kontaktů uživatele"}']);
        Price::insert([
            [
                'service' => '{"ua":"Вартість перегляду контактів спеціалістів","en":"Specialist contacts cost","cz":"Cena kontaktů specialistů"}',
                'cost' => 10
            ],
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
    }
}
