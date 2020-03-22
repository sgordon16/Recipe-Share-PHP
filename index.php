<?php
include 'header.php';
$sql = '';
$conn = mysqli_connect('localhost', 'root', '', 'mydb');
if (mysqli_connect_errno()) {
    echo 'connection failed';
}
$query = "SELECT name FROM diet_options";
$result = mysqli_query($conn, $query);
$options = mysqli_fetch_all($result, MYSQLI_ASSOC);
mysqli_free_result($result);

if (!empty($_POST['submit'])) {   
    $searchWord = $_POST['searchWord'];
    $sql = "select * from recipes where title like '%${searchWord}%'";
    if(isset($_POST['diets'])){        
        foreach($_POST['diets'] as $diet) {
            $sql .= " AND JSON_SEARCH(diet, 'one', '${diet}') is not null";
        }
    } 
    echo '$sql: '.$sql;
    $result1 = mysqli_query($conn, $sql);
    $recipes = mysqli_fetch_all($result1, MYSQLI_ASSOC);
    mysqli_free_result($result1);
}
else {
    $sql = 'select * from recipes order by rating desc, date limit 12';
    $result1 = mysqli_query($conn, $sql);
    $recipes = mysqli_fetch_all($result1, MYSQLI_ASSOC);
    mysqli_free_result($result1);
}
?>
<script src="js/StarRating.js"></script>
<script src="js/responsive-carousel.js"></script>
  <div id="banner-section" class="container my-4">
	  <div class="carousel BannerSlide-carousel">
	    <div class="carousel-inner">
	      <div class="slide active" style="">
                  <img src="img/lily-banse--YHSwy6uqvk-unsplash.jpg">
	      </div>
	      <div class="slide" style="">
                  <img src="img/Canva - Fried Meat on Top of White Plate.jpg">
	      </div>
              <div class="slide" style="">
                  <img src="img/elli-o-43179-unsplash.jpg">
	      </div>
              <div class="slide" style="">
                  <img src="img/melissa-walker-horn-637092-unsplash.jpg">
	      </div>
              <div class="slide" style="">
                  <img src="img/rachel-park-366508-unsplash.jpg">
	      </div>
              <div class="slide" style="">
                  <img src="img/wesual-click-437804-unsplash.jpg">
	      </div>
	    </div>
	    <div class="arrow arrow-left"></div>
	    <div class="arrow arrow-right"></div>
	</div>
  </div>
<div class="container my-4">

    <div class="row">
        <?php foreach ($recipes as $recipe) : ?>
        <div class="col-lg-3 col-md-6 mb-4">
            <div class="card h-100 shadow custom-colors"><img class="card-img-top" src="<?php echo $recipe['imgUrl']; ?>" alt="https://dummyimage.com/500x325/000/fff" />
                <div class="card-body">
                    <a href="ViewRecipe.php?id=<?php echo $recipe['ID']; ?>">
                        <h4 class="card-title text-center"><?php echo $recipe['title']; ?></h4>
                    </a>
                    <div class="text-center">
                        <span class="rating small-gold" data-default-rating="<?php echo $recipe['rating']; ?>" disabled="disabled"></span>
                    </div>
                    <p class="card-text"> 
                        <br/>Calories per serving: <?php echo $recipe['caloriesPerServing']; ?>
                        <br/>Time: <?php echo $recipe['time']; ?> min.
                        <br/>Servings: <?php echo $recipe['servings']; ?></p>
                </div>
            </div>
        </div>
       <?php endforeach; ?> 
    </div>
</div>

<script>

	// Custom options for the carousel
	var args = {
		arrowRight : '.arrow-right',
		arrowLeft : '.arrow-left',
		speed : 700,
		slideDuration : 4000
	};
	// start BannerSlide
	$('.carousel').BannerSlide(args);

</script>
<?php
include 'footer.php';
?>