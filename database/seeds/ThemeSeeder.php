<?php

use Illuminate\Database\Seeder;
use App\Theme;

class ThemeSeeder extends Seeder
{
  private function saveTheme($name, $placeholder, $active)
  {
    $t = new Theme();
    $t->name = $name;
    $t->placeholder = $placeholder;
    $t->active = $active;
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
      array("Et si les marmottes vendaient des parpaings", "Bois ou parpaings", true),
      array("La princesse a mangé un tacos", "C'est moi qui décide", true),
      array("La physique quantique pour les nuls", "Mort et pas mort", false),
      array("La baleine de la mer rouge", "J'aurais peut-être dû tourner à droite", false),
      array("L'apartheid entre les souris et les rats", "Mangeons le même fromage", true)
    );

    for ($i=0; $i < count($themes); ++$i) {
      $this->saveTheme($themes[$i][0], $themes[$i][1], $themes[$i][2]);
    }
  }
}
