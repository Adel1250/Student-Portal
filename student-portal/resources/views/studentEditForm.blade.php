<!DOCTYPE html>

<head>
    <style>
        body {
            margin: 0;
            padding: 0;
            font-family: sans-serif;
            background: linear-gradient(120deg, #2980b9, #8e44ad);
            height: 100vh;
            overflow: hidden;
        }

        .center {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            width: 400px;
            background: white;
            border-radius: 10px;
        }

        .center h1 {
            text-align: center;
            padding: 0 0 20px 0;
            border-bottom: 1px solid silver;
        }

        .center form {
            padding: 0 40px;
            box-sizing: border-box;
        }

        .txt_field {
            position: relative;
            border-bottom: 2px solid #adadad;
            margin: 30px 0;
            width: 100%;
            padding: 0 5px;
            height: 40px;
            font-size: 16px;
            border: 1.5px solid;
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

        .signup_link {
            text-align: center;
            font-weight: bold;
        }

        .signup_link a {
            margin: 30px 0;
            text-align: center;
            font-size: 16px;
            color: #2691d9;
            text-decoration: none;
        }
    </style>
</head>

<body>
    <div class="center">
        <h1>Student Edit</h1>
        <form action='studentEdit' method="POST">
            @csrf
            <input class="txt-field" type="text" name="id" placeholder="ID" /><br>
            <span style="color:red">@error ('id') {{$message}} @enderror</span><br><br>
            <input class="txt-field" type="username" name="username" placeholder="Username" /><br>
            <span style="color:red">@error ('username') {{$message}} @enderror</span><br><br>
            <input class="txt-field" type="password" name="password" placeholder="Password" /><br>
            <span style="color:red">@error ('password') {{$message}} @enderror</span><br><br>
            <input class="txt-field" type="email" name="email" placeholder="E-mail" /><br>
            <span style="color:red">@error ('email') {{$message}} @enderror</span><br><br>
            <?php
            if (isset($_SESSION['error'])) {
                echo "<h4 style=color:red><center>" . $_SESSION['error'] . "</center></h4>";
                unset($_SESSION['error']);
            }
            ?>
            <br>
            <button type="submit">Edit</button><br><br>
        </form>
    </div>
</body>

</html>
