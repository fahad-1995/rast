<?php $title = 'Home Page';
require_once 'admin/template/header.php';
require_once 'config/database.php';
require_once 'classes/User.php';

$user = new User;

if(!$user->isAdmin()){
    require_once './templet/header.php';
    echo "
    <div class=\"container\">
        <div class=\"text-center\" >
            <br>
                <h1>لا يمكن العثور على الصفحة</h1>
            <br>
        </div>
        </div>    
    ";
    require_once './templet/footer.php';
    die();
}
?>



<div class="text-center">
    <hr>
    <h2 >مرحبا بك بصفحة الادمن</h2>
    <hr>
    <div class="card text-center">    
        <div class="card">
        <div class="card-header">
        <h5 class="card-title">لوحة التحكم</h5>
            </div>
            <div class="card-body">
                <a class="btn  btn-secondary" href="./admin/artist/viewArtist.php">عرض الفنانين</a>
                <a class="btn  btn-secondary" href="./admin/artist/addArtist.php"> اضف فنان</a>
                <a class="btn  btn-secondary" href="./admin/song/viewSongs.php"> عرض الأغاني</a>
                <a class="btn  btn-secondary" href="./admin/song/addSong.php"> اضف أغنية</a>
                <a class="btn  btn-danger" href="logout.php">تسجيل الخروج</a>
            </div>
        </div>
    
    </div>
</div>



<?php require_once 'admin/template/footer.php' ?>