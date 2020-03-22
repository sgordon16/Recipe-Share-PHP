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
<div class="container my-4">
    <!-- Jumbotron Header -->
    <div class="jumbotron jumbotron-fluid">
        <video autoplay muted loop poster="https://dummyimage.com/900x400/000/fff">
            <source src="" data-src="videos/1021335946-preview.mp4" type="video/mp4">
        </video>
        <div class="container text-white mx-auto">
            <h1 class="display-3 text-center font2">Search Recipes</h1>
            <form action="?" method="post">
                <div class="input-group mx-auto">
                    <span class="input-group-append">
                        <button data-toggle="dropdown" class="btn btn-outline-secondary border border-right-0 dropdown-toggle custom-colors" type="buttton">
                            Filters
                        </button>
                        <ul class="dropdown-menu shadow">
                            <h5 class="dropdown-header">Diet</h5>
                            <?php foreach ($options as $option) : ?>
                            <li class="dropdown-item">
                                <div class="form-check">
                                    <label class="form-check-label" for="<?php echo $option['name']; ?>"></label>
                                    <input type="checkbox" id="<?php echo $option['name']; ?>" class="form-check-input" name="diets[]" value="<?php echo $option['name']; ?>">
                                        <?php echo $option['name']; ?>
                                </div>
                            </li>
                            <?php endforeach; ?> 
                        </ul> 
                    </span>
                    <input id="searchBar" type="text" class="form-control border border-right-0" name="searchWord" placeholder="Search...">
                    <span class="input-group-append">
                        <button id="search" class="btn btn-outline-secondary border border-left-0 custom-colors" type="submit" name="submit" value="submit">
                            <i class="fas fa-search fa-sm"></i>
                        </button> 
                    </span>
                </form>
            </div>
        </div>
    </div>
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
<?php
include 'footer.php';
?>