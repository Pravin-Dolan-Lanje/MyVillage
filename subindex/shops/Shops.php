<?php  
require '../../db_config.php';

$sql = "SELECT * FROM shops ORDER BY created_at DESC";
$result = $conn->query($sql);
?>
<!DOCTYPE html>
<html lang="en">

<head>
	<title>Shops Of Siregaon Bandh </title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
	<link href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700,800,900" rel="stylesheet">

	<link rel="stylesheet" href="../../css/open-iconic-bootstrap.min.css">
	<link rel="stylesheet" href="../../css/animate.css">

	<link rel="icon" type="image/x-icon" href="./images/favicon.ico">

	<!-- Bootstrap CSS -->
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">

	<!-- FontAwesome for Icons -->
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">

	<!-- <script src="https://maps.googleapis.com/maps/api/js?key=YOUR_API_KEY&callback=initMap" async defer></script> -->


	<link rel="stylesheet" href="../../css/owl.carousel.min.css">
	<link rel="stylesheet" href="../../css/owl.theme.default.min.css">
	<link rel="stylesheet" href="../../css/magnific-popup.css">
    <!-- <link rel="stylesheet" href="assets/styles.css"> -->
	<link rel="stylesheet" href="../../css/aos.css">

	<link rel="stylesheet" href="../../css/ionicons.min.css">

	<link rel="stylesheet" href="../../css/flaticon.css">
	<link rel="stylesheet" href="../../css/icomoon.css">
	<link rel="stylesheet" href="../../scss/style.css">

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
.shop-card {
            transition: transform 0.3s ease-in-out;
        }
        .shop-card:hover {
            transform: scale(1.05);
        }
        .shop-image {
            height: 200px;
            object-fit: fill;
        }
		
    /* .header {
        text-align: center;
        margin-bottom: 40px;
        padding-bottom: 20px;
        border-bottom: 1px solid #eaeaea;
    }
     */
    h1 {
        color: #2c3e50;
        margin-bottom: 10px;
        font-size: 2rem;
    }
    
    .subtitle {
        color: #7f8c8d;
        font-weight: normal;
        font-size: 1rem;
        margin-top: 0;
    }
    
    .shops-containers {
        display: grid;
        grid-template-columns: repeat(2, 1fr);
        gap: 25px;
        margin-top: 25px;
    }
    
    .shop-card {
        background-color: white;
        border-radius: 8px;
        box-shadow: 0 3px 6px rgba(0, 0, 0, 0.1);
        overflow: hidden;
        transition: transform 0.3s ease, box-shadow 0.3s ease;
        display: flex;
        flex-direction: column;
        height: 400px;
    }
    
    .shop-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 8px 15px rgba(0, 0, 0, 0.1);
    }
    
    .shop-image-containers {
        width: 100%;
        height: 300px;
        overflow: hidden;
        position: relative;
    }
    
    .shop-image {
        width: 100%;
        height: 80%;
        object-fit: fill;
        object-position: center;
        transition: transform 0.5s ease;
    }
    
    .shop-card:hover .shop-image {
        transform: scale(1.05);
    }
    
    .shop-info {
        padding: 20px;
        flex-grow: 1;
        display: flex;
        flex-direction: column;
    }
    
    .shop-name {
        font-size: 18px;
        margin: 0 0 12px 0;
        color: #2c3e50;
    }
    
    .shop-description {
        color: #7f8c8d;
        line-height: 1.5;
        margin-bottom: 15px;
        flex-grow: 1;
        font-size: 14px;
        display: -webkit-box;
        -webkit-line-clamp: 3;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }
    
    .no-image {
        width: 100%;
        height: 220px;
        background-color: #ecf0f1;
        display: flex;
        align-items: center;
        justify-content: center;
        color: #7f8c8d;
        font-size: 14px;
    }
    
    .search-containers {
        margin-bottom: 25px;
        display: flex;
        justify-content: center;
    }
    
    .search-box {
        padding: 10px 18px;
        width: 60%;
        border: 1px solid #ddd;
        border-radius: 25px;
        font-size: 14px;
        outline: none;
        transition: all 0.3s;
    }
    
    .search-box:focus {
        border-color: #3498db;
        box-shadow: 0 0 0 3px rgba(52, 152, 219, 0.2);
    }
    
    .no-shops {
        grid-column: 1 / -1;
        text-align: center;
        padding: 30px;
        background-color: white;
        border-radius: 8px;
        box-shadow: 0 3px 6px rgba(0, 0, 0, 0.1);
    }
    
  
    /* Responsive adjustments */
    @media (max-width: 768px) {
        .shops-container {
            grid-template-columns: 1fr;
            gap: 20px;
        }
        
        .shop-card {
            height: auto;
        }
        
        .shop-image-containers {
            height: 200px;
        }
        
        .search-box {
            width: 100%;
        }
        
        h1 {
            font-size: 1.8rem;
        }
    }
    
    @media (max-width: 480px) {
        body {
            padding: 15px;
        }
        
        .shop-image-containers {
            height: 180px;
        }
        
        .no-image {
            height: 180px;
        }
    }
