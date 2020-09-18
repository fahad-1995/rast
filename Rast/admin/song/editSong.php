<?php
require_once './../../admin/template/header.php';
require_once './../../config/database.php'; 
require_once './../../classes/User.php';

$user = new User;
$errors = [];

if(!$user->isAdmin()){
    die('<h2>404 Not found page</h2>');
}

$query = "select * from artist ";
$artists = $mysqli->query($query)
->fetch_all(MYSQLI_ASSOC); 


if(!isset($_GET['id']) || !$_GET['id']){ die("Song id is missing");}

$st = $mysqli->prepare("select * from songs where id = ? limit 1");
$st->bind_param('i', $nameId);
$nameId = $_GET['id'];
$st->execute();

$artistRow = $st->get_result()->fetch_assoc();

$name = $artistRow['name'];
$artist = $artistRow['artist_name'];
$scale = $artistRow['scale'];

$scales = ['مقام العجم','مقام النهاوند','مقام البيات','مقام الراست','مقام الكرد','مقام الحجاز','مقام السيكا','مقام الصبا','مقام الهزام'];



if($_SERVER['REQUEST_METHOD'] == 'POST'){

    //if(empty($_POST['name'])){array_push($errors,"Name is required");}
    //if(empty($_POST['artist'])){array_push($errors,"Artist is required");}

    if(!count($errors)){

        $st = $mysqli->prepare("update songs set name = ? , artist_name = ?, scale = ?  where id = ?");
        $st->bind_param('sssi', $dbName, $dbArtestName,$dbScale, $dbId);
        $dbName = $_POST['song'];
        $dbArtestName= $_POST['artist'];
        $dbScale = $_POST['scale'];
        $dbId = $_GET['id'];
        $st->execute();
    
        if($st->error){
            array_push($errors, $st->error);
        }else{
            $_SESSION['success_message'] = "تم تعديل البيانات بنجاح ✅";
            echo "<script>location.href = 'viewSongs.php'</script>";
        }

    }

    
}

?>
<?php include './../../admin/template/errors.php'?>
<h3>تحديث بيانات الفنان</h3>
<div class="text-right">
    <a class="btn  btn-secondary" href="viewArtist.php"> الرجوع </a>
</div>

<form action="" method="post"  >
    <div class="form-group">
        <label for="song">الاغنية :</label>
        <input type="text" name="song" class="form-control" value="<?php echo $name?>">
    </div>
    <div class="form-group">
        <label for="artist"> الفنان :</label>
        <select name="artist" id="artist" class="form-control">
                <?php foreach($artists as $artist) { ?>
                    <option value="<?php echo $artist['name'] ?>">
                        <?php echo $artist['name']; ?>
                    </option>
                <?php } ?>
        </select>
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
    </div>
    <button class="btn btn-secondary form-control " >حدث</button>
</form>


<?php require_once './../../admin/template/footer.php' ?>