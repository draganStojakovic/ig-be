<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Post>
 */
class PostFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $validImgUrls = collect([
            'https://fujifilm-x.com/wp-content/uploads/2021/01/gfx100s_sample_04_thum-1.jpg',
            'https://www.cameraegg.org/wp-content/uploads/2015/06/canon-powershot-g3-x-sample-images-1.jpg',
            'https://fujifilm-x.com/wp-content/uploads/2019/08/xc16-50mmf35-56-ois-2_sample-images03.jpg',
            'https://nikonrumors.com/wp-content/uploads/2014/03/Nikon-1-V3-sample-photo.jpg',
            'https://live.staticflickr.com/3935/15607410112_004c958f33_b.jpg',
            'https://www.isixsigma.com/wp-content/uploads/2019/09/The-Importance-of-Sample-Size.jpg',
            'https://cdn.pixabay.com/photo/2022/01/28/18/32/leaves-6975462__340.png',
            'https://storage.googleapis.com/pod_public/1300/88149.jpg',
            'https://i.pinimg.com/736x/44/29/f0/4429f02128255f000ff0f11e03fc2cb2.jpg',
            'https://img.freepik.com/free-photo/wide-angle-shot-single-tree-growing-clouded-sky-during-sunset-surrounded-by-grass_181624-22807.jpg',
            'https://www.rd.com/wp-content/uploads/2020/04/GettyImages-1093840488-5-scaled.jpg',
            'https://www.mobygames.com/images/covers/l/95138-arrow-flash-genesis-front-cover.jpg',
            'https://www.playnplay.net/wp-content/uploads/2022/03/musha-genesis-3.jpg',
            'https://cdn-japantimes.com/wp-content/uploads/2020/11/np_file_54227.jpeg',
            'https://upload.wikimedia.org/wikipedia/commons/a/a8/IMG_2450_%C5%A0i%C5%A1a_kod_Klju%C4%8Da.jpg',
            'https://www.srbijanadlanu.rs/wordpress/wp-content/uploads/2020/06/Fruska-gora-2%d0%b1-flickr.com_.jpg',
            'https://www.traveltonovisad.com/wp-content/uploads/2017/03/fruska-gora.jpg',
            'https://cdn.holiday-link.com/images/article/biokovo-70-makarska_145838873514.jpg',
            'https://i.croatiaimages.com/articles/3/view-of-makarska-riviera-from-biokovo-1-l.jpg',
            'https://www.indiewire.com/wp-content/uploads/2019/06/end-of-evangelion.jpg',
            'https://upload.wikimedia.org/wikipedia/commons/thumb/c/c8/Altja_j%C3%B5gi_Lahemaal.jpg/1200px-Altja_j%C3%B5gi_Lahemaal.jpg',
            'https://wallpapercave.com/wp/wp4088639.jpg',
            'https://wallpapercave.com/wp/wp11489561.jpg',
            'https://www.syfy.com/sites/syfy/files/styles/scale--1200/public/2020/06/ecco_screenshot.jpg',
            'https://m.media-amazon.com/images/I/71Lt+M9uXsL._AC_SL1200_.jpg',
            'https://autoworks-nj.com/wp-content/uploads/2016/04/Marlboro-Car-Amplifiers.jpg',
            'https://i.ebayimg.com/images/g/hFYAAOSw3KRiXFDW/s-l1600.jpg',
            'https://mixmag.asia/assets/uploads/images/_columns2/daft-punk-homework-equipment-gear.jpg',
        ]);

        return [
            'title' => fake()->words(5, true),
            'description' => fake()->sentences(6, true),
            'image_urls' => $validImgUrls->random(5),
        ];
    }
}
