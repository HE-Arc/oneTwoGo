<?php

use Illuminate\Database\Seeder;
use App\Theme;
use App\Constraint;
use App\ConstraintTheme;

class ConstraintThemeSeeder extends Seeder
{
  private function savePivot($constraint_id, $theme_id)
  {
    DB::table('constraint_theme')->insert([
        'constraint_id' => $constraint_id,
        'theme_id' => $theme_id
    ]);
  }

  public function run()
  {
    $pivots = array (
    array(1,1),
    array(1,2),
    array(2,2),
    array(2,3),
    array(2,5),
    array(3,4),
    array(4,4)
    );

    for ($i=0; $i < count($pivots); ++$i) {
      $this->savePivot($pivots[$i][0],$pivots[$i][1]);
    }
  }
}
