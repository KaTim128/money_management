<?php
require('header.php');

if (isset($_SESSION['user_id'])) {
    $select_query = "SELECT * FROM users WHERE user_id = $user_id";
    $result_query = mysqli_query($conn, $select_query);
    $rows = mysqli_fetch_assoc($result_query);

    $total_salary = $rows['total_salary'];
    $needs_percent = $rows['needs_percent'];
    $wants_percent = $rows['wants_percent'];
    $savings_percent = $rows['savings_percent'];

    $needs_amount = $rows['needs_amount'];
    $wants_amount = $rows['wants_amount'];
    $savings_amount = $rows['savings_amount'];

    $goal_total = isset($_POST['goal_total']) ? $_POST['goal_total'] : 5000;
    $want_cut = isset($_POST['want_cut']) ? (int) $_POST['want_cut'] : 30;
    $want_goals = $wants_amount * ($want_cut / 100);
    $daily_income = $total_salary / 31;

    $year_total = ($total_salary * 12);
    $monthly_goals = $want_goals;
    $weekly_goals = $monthly_goals / 4;
    $daily_goals = $weekly_goals / 7;

    $months_required = $monthly_goals > 0 ? ceil($goal_total / $monthly_goals) : 0;
    $weeks_required = $weekly_goals > 0 ? ceil($goal_total / $weekly_goals) : 0;
    $days_required = $daily_goals > 0 ? ceil($goal_total / $daily_goals) : 0;
    $years_required = $months_required > 0 ? ceil($months_required / 12) : 0;

    if (isset($_POST['want_cut']) && is_numeric($_POST['want_cut'])) {
        $want_cut = $_POST['want_cut'] / 100;
    } else {
        $want_cut = $rows['want_cut']; // Fallback to existing value if empty or invalid
    }


    if (isset($_POST['update'])) {
        $goal_total = $_POST['goal_total'];
        $want_cut = (int) $_POST['want_cut']; // Save as integer

        $query = "UPDATE users 
                  SET goal_amount = '$goal_total',
                      want_cut = '$want_cut'
                  WHERE user_id = $user_id";

        $update_result = mysqli_query($conn, $query);
    }

} else {
    header("Location: login.php");
    exit();
}
?>

<div class="container mt-4">
    <div class="row text-center mb-4">
        <h3 class="fw-bold">Goal Spending Overview 💸</h3>
        <p class="text-muted">Track your progress towards your RM<?= number_format($goal_total, 2) ?> goal.</p>
    </div>

    <div class="row g-4">
        <div class="col-md-6">
            <div class="card shadow-sm rounded-4 p-4 mb-3">
                <h5 class="fw-semibold">Annual Estimated Income</h5>
                <h6>🪙 RM<?= number_format($year_total, 2) ?></h6>

                <h5 class="fw-semibold mt-2">Monthly Estimated Income</h5>
                <h6>🪙 RM<?= number_format($total_salary, 2) ?></h6>

                <h5 class="fw-semibold mt-2">Daily Estimated Income</h5>
                <h6>🪙 RM<?= number_format($daily_income, 2) ?></h6>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card shadow-sm rounded-4 p-4 mb-3">
                <h5 class="fw-semibold">Estimated Time to Reach Goal</h5>
                <ul class="list-group list-group-flush text-start">
                    <li class="list-group-item"><strong>Days:</strong> <?= $days_required ?></li>
                    <li class="list-group-item"><strong>Weeks:</strong> <?= $weeks_required ?></li>
                    <li class="list-group-item"><strong>Months:</strong> <?= $months_required ?></li>
                    <li class="list-group-item"><strong>Years:</strong> <?= $years_required ?></li>
                </ul>
            </div>
        </div>
    </div>

    <div class="row mt-2">
        <div class="col-md-12 d-flex justify-content-center gap-3">
            <button class="btn btn-outline-warning" onclick="toggleView('daily')">Daily Spending</button>
            <button class="btn btn-outline-success" onclick="toggleView('weekly')">Weekly Spending</button>
            <button class="btn btn-outline-primary" onclick="toggleView('monthly')">Monthly Spending</button>
        </div>
    </div>

    <div class="row mt-4">
        <!-- Spending Breakdown Section (Full Height) -->
        <div class="col-md-6 mb-4">
            <div class="row">
                <div class="col-md-12">
                    <div id="daily" class="spending-view card shadow-sm rounded-4 p-5">
                        <h5>Daily Spending Breakdown</h5>
                        <p><strong>Goals:</strong> RM<?= number_format($daily_goals, 2) ?></p>
                        <p><strong>Needs:</strong> RM<?= number_format(($needs_amount / 30), 2) ?></p>
                        <p><strong>Wants:</strong> RM<?= number_format((($wants_amount / 30) - $daily_goals), 2) ?></p>
                        <p><strong>Savings:</strong> RM<?= number_format(($savings_amount / 30), 2) ?></p>
                    </div>
                </div>

                <div class="col-md-12">
                    <div id="weekly" class="spending-view card shadow-sm rounded-4 p-5" style="display:none;">
                        <h5>Weekly Spending Breakdown</h5>
                        <p><strong>Goals:</strong> RM<?= number_format($weekly_goals, 2) ?></p>
                        <p><strong>Needs:</strong> RM<?= number_format($needs_amount / 4, 2) ?></p>
                        <p><strong>Wants:</strong> RM<?= number_format(($wants_amount / 4) - $weekly_goals, 2) ?></p>
                        <p><strong>Savings:</strong> RM<?= number_format($savings_amount / 4, 2) ?></p>
                    </div>
                </div>

                <div class="col-md-12">
                    <div id="monthly" class="spending-view card shadow-sm rounded-4 p-5" style="display:none;">
                        <h5>Monthly Spending Breakdown</h5>
                        <p><strong>Goals:</strong> RM<?= number_format($monthly_goals, 2) ?></p>
                        <p><strong>Needs:</strong> RM<?= number_format($needs_amount, 2) ?></p>
                        <p><strong>Wants:</strong> RM<?= number_format($wants_amount - $monthly_goals, 2) ?></p>
                        <p><strong>Savings:</strong> RM<?= number_format($savings_amount, 2) ?></p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Form Section (Side by Side with Breakdown) -->
        <div class="col-md-6 mb-4">
            <div class="card shadow-sm rounded-4 p-4 h-100">
                <form method="POST" action="">
                    <label for="goal_total" class="form-label">Set Your Goal Amount (RM)</label>
                    <input type="number" min="0" name="goal_total" id="goal_total" class="form-control"
                        value="<?= $goal_total ?>" required>

                    <label for="want_cut" class="form-label mt-3">Adjust Want Cut (%)</label>
                    <input type="number" min="0" max="100" name="want_cut" id="want_cut" class="form-control"
                        value="<?= $want_cut ?>" required>

                    <button class="btn btns mt-3 w-100" name="update" type="submit">Update</button>
                </form>
            </div>
        </div>
    </div>

</div>

<script>
    function toggleView(view) {
        const views = document.querySelectorAll('.spending-view');
        views.forEach(v => v.style.display = 'none');
        document.getElementById(view).style.display = 'block';
    }
</script>

<?php
require('footer.php');
?>f