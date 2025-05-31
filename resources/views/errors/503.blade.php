<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>We'll be back soon! | Zahin-Oxus</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600;700&display=swap" rel="stylesheet">
    <style>
        :root {
            --primary: #4f46e5;
            --dark: #1e293b;
            --light: #f8fafc;
            --gray: #64748b;
        }
        
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        
        body {
            background: var(--light);
            color: var(--dark);
            font-family: 'Inter', sans-serif;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            padding: 2rem;
            text-align: center;
            line-height: 1.6;
        }
        
        .container {
            max-width: 600px;
            width: 100%;
        }
        
        .logo {
            width: 120px;
            margin-bottom: 2.5rem;
            opacity: 0.8;
        }
        
        h1 {
            font-size: 2.5rem;
            font-weight: 700;
            margin-bottom: 1.5rem;
            line-height: 1.2;
            background: linear-gradient(90deg, var(--primary), #7c3aed);
            -webkit-background-clip: text;
            background-clip: text;
            color: transparent;
        }
        
        p {
            font-size: 1.125rem;
            color: var(--gray);
            margin-bottom: 2rem;
        }
        
        .contact {
            margin-top: 2rem;
            padding-top: 2rem;
            border-top: 1px solid #e2e8f0;
        }
        
        .contact a {
            color: var(--primary);
            text-decoration: none;
            font-weight: 600;
            transition: all 0.3s ease;
        }
        
        .contact a:hover {
            text-decoration: underline;
        }
        
        .animation {
            width: 150px;
            height: 150px;
            margin: 0 auto 2rem;
            position: relative;
        }
        
        .gear {
            position: absolute;
            width: 60px;
            height: 60px;
            animation: rotate 6s linear infinite;
        }
        
        .gear:nth-child(2) {
            right: 0;
            bottom: 0;
            animation-direction: reverse;
            animation-duration: 8s;
        }
        
        @keyframes rotate {
            0% { transform: rotate(0deg); }
            100% { transform: rotate(360deg); }
        }
        
        @media (max-width: 640px) {
            h1 {
                font-size: 2rem;
            }
            
            p {
                font-size: 1rem;
            }
            
            .animation {
                width: 120px;
                height: 120px;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="animation">
            <svg class="gear" viewBox="0 0 50 50" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M47.5 25C47.5 37.4264 37.4264 47.5 25 47.5C12.5736 47.5 2.5 37.4264 2.5 25C2.5 12.5736 12.5736 2.5 25 2.5C37.4264 2.5 47.5 12.5736 47.5 25Z" stroke="#4f46e5" stroke-width="5" stroke-linecap="round" stroke-linejoin="round" stroke-dasharray="5 5"/>
                <path d="M25 12.5V2.5M25 47.5V37.5M12.5 25H2.5M47.5 25H37.5" stroke="#7c3aed" stroke-width="5" stroke-linecap="round"/>
            </svg>
            <svg class="gear" viewBox="0 0 50 50" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M47.5 25C47.5 37.4264 37.4264 47.5 25 47.5C12.5736 47.5 2.5 37.4264 2.5 25C2.5 12.5736 12.5736 2.5 25 2.5C37.4264 2.5 47.5 12.5736 47.5 25Z" stroke="#4f46e5" stroke-width="5" stroke-linecap="round" stroke-linejoin="round" stroke-dasharray="5 5"/>
                <path d="M25 12.5V2.5M25 47.5V37.5M12.5 25H2.5M47.5 25H37.5" stroke="#7c3aed" stroke-width="5" stroke-linecap="round"/>
            </svg>
        </div>
        
        <h1>We're Under Maintenance</h1>
        <p>We're currently performing scheduled maintenance to improve your experience. Please check back soon.</p>
        
        <div class="contact">
            <p>Need immediate assistance?<br>Email us at <a href="mailto:info@zahin-oxus.af">info@zahin-oxus.af</a></p>
        </div>
    </div>
</body>
</html>