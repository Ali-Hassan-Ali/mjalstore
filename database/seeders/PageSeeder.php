<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Admin;
use App\Models\PAge;

class PageSeeder extends Seeder
{
    public function run(): void
    {
    	$descriptionOne = 'نسعد بوجودك لدينا في موقع مجال ستور. تنطبق شروط الإستخدام على الموقع والشركات التابعة لمجموعتنا أو شركائنا. و فضلًا عن جميع أقسامها وفروعها ومواقع الإنترنت التابعة لها التي تشير إلى هذه الشروط والأحكام كمرجع آمن لها. أيها الضيف الكريم، اثناء زيارتك للموقع، أنت تضمن موافقتك على الشروط والأحكام الحالية. وإن كنت لا توافق عليها، بإمكانك عدم إستخدام الموقع. علما بأن الموقع يحتفظ بالحق في تغيير أجزاء من شروط الاستخدام والأحكام أو تعديلها أو إضافة البعض منها، أو إزالتها في أي وقت من الأوقات. وتصبح التغييرات فعالة عندما يتم نشرها على الموقع من دون سابق إنذار. يرجى مراجعة شروط الاستخدام والأحكام بشكل منتظم لمواكبة كل التحديثات. ويشكل استخدامك المستمر للموقع موافقتك التامة على كل التغييرات التي يجري إحداثها على شروط الاستخدام والأحكام.';
    	$descriptionTow = 'يرجى الملاحظة أنه في بعض الحالات، قد لا تتم الموافقة على طلبية لعدت اسباب وعلى سبيل المثال ان كان المنتج الذي ترغب بشرائه غير متوفر أو في حال تم تسعير المنتج بطريقة خاطئة أو في حال تبين ان الطلبية إحتيالية. سوف يقوم موقع دليل ستور بإعادة ما قمت بدفعه للطلبات التي لم يتم قبولها أو التي يتم إلغاؤها. وقبل أن نوافق على الطلبية قد نطلب منك تقديم معلومات إضافية، بما في ذلك ولكن ليس على سبيل الحصر، رقم الهاتف والعنوان أو وثائق رسمية تثبت هويتك.
							جميع حقوق الملكية الفكرية على موقع مجال ستور، وكافة المعلومات والتصاميم والرسومات والكتابات والأيقونات والصور والفيديو والموسيقى والصوت والواجهات والرموز والبرامج بالإضافة إلى كيفية اختيارها وترتيبها، ملكية حصرية لموقع مجال ستور خاضعة لحماية حقوق النشر والعلامة التجارية.
							عند الشراء او ارسال بريد الإلكتروني لموقع مجال ستور أنت توافق على استلام أي ايميلات منا.
							يحق لموقع مجال ستور بأن يجري أية تعديلات أو تغييرات على الموقع وعلى السياسات والاتفاقيات المرتبطة بالموقع بما في ذلك سياسة الخصوصية وكذلك الوثيقة لأحكام وشروط الخدمة.';

    	$data = [
    		[
                'title'      		=> json_encode(['ar' => 'سياسة الاستخدام', 'en' => 'سياسة الاستخدام']),
                'description_one' 	=> json_encode(['ar' => $descriptionOne, 'en' => $descriptionOne]),
                'description_tow' 	=> json_encode(['ar' => $descriptionTow, 'en' => $descriptionTow]),
                'status'    		=> 1,
                'order'				=> 1,
                'slug'      		=> str()->slug('return policy', '-'),
                'admin_id'  		=> Admin::first()?->id,
                'created_at'		=> now(),
            ],
            [
                'title'      		=> json_encode(['ar' => 'سياسة الاسترجاع', 'en' => 'recovery policy']),
                'description_one' 	=> json_encode(['ar' => $descriptionOne, 'en' => $descriptionOne]),
                'description_tow' 	=> json_encode(['ar' => $descriptionTow, 'en' => $descriptionTow]),
                'status'    		=> 1,
                'order'				=> 2,
                'slug'      		=> str()->slug('recovery policy', '-'),
                'admin_id'  		=> Admin::first()?->id,
                'created_at'		=> now(),
            ],
            [
                'title'      		=> json_encode(['ar' => 'سياسه الخصوصيه', 'en' => 'prives policy']),
                'description_one' 	=> json_encode(['ar' => $descriptionOne, 'en' => $descriptionOne]),
                'description_tow' 	=> json_encode(['ar' => $descriptionTow, 'en' => $descriptionTow]),
                'status'    		=> 1,
                'order'				=> 3,
                'slug'      		=> str()->slug('prives policy', '-'),
                'admin_id'  		=> Admin::first()?->id,
                'created_at'		=> now(),
            ],
    	];

    	Page::insert($data);

    }//end of run

}//end of class