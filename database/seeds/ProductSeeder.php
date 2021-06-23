<?php

use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
         DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        App\Models\Product::truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
        $description='<p>Hãng thể thao Nike vừa giới thiệu áo Chelsea sân nhà 2020 &#8211; 2021 cùng nhà tài trợ mới <strong>Three</strong> vào ngày 1 tháng 7 vừa qua. Mẫu áo đấu sẽ được giới thiệu đến người hâm mộ The Blues trong trận đấu vòng 32 giải Ngoại Hạng với West Ham.</p>
        <p><img class="aligncenter size-full wp-image-14753" src="https://www.sporter.vn/wp-content/uploads/2017/06/Ao-chelsaea-san-nha-0.jpg" alt="Áo chelsea sân nhà" width="1000" height="563" srcset="https://www.sporter.vn/wp-content/uploads/2017/06/Ao-chelsaea-san-nha-0.jpg 1000w, https://www.sporter.vn/wp-content/uploads/2017/06/Ao-chelsaea-san-nha-0-710x400.jpg 710w, https://www.sporter.vn/wp-content/uploads/2017/06/Ao-chelsaea-san-nha-0-768x432.jpg 768w, https://www.sporter.vn/wp-content/uploads/2017/06/Ao-chelsaea-san-nha-0-600x338.jpg 600w" sizes="(max-width: 1000px) 100vw, 1000px" /></p>
        <h2>Áo Chelsea sân nhà 2020 -2021 hàng Thái Lan</h2>
        <p>Mẫu áo đấu sân nhà vẫn sử dụng màu sắc truyền thống Xanh dương và tạo điểm nhấn thay đổi ở chiếc cổ tròn đầy tính năng động và thể thao. Nhà tài trợ Huyndai vẫn đồng hành cùng Chelsea mùa giải năm nay.</p>
        <p><img class="alignnone wp-image-11467 size-medium" src="https://www.sporter.vn/wp-content/uploads/2017/06/Ao-chelsea-san-nha-1-2-400x400.jpg" alt="Áo chelsea sân nhà" width="400" height="400" srcset="https://www.sporter.vn/wp-content/uploads/2017/06/Ao-chelsea-san-nha-1-2-400x400.jpg 400w, https://www.sporter.vn/wp-content/uploads/2017/06/Ao-chelsea-san-nha-1-2-280x280.jpg 280w, https://www.sporter.vn/wp-content/uploads/2017/06/Ao-chelsea-san-nha-1-2-768x768.jpg 768w, https://www.sporter.vn/wp-content/uploads/2017/06/Ao-chelsea-san-nha-1-2-800x800.jpg 800w, https://www.sporter.vn/wp-content/uploads/2017/06/Ao-chelsea-san-nha-1-2-300x300.jpg 300w, https://www.sporter.vn/wp-content/uploads/2017/06/Ao-chelsea-san-nha-1-2-600x600.jpg 600w, https://www.sporter.vn/wp-content/uploads/2017/06/Ao-chelsea-san-nha-1-2-100x100.jpg 100w, https://www.sporter.vn/wp-content/uploads/2017/06/Ao-chelsea-san-nha-1-2.jpg 900w" sizes="(max-width: 400px) 100vw, 400px" /><img class="alignnone wp-image-14754 size-medium" src="https://www.sporter.vn/wp-content/uploads/2017/06/Ao-chelsaea-san-nha-1-400x400.jpg" alt="Áo chelsea sân nhà" width="400" height="400" srcset="https://www.sporter.vn/wp-content/uploads/2017/06/Ao-chelsaea-san-nha-1-400x400.jpg 400w, https://www.sporter.vn/wp-content/uploads/2017/06/Ao-chelsaea-san-nha-1-280x280.jpg 280w, https://www.sporter.vn/wp-content/uploads/2017/06/Ao-chelsaea-san-nha-1-768x768.jpg 768w, https://www.sporter.vn/wp-content/uploads/2017/06/Ao-chelsaea-san-nha-1.jpg 800w, https://www.sporter.vn/wp-content/uploads/2017/06/Ao-chelsaea-san-nha-1-300x300.jpg 300w, https://www.sporter.vn/wp-content/uploads/2017/06/Ao-chelsaea-san-nha-1-600x600.jpg 600w, https://www.sporter.vn/wp-content/uploads/2017/06/Ao-chelsaea-san-nha-1-100x100.jpg 100w" sizes="(max-width: 400px) 100vw, 400px" /></p>
        <p>Điểm nhấn của mẫu áo đấu được thể hiện ở đường kẻ sọc xanh Navy bên hông áo, cùng với khẩu hiệu: <strong>&#8220;Pride of London&#8221;. </strong>Ngoài ra, các họa tiết dập chìm nổi bên trên bề mặt áo sẽ là những điểm nổi bật trên tổng thể đơn giản của áo đấu The Blues năm nay.</p>
        <p><img class="aligncenter wp-image-14763" src="https://www.sporter.vn/wp-content/uploads/2017/06/Ao-chelsaea-san-nha-11-1024x800.jpg" alt="Áo chelsea sân nhà" width="640" height="500" srcset="https://www.sporter.vn/wp-content/uploads/2017/06/Ao-chelsaea-san-nha-11-1024x800.jpg 1024w, https://www.sporter.vn/wp-content/uploads/2017/06/Ao-chelsaea-san-nha-11-512x400.jpg 512w, https://www.sporter.vn/wp-content/uploads/2017/06/Ao-chelsaea-san-nha-11-768x600.jpg 768w, https://www.sporter.vn/wp-content/uploads/2017/06/Ao-chelsaea-san-nha-11-600x469.jpg 600w, https://www.sporter.vn/wp-content/uploads/2017/06/Ao-chelsaea-san-nha-11.jpg 1600w" sizes="(max-width: 640px) 100vw, 640px" /></p>
        <h2>Hình ảnh mẫu <a href="https://www.sporter.vn/ao-bong-da-clb/" data-wpel-link="internal">áo bóng đá</a> sân nhà Chelsea 2020 &#8211; 2021 sân nhà:</h2>
        <p><img class="aligncenter size-full wp-image-14756" src="https://www.sporter.vn/wp-content/uploads/2017/06/Ao-chelsaea-san-nha-4.jpg" alt="Áo chelsea sân nhà" width="640" height="360" srcset="https://www.sporter.vn/wp-content/uploads/2017/06/Ao-chelsaea-san-nha-4.jpg 640w, https://www.sporter.vn/wp-content/uploads/2017/06/Ao-chelsaea-san-nha-4-600x338.jpg 600w" sizes="(max-width: 640px) 100vw, 640px" /> <img class="aligncenter size-full wp-image-14762" src="https://www.sporter.vn/wp-content/uploads/2017/06/Ao-chelsaea-san-nha-10.jpg" alt="Áo chelsea sân nhà" width="640" height="567" srcset="https://www.sporter.vn/wp-content/uploads/2017/06/Ao-chelsaea-san-nha-10.jpg 640w, https://www.sporter.vn/wp-content/uploads/2017/06/Ao-chelsaea-san-nha-10-451x400.jpg 451w, https://www.sporter.vn/wp-content/uploads/2017/06/Ao-chelsaea-san-nha-10-600x532.jpg 600w" sizes="(max-width: 640px) 100vw, 640px" /> <img class="aligncenter wp-image-14761 size-full" src="https://www.sporter.vn/wp-content/uploads/2017/06/Ao-chelsaea-san-nha-9.jpg" alt="Áo chelsea sân nhà" width="640" height="928" srcset="https://www.sporter.vn/wp-content/uploads/2017/06/Ao-chelsaea-san-nha-9.jpg 640w, https://www.sporter.vn/wp-content/uploads/2017/06/Ao-chelsaea-san-nha-9-276x400.jpg 276w, https://www.sporter.vn/wp-content/uploads/2017/06/Ao-chelsaea-san-nha-9-552x800.jpg 552w, https://www.sporter.vn/wp-content/uploads/2017/06/Ao-chelsaea-san-nha-9-600x870.jpg 600w" sizes="(max-width: 640px) 100vw, 640px" /> <img class="aligncenter wp-image-14760 size-full" src="https://www.sporter.vn/wp-content/uploads/2017/06/Ao-chelsaea-san-nha-8.jpg" alt="Áo chelsea sân nhà" width="640" height="928" srcset="https://www.sporter.vn/wp-content/uploads/2017/06/Ao-chelsaea-san-nha-8.jpg 640w, https://www.sporter.vn/wp-content/uploads/2017/06/Ao-chelsaea-san-nha-8-276x400.jpg 276w, https://www.sporter.vn/wp-content/uploads/2017/06/Ao-chelsaea-san-nha-8-552x800.jpg 552w, https://www.sporter.vn/wp-content/uploads/2017/06/Ao-chelsaea-san-nha-8-600x870.jpg 600w" sizes="(max-width: 640px) 100vw, 640px" /><img class="aligncenter size-full wp-image-14759" src="https://www.sporter.vn/wp-content/uploads/2017/06/Ao-chelsaea-san-nha-7.jpg" alt="Áo chelsea sân nhà" width="640" height="733" srcset="https://www.sporter.vn/wp-content/uploads/2017/06/Ao-chelsaea-san-nha-7.jpg 640w, https://www.sporter.vn/wp-content/uploads/2017/06/Ao-chelsaea-san-nha-7-349x400.jpg 349w, https://www.sporter.vn/wp-content/uploads/2017/06/Ao-chelsaea-san-nha-7-600x687.jpg 600w" sizes="(max-width: 640px) 100vw, 640px" /> <img class="aligncenter size-full wp-image-14758" src="https://www.sporter.vn/wp-content/uploads/2017/06/Ao-chelsaea-san-nha-6.jpg" alt="Áo chelsea sân nhà" width="640" height="733" srcset="https://www.sporter.vn/wp-content/uploads/2017/06/Ao-chelsaea-san-nha-6.jpg 640w, https://www.sporter.vn/wp-content/uploads/2017/06/Ao-chelsaea-san-nha-6-349x400.jpg 349w, https://www.sporter.vn/wp-content/uploads/2017/06/Ao-chelsaea-san-nha-6-600x687.jpg 600w" sizes="(max-width: 640px) 100vw, 640px" /></p>
        <h2>Video <a href="https://www.sporter.vn/do-bong-da/" data-wpel-link="internal">đồ đá banh</a> Chelsea sân nhà 2020 &#8211; 2021:</h2>
        <p><iframe title="The Story Of Chelsea&#039;s New 2020/21 Home Kit ft. Ruud Gullit" width="1020" height="574" src="https://www.youtube.com/embed/gmbb66Iz1lE?feature=oembed" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe></p>
        <p>Bạn có thể đặt các mẫu quần áo bóng đá tại Sporter.vn với giá luôn mềm nhất, chúng tôi chuyên cung cấp các mẫu quần áo thi đấu bóng đá CLB mùa 2020 &#8211; 2021 mới nhất với các loại sau:</p>
        <h2>Áo bóng đá Chelsea sân nhà 2020 – 2021 hàng Thái Lan F1:</h2>
        <p><strong>Giá thị trường: 300.000đ/1 áo – 350.000đ/ 1 bộ.</strong><strong><br />
        Giá tại Sporter.vn: 195.000đ/ 1 áo – 260.000đ/ 1 bộ.<br />
        Đặt từ 10 bộ trở lên chỉ còn 250.000đ/ 1 bộ</strong></p>
        <p><span style="color: #ff6600"><strong>Phiên bản bodyfit sẽ có giá cao hơn đôi chút so với phiên bản thông thường.</strong></span></p>
        <p>– Đây là mẫu áo đấu đẹp nhất và gần giống nhất so với áo chính hãng, giống tới 99%, thường đường gọi là áo F1 . Đây là mẫu áo được may bằng vải Thái Lan chất lượng cao cấp giống hệt vải chính hãng.<br />
        – Ưu điểm: Đẹp giống hệt hàng chính hãng, nếu không rành sẽ rất khó phân biệt đâu là áo chính hãng, đâu là <a href="https://www.sporter.vn/ao-bong-da-thai-lan/" data-wpel-link="internal"><strong>áo bóng đá Thái Lan</strong></a> F1. Chất lượng cao, mặc mát mẻ và dễ chịu, thoải mái khi mặc. Rẻ hơn rất nhiều so với hàng chính hãng.<br />
        – Nhược điểm: Giá cao hơn các mẫu khác khá nhiều.</p>
        <h2>Áo bóng đá Chelsea sân nhà 2020 – 2021 hàng Việt Nam:</h2>
        <p><strong>Giá thị trường: 120.000đ/ 1 bộ.</strong><strong><br />
        Giá tại Sporter.vn chỉ từ: 90.000đ/ 1 bộ.<br />
        Đặt từ 10 bộ trở lên chỉ còn 85.000đ/ 1 bộ</strong></p>
        <p>– Đây là mẫu quần áo câu lạc bộ đang được bán nhiều nhất trên thị trường, thường được may bằng vải thun lạnh. Đây là hàng phổ thông nhất hiện nay.<br />
        – Ưu điểm: Giá rẻ, mặc cũng khá bền.<br />
        – Nhược điểm: Mặc nóng và thấm hút mồ hôi không tốt lắm. Chỉ giống khoảng 90% so với hàng chính hãng.</p>
        <p>&nbsp;</p>';
        $summary='<p>Mẫu quần áo bóng đá <a href="https://www.sporter.vn/ao-chelsea/" data-wpel-link="internal"><strong>Chelsea</strong></a> sân nhà, đây là mẫu quần áo bóng đá sân mùa giải mới của câu lạc bộ:<br><strong>Hàng VN:</strong>&nbsp;Giá lẻ Khuyến mãi từ 2 bộ trở lên: 90.000đ/1 bộ.<br>–Từ 10 bộ trở lên: 85.000đ/1 bộ.<br><strong>Hàng Thái Lan F1:</strong> 195.000đ/1 áo – 260.000đ/1 bộ<br>–Từ 10 bộ trở lên: 250.000đ/1 bộ<br><span style="color: #ff6600"><strong>Phiên bản bodyfit sẽ có giá cao hơn đôi chút so với phiên bản thông thường.</strong></span></';
        $data=[
            ['code'=>'SP000001','min'=>'10','weight'=>200,'unit_id'=>'1','title'=>'Áo Chelsea sân nhà 2020 – 2021','slug'=>'ao-chelsea-san-nha-2020–2021','summary'=>$summary,'description'=>$description,'photo'=>'/photos/1/product/chelsea1.jpg,/photos/1/product/chelsea2.jpg,/photos/1/product/chelsea3.jpg,/photos/1/product/chelsea4.jpg','size'=>'M,L,XL,XXL','condition'=>'new','status'=>'1','is_featured'=>'1','cat_id'=>'2','child_cat_id'=>'9'],
            ['code'=>'SP000002','min'=>'20','weight'=>200,'unit_id'=>'1','title'=>'Áo Chelsea sân khách 2020 – 2021','slug'=>'ao-chelsea-san-khách-2020–2021','summary'=>$summary,'description'=>$description,'photo'=>'/photos/1/product/chelsea_khach1.jpg,/photos/1/product/chelsea_khach2.jpg,/photos/1/product/chelsea_khach3.jpg,/photos/1/product/chelsea_khach4.jpg','size'=>'M,L,XL,XXL','condition'=>'new','status'=>'1','is_featured'=>'1','cat_id'=>'2','child_cat_id'=>'8'],
            ['code'=>'SP000003','min'=>'30','weight'=>200,'unit_id'=>'1','title'=>'Áo Chelsea thứ 3 2020 – 2021','slug'=>'ao-chelsea-thu-3-2020–2021','summary'=>$summary,'description'=>$description,'photo'=>'/photos/1/product/chelsea_thu31.jpg,/photos/1/product/chelsea_thu32.jpg','size'=>'M,L,XL,XXL','condition'=>'new','status'=>'1','is_featured'=>'1','cat_id'=>'2','child_cat_id'=>'7'],
        ];
        DB::table('products')->insert($data);
        $arr=array('Manchester United','Manchester City','Liverpool','Arsnal','Việt Nam','Đức','Anh','Pháp','Brazil');
        $arr_slug=array('manchester-united','manchester-city','liverpool','arsenal','viet-nam','duc','anh','phap','brazil');
        $k=4;
        $m=5;
        $n=6;
        for($i=0; $i<count($arr); $i++){
            $data=[
                ['code'=>'SP00000'.$k,'min'=>'10','weight'=>200,'unit_id'=>'1','title'=>'Áo '.$arr[$i].' sân nhà 2020 – 2021','slug'=>'ao-'.$arr_slug[$i].'-san-nha-2020–2021','summary'=>$summary,'description'=>$description,'photo'=>'/photos/1/product/chelsea1.jpg,/photos/1/product/chelsea2.jpg,/photos/1/product/chelsea3.jpg,/photos/1/product/chelsea4.jpg','size'=>'M,L,XL,XXL','condition'=>'new','status'=>'1','is_featured'=>'1','cat_id'=>'2','child_cat_id'=>'9'],
                ['code'=>'SP00000'.$m,'min'=>'20','weight'=>200,'unit_id'=>'1','title'=>'Áo '.$arr[$i].' sân khách 2020 – 2021','slug'=>'ao-'.$arr_slug[$i].'-san-khách-2020–2021','summary'=>$summary,'description'=>$description,'photo'=>'/photos/1/product/chelsea_khach1.jpg,/photos/1/product/chelsea_khach2.jpg,/photos/1/product/chelsea_khach3.jpg,/photos/1/product/chelsea_khach4.jpg','size'=>'M,L,XL,XXL','condition'=>'new','status'=>'1','is_featured'=>'1','cat_id'=>'2','child_cat_id'=>'8'],
                ['code'=>'SP00000'.$n,'min'=>'30','weight'=>200,'unit_id'=>'1','title'=>'Áo '.$arr[$i].' thứ 3 2020 – 2021','slug'=>'ao-'.$arr_slug[$i].'-thu-3-2020–2021','summary'=>$summary,'description'=>$description,'photo'=>'/photos/1/product/chelsea_thu31.jpg,/photos/1/product/chelsea_thu32.jpg','size'=>'M,L,XL,XXL','condition'=>'new','status'=>'1','is_featured'=>'1','cat_id'=>'2','child_cat_id'=>'7'],
            ];
            DB::table('products')->insert($data);
            $m=$m+3;
            $n=$n+3;
            $k=$k+3;
        }
    }
}
