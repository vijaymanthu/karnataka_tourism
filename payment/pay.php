<?php
require '.././includes/db.php';
require('config.php');
require('razorpay-php/Razorpay.php');
session_start();
// Create the Razorpay Order
use Razorpay\Api\Api;

if (isset($_POST['submit2'])) {
    // $ploc = $_POST['ploc'];
    $pname = $_POST['pname'];
    // $nod = $_POST['nod'];
    // $placename = $_POST['placename'];
    $email = $_SESSION['email'];
    $price = $_POST['price'];
    $date = $_POST['date'];
    $dst_id = $_POST['dist_id'];
    $ptype = $_POST['ptype'];
    $p_id = $_POST['p_id'];
    $res = mysqli_query($conn, "SELECT fname,lname,mobile_no from register where email_id ='" . $_SESSION['email'] . "'");
    $fetch_name = $res->fetch_assoc();
    $name = $fetch_name['fname'] . " " . $fetch_name['lname'];
    $mobile = $fetch_name['mobile_no'];
    $reg_date = date("Y-m-d");

    $sql = "INSERT INTO `tblbooking`(`District_Id`, `UserEmail`,`TripDate`, `status`,`P_id`) VALUES ('$dst_id','$email','$date','registerd','$p_id')";
    $insert = mysqli_query($conn, $sql);
    $_SESSION['name'] = $name;
    $_SESSION['mobile_no'] = $mobile;

    if (!$insert)
        echo "<script>alert('not inserted')</script>";
    $api = new Api($keyId, $keySecret);

    //
    // We create an razorpay order using orders api
    // Docs: https://docs.razorpay.com/docs/orders
    //

    $orderData = [
        'receipt'         => 3456,
        'amount'          => $price * 100, // 2000 rupees in paise
        'currency'        => 'INR',
        'payment_capture' => 1 // auto capture
    ];

    $razorpayOrder = $api->order->create($orderData);

    $razorpayOrderId = $razorpayOrder['id'];

    $_SESSION['razorpay_order_id'] = $razorpayOrderId;

    $displayAmount = $amount = $orderData['amount'];

    if ($displayCurrency !== 'INR') {
        $url = "https://api.fixer.io/latest?symbols=$displayCurrency&base=INR";
        $exchange = json_decode(file_get_contents($url), true);

        $displayAmount = $exchange['rates'][$displayCurrency] * $amount / 100;
    }

    $data = [
        "key"               => $keyId,
        "amount"            => $amount,
        "name"              => "Karnataka Tourism",
        "description"       => "ready to go",
        "image"             => "https://s29.postimg.org/r6dj1g85z/daft_punk.jpg",
        "prefill"           => [
            "name"              => "$name",
            "email"             => $_SESSION['email'],
            "contact"           => "$mobile",
        ],
        "notes"             => [
            "address"           => "Booking_id",
            "merchant_order_id" => "12312321",
        ],
        "theme"             => [
            "color"             => "#00FF00"
        ],
        "order_id"          => $razorpayOrderId,
    ];

    if ($displayCurrency !== 'INR') {
        $data['display_currency']  = $displayCurrency;
        $data['display_amount']    = $displayAmount;
    }

    $json = json_encode($data);
?>
    <form action="verify.php" method="POST">
        <script src="https://checkout.razorpay.com/v1/checkout.js" data-key="<?php echo $data['key'] ?>" data-amount="<?php echo $data['amount'] ?>" data-currency="INR" data-name="<?php echo $data['name'] ?>" data-image="<?php echo $data['image'] ?>" data-description="<?php echo $data['description'] ?>" data-prefill.name="<?php echo $data['prefill']['name'] ?>" data-prefill.email="<?php echo $data['prefill']['email'] ?>" data-prefill.contact="<?php echo $data['prefill']['contact'] ?>" data-notes.shopping_order_id="3456" data-order_id="<?php echo $data['order_id'] ?>" <?php if ($displayCurrency !== 'INR') { ?> data-display_amount="<?php echo $data['display_amount'] ?>" <?php } ?> <?php if ($displayCurrency !== 'INR') {
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                ?> data-display_currency="<?php echo $data['display_currency'] ?>" <?php } ?>>
        </script>
        <!-- Any extra fields to be submitted with the form but not sent to Razorpay -->
        <input type="hidden" name="shopping_order_id" value="3456">
    </form>
<?php
}
?>