<?php
require_once './../../admin/template/header.php';
require_once './../../config/database.php'; 
require_once './../../classes/User.php';

$user = new User;
$errors = [];

if(!$user->isAdmin()){
    die('<h2>404 Not found page</h2>');
}



if(!isset($_GET['id']) || !$_GET['id']){ die("Artist id is missing");}

$st = $mysqli->prepare("select * from artist where id = ? limit 1");
$st->bind_param('i', $nameId);
$nameId = $_GET['id'];
$st->execute();

$artistRow = $st->get_result()->fetch_assoc();

$name = $artistRow['name'];
$image = $artistRow['image'];




if($_SERVER['REQUEST_METHOD'] == 'POST'){

    if(empty($_POST['name'])){array_push($errors,"Name is required");}
    if(empty($_POST['image'])){array_push($errors,"Image is required");}

    if(!count($errors)){

        $st = $mysqli->prepare("update artist set name = ? , image = ?  where id = ?");
        $st->bind_param('ssi', $dbName, $dbImage, $dbId);
        $dbName = $_POST['name'];
        $dbImage= $_POST['image'];
        $dbId = $_GET['id'];
        $st->execute();
    
        if($st->error){
            array_push($errors, $st->error);
        }else{
            $_SESSION['success_message'] = "تم تعديل البيانات بنجاح ✅";
            echo "<script>location.href = 'viewArtist.php'</script>";
        }

    }

    
}

?>
<?php include './../../admin/template/errors.php'?>
<h3>تحديث بيانات الفنان</h3>
<div class="text-right">
    <a class="btn  btn-secondary" href="viewArtist.php"> الرجوع </a>
</div>

<form action="" method="post"   >
    <div class="form-group">
        <label for="Name">الفنان</label>
        <input type="text" name="name" id="Name" class="form-control" value="<?php echo  $name ?>">
    </div>
    <div class="form-group">
        <label for="image">رابط الصورة</label>
        <input type="text" name="image" id="image" class="form-control" value="<?php echo  $image ?>">
    </div>
    <button class="btn btn-secondary form-control " >حدث !</button>
</form>


<?php require_once './../../admin/template/footer.php' ?>