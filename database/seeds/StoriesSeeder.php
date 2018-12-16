<?php

use Carbon\Carbon;
use Illuminate\Database\Seeder;

class StoriesSeeder extends Seeder
{
    private function savePivot($constraint_id, $story_id)
    {
        DB::table('constraint_story')->insert([
        'constraint_id' => $constraint_id,
        'story_id' => $story_id
        ]);
    }

    /**
     * Run the database seeds.
     * 'theme_id' => 1,
     * @return void
     */
    public function run()
    {
      $id = DB::table('stories')->insertGetId(
        [
          'user_id' => 1,
          'theme_id' => 1,
          'title' => 'L\'histoire tragique d\'un grand père',
          'text' => 'Mourant, allongé sur le lit dans sa chambre, un vieillard distingue une merveilleuse odeur de tarte aux pommes...
          Il demanda a son petit fils : "Petit, va donc pour ton héros chercher une part de tarte aux pommes, elle sent tellement bon, ce serait un crime de m\'en priver... "
          Le gamin part demander à sa mère s\'il peut prendre une part.
          Il revient alors dans la chambre les mains vides, en disant :
          "Maman a dit que la tarte c\'était pour après l\'enterrement !',
          'deleteVoted' => 0,
          'created_at' => Carbon::now()
        ]
      );

      $this->savePivot($id, 8);
      $this->savePivot($id, 9);

        $id = DB::table('stories')->insertGetId(
          [
            'user_id' => 2,
            'theme_id' => 2,
            'title' => 'Ménagerie en papier',
            'text' => 'La mère de Jack peut donner vie à des animaux en papier grâce à un puissant rituel. Au début, Jack les aime et passe des heures avec sa mère. Mais dès qu\'il a grandi, il cesse de lui parler car elle est incapable de converser en anglais.
Lorsque sa mère tente de lui parler à travers ses créations, il les tue et les collecte dans une boîte. Après une perte tragique, il apprend enfin à connaître son histoire à travers un message caché qu\'il aurait dû lire il y a longtemps.',
            'deleteVoted' => 0,
            'created_at' => Carbon::now()
          ]
        );

        $this->savePivot($id, 157);
        $this->savePivot($id, 158);

        $id = DB::table('stories')->insertGetId(
          [
            'user_id' => 1,
            'theme_id' => 3,
            'title' => 'Harrison Bergeron',
            'text' => 'Nous sommes en 2081 et tous ont été rendus égaux par la force. Pour ce faire, chaque personne qui est supérieure de quelque manière que ce soit a été handicapée (ce qui empêche toute personne de tirer pleinement parti de ses capacités) par le gouvernement.
Les personnes intelligentes sont distraites par des bruits dérangeants. Les bons danseurs doivent porter des poids pour ne pas trop bien danser. Les personnes attrayantes portent des masques laids afin de ne pas paraître mieux que quiconque. Cependant, un jour il y a une abominable rébellion et tout change pour un bref instant.',
            'deleteVoted' => 0,
            'created_at' => Carbon::now()
          ]
        );

        $this->savePivot($id, 213);
        $this->savePivot($id, 214);

        $id = DB::table('stories')->insertGetId(
          [
            'user_id' => 2,
            'theme_id' => 4,
            'title' => 'Extrait de «Little Dorrit»',
            'text' => 'Dorrit est une enfant dont le père est en prison pour piraterie depuis qu\'elle se souvient. Incapables de payer leurs dettes, toute la famille est obligée de passer ses journées dans une cellule.
Dorrit pense au monde extérieur et a hâte de le voir. Cet extrait vous présente la famille et sa vie en prison. Le roman explique comment ils réussissent à sortir et comment Dorrit n\'oublie jamais la gentillesse des personnes qui l\'ont aidée.',
            'deleteVoted' => 0,
            'created_at' => Carbon::now()
          ]
        );

        $this->savePivot($id, 308);
        $this->savePivot($id, 309);

        $id = DB::table('stories')->insertGetId(
          [
            'user_id' => 1,
            'theme_id' => 5,
            'title' => 'L\'histoire d\'une heure',
            'text' => 'Mme Mallard a des problèmes cardiaques qui pourraient la tuer. Quand son mari meurt, les gens qui viennent lui donner cette nouvelle essaient de le faire gentiment. Quand elle est finalement informée, elle éclate en sanglots. Finalement, elle va dans sa chambre et s’enferme.
Cependant, tout en pensant à l’avenir, elle est enthousiasmée par l’idée de liberté qui pourrait découler de la présente mort de son mari. Au bout d\'une heure, la sonnette sonne à la porte et son mari est debout, bien vivant. Quand elle le voit, elle fait une crise cardiaque et meurt.',
            'deleteVoted' => 0,
            'created_at' => Carbon::now()
          ]
        );

        $this->savePivot($id, 429);
        $this->savePivot($id, 431);

        $id = DB::table('stories')->insertGetId(
          [
            'user_id' => 1,
            'theme_id' => 2,
            'title' => 'Fantômes et vides',
            'text' => 'Je suis devenu en quelque sorte une femme qui crie et, parce que je ne veux pas être une femme qui crie, dont les petits enfants se promènent avec des visages figés et vigilants, je me suis mise à laçage sur mes espadrilles après le dîner et Promenez-vous dans des rues pavées, laissant le déshabillage, la lecture, le chant et la rentrée des garçons à mon mari, un homme qui ne crie pas. Le quartier s\'assombrit pendant que je marche et un deuxième quartier se déroule au sommet de celui de la journée. Nous avons peu de réverbères, et ceux que je passe sous font mon ombre; il est à la traîne derrière moi, galope, gambade devant. La seule autre illumination vient des fenêtres des maisons que je croise et de la lune qui m\'ordonne de lever les yeux! Des chats sauvages filent sous les pieds, des fleurs d\'oiseaux de paradis ressortent de l\'ombre, des odeurs sont expirées dans l\'air: poussière de chêne, moisissure visqueuse, camphre. Le nord de la Floride est froid en janvier et je marche vite pour me réchauffer, mais aussi parce que, même si le quartier est ancien - d’immenses maisons victoriennes rayonnant dans des bungalows construits dans des années 1920, puis des ranchs modernes du milieu du siècle - c’est imparfaitement sûr. Il y a eu un viol il y a un mois, une joggeuse d\'une cinquantaine d\'années tirée dans les azalées; et, il y a une semaine, une meute de pit-bulls a écrasé une mère avec un bébé dans sa poussette et l\'a malmenée, mais pas à en mourir. Ce n’est pas la faute des chiens, c’est la faute des propriétaires! Les amoureux des chiens ont crié sur la liste de courrier électronique du quartier, et c’est vrai, c’était la faute des propriétaires, mais ces chiens étaient aussi de ces créatures. Lors de la construction de la banlieue, dans les années soixante-dix, les maisons historiques du centre-ville ont été abandonnées aux étudiants diplômés qui chauffaient les haricots au-dessus des brûleurs Bunsen sur les sols en pin des cœurs et découpaient les appartements dans des salles de bal. Lorsque la négligence et l\'humidité ont fait en sorte que les maisons pourrissent, tombent et développent des écailles rouillées, il y a eu un deuxième abandon, au profit des pauvres, des squatters. Nous avons déménagé ici il y a dix ans parce que notre maison était bon marché et que nous avions des ossements vierges, et que je décidais que si je devais vivre dans le Sud, avec ses arachides bouillies et sa mousse espagnole pendante comme des poils des aisselles, du moins je ne le ferais pas. t me barricader avec ma blancheur dans une communauté fermée. N\'est-ce pas? . . risqué? Les gens de nos parents diraient, grimaçant, quand nous leur avons dit où nous vivions, et il a fallu toute ma volonté pour ne pas dire, tu veux dire noir, ou juste pauvre? Parce que c\'était les deux.',
            'deleteVoted' => 0,
            'created_at' => Carbon::now()
          ]
          );

          $this->savePivot($id, 207);
          $this->savePivot($id, 209);
    }

    private function savePivot($story_id, $constraint_id)
    {
        DB::table('constraint_story')->insert([
        'constraint_id' => $constraint_id,
        'story_id' => $story_id
        ]);
    }
}
