<?php require_once './templet/header.php';
require_once './config/database.php';

$secureArtist = filter_var ( $_GET['artist'], FILTER_SANITIZE_STRING);

$songs = $mysqli->query("select * from songs where artist_name='$secureArtist'")->fetch_all(MYSQLI_ASSOC);


?>

<section class="page-section portfolio" id="portfolio">
            <div class="container">
                <!-- Portfolio Section Heading-->
                <div class="text-center">
                    <h2 class="page-section-heading text-secondary mb-0 d-inline-block">أغاني <?php echo $secureArtist; ?></h2>
                </div>
                <!-- Icon Divider-->
                <div class="divider-custom">
                    <div class="divider-custom-line"></div>
                </div>
                <!-- Portfolio Grid Items-->
                
                <div class="row justify-content-center">
                    <!-- Portfolio Items-->
                    <div class="container" >
                    <div class="table-responsive text-center">
                        <table class="table table-hover table-striped">
                            <thead>
                                <tr>
                                    <th>المقام</th>
                                    <th>اسم الفنان</th>
                                    <th>اسم الاغنية</th>
                                </tr>   
                            </thead>
                            <tbody>

                        <?php foreach ($songs as   $song) {?>
                            <tr>
                                <td><?php echo $song['scale'] ?></td>
                                <td><?php echo $song['artist_name'] ?></td>
                                <td><?php echo $song['name'] ?></td>
                            </tr>

                        <?php } ?>
                        </tbody>
                        </table>
                    </div>
                    </div>
                </div>
        </section>

<?php require_once './templet/footer.php';?>

