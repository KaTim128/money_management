<?php
require('header.php');
$showResults = false;
// Initialize variables with default values
$salary = $_POST['salary'] ?? 0;
$needs_percent = $_POST['needs_percent'] ?? 50;
$wants_percent = $_POST['wants_percent'] ?? 30;
$savings_percent = $_POST['savings_percent'] ?? 20;

$error = ''; // To store error messages

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $total_salary = $salary;
    $total_percent = $needs_percent + $wants_percent + $savings_percent;

    if ($total_percent < 100) {
        // Add remaining percent to savings automatically
        $remaining = 100 - $total_percent;
        $savings_percent += $remaining;
        $error = "Remaining $remaining% has been added to Savings automatically.";
        $showResults = true;
    } elseif ($total_percent == 100) {
        $showResults = true;
    } else {
        $showResults = false;
        $error = 'Total percentage exceeded 100%. Please adjust the values.😾';
    }

    if ($showResults) {
        $needs = $total_salary * $needs_percent / 100;
        $wants = $total_salary * $wants_percent / 100;
        $savings = $total_salary * $savings_percent / 100;
    }
}
?>
<div class="center-container container">
    <div class="row">
        <?php if ($showResults): ?>
            <div class="col-12 d-flex justify-content-center">
                <div class="breakdown-box mb-4">
                    <h4 style="text-decoration:underline">Salary Breakdown</h4>💵💰💴💸🪙💳
                    <p><strong>Salary (100%):</strong> RM <?= number_format($total_salary, 2) ?></p>
                    <p><strong>Needs (<?= $needs_percent ?>%):</strong> RM <?= number_format($needs, 2) ?></p>
                    <p><strong>Wants (<?= $wants_percent ?>%):</strong> RM <?= number_format($wants, 2) ?></p>
                    <p><strong>Savings (<?= $savings_percent ?>%):</strong> RM <?= number_format($savings, 2) ?></p>
                </div>
            </div>
        <?php endif; ?>
        <div class="col-md-12 d-flex justify-content-center">
            <form action="" method="post" id="percentageForm" class="w-100">
                <input type="hidden" name="salary" value="<?= htmlspecialchars($salary) ?>">
                <div class="container justify-content-center align-items-center">

                    <?php if (!empty($error)): ?>
                        <p class="justify-content-center align-items-center d-flex">
                            <img src="https://media4.giphy.com/media/v1.Y2lkPTc5MGI3NjExcTQzM2lhNGhyaWd0bWhtcHl6NDZ3cG1qamIwazBlajZ0OGVtam41ciZlcD12MV9pbnRlcm5hbF9naWZfYnlfaWQmY3Q9Zw/W8hVGGjOjV82Rh6Oyi/giphy.gif"
                                style="max-height: 400px; border-radius:5px; border: 4px solid var(--brown2);">
                        </p>
                        <div style="color:rgb(255, 0, 149); font-weight: bold;"><?= $error ?></div>
                    <?php endif; ?>

                    <div class="center my-3 input-group justify-content-center">
                        <span class="input-group-text">Needs:</span>
                        <input type="number" name="needs_percent" class="form-control bar percent-input"
                            placeholder="50" value="<?= $needs_percent ?>" min="0" max="100" required>
                        <span class="input-group-reverse">%</span>
                    </div>
                    <div class="center my-3 input-group justify-content-center">
                        <span class="input-group-text">Wants:</span>
                        <input type="number" name="wants_percent" class="form-control bar percent-input"
                            placeholder="30" value="<?= $wants_percent ?>" min="0" max="100" required>
                        <span class="input-group-reverse">%</span>
                    </div>
                    <div class="center my-3 input-group justify-content-center">
                        <span class="input-group-text">Savings:</span>
                        <input type="number" name="savings_percent" class="form-control bar percent-input"
                            placeholder="20" value="<?= $savings_percent ?>" min="0" max="100" required>
                        <span class="input-group-reverse">%</span>
                    </div>
                </div>
                <div class="d-flex justify-content-center mb-4" style="gap:20px;">
                    <a href="index.php" class="btn btns">Back</a>
                    
                    <button type="submit" class="btn btns">Calculate</button>
                </div>
            </form>
        </div>
    </div>
</div>