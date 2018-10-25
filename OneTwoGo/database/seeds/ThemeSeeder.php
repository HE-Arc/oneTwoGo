<?php

use Illuminate\Database\Seeder;
use App\Theme;

class ThemeSeeder extends Seeder
{
  private function saveTheme($name, $placeholder)
  {
    $t = new Theme();
    $t->name = $name;
    $t->placeholder = $placeholder;
    $t->save();
  }

  /**
   * Run the database seeds.
   *
   * @return void
   */
  public function run()
  {
    $themes = array (
      array("Et si les marmottes vendaient des parpaings", "Bois ou parpaings"),
      array("La princesse a mangé un tacos", "C'est moi qui décide"),
      array("La physique quantique pour les nuls", "Mort et pas mort"),
      array("La baleine de la mer rouge", "J'aurais peut-être dû tourner à droite"),
      array("L'apartheid entre les souris et les rats", "Mangeons le même fromage")
    );

    for ($i=0; $i < count($themes); ++$i) {
      $this->saveTheme($themes[$i][0], $themes[$i][1]);
    }
  }
}
