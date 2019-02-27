<?php

use Illuminate\Database\Seeder;

use App\Album;

class albumesSeeder extends Seeder
{
   
    public function run()
    {
        DB::table('albumes')->delete();

        $album=new Album();
        $album->id_user=1;
        $album->nombre="fotos del verano";
        $album->save();

        $album=new Album();
        $album->id_user=2;
        $album->nombre="fotos de la primavera";
        $album->save();

        $album=new Album();
        $album->id_user=3;
        $album->nombre="fotos del otoño";
        $album->save();

        $album=new Album();
        $album->id_user=4;
        $album->nombre="fotos del invierno";
        $album->save();
    }
}
