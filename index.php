<?php 

include('config/db_connect.php');

// Delete manga volume
if(isset($_POST['delete'])) {
    $id_to_delete = mysqli_real_escape_string($connect, $_POST['id_to_delete']);

    $sql = "DELETE FROM manga WHERE id = $id_to_delete";

    if(mysqli_query($connect, $sql)) {
        header('Location: index.php');
    } else {
        echo 'Query error: ' . mysqli_error($connect);
    }
}

// Write query for all pizzas

// $sql = 'SELECT * FROM pizzas';
$sql = 'SELECT title, mangaka, volume, importance, id FROM manga ORDER BY created_at';

// Make query & get results
$result = mysqli_query($connect, $sql);
// print_R($result);

// Fetch the resulting rows as an array
$mangas = mysqli_fetch_all($result, MYSQLI_ASSOC);

// print_r($mangas);

// Free result from memory
mysqli_free_result($result);

// Close connection
mysqli_close($connect);


?>

<!DOCTYPE html>
<html lang="en">
<?php include("templates/header.php"); ?>

<section>
    <div class="container">
        <h1>My Wishlist</h1>
        <div class="manga-grid">
            <?php foreach($mangas as $manga) { ?> 
                <div class="manga-card flow-content">
                    <!-- <img src="" alt="cover of the manga" data-manga-image> -->
                    <h3 class="title" data-manga-title><?php echo $manga['title']; ?></h3>
                    <p class="volume"><?php echo 'Volume: ' . htmlspecialchars($manga['volume']); ?></p>
                    <p class="mangaka"><?php echo 'Mangaka: ' . htmlspecialchars($manga['mangaka']); ?></p>
                    <p class="importance"><?php echo 'Importance: ' . htmlspecialchars($manga['importance']); ?></p>
                    <form action="index.php" method="POST">
                        <input type="hidden" name="id_to_delete" value="<?php echo htmlspecialchars($manga['id']); ?>">
                        <input type="submit" class="delete-btn" name="delete" value="delete">
                    </form>
                </div>
            
            <?php } ?>
        </div>
    </div>
</section>


<?php include("templates/footer.php"); ?>
</html>