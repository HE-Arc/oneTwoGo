<?php

use Illuminate\Database\Seeder;
use App\Constraint;

class ConstraintSeeder extends Seeder
{
  private function saveConstraint($word, $active)
  {
    $c = new Constraint();
    $c->word = $word;
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
      array ('pelage', true),
      array ('objectif', false),
      array ('ragot', true),
      array ('bubulle', false),
      array ('révolution', true)
    );

    for ($i=0; $i < count($constraints); ++$i) {
      $this->saveConstraint($constraints[$i][0],$constraints[$i][1]);
    }
  }
}
