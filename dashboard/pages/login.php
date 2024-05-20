<?php
include '../proses.php';
$db = new Connect_db();
if (isset($_POST["signup"])) {
    $username = $_POST["username"];
    $no_wa = $_POST["no_wa"];
    $email = $_POST["email"];
    $password = $_POST["password"];
    $db->signUp($username, $no_wa, $email, $password);
    $status = $_SESSION['status'];
    $message = $_SESSION['message'];
    unset($_SESSION['status']);
    unset($_SESSION['message']);
}
if (isset($_POST["signin"])) {
    $username = $_POST["username"];
    $password = $_POST["password"];
    $db->signIn($username, $password);
    $status = $_SESSION['status'];
    $message = $_SESSION['message'];
    unset($_SESSION['status']);
    unset($_SESSION['message']);
}

if (isset($_SESSION['login'])) {
    header("Location: ../order/index.php");
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="../css/login.css">
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
	<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
	<title>Halaman Login</title>
</head>

<body style="overflow-y: hidden;">
	<h2>Halaman Login</h2>
	<div class="container" id="container">
		<div class="form-container sign-up-container">
			<form action="" method="post">
				<h1>Buat Akun</h1>
				<input type="text" placeholder="Username" name="username" autocomplete="off" required id="register-username"/>
				<input type="text" placeholder="No Whatsapp" name="no_wa" autocomplete="off" required  id="register-wa"/>
				<input type="email" placeholder="Email" name="email" autocomplete="off" required id="register-email"/>
				<input type="password" placeholder="Password" name="password" autocomplete="off" required id="register-password"/>
				<button type="submit" name="signup">Daftar</button>
			</form>
		</div>
		<div class="form-container sign-in-container">
			<form action="" method="post">
				<h1>Sign in</h1>
				<input type="username" placeholder="Username" name="username" autocomplete="off" required
					id="login-username" />
				<input type="password" placeholder="Password" name="password" autocomplete="off" required
				id="login-password" />

				<button type="submit" name="signin">Sign In</button>
			</form>
		</div>
		<div class="overlay-container">
			<div class="overlay">
				<div class="overlay-panel overlay-left">
					<h1>punya akun ?</h1>
					<p></p>
					<button class="ghost" id="signIn">Sign In</button>
				</div>
				<div class="overlay-panel overlay-right">
					<h1>Selamat Datang</h1>
					<p>Untuk bisa dapatkan tiket, silahkan daftar terlebih dahulu</p>
					<button class="ghost" id="signUp">Sign Up</button>
				</div>
			</div>
		</div>
	</div>


	<script src="../js/login.js"></script>
	<script>
		$(document).ready(function () {
			<?php if (isset($status) && isset($message)): ?>
				showAlert('<?=ucfirst($status);?>', '<?=$status;?>', '<?=$message;?>')
			<?php endif;?>

			$('#login-username').on({
				invalid: (e) => setValid(e, "Username Tidak Boleh Kosong!"),
				input: (e) => e.target.setCustomValidity("")
			})
			$('#login-password').on({
				invalid: (e) => setValid(e, "Password Tidak Boleh Kosong!"),
				input: (e) => e.target.setCustomValidity("")
			})
			$('#register-username').on({
				invalid: (e) => setValid(e, "Username Tidak Boleh Kosong!"),
				input: (e) => e.target.setCustomValidity("")
			})
			$('#register-wa').on({
				invalid: (e) => setValid(e, "Nomor WA Tidak Boleh Kosong!"),
				input: (e) => e.target.setCustomValidity("")
			})
			$('#register-email').on({
				invalid: (e) => setValid(e, "Email Tidak Boleh Kosong!"),
				input: (e) => e.target.setCustomValidity("")
			})
			$('#register-password').on({
				invalid: (e) => setValid(e, "Password Tidak Boleh Kosong!"),
				input: (e) => e.target.setCustomValidity("")
			})
		});

		function setValid(e, message){
			e.target.setCustomValidity("");
			if (!e.target.validity.valid) {
				e.target.setCustomValidity(message);
			}
		}

		function showAlert(title, icon, message) {
			Swal.fire({
				title: title,
				text: message,
				icon: icon,
			})
		}
	</script>
</body>

</html>
