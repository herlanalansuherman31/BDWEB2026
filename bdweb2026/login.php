<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - NsqlNPb</title>

    <style>

        *{
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body{
            font-family: Arial, sans-serif;

            background:
            linear-gradient(to top,
            rgba(0,0,0,0.75),
            rgba(0,0,0,0.75)),
            url("home/image/tech.jpg");

            background-size: cover;             
            background-position: center;

            height: 100vh;

            display: flex;
            justify-content: center;
            align-items: center;

            overflow: hidden;
        }

        /* glow background */
        .bg-glow{
            position: absolute;

            width: 500px;
            height: 500px;

            background: #23c0e7;

            border-radius: 50%;

            filter: blur(150px);

            opacity: 0.12;

            z-index: 0;
        }

        /* login card */
        .login-container{

            position: relative;
            z-index: 2;

            width: 420px;

            padding: 45px;

            border-radius: 28px;

            background: rgba(10,15,35,0.45);

            backdrop-filter: blur(12px);

            border: 1px solid rgba(35,192,231,0.25);

            box-shadow:
            0 0 30px rgba(35,192,231,0.12),
            inset 0 0 20px rgba(255,255,255,0.03);
        }

        /* logo */
        .logo{
            text-align: center;
            margin-bottom: 25px;
        }

        .logo img{
            width: 85px;
        }

        /* title */
        .login-container h2{

            color: white;

            font-size: 42px;

            text-align: center;

            margin-bottom: 10px;

            font-family: 'Arial Black', sans-serif;

            text-shadow:
            0 0 15px rgba(35,192,231,0.2);
        }

        /* subtitle */
        .subtitle{

            text-align: center;

            color: #a7d8ff;

            font-size: 14px;

            letter-spacing: 2px;

            margin-bottom: 35px;
        }

        /* input group */
        .input-group{
            margin-bottom: 22px;
        }

        .input-group label{

            display: block;

            color: #7ebeff;

            margin-bottom: 10px;

            font-size: 13px;

            letter-spacing: 2px;
        }

        .input-group input{

            width: 100%;

            padding: 16px 18px;

            border-radius: 14px;

            border: 1px solid rgba(255,255,255,0.1);

            background: rgba(255,255,255,0.05);

            color: white;

            outline: none;

            font-size: 15px;

            transition: 0.3s;
        }

        .input-group input:focus{

            border-color: #23c0e7;

            box-shadow:
            0 0 15px rgba(35,192,231,0.25);
        }

        /* button */
        .login-btn{

            width: 100%;

            padding: 16px;

            border: none;

            border-radius: 14px;

            background:
            linear-gradient(135deg,#23c0e7,#1b7cff);

            color: white;

            font-size: 15px;

            font-weight: bold;

            cursor: pointer;

            transition: 0.3s;

            margin-top: 10px;

            box-shadow:
            0 0 20px rgba(35,192,231,0.2);
        }

        .login-btn:hover{
            transform: translateY(-3px);

            box-shadow:
            0 0 25px rgba(35,192,231,0.35);
        }

        /* footer text */
        .footer-text{

            text-align: center;

            margin-top: 25px;

            color: #8caed6;

            font-size: 13px;
        }

    </style>

</head>

<body>

    <div class="bg-glow"></div>

    <div class="login-container">

        <div class="logo">
            <img src="home/image/logo.png" alt="Logo">
        </div>

        <h2>LOGIN</h2>

        <p class="subtitle">
            DATABASE MANAGEMENT SYSTEM
        </p>

        <form action="proses_login.php" method="POST">

            <div class="input-group">
                <label>USERNAME</label>

                <input
                    type="text"
                    name="username"
                    placeholder="Masukkan username"
                    required
                >
            </div>

            <div class="input-group">
                <label>PASSWORD</label>

                <input
                    type="password"
                    name="password"
                    placeholder="Masukkan password"
                    required
                >
            </div>

            <button type="submit" class="login-btn">
                ACCESS SYSTEM
            </button>

        </form>


    </div>

</body>
</html>
```
