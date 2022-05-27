<!DOCTYPE html>
<html lang="en">

<head>
    <title>Delete</title>
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
    <script>
        function validateForm() {
            if ((document.getElementById('student').checked != true) && (document.getElementById('course').checked != true) && (document.getElementById('teacher').checked != true)) {
                alert("Radio button must be checked");
                return false;
            }
        }
    </script>
</head>

<body>
    <div class="center">
        <h1>Delete</h1>
        <form action="delete" method="post" onsubmit="return validateForm()">
            @csrf
            <input class="txt-field" type="text" name="id" placeholder="ID" /><br><br>
            <label class="mt-checkbox">
                <input type="radio" id="teacher" name="radio" value="teacher"> Teacher
            </label>
            <label class="mt-checkbox">
                <input type="radio" id="course" name="radio" value="course"> Course
            </label>
            <label class="mt-checkbox">
                <input type="radio" id="student" name="radio" value="student"> Student
            </label>
            <br><br>
            <?php
            if (isset($_SESSION['error'])) {
                echo "<h4 style=color:red><center>" . $_SESSION['error'] . "</center></h4>";
                unset($_SESSION['error']);
            }
            ?>
            <button type="submit">Delete</button><br>
            <br>
            <div class="signup_link">
                <a href="/adminProfile">Admin Profile</a> <br>
            </div>
        </form>
    </div>
</body>

</html>
