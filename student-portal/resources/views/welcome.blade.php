<!DOCTYPE html>
<html lang="en">
<link rel="stylesheet" href="bootstrap-4.1.3-dist/css/bootstrap.min.css">
<script src="https://use.fontawesome.com/releases/v5.5.0/js/all.js"></script>

<head>
    <title>Student Portal</title>
    <style>
        body {
            margin: 0;
            padding: 0;
            font-family: sans-serif;
            background: linear-gradient(100deg, #2980b9, #8e44ad);
            height: 100vh;
            overflow: hidden;
            color: white;

        }

        button[type="submit"] {
            width: 100%;
            height: 50px;
            border: 1px solid;
            background: #2691d9;
            border-radius: 25px;
            font-size: 18px;
            color: #e9f4fb;
            font-weight: 700;
            cursor: pointer;
            outline: none;
        }

        button[type="submit"]:hover {
            border-color: #2691d9;
            transition: -5s;
        }

        .center {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            width: 400px;
        }

        .center h1 {

            text-align: center;
            font-size: 30.5px;
            padding: 0 0 20px 0;
            border-bottom: 1px solid silver;
        }

        .signup_link {
            text-align: center;
            font-weight: bold;
        }

        .signup_link a {
            margin: 30px 0;
            text-align: center;
            font-size: 16px;
            color: azure;
            text-decoration: none;

        }

        footer {
            position: fixed;
            left: 0;
            bottom: 0;
            width: 100%;
            color: white;
            text-align: center;
        }
    </style>
</head>

<body>
    <div class="center">
        <h1>Welcome to Student Portal</h1>
        <form action="login">
            <button type="submit">Login</button><br><br>
        </form>

    </div>
</body>

</html>
