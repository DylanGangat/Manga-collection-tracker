<?php 
    include('config/db_connect.php');

    $title = $mangaka = $volume = '';
    $errors = ['title' => '', 'mangaka' => '', 'volume' => ''];

    if(isset($_POST['submit'])) {

        // Title
        if(empty($_POST['title'])) {
            $errors['title'] = 'A title is required';
        } else {
            $title = $_POST['title'];
            if(!preg_match('/^[a-zA-Z\s]+$/', $title)){
                $errors['title'] = 'Title must be letters and spaces'; 
            }
        }

        // Mangaka
        if(empty($_POST['mangaka'])) {
            $errors['mangaka'] = 'A mangaka is required';
        } else {
            $mangaka = $_POST['mangaka'];
            if(!preg_match('/^[a-zA-Z\s]+$/', $mangaka)){
                $errors['mangaka'] = 'Mangaka must be letters and spaces'; 
            }
        }

        // Volume
        if(empty($_POST['volume'])) {
            $errors['volume'] = 'A volume number is required';
        } else {
            $volume = $_POST['volume'];
            if(!preg_match('/^[0-9]*$/', $volume)) {
                $errors['volume'] = 'Volume must be a whole number';
            }
        }

        if(array_filter($errors)) {
            // echo 'Error in the form';
        } else {
            $title = mysqli_real_escape_string($connect, $_POST['title']);
            $mangaka = mysqli_real_escape_string($connect, $_POST['mangaka']);
            $volume = mysqli_real_escape_string($connect, $_POST['volume']);
            $importance = mysqli_real_escape_string($connect, $_POST['importance']);

            $sql = "INSERT INTO manga(title, mangaka, volume, importance) VALUES('$title', '$mangaka', '$volume', '$importance')";

            if(mysqli_query($connect, $sql)) {
                // success
                header('Location: index.php');
            } else {
                // error
				echo 'query error: ' . mysqli_error($connect);
            }
        }
    }

    // END OF POST CHECK

?>



<!DOCTYPE html>
<html lang="en">
<?php include('templates/header.php'); ?>

<section class="container add">
    <h1>Add a Manga Volume</h1>

    <form class="add-form flow-content" action="add.php" method="POST">

        <!-- Title -->

        <div class="form-input">
            <div class="form-input-info">
                <label for="title">Title</label>
                <input type="text" name="title" id="title" value="<?php echo $title; ?>">
            </div>
            <div class="error-text"><?php echo $errors['title']; ?></div>
        </div>

        <!-- Mangaka -->

        <div class="form-input">
            <div class="form-input-info">
                <label for="mangaka">Mangaka</label>
                <input type="text" name="mangaka" id="mangaka" value="<?php echo $mangaka; ?>">
            </div>
            <div class="error-text"><?php echo $errors['mangaka']; ?></div>
        </div>

    
        <!-- Volume -->

        <div class="form-input">
            <div class="form-input-info">
                <label for="volume">Volume</label>
                <input type="number" name="volume" id="volume" value="<?php echo $volume; ?>">
            </div>
            <div class="error-text"><?php echo $errors['volume']; ?></div>
        </div>

        <!-- Importance -->
        <div class="form-input">
            <div class="form-input-info">
                <label for="importance">Importance</label>
                <select name="importance" id="importance">
                    <option value="High">High</option>
                    <option value="Medium">Medium</option>
                    <option value="Low">Low</option>
                </select>
            </div>
        </div>

        <input class="submit-btn" type="submit" name="submit" value="Submit">
    </form>
</section>

<?php include('templates/footer.php'); ?> 
</html>