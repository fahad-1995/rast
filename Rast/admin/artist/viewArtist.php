<?php
require_once './../../admin/template/header.php';
require_once './../../config/database.php'; 
require_once './../../classes/User.php';

$user = new User;

if(!$user->isAdmin()){
    die('<h2>404 Not found page</h2>');
}
$details = '';
$query = "select * from artist";
$results = $mysqli->query($query)
            ->fetch_all(MYSQLI_ASSOC);
         

?>

<?php if(!isset($_GET['id'])){   ?>

<h2 class="text-center">قائمة الفنانين</h2>
<div class="text-right">
    <a class="btn  btn-secondary" href="/RastProject/admin.php"> الرجوع </a>
</div>
<div class="table-responsive text-center">
    <table class="table table-hover table-striped">
        <thead>
            <tr>
                <th>رقم الفنان</th>
                <th>اسم الفنان</th>
                <th>رابط الصورة</th>
                <th>التحكم</th>
                <th>#</th>
            </tr>   
        </thead>
        <tbody>


<?php foreach($results as $result) { ?>
    <tr>
        <td><?php echo $result['id'] ?></td>
        <td><?php echo $result['name'] ?></td>
        <td><?php echo $result['image'] ?></td>
      
        <td>
            <a class="btn btn-sm btn-secondary" href="edit.php?id=<?php echo $result['id'] ?>">Edit</a>
        </td>  
        <td>
            <form onsubmit="return confirm('Are you sure ?')" action="" method="post" style="display: inline-block;">
                    <input type="hidden" name="resultRow" value="<?php echo $result['id']?>">
                    <button class="btn btn-sm btn-danger">Delete</button>
            </form>
        </td>
    </tr>
<?php }?>
        </tbody>
    </table>
</div>

<?php }?>

<?php
 if(isset($_POST['resultRow'])){
    $st = $mysqli->prepare("delete from result where id= ?");
    $st->bind_param('i',$ID);
    $ID = $_POST['resultRow'];
    $st->execute();

    $st2 = $mysqli->prepare("delete from details where student_id= ?");
    $st2->bind_param('i',$ID);
    $ID = $_POST['resultRow'];
    $st2->execute();

    echo "<script>location.href = 'result.php'</script>";
 }
?>

<?php require_once './../../admin/template/footer.php'; ?>
