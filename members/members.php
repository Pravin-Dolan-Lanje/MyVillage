<?php
include '../db_config.php';
// require_once '../Admin/auth_check.php';

// Fetch Members
$sql = "SELECT * FROM members";
$result = $conn->query($sql);
?>
<!DOCTYPE html>
<html lang="en">

<head>
	<title>Members Of Siregaon Bandh </title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
	<link href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700,800,900" rel="stylesheet">

	<link rel="stylesheet" href="../css/open-iconic-bootstrap.min.css">
	<link rel="stylesheet" href="../css/animate.css">

	<link rel="icon" type="image/x-icon" href="./images/favicon.ico">

	<!-- Bootstrap CSS -->
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">

	<!-- FontAwesome for Icons -->
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">

	<!-- <script src="https://maps.googleapis.com/maps/api/js?key=YOUR_API_KEY&callback=initMap" async defer></script> -->


	<link rel="stylesheet" href="../css/owl.carousel.min.css">
	<link rel="stylesheet" href="../css/owl.theme.default.min.css">
	<link rel="stylesheet" href="../css/magnific-popup.css">
    <link rel="stylesheet" href="assets/styles.css">
	<link rel="stylesheet" href="../css/aos.css">
    <link rel="stylesheet" href="assets/styles.css">
	<link rel="stylesheet" href="../css/ionicons.min.css">

	<link rel="stylesheet" href="../css/flaticon.css">
	<link rel="stylesheet" href="../css/icomoon.css">
	<link rel="stylesheet" href="../scss/style.css">

	<!-- Latest AOS CSS -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.css">

<!-- Latest AOS JavaScript -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.js"></script>
</head>
<style>
	.hero-wrap.hero-wrap-2 {
  height: 600px;
}
@media (max-width: 991.98px) {
  .hero-wrap.hero-wrap-2 {
    height: 30vh;
    object-fit: fill;
  }
}
</style>
<body>

	<!-- Navigation Bar -->
	<div id="header-container"></div>
	<!-- END nav -->
	<section class="hero-wrap hero-wrap-2">
		<div class="slide active" data-title="Bringing Home the Trophy! 🥇">
			<img src="../images/vill/membersgram.jpg" alt="Image 1">
		</div>
		<div class="slide" data-title="Meeting">
			<img src="../images/vill/grampanchayat2.jpg" alt="Image 2">
		</div>
		<div class="slide" data-title="Grampanchayat Siregaon/Bandh">
			<img src="../images/vill/grampanchayat.jpg" alt="Image 3">
		</div>
		<div class="slider-controls">
			<button class="prev-btn"><i class="fas fa-chevron-left"></i></button>
			<button class="next-btn"><i class="fas fa-chevron-right"></i></button>
		</div>


		<div class="overlay"></div>
		<div class="container">
			<div class="row no-gutters slider-text align-items-end justify-content-center">
				<div class="col-md-9 ftco-animate pb-5 text-center">
					<h1 class="mb-3 bread" id="image-title">Bringing Home the Trophy! 🥇</h1>
					<p class="breadcrumbs"><span class="mr-2">Members</span></p>
				</div>
			</div>
		</div>
	</section>
    <h1>Members Management</h1>
    <h2>Members List</h2>
    <?php if ($result->num_rows > 0): ?>
        <table>
            <tr>
                <th>Sr. No</th>
                <th>Photo</th>
                <th>Name</th>
                <th>Designation</th>
                <th>Mobile No.</th>
                <th>Email ID</th>
            </tr>
            <?php while ($row = $result->fetch_assoc()): ?>
                <tr>
                    <td><?php echo $row['sr_no']; ?></td>
                    <td><img src="data:image/jpeg;base64,<?= base64_encode($row['photo']); ?>" alt="Photo"></td>
                    <td><?= $row['name']; ?></td>
                    <td><?= $row['designation']; ?></td>
                    <td><?= $row['mobile_no']; ?></td>
                    <td><?= $row['email_id']; ?></td>  
                </tr>
            <?php endwhile; ?>
        </table>
    <?php else: ?>
        <p style="text-align: center;">No members found.</p>
    <?php endif; ?>
    <?php $conn->close(); ?>
	<div id="footer-container"></div>
	<!-- loader -->
	<div id="ftco-loader" class="show fullscreen"><svg class="circular" width="48px" height="48px">
			<circle class="path-bg" cx="24" cy="24" r="22" fill="none" stroke-width="4" stroke="#eeeeee" />
			<circle class="path" cx="24" cy="24" r="22" fill="none" stroke-width="4" stroke-miterlimit="10"
				stroke="#F96D00" />
		</svg></div>

		<script>
	// Function to load HTML into an element
	async function loadHTML(url, elementId) {
	  try {
		const response = await fetch(url);
		const html = await response.text();
		document.getElementById(elementId).innerHTML = html;
	  } catch (err) {
		console.error(`Failed to load ${url}:`, err);
	  }
	}
	
	// Load your components when page loads
	window.addEventListener('DOMContentLoaded', () => {
	  loadHTML('../include/header.html', 'header-container');
	  loadHTML('../include/footer.html', 'footer-container');
	//   loadHTML('include/slider.html', 'slider-container');
	});
	
</script>
	<script src="../js/jquery.min.js"></script>
	<script src="../js/jquery-migrate-3.0.1.min.js"></script>
	<script src="../js/popper.min.js"></script>
	<script src="../js/bootstrap.min.js"></script>
	<script src="../js/jquery.easing.1.3.js"></script>
	<script src="../js/jquery.waypoints.min.js"></script>
	<script src="../js/jquery.stellar.min.js"></script>
	<script src="../js/owl.carousel.min.js"></script>
	<script src="../js/jquery.magnific-popup.min.js"></script>
	<!-- <script src="js/aos.js"></script> -->
	<script src="../js/jquery.animateNumber.min.js"></script>
	<script src="../js/scrollax.min.js"></script>
	<!-- <script src="js/google-map.js"></script> -->
	<script src="../js/main.js"></script>
	<script src="../index.js"></script>
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
	<!-- <link rel="icon" type="image/x-icon" href="./images/favicon.ico"> -->
	
</body>

</html>