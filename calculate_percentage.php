<?php
$salary = $_POST['salary'] ?? 0;
$needs_percent = $_POST['needs_percent'] ?? 50;
$wants_percent = $_POST['wants_percent'] ?? 30;
$savings_percent = $_POST['savings_percent'] ?? 20;

$total_percent = $needs_percent + $wants_percent + $savings_percent;
$response = ['showResults' => false, 'error' => ''];

if ($total_percent < 100) {
    $remaining = 100 - $total_percent;
    $savings_percent += $remaining;
    $response['error'] = "Remaining $remaining% has been added to Savings automatically.";
    $response['showResults'] = true;
} elseif ($total_percent == 100) {
    $response['showResults'] = true;
} else {
    $response['error'] = 'Total percentage exceeded 100%. Please adjust the values.😾';
}

if ($response['showResults']) {
    $response['salary'] = number_format($salary, 2);
    $response['needs'] = number_format($salary * $needs_percent / 100, 2);
    $response['wants'] = number_format($salary * $wants_percent / 100, 2);
    $response['savings'] = number_format($salary * $savings_percent / 100, 2);
    $response['needs_percent'] = $needs_percent;
    $response['wants_percent'] = $wants_percent;
    $response['savings_percent'] = $savings_percent;
}

echo json_encode($response);
?>
