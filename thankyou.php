<?php 
include 'header.php';
$message = '';
if(isset($_GET['message'])){
    $message = $_GET['message'];
}; 
?>
    <div class="container">
        <div class="row">
            <div class="col-lg-8 col-xl-6 mx-auto">
                <div class="card card-signin flex-row my-5 shadow">
                    <div class="card-body mx-auto text-center">
                        <i class="fa fa-check-circle fa-5x" aria-hidden="true"></i>
                        <hr>
                        <h1><?php echo $message; ?></h1>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php 
include 'footer.php';
?>

