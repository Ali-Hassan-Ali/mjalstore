<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use App\Models\Admin;

class SettingSeeder extends Seeder
{
    public function run(): void
    {
        // websit
    	$this->webSite();
        
        // aboutPage
        $this->aboutPage();

        // contact
        $this->contact();

        // media
        $this->media();


    }//end of run

    protected function webSite()
    {
        $websitTitle = ['ar' => 'مجال استور', 'en' => 'mjastore'];
        $websiDes    = ['ar' => 'مجال ستور يضمن لزبائنها أفضل الأسعار, نحن نضمن لك أنك لن تجد عرضا أفضل من العروض الموجودة على موقعنا.', 'en' => ''];

        saveTransSetting('websit_title', json_encode($websitTitle));
        saveTransSetting('websit_description', json_encode($websiDes));
        
    }//end mof webSite

    protected function aboutPage()
    {
        $aboutPageTitle       = ['ar' => 'من نحن', 'en' => 'About Us'];
        $aboutPageDescription = ['ar' => 'هذا نص تجريبي لاختبار شكل و حجم النصوص و طريقة عرضهاi في هذا المكان و حجم و لون الخط حيث يتم التحكم في هذا النص وامكانية تغييرة في اي وقت عن طريق ادارة الموقع . يتم اضافة هذا النص كنص تجريبي للمعاينة . هذا نص تجريبي لاختبار شكل و حجم النصوص و طريقة عرضهاi في هذا المكان و حجم و لون الخط حيث يتم التحكم في هذا النص وامكانية تغييرة في اي وقت عن طريق ادارة الموقع . يتم اضافة هذا النص كنص تجريبي للمعاينة .', 'en' => ''];

        saveTransSetting('about_page_title', json_encode($aboutPageTitle));
        saveTransSetting('about_page_description', json_encode($aboutPageDescription));
        
    }//end mof aboutPage

    protected function contact()
    {
        $items = ['phone' => '(+800) 123 456 7890', 'email' => 'manager@shop.com', 'address' => 'Location store test', 'address_link' => 'http://mjastore.test'];
        
        foreach ($items as $key=>$value) {
            saveTransSetting('contact_' . $key, $value);
        }
        
    }//end mof contact

    protected function media()
    {
        $items = $items = ['facebook' => 'https://www.facebook.com/', 'twitter' => 'https://twitter.com/', 'instagram'  => 'https://www.instagram.com/', 'video_links' => 'https://www.youtube.com/watch?v=_cos-M5TbC8', 'google_play' => 'https://test.com/', 'apple_store' => 'https://test.com/'];
        
        foreach ($items as $key=>$value) {
            saveTransSetting('media_' . $key, $value);
        }
        
    }//end mof media

}//end of class