</style>
<body>

	<!-- Navigation Bar -->
	<div id="header-container"></div>
	<!-- END nav -->
	<section class="hero-wrap hero-wrap-2">
		<div class="slide active" data-title="Bringing Home the Trophy! 🥇">
			<img src="../../images/vill/membersgram.jpg" alt="Image 1">
		</div>
		<div class="slide" data-title="Meeting">
			<img src="../../images/vill/grampanchayat2.jpg" alt="Image 2">
		</div>
		<div class="slide" data-title="Grampanchayat Siregaon/Bandh">
			<img src="../../images/vill/grampanchayat.jpg" alt="Image 3">
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
					<p class="breadcrumbs"><span class="mr-2">Shops</span></p>
				</div>
			</div>
		</div>
	</section>
	<hr>
	
    </style>
</head>
<body>
   
    <div class="header">
        <h1>Our Shops</h1>
        <p class="subtitle">Browse through our collection of wonderful shops</p>
    </div>
    
    <div class="search-containers">
        <input type="text" class="search-box" placeholder="Search shops..." id="searchInput" onkeyup="searchShops()">
    </div>
    
    <div class="shops-containers" id="shopsContainer">
        <?php
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                echo '<div class="shop-card">';
                
                if (!empty($row['image_path'])) {
                    $image_path = str_replace('\\', '/', $row['image_path']);
					// $image_path = 'shops/' . str_replace('\\', '/', $row['image_path']);
                    
                    if (file_exists($image_path)) {
                        $web_path = $row['image_path'];
                        if (strpos($image_path, $_SERVER['DOCUMENT_ROOT']) === 0) {
                            $web_path = str_replace($_SERVER['DOCUMENT_ROOT'], '', $image_path);
                        }
                        
                        echo '<div class="shop-image-containers">';
                        echo '<img src="' . htmlspecialchars($web_path) . '" class="shop-image" alt="' . htmlspecialchars($row['name']) . '">';
                        echo '</div>';
                    } else {
                        echo '<div class="no-image">Image not found</div>';
                    }
                } else {
                    echo '<div class="no-image">No Image Available</div>';
                }
                
                echo '<div class="shop-info">';
                echo '<h2 class="shop-name">' . htmlspecialchars($row['name']) . '</h2>';
                echo '<p class="shop-description">' . htmlspecialchars($row['description']) . '</p>';
                echo '</div>';
                
                echo '</div>';
            }
        } else {
            echo '<div class="no-shops">';
            echo '<h2>No shops available at the moment</h2>';
            echo '<p>Please check back later or contact support for more information.</p>';
            echo '</div>';
        }
        ?>
    </div>

    
	<hr>
	<div id="footer-container"></div>
    <script>
        function searchShops() {
            const input = document.getElementById('searchInput');
            const filter = input.value.toUpperCase();
            const container = document.getElementById('shopsContainer');
            const cards = container.getElementsByClassName('shop-card');

            for (let i = 0; i < cards.length; i++) {
                const name = cards[i].getElementsByClassName('shop-name')[0].textContent;
                const description = cards[i].getElementsByClassName('shop-description')[0].textContent;
                
                if (name.toUpperCase().indexOf(filter) > -1 || description.toUpperCase().indexOf(filter) > -1) {
                    cards[i].style.display = "";
                } else {
                    cards[i].style.display = "none";
                }
            }
        }
    </script>
	

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
	<script src="../../js/jquery.min.js"></script>
	<script src="../../js/jquery-migrate-3.0.1.min.js"></script>
	<script src="../../js/popper.min.js"></script>
	<script src="../../js/bootstrap.min.js"></script>
	<script src="../../js/jquery.easing.1.3.js"></script>
	<script src="../../js/jquery.waypoints.min.js"></script>
	<script src="../../js/jquery.stellar.min.js"></script>
	<script src="../../js/owl.carousel.min.js"></script>
	<script src="../../js/jquery.magnific-popup.min.js"></script>
	<!-- <script src="js/aos.js"></script> -->
	<script src="../../js/jquery.animateNumber.min.js"></script>
	<script src="../../js/scrollax.min.js"></script>
	<!-- <script src="js/google-map.js"></script> -->
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

	<script src="../../js/main.js"></script>
	<script src="../../index.js"></script>
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
	<!-- <link rel="icon" type="image/x-icon" href="./images/favicon.ico"> -->
	
</body>

</html>