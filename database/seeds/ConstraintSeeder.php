<?php

use Illuminate\Database\Seeder;
use App\Constraint;

class ConstraintSeeder extends Seeder
{
  private function saveConstraint($word)
  {
    $c = new Constraint();
    $c->word = $word;
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
      'pelage',
      'objectif',
      'ragot',
      'bubulle',
      'révolution'
    );

    for ($i=0; $i < count($constraints); ++$i) {
      $this->saveConstraint($constraints[$i]);
    }
  }
}
