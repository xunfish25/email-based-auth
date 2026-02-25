<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home - Email Auth</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            max-width: 600px;
            margin: 100px auto;
            padding: 20px;
            background-color: #f5f5f5;
        }
        .container {
            background: white;
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        }
        h2 {
            text-align: center;
            color: #333;
            margin-bottom: 30px;
        }
        .welcome {
            text-align: center;
            margin-bottom: 30px;
            font-size: 18px;
            color: #666;
        }
        .logout-btn {
            display: block;
            width: 200px;
            margin: 0 auto;
            padding: 12px;
            background-color: #dc3545;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 16px;
            text-align: center;
            text-decoration: none;
        }
        .logout-btn:hover {
            background-color: #c82333;
        }
        .info-box {
            background-color: #e7f3ff;
            border: 1px solid #b3d9ff;
            border-radius: 4px;
            padding: 20px;
            margin-bottom: 20px;
        }
        .info-box h3 {
            margin-top: 0;
            color: #0056b3;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Welcome to Email Auth System</h2>
        
        <div class="welcome">
            <p>Welcome, <strong><?php echo htmlspecialchars($_SESSION['user']); ?></strong>!</p>
            <p>You have successfully logged in.</p>
        </div>
        
        <div class="info-box">
            <h3>Account Information</h3>
            <p><strong>Email:</strong> <?php echo htmlspecialchars($_SESSION['user']); ?></p>
            <p><strong>Status:</strong> Verified</p>
            <p><strong>Login Time:</strong> <?php echo date('Y-m-d H:i:s'); ?></p>
        </div>
        
        <a href="index.php?action=logout" class="logout-btn">Logout</a>
    </div>
</body>
</html>