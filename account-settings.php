<?php
// Call the the header.php file
include('include/header.php');

$user_id = $_SESSION['user_id'];

$stmt = $pdo->prepare("select email, display_name from users where email=?");
$stmt->execute([$_SESSION['email']]);

$row = $stmt->fetch();

if ($row) {
    $user_email = $row['email'];
    $display_name = $row['display_name'];
}



if (isset($_POST['update'])) {

    $update_sql = "UPDATE users SET display_name=? where id=?";
    $display_nameVal = filter_input(INPUT_POST, 'display_nameVar');
    $update_stmt = $pdo->prepare($update_sql)->execute([$display_nameVal, $user_id]);
    if ($update_stmt) {
        echo "<script src='include/assets/js/sweetalert2.all.min.js'></script>";
        echo "<script language = javascript>
        Swal.fire({
            icon: 'success',
            text: 'The display name was updated succesfully',
          })
          </script>";
        $display_name = $display_nameVal;
    }
}
?>
<div class="container">
    <div class="main-body">
        <div class="row mt-3 section-title">
            <h2 class="section-title">Account Settings</h2>
            <div class="col-lg-4">
                <div class="settings-card">
                    <div class="card-body">
                        <div class="d-flex flex-column align-items-center text-center">
                            <div class="mt-3">
                                <h4><?php _e($display_name); ?></h4>
                                <p class="text-secondary mb-1">Regular User</p>
                            </div>
                        </div>
                        <hr class="my-4">

                        <h5 class="header-title mb-4">Favorite Recipes</h4>
                            <ul class="list-unstyled activity-wid card-mb-0">

                                <?php
                                $rec_stmt = $pdo->query("SELECT DISTINCT recipe_id FROM favorite_recipes WHERE user_id=$user_id");

                                while ($recipe_res = $rec_stmt->fetch()) {
                                    $recipe_name = '';
                                    $recdet_stmt = $pdo->query("SELECT recipe_id, recipe_name, image_path FROM recipes WHERE recipe_id=" . $recipe_res['recipe_id']);
                                    if ($recipedet_res = $recdet_stmt->fetch()) {
                                        $recipe_name = $recipedet_res['recipe_name'];
                                    }
                                ?>

                                    <li class="activity-list activity-border">
                                        <a href="recipe-details?id=<?php _e($recipe_res['recipe_id']); ?>">
                                            <div class="activity-icon avatar-sm">
                                                <img src="images/<?php _e($recipedet_res['image_path']); ?>" alt="<?php _e($recipe_name); ?>" class="avatar-sm rounded-circle" alt="">
                                            </div>
                                        </a>
                                        <div class="media">
                                            <div class="card-me-3">
                                                <a href="recipe-details?id=<?php _e($recipe_res['recipe_id']); ?>">
                                                    <h5 class="font-size-15 mb-1"><?php _e($recipe_name); ?></h5>
                                                </a>
                                            </div>

                                        </div>
                                    </li>
                                <?php
                                }
                                ?>
                            </ul>
                    </div>
                </div>
            </div>

            <div class="col-lg-8">

                <div class="settings-card">
                    <form method="POST" method="post" enctype="multipart/form-data">
                        <div class="card-body">

                            <div class="row mb-3 vertical-align">

                                <div class="col-sm-3">

                                    <h6 class="mb-0">Display Name</h6>
                                </div>
                                <div class="col-sm-6 text-secondary">
                                    <input type="text" id="display_nameVar" name="display_nameVar" class="form-control" value="<?php _e($display_name); ?>">
                                </div>
                            </div>
                            <div class="row mb-3 vertical-align">
                                <div class="col-sm-3">
                                    <h6 class="mb-0">Email</h6>
                                </div>
                                <div class="col-sm-6 text-secondary">
                                    <input readonly type="text" class="form-control" value="<?php _e($user_email); ?>">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-3"></div>
                                <div class="col-sm-4 text-secondary">
                                    <button type="submit" name="update" id="update" class="btn btn-primary px-4">Save Changes</button>
                                </div>

                            </div>

                        </div>
                    </form>
                </div>
            </div>

        </div>
    </div>
</div>

<?php

// Call the the footer.php file
include('include/footer.php');

?>