<?php

use Carbon\Carbon;
use Illuminate\Database\Seeder;

class StoriesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     * 'theme_id' => 1,
     * @return void
     */
    public function run()
    {
      DB::table('stories')->insert(
        [
          'user_id' => 1,
          'theme_id' => 1,
          'title' => 'L\'histoire tragique d\'un grand père',
          'text' => 'Mourant, allongé sur le lit dans sa chambre, un vieillard distingue une merveilleuse odeur de tarte aux pommes provenant de la cuisine...
          Il demanda a son petit fils : "Petit, va donc me chercher une part de tarte aux pommes, elle sent tellement bon, ce serai certainement un de mes derniers plaisir avant de mourir... "
          Le gamin part demander à sa mère s\'il peut prendre une part.
          Il revient alors dans la chambre les mains vident, en disant :
          "Maman a dit que la tarte c\'était pour après l\'enterrement !',
          'deleteVoted' => 0,
          'created_at' => Carbon::now()
        ]
      );

        DB::table('stories')->insert(
          [
            'user_id' => 2,
            'theme_id' => 2,
            'title' => 'Ménagerie en papier',
            'text' => 'La mère de Jack peut donner vie à des animaux en papier. Au début, Jack les aime et passe des heures avec sa mère. Mais dès qu\'il a grandi, il cesse de lui parler car elle est incapable de converser en anglais.
            Lorsque sa mère tente de lui parler à travers ses créations, il les tue et les collecte dans une boîte. Après une perte tragique, il apprend enfin à connaître son histoire à travers un message caché qu\'il aurait dû lire il y a longtemps.',
            'deleteVoted' => 0,
            'created_at' => Carbon::now()
          ]
        );

        DB::table('stories')->insert(
          [
            'user_id' => 1,
            'theme_id' => 3,
            'title' => 'Harrison Bergeron',
            'text' => 'Nous sommes en 2081 et tous ont été rendus égaux par la force. Pour ce faire, chaque personne qui est supérieure de quelque manière que ce soit a été handicapée (ce qui empêche toute personne de tirer pleinement parti de ses capacités) par le gouvernement.
            Les personnes intelligentes sont distraites par des bruits dérangeants. Les bons danseurs doivent porter des poids pour ne pas trop bien danser. Les personnes attrayantes portent des masques laids afin de ne pas paraître mieux que quiconque. Cependant, un jour il y a une rébellion et tout change pour un bref instant.',
            'deleteVoted' => 0,
            'created_at' => Carbon::now()
          ]
        );

        DB::table('stories')->insert(
          [
            'user_id' => 2,
            'theme_id' => 4,
            'title' => 'Extrait de «Little Dorrit»',
            'text' => 'Dorrit est une enfant dont le père est en prison depuis qu\'elle se souvient. Incapables de payer leurs dettes, toute la famille est obligée de passer ses journées dans une cellule.
            Dorrit pense au monde extérieur et a hâte de le voir. Cet extrait vous présente la famille et sa vie en prison. Le roman explique comment ils réussissent à sortir et comment Dorrit n\'oublie jamais la gentillesse des personnes qui l\'ont aidée.',
            'deleteVoted' => 0,
            'created_at' => Carbon::now()
          ]
        );

        DB::table('stories')->insert(
          [
            'user_id' => 1,
            'theme_id' => 5,
            'title' => 'L\'histoire d\'une heure',
            'text' => 'Mme Mallard a des problèmes cardiaques qui pourraient la tuer. Quand son mari meurt, les gens qui viennent lui donner cette nouvelle essaient de le faire gentiment. Quand elle est finalement informée, elle éclate en sanglots. Finalement, elle va dans sa chambre et s’enferme.
            Cependant, tout en pensant à l’avenir, elle est enthousiasmée par l’idée de liberté qui pourrait découler de la mort de son mari. Au bout d\'une heure, la sonnette sonne à la porte et son mari est debout, bien vivant. Quand elle le voit, elle fait une crise cardiaque et meurt.',
            'deleteVoted' => 0,
            'created_at' => Carbon::now()
          ]
        );
    }
}
