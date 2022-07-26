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
$sql = 'SELECT title, mangaka, volume, id FROM manga ORDER BY created_at';

// Make query & get results
$result = mysqli_query($connect, $sql);
// print_R($result);

// Fetch the resulting rows as an array
$mangas = mysqli_fetch_all($result, MYSQLI_ASSOC);

print_r($mangas);

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
        <h1>My Collection</h1>
        <div>
            <?php foreach($mangas as $manga) { ?> 
                <div>
                    <h3><?php echo $manga['title']?></h3>
                    <p><?php echo 'volume: ' . htmlspecialchars($manga['volume']); ?></p>
                    <p><?php echo htmlspecialchars($manga['mangaka']); ?></p>
                    <form action="index.php" method="POST">
                        <input type="hidden" name="id_to_delete" value="<?php echo htmlspecialchars($manga['id']); ?>">
                        <input type="submit" name="delete" value="delete">
                    </form>
                </div>
            
            <?php } ?>
        </div>
    </div>
</section>


<?php include("templates/footer.php"); ?>
</html>