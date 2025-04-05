<?php
session_start();

// Check if user is logged in and OTP verified
if (!isset($_SESSION['user']) || !$_SESSION['user']['logged_in'] || !isset($_SESSION['otp_verified'])) {
    header('Location: login.php');
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel - Siregaon Bandh</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        :root {
            --primary-color: #4361ee;
            --primary-dark: #3a56d4;
            --secondary-color: #4cc9f0;
            --dark-bg: #1f293a;
            --light-bg: #f8f9fa;
            --card-shadow: 0 10px 20px rgba(0, 0, 0, 0.1);
            --transition: all 0.3s ease;
        }

        body {
            background-color: #f5f7fa;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        .admin-header {
            background: linear-gradient(135deg, var(--primary-color) 0%, var(--primary-dark) 100%);
            color: white;
            padding: 2rem 0;
            margin-bottom: 2rem;
            box-shadow: 0 4px 12px rgba(67, 97, 238, 0.2);
        }

        .admin-header h2 {
            font-weight: 700;
            text-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        .admin-container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 15px;
        }

        .card {
            border: none;
            border-radius: 12px;
            box-shadow: var(--card-shadow);
            transition: var(--transition);
            margin-bottom: 25px;
            overflow: hidden;
            height: 100%;
            border-left: 4px solid var(--primary-color);
        }

        .card:hover {
            transform: translateY(-5px);
            box-shadow: 0 15px 30px rgba(0, 0, 0, 0.15);
        }

        .card-header {
            background-color: white;
            border-bottom: none;
            padding: 1.5rem;
            position: relative;
        }

        .card-header h4 {
            color: var(--primary-color);
            font-weight: 600;
            margin: 0;
        }

        .card-header i {
            position: absolute;
            right: 1.5rem;
            top: 50%;
            transform: translateY(-50%);
            font-size: 1.5rem;
            color: var(--primary-color);
            opacity: 0.2;
        }

        .card-body {
            padding: 1.5rem;
        }

        .btn-admin {
            background-color: var(--primary-color);
            color: white;
            border: none;
            border-radius: 8px;
            padding: 0.75rem;
            font-weight: 500;
            transition: var(--transition);
            width: 100%;
        }

        .btn-admin:hover {
            background-color: var(--primary-dark);
            transform: translateY(-2px);
            box-shadow: 0 6px 12px rgba(67, 97, 238, 0.3);
        }

        .btn-admin:active {
            transform: translateY(0);
        }

        .user-info {
            position: absolute;
            top: 20px;
            right: 20px;
            display: flex;
            align-items: center;
        }

        .user-info img {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            margin-right: 10px;
            border: 2px solid white;
        }

        .user-info span {
            color: white;
            font-weight: 500;
        }

        .logout-btn {
            position: absolute;
            top: 20px;
            left: 20px;
        }

        @media (max-width: 768px) {
            .admin-header {
                padding: 1.5rem 0;
            }

            .user-info {
                position: static;
                justify-content: center;
                margin-top: 15px;
            }

            .logout-btn {
                position: static;
                margin-bottom: 15px;
            }
        }
    </style>
</head>

<body>
    <header class="admin-header text-center">
        <div class="container position-relative">
            <a href="logout.php" class="btn btn-light logout-btn">
                <i class="fas fa-sign-out-alt"></i> Logout
            </a>
            <h2>Siregaon Bandh Village Administration</h2>
            <div class="user-info">
                <img src="https://ui-avatars.com/api/?name=<?php echo urlencode($_SESSION['user']['name'] ?? 'Admin'); ?>&background=random"
                    alt="User">
                <span><?php echo $_SESSION['user']['name'] ?? 'Admin'; ?></span>
            </div>
        </div>
    </header>

    <div class="admin-container">
        <div class="row">
            <div class="col-md-4">
                <div class="card">
                    <div class="card-header">
                        <h4><i class="fas fa-users"></i> Members</h4>
                        <i class="fas fa-users"></i>
                    </div>
                    <div class="card-body">
                        <a href="../members/members_list.php" class="btn btn-admin">
                            <i class="fas fa-user-cog me-2"></i> Manage Members
                        </a>
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="card">
                    <div class="card-header">
                        <h4><i class="fas fa-bullhorn"></i> Notice Board</h4>
                        <i class="fas fa-bullhorn"></i>
                    </div>
                    <div class="card-body">
                        <a href="../notice/index.php" class="btn btn-admin">
                            <i class="fas fa-edit me-2"></i> Manage Notices
                        </a>
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="card">
                    <div class="card-header">
                        <h4><i class="fas fa-envelope"></i> Contact Us</h4>
                        <i class="fas fa-envelope"></i>
                    </div>
                    <div class="card-body">
                        <a href="../forms/contact/index.php" class="btn btn-admin">
                            <i class="fas fa-inbox me-2"></i> Manage Contacts
                        </a>
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="card">
                    <div class="card-header">
                        <h4><i class="fas fa-comment-alt"></i> Feedback</h4>
                        <i class="fas fa-comment-alt"></i>
                    </div>
                    <div class="card-body">
                        <a href="../forms/feedback/index.php" class="btn btn-admin">
                            <i class="fas fa-star me-2"></i> Manage Feedback
                        </a>
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="card">
                    <div class="card-header">
                        <h4><i class="fas fa-store"></i> Shops</h4>
                        <i class="fas fa-store"></i>
                    </div>
                    <div class="card-body">
                        <a href="../subindex/shops/index_shops.php" class="btn btn-admin">
                            <i class="fas fa-cog me-2"></i> Manage Shops
                        </a>
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="card">
                    <div class="card-header">
                        <h4><i class="fas fa-calendar-alt"></i> Events</h4>
                        <i class="fas fa-calendar-alt"></i>
                    </div>
                    <div class="card-body">
                        <a href="../event/admin.php" class="btn btn-admin">
                            <i class="fas fa-calendar-check me-2"></i> Manage Events
                        </a>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card">
                    <div class="card-header">
                        <h4><i class="fas fa-file-alt me-2"></i> Forms</h4>
                        <!-- <i class="fas fa-file-alt"></i> -->
                    </div>
                    <div class="card-body">
                        <a href="../forms/village & panchayat form/indexform.php" class="btn btn-admin">
                            <i class="fas fa-tasks me-2"></i> Manage Forms
                        </a>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card">
                    <div class="card-header">
                        <h4><i class="fas fa-images me-2"></i> Gallery</h4>
                        <!-- <i class="fas fa-images"></i> -->
                    </div>
                    <div class="card-body">
                        <a href="../subindex/indexgallery.php" class="btn btn-admin">
                            <i class="fas fa-images me-2"></i> Manage Gallery
                        </a>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card">
                    <div class="card-header">
                        <h4><i class="fas fa-map-marker-alt me-2"></i> Places</h4>
                    </div>
                    <div class="card-body">
                        <a href="../subindex/place_to_visit/admin.php" class="btn btn-admin">
                            <i class="fas fa-map-marker-alt me-2"></i> Manage Places
                        </a>
                    </div>
                </div>

            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Add active class to current card
        document.addEventListener('DOMContentLoaded', function () {
            const cards = document.querySelectorAll('.card');

            cards.forEach(card => {
                card.addEventListener('click', function (e) {
                    if (e.target.tagName === 'A') {
                        cards.forEach(c => c.classList.remove('active'));
                        this.classList.add('active');
                    }
                });
            });
        });
    </script>
</body>

</html>