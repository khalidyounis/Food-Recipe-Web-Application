<?php

// Call the the header.php file
include('include/header.php');

// Check if the user is logged in
if (!isset($_SESSION['user_logged_in'])) {
  // Redirect to the index page
  header('Location:login.php');
}

?>
<div class="container">

  <?php

  //Gets User ID from the session variable
  $user_id = $_SESSION['user_id'];

  // Gets value sent over search form
  if (!empty($_GET['keyword'])) {
    $query = $_GET['keyword'];
  } else {
    $query = 0;
  }


  // You can set minimum length of the query if you want
  $min_length = 1;


  if (strlen($query) >= $min_length) { // if query length is more or equal minimum length then

    // changes characters used in html to their equivalents, for example: < to &gt;
    $query = htmlspecialchars($query);

    // Get the list of favorite recipes for the logged in user
    $userfav_arr = $pdo->query("SELECT DISTINCT recipe_id, user_id FROM favorite_recipes WHERE user_id=$user_id");

    // Store the query result in an array
    $fav_arr = [];

    foreach ($userfav_arr as $row) {
      $fav_arr[] = $row['recipe_id'];
    }

    // User recipe search query
    $stmt = $pdo->query("select * from recipes where recipe_name LIKE '%" . $query . "%' ORDER BY recipe_id ASC");
    $i = 0;
    if ($recipe_res = $stmt->fetch()) {
      $i++;
  ?>


      <div class="search-title mt-5">
        <h2>Search results</h2>
        <h6> <?php _e($i); ?> Recipe found </h6>
      </div>

      <div class="recipe-card">
        <div class="badge"><i class="fa fa-clock-o mx-1"></i><?php _e($recipe_res['cooking_time']); ?></div>
        <a href="recipe-details?id=<?php _e($recipe_res['recipe_id']); ?>">
          <div class="recipe-thumb image-credit-wrapper">
            <span class="image-credit"><?php _e($recipe_res['image_credits']); ?></span>
            <img src="images/<?php _e($recipe_res['image_path']); ?>" alt="<?php _e($recipe_res['recipe_name']); ?>">
          </div>
        </a>
        <div class="recipe-details">
          <h3><a href="recipe-details?id=<?php _e($recipe_res['recipe_id']); ?>"><?php _e($recipe_res['recipe_name']); ?></a></h4>

            <p>Food description</p>
            <?php
            if (!isset($_SESSION['user_logged_in'])) {
            ?>
              <div>
                <div>
                  <a href="login" class="exclusive-members">For exclusive members - Sign up</a>
                </div>
              <?php

            } else {

              ?>
                <div class=" recipe-bottom-details">


                  <div class="recipe-links <?php
                                            if (in_array($recipe_res['recipe_id'], $fav_arr)) {
                                              _e("user-favorite");
                                            }
                                            ?>" id=<?php _e("recipe-" . $i); ?>>
                    <a id="add-favorite-<?php _e($i); ?>" name="add-favorite-<?php _e($i); ?>" onclick="<?php
                                                                                                        if (in_array($i, $fav_arr)) {
                                                                                                          _e("RemoveFav(");
                                                                                                        } else {
                                                                                                          _e("AddtoFav(");
                                                                                                        }

                                                                                                        _e($recipe_res['recipe_id']); ?>)"><i class="fa fa-heart 
                
                "></i></a>
                  </div>
                <?php } ?>
                </div>
              </div>
        </div>
      <?php } else
      if (!$recipe_res = $stmt->fetch() || $query != 0) {
      ?>
        <div class="search-title mt-5">
          <h2>Search results</h2>
          <h6> No recipes found </h6>
        </div>
    <?php
    }
  }
    ?>
      </div>




</div>
</div>

<?php

// Call the the footer.php file
include('include/footer.php');

?>

<script>
  //This function is enabling the user to add the recipes to the user's favorite list and call the PHP file to inser into the favorite recipes list
  function AddtoFav(recipeID) {
    $.ajax({
      url: "add-favorite.php",
      method: "POST",
      data: {
        recipe_id: recipeID,
        userID: <?php _e($user_id); ?>
      },
      success: function(data) {
        Swal.fire({
          icon: 'success',
          text: 'The recipe has been added to your favorite list',
        })
        var d = document.getElementById("recipe-" + recipeID);
        d.className += " user-favorite";
        document.getElementById('add-favorite-' + recipeID).setAttribute('onclick', 'RemoveFav(' + recipeID + ')');
      }
    });
  };
</script>


<script>
  
  //This function is to remove the recipe from the favorite recipes table in the database

  function RemoveFav(recipeID) {

    $.ajax({
      url: "remove-favorite.php",
      method: "POST",
      data: {
        recipe_id: recipeID,
        userID: <?php _e($user_id); ?>
      },
      success: function(data) {
        Swal.fire({
          icon: 'warning',
          text: 'The recipe has been removed from your favorite list',
        })

        $("#recipe-" + recipeID).removeClass("user-favorite");
        document.getElementById('add-favorite-' + recipeID).setAttribute('onclick', 'AddtoFav(' + recipeID + ')');
      }
    });
  };
</script>