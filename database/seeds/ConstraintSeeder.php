<?php

use Illuminate\Database\Seeder;
use App\Constraint;

class ConstraintSeeder extends Seeder
{
  private function saveConstraint($word, $use, $active)
  {
    $c = new Constraint();
    $c->word = $word;
    $c->use = $use;
    $c->active = $active;
    $c->save();
  }

  /**
   * Run the database seeds.
   *
   * @return void
   */
  public function run()
  {
    $constraints = array (
      array ('pelage', true, true),
      array ('objectif', true, false),
      array ('ragot', true, true),
      array ('bubulle', true, false),
      array ('révolution', true, true),
      array('poil', false, true),
      array('nain', false, true),
      array('cochon', false, true)
    );

    for ($i=0; $i < count($constraints); ++$i) {
      $this->saveConstraint($constraints[$i][0],$constraints[$i][1],$constraints[$i][2]);
    }
  }
}
