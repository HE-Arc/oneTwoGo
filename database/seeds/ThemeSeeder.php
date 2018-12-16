<?php

use Illuminate\Database\Seeder;
use App\Theme;
use App\Constraint;

class ThemeSeeder extends Seeder
{
    private function saveTheme($name, $placeholder, $active)
    {
        $t = new Theme();
        $t->name = $name;
        $t->placeholder = $placeholder;
        $t->active = $active;
        $t->save();
        return $t->id;
    }

    private function savePivot($constraint_id, $theme_id)
    {
        DB::table('constraint_theme')->insert([
        'constraint_id' => $constraint_id,
        'theme_id' => $theme_id
        ]);
    }

    private function saveConstraint($word, $use, $active)
    {
        $c = new Constraint();
        $c->word = $word;
        $c->use = $use;
        $c->active = $active;
        $c->save();
        return $c->id;
    }

    private function seedTheme($filename)
    {
        $json = File::get($filename);
        $data = json_decode($json);
        $themeid = $this->saveTheme($data->themename, $data->placeholder, random_int(0,10) != 0);
        foreach($data->constraints as $constraint)
        {
            try
            {
                $constraintid = $this->saveConstraint($constraint->word, $constraint->use, random_int(0,10) != 0);
            }
            catch(Exception $e)
            {
                $constraintid = Constraint::where('word', $constraint->word)->first()->id;
            }
            try
            {
                $this->savePivot($constraintid, $themeid);
            }
            catch(Exception $e)
            {
                echo "double in : ".$data->themename." :".$constraint."\n";
            }
        }
    }

    /**
    * Run the database seeds.
    *
    * @return void
    */
    public function run()
    {
        // Pour le seeding de thème, utilisation de https://www.rimessolides.com pour trouver des mots par champs lexicale
        $folder = "database/data/";
        $files = scandir($folder);
        unset($files[0]);
        unset($files[1]);
        foreach($files as $file)
        {
            $path = $folder.$file;
            $this->seedTheme($path);
        }
    }
}
