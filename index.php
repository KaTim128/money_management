<?php
require('header.php');

$select_query = "SELECT * FROM users WHERE user_id = '$user_id'";
$result_query = mysqli_query($conn, $select_query);
$rows = mysqli_fetch_assoc($result_query);
$total_salary = $rows['total_salary'];
?>
<div class="center-container">
    <div class="container">
        <h2 class="text-center mb-3">What is your monthly salary? 👑</h2>
        <form action="percentage.php" method="post">
            <div class="center my-3">
                <div class="input-group">
                    <span class="input-group-text custom-span">RM</span>
                    <input type="number" name="salary" class="form-control bar" value="<?= $total_salary ?>" placeholder="<?= $total_salary ?>" required>
                </div>
            </div>
            <div class="d-flex justify-content-center">
                <button type="submit" class="btn btns">Enter</button>
            </div>
        </form>
    </div>
</div>
<?php
require('footer.php');
?>