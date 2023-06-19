<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Category;
use App\Models\Admin;

class SubCategorySeeder extends Seeder
{
    public function run(): void
    {
    	$description = 'في حال كنت تحب ألعاب اللوح الكلاسيكية فإن لعبة يلا لودو ستصبح لعبتك المفضلة! تجمع يلا لودو كلاً من لعبة لودو الكلاسيكية والدومينو الشهيرة، يمكنك اللعب بأنماط اللعب المختلفة، اللعب بالغرف الخاصة، الدردشة الحية مع اللاعبين لتكون اللعبة أكثر متعة كما يمكنك أيضا اللعب من دون اتصال بالأنترنت، والمزيد من المرح ينتظرك! لا يمكن استخدامها في المملكة العربية السعودية والإمارات العربية المتحدة والبحرين وعمان ومصر والمغرب وتونس والجزائر وفلسطين والأردن';

        $data = [
            [
                'name'	        => json_encode(['ar' => 'آيتونز', 'en' => 'آيتونز']),
                'title_card'    => json_encode(['ar' => 'حمل ما تريد من ألعاب PC المدفوعة', 'en' => 'حمل ما تريد من ألعاب PC المدفوعة']),
                'description' 	=> json_encode(['ar' => $description, 'en' => $description]),
                'color_1'		=> '#ff1a1a',
                'color_2'		=> '#8f06fa',
                'status'    	=> 1,
                'has_market'    => 1,
                'slug'      	=> str()->slug('آيتونز', '-'),
                'parent_id' 	=> 1,
                'admin_id'  	=> Admin::first()?->id,
                'created_at'    => now(),
            ],

            [
                'name'	        => json_encode(['ar' => 'قوقل بلاي', 'en' => 'قوقل بلاي']),
                'title_card'    => json_encode(['ar' => 'حمل ما تريد من ألعاب PC المدفوعة', 'en' => 'حمل ما تريد من ألعاب PC المدفوعة']),
                'description'  	=> json_encode(['ar' => $description, 'en' => $description]),
                'color_1'		=> '#199afe',
                'color_2'		=> '#05fadd',
                'status'    	=> 1,
                'has_market'    => 1,
                'slug'      	=> str()->slug('قوقل بلاي', '-'),
                'parent_id' 	=> 1,
                'admin_id'  	=> Admin::first()?->id,
                'created_at'    => now(),
            ],

            [
                'name'	        => json_encode(['ar' => 'هواوي', 'en' => 'هواوي']),
                'title_card'    => json_encode(['ar' => 'حمل ما تريد من ألعاب PC المدفوعة', 'en' => 'حمل ما تريد من ألعاب PC المدفوعة']),
                'description'  	=> json_encode(['ar' => $description, 'en' => $description]),
                'color_1'		=> '#faf200',
                'color_2'		=> '#05f6fa',
                'status'    	=> 1,
                'has_market'    => 1,
                'slug'      	=> str()->slug('هواوي', '-'),
                'parent_id' 	=> 1,
                'admin_id'  	=> Admin::first()?->id,
                'created_at'    => now(),
            ],
        ];

        Category::insert($data);

        $data = [
            [
                'name'	        => json_encode(['ar' => 'ببجي', 'en' => 'ببجي']),
                'title_card'    => json_encode(['ar' => 'حمل ما تريد من ألعاب PC المدفوعة', 'en' => 'حمل ما تريد من ألعاب PC المدفوعة']),
                'description'  	=> json_encode(['ar' => $description, 'en' => $description]),
                'color_1'		=> '#000000',
                'color_2'		=> '#ca48c6',
                'status'    	=> 1,
                'slug'      	=> str()->slug('ببجي', '-'),
                'parent_id' 	=> 1,
                'admin_id'  	=> Admin::first()?->id,
                'created_at'    => now(),
            ],

            [
                'name'	        => json_encode(['ar' => 'بلايستيشن', 'en' => 'بلايستيشن']),
                'title_card'    => json_encode(['ar' => 'حمل ما تريد من ألعاب PC المدفوعة', 'en' => 'حمل ما تريد من ألعاب PC المدفوعة']),
                'description'  	=> json_encode(['ar' => $description, 'en' => $description]),
                'color_1'		=> '#000000',
                'color_2'		=> '#ca48c6',
                'status'    	=> 1,
                'slug'      	=> str()->slug('بلايستيشن', '-'),
                'parent_id' 	=> 1,
                'admin_id'  	=> Admin::first()?->id,
                'created_at'    => now(),
            ],

            [
                'name'	        => json_encode(['ar' => 'فري فاير', 'en' => 'فري فاير']),
                'title_card'    => json_encode(['ar' => 'حمل ما تريد من ألعاب PC المدفوعة', 'en' => 'حمل ما تريد من ألعاب PC المدفوعة']),
                'description'  	=> json_encode(['ar' => $description, 'en' => $description]),
                'color_1'		=> '#000000',
                'color_2'		=> '#ca48c6',
                'status'    	=> 1,
                'slug'      	=> str()->slug('فري فاير', '-'),
                'parent_id' 	=> 1,
                'admin_id'  	=> Admin::first()?->id,
                'created_at'    => now(),
            ],
        ];

        Category::insert($data);

    }//end of run

}//end of class