<?php
session_start();
error_reporting(0);
include('includes/db.php');

$dist_id = $_POST['dist_id'];
$ptype = $_POST['ptype'];



$sql = "SELECT * from packages where ptype='$ptype' and district_id='$dist_id'";
$query = mysqli_query($conn, $sql);
// $query->execute();
$fetch_price = mysqli_query($conn, "SELECT price from district where id = '$dist_id' and p_type ='$ptype'");
$pack_price = $fetch_price->fetch_assoc();
?><div class="row">
    <div class="col">
        <p class="danger h3" style="font-family:'Times New Roman', Times, serif">Rs. <?php echo $pack_price['price'] ?></p>
    </div>
</div>

<?php
$cnt = 1;
if (mysqli_num_rows($query) > 0) {
    while ($result = $query->fetch_assoc()) {
        $p_id = $result['p_id'];
?>

        <div class="rom-btm">
            <div class="col-md-3 room-left wow fadeInLeft animated" data-wow-delay=".5s">
                <img src="<?php
                            $fetch_image = mysqli_query($conn, "SELECT * from images where p_id ='$p_id' limit 1");
                            $imagepath = $fetch_image->fetch_assoc();
                            echo "./uploads/images/$ptype/" . $imagepath['image'] ?>" class="img-responsive" alt="adfgd">
            </div>
            <div class="col-md-6 room-midle wow fadeInUp animated" data-wow-delay=".5s">
                <h4>Package Name: <?php echo $dist_id . "" . htmlentities($result['pname']);

                                    ?></h4>
                <!-- <h6>Package Type : <?php echo htmlentities($result['PackageType']); ?></h6> -->
                <p><b>Package Location :</b> <?php echo htmlentities($result['PackageLocation']); ?></p>
                <p><b>Package Description :</b> <?php echo htmlentities($result['description']); ?></p>
                <!-- <p><b>Features</b> <?php echo htmlentities($result['packageFetures']); ?></p> -->
            </div>
            <div class="col-md-3 room-right wow fadeInRight animated" data-wow-delay=".5s">
                <h5>Rupees <?php echo htmlentities($result['price']); ?></h5>
                <a href="package-details.php?ptype=<?php echo htmlentities($result['ptype']) ?>&pkgid=<?php echo htmlentities($result['p_id']); ?>" class="view">Details</a>
            </div>
            <div class="clearfix"></div>
        </div>

    <?php }
    ?>
    <form name="book" action="./payment/pay.php" method="post">
        <input type="hidden" name="pname" value="<?php echo htmlentities($result['pname']); ?>">
        <input type="hidden" name="price" value="<?php echo htmlentities($pack_price['price']); ?>">
        <input type="hidden" name="dist_id" value="<?php $dist_id = $_POST['dst_id']; ?>">
        <input type="hidden" name="ptype" value="<?php $ptype = $_POST['ptype']; ?>">
        <div class="selectroom_top" style="margin: 30px;">
            <h2>Travel</h2>
            <div class="selectroom-info animated wow fadeInUp animated" data-wow-duration="1200ms" data-wow-delay="500ms" style="visibility: visible; animation-duration: 1200ms; animation-delay: 500ms; animation-name: fadeInUp; margin-top: -70px">
                <ul>

                    <li class="spe">
                        <label class="inputLabel">Date</label>

                        <input class="form-control" type="date" name="date" min="<?php echo date("Y-m-d")?>" required="">

                    </li>
                    <?php if ($_SESSION['login']) { ?>
                        <li class="spe" align="center">
                            <button type="submit" name="submit2" class="btn-primary btn">Book</button>
                        </li>
                    <?php } else { ?>
                        <li class="sigi" align="center" style="margin-top: 1%">
                            <a href="#" data-toggle="modal" data-target="#myModal4" class="btn-primary btn"> Book</a>
                        </li>
                    <?php } ?>
                    <div class="clearfix"></div>
                </ul>
            </div>

        </div>
    </form>
<?php
} else { ?>
    <div class="rom-btm">
        <div class="col-md-12 room-left wow fadeInLeft animated text-center" data-wow-delay=".5s">
            <h3>No Packages Available</h3>
        </div>
    </div><?php
        }

            ?>