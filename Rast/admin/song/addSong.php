<?php
require_once './../../admin/template/header.php';
require_once './../../config/database.php'; 
require_once './../../classes/User.php';
require_once 'addSongHun.php';

$user = new User;

if(!$user->isAdmin()){
    die('<h2>404 Not found page</h2>');
}

$query = "select * from artist ";
$artists = $mysqli->query($query)
->fetch_all(MYSQLI_ASSOC); 

$scales = ['مقام العجم','مقام النهاوند','مقام البيات','مقام الراست','مقام الكرد','مقام الحجاز','مقام السيكا','مقام الصبا','مقام الهزام'];

?>

<div class="text-right">
    <a class="btn  btn-secondary" href="./../../admin.php"> الرجوع </a>
</div>

<form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="post" enctype="multipart/form-data"  >
    <div class="form-group">
        <label for="song">الاغنية :</label>
        <input type="text" name="song" class="form-control" value="<?php if(isset($_SESSION['song_form']['song'])) echo  $_SESSION['song_form']['song'] ?>">
        <span class="text-danger" ><?php echo $songError ?></span>
    </div>
    <div class="form-group">
        <label for="artist"> الفنان :</label>
        <select name="artist" id="artist" class="form-control">
                <?php foreach($artists as $artist) { ?>
                    <option value="<?php echo $artist['name'] ?>">
                        <?php echo $artist['name'] ?>
                    </option>
                <?php } ?>
        </select>
        <span class="text-danger" ><?php echo $artistError ?></span>
    </div>
    <div class="form-group">
        <label for="scale">المقام :</label>
        <select name="scale" id="scale" class="form-control">
                <?php foreach($scales as  $scale) { ?>
                    <option value="<?php echo $scale ?>">
                        <?php echo $scale ?>
                    </option>
                <?php } ?>
        </select>
        <span class="text-danger" ><?php echo $scaleError ?></span>
    </div>
    <button class="btn btn-secondary form-control " >أضف</button>
</form>