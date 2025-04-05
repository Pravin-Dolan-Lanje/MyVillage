<?php
require '../db_config.php';
$sql = "SELECT * FROM newspaper";
$result = $conn->query($sql);

?>

<!DOCTYPE html>
<html lang="en">

<head>
	<title>Newspaper Gallery </title>
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
    <!-- <link rel="stylesheet" href="assets/styles.css"> -->
	<link rel="stylesheet" href="../css/aos.css">

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

.containers {
            max-width: 1200px;
            margin: 0 auto;
            background: white;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
        }
h1 {
            color: #333;
            text-align: center;
            margin-bottom: 30px;
        }
        .image-gallery {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(200px, 1fr));
            gap: 20px;
        }
        .image-card {
            border: 1px solid #ddd;
            border-radius: 5px;
            padding: 10px;
            text-align: center;
        }
        .image-preview {
            max-width: 100%;
            height: auto;
            border-radius: 4px;
            cursor: pointer;
        }
        .no-images {
            text-align: center;
            padding: 20px;
            color: #666;
            font-style: italic;
        }

        /* Lightbox Modal Style */
        .modal {
            display: none;
            position: fixed;
            z-index: 1000;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.8);
            justify-content: center;
            align-items: center;
        }
        .modal-content {
            max-width: 90%;
            max-height: 90%;
        }
        .modal img {
            width: 100%;
            height: auto;
            border-radius: 8px;
        }
        .modal-close {
            position: absolute;
            top: 20px;
            right: 20px;
            color: white;
            font-size: 30px;
            cursor: pointer;
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
					<p class="breadcrumbs"><span class="mr-2">Newspaper Gallery</span></p>
				</div>
			</div>
		</div>
	</section>
	<hr>
	<div class="containers">
        <h1>Newspaper Gallery</h1>

        <?php if ($result && $result->num_rows > 0): ?>
            <div class="image-gallery">
                <?php while ($row = $result->fetch_assoc()): ?>
                    <div class="image-card">
                        <a href="javascript:void(0);" onclick="openModal('<?php echo 'data:'.$row['mime_type'].';base64,'.base64_encode($row['image_data']); ?>')">
                            <img src="data:<?php echo $row['mime_type']; ?>;base64,<?php echo base64_encode($row['image_data']); ?>" class="image-preview" alt="<?php echo htmlspecialchars($row['name']); ?>">
                        </a>
                        <h3><?= htmlspecialchars($row['name']) ?></h3>
                    </div>
                <?php endwhile; ?>
            </div>
        <?php else: ?>
            <div class="no-images">
                <p>No images found in the database.</p>
            </div>
        <?php endif; ?>
    </div>

    <!-- Lightbox Modal -->
    <div id="imageModal" class="modal">
        <span class="modal-close" onclick="closeModal()">&times;</span>
        <div class="modal-content">
            <img id="modalImage" src="" alt="Large Image">
        </div>
    </div>

    <script>
        // Open the modal and display the clicked image
        function openModal(imageData) {
            const modal = document.getElementById("imageModal");
            const modalImage = document.getElementById("modalImage");
            modal.style.display = "flex";
            modalImage.src = imageData;
        }

        // Close the modal
        function closeModal() {
            const modal = document.getElementById("imageModal");
            modal.style.display = "none";
        }

        // Close the modal if clicked outside the image
        window.onclick = function(event) {
            const modal = document.getElementById("imageModal");
            if (event.target === modal) {
                modal.style.display = "none";
            }
        }
    </script>

	<hr>
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
	<script src="gallery.js"></script>
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