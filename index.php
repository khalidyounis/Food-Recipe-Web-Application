<?php
// Call the the header.php file
include('include/header.php');

//Get the user ID from the session variables
$user_id = $_SESSION['user_id'];

?>
<div class="container">
  <div class="row pt-3 section-title">

    <h2 class="section-title">Our Popular New Recipes in October</h2>
    <p>Not everybody loves cooking, but once in a blue moon, we always get the urge to jump into the kitchen and whip up something delicious.</p>
    <p>However, it is hard to keep your culinary game fresh if you lack new ideas and always prepare the same old dish that you inherited from your mum. This is why you need to check out various recipe websites for inspiration. But, how do you know the sites to visit, considering that there are thousands of them out there? This is why we have scoured through the internet and brought you some of the best recipe websites.</p>
    <?php
    // Check if the user is logged in
    if (isset($_SESSION['user_logged_in'])) {
    ?>
      <div>
        <button class="btn btn-default filter-button filter-button-active" data-filter="all">All</button>
        <button class="btn btn-default filter-button" data-filter="main">Main</button>
        <button class="btn btn-default filter-button" data-filter="starter">Starter</button>
        <button class="btn btn-default filter-button" data-filter="dessert">Dessert</button>
      </div>
    <?php
    }
    ?>

    <?php
    // Get the list of favorite recipes for the logged in user
    $userfav_arr = $pdo->query("SELECT DISTINCT recipe_id, user_id FROM favorite_recipes WHERE user_id=$user_id");
    $fav_arr = [];
    // Store the query results in an array to be checked
    foreach ($userfav_arr as $row) {
      $fav_arr[] = $row['recipe_id'];
    }

    // Check whether the user is logged in
    if (isset($_SESSION['user_logged_in'])) {
      // Get the list of recipes for the registered users
      $stmt = $pdo->query("select * from recipes ORDER BY recipe_id ASC");
    } else {
      // Get the list of recipes for the unregistered users
      $stmt = $pdo->query("select * from recipes ORDER BY recipe_id ASC limit 2");
    }

    $i = 0;
    while ($recipe_res = $stmt->fetch()) {
      $i++;
    ?>
      <div class="recipe-card filter <?php _e($recipe_res['recipe_type']); ?>">
        <div class="badge"><i class="fa fa-clock-o mx-1"></i><?php _e($recipe_res['cooking_time']); ?></div>
        <a href="recipe-details?id=<?php _e($recipe_res['recipe_id']); ?>">
          <div class="recipe-thumb image-credit-wrapper">
            <span class="image-credit"><?php _e($recipe_res['image_credits']); ?></span>
            <img src="images/<?php _e($recipe_res['image_path']); ?>" alt="<?php _e($recipe_res['recipe_name']); ?>">
          </div>
        </a>

        <div class="recipe-details">
          <h3><a href="recipe-details?id=<?php _e($recipe_res['recipe_id']); ?>"><?php _e($recipe_res['recipe_name']); ?></a></h4>
            <p class="ellipsis-text"><?php _e($recipe_res['recipe_description']); ?></p>

            <?php
            // Check whether the user is logged in
            if (!$_SESSION['user_logged_in']) {
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
                                            //Check if the current recipe is in user's favorite recipes list
                                            if (in_array($recipe_res['recipe_id'], $fav_arr)) {
                                              _e("user-favorite");
                                            }
                                            ?>" id=<?php _e("recipe-" . $i);
                                                    ?>>



                    <a id="add-favorite-<?php _e($i); ?>" name="add-favorite-<?php _e($i); ?>" onclick="<?php
                                                                                                        if (in_array($i, $fav_arr)) {

                                                                                                          // Add the RemoveFav() JavaScript function that is declared in this page
                                                                                                          _e("RemoveFav(");
                                                                                                        } else {
                                                                                                          // Add the AddtoFav() JavaScript function that is declared in this page
                                                                                                          _e("AddtoFav(");
                                                                                                        }

                                                                                                        _e($recipe_res['recipe_id']); ?>)"><i class="fa fa-heart 
                
                "></i></a>


                  </div>
                <?php } ?>
                </div>
              </div>
        </div>
      <?php }

      ?>

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