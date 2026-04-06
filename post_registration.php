<?php
// ============================================================
//  post_registration.php
//  Handles form data submitted via HTTP POST ($_POST)
// ============================================================

$method = "POST";
$source = '$_POST';
$data   = [];
$errors = [];

// ── Collect & sanitise ───────────────────────────────────────
function clean($val) {
    return htmlspecialchars(trim($val ?? ''), ENT_QUOTES, 'UTF-8');
}

$firstName       = clean($_POST['first_name']       ?? '');
$lastName        = clean($_POST['last_name']        ?? '');
$email           = clean($_POST['email']            ?? '');
$phone           = clean($_POST['phone']            ?? '');
$dob             = clean($_POST['dob']              ?? '');
$gender          = clean($_POST['gender']           ?? '');
$username        = clean($_POST['username']         ?? '');
$password        = $_POST['password']               ?? '';        // NOT stored in real apps
$confirmPassword = $_POST['confirm_password']       ?? '';
$course          = clean($_POST['course']           ?? '');
$address         = clean($_POST['address']          ?? '');
$terms           = isset($_POST['terms']);

// ── Validation ───────────────────────────────────────────────
if ($firstName === '')              $errors['first_name']       = 'First name is required.';
if ($lastName  === '')              $errors['last_name']        = 'Last name is required.';
if (!filter_var($email, FILTER_VALIDATE_EMAIL))
                                    $errors['email']            = 'Enter a valid e-mail address.';
if ($phone !== '' && !preg_match('/^\d{10}$/', preg_replace('/\D/', '', $phone)))
                                    $errors['phone']            = 'Phone must be 10 digits.';
if ($dob === '')                    $errors['dob']              = 'Date of birth is required.';
if ($gender === '')                 $errors['gender']           = 'Please select your gender.';
if (!preg_match('/^[a-zA-Z0-9_]{4,20}$/', $username))
                                    $errors['username']         = 'Username: 4–20 chars (letters, numbers, _).';
if (!preg_match('/^(?=.*[A-Z])(?=.*\d)(?=.*[^A-Za-z0-9]).{8,}$/', $password))
                                    $errors['password']         = 'Password needs 8+ chars, uppercase, digit & special char.';
if ($password !== $confirmPassword) $errors['confirm_password'] = 'Passwords do not match.';
if (!$terms)                        $errors['terms']            = 'You must accept the Terms of Service.';

// ── Age calculation ──────────────────────────────────────────
$age = '';
if ($dob !== '') {
    $birthDate = new DateTime($dob);
    $today     = new DateTime();
    $age       = $today->diff($birthDate)->y . ' years';
}

// ── Data row for display ─────────────────────────────────────
$data = [
    'Full Name'    => trim("$firstName $lastName"),
    'Email'        => $email,
    'Phone'        => $phone ?: '—',
    'Date of Birth'=> $dob ? date('d M Y', strtotime($dob)) . " ($age)" : '—',
    'Gender'       => ucfirst(str_replace('_',' ', $gender)) ?: '—',
    'Username'     => $username,
    'Course'       => $course ?: '—',
    'Address'      => $address ?: '—',
    'Terms'        => $terms ? '✓ Accepted' : '✗ Not accepted',
    'Submitted via'=> "HTTP $method using $source",
];

$success = empty($errors);
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8"/>
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title><?= $success ? 'Registration Successful' : 'Registration Failed' ?> — POST</title>
  <?php include '_result_styles.php'; ?>
</head>
<body>
<?php include '_result_body.php'; ?>
</body>
</html>
