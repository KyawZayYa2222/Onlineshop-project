<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>404 not found</title>
    <style>
        body{
            margin: 0;
            padding: 0;
        }
        .container{
            width: 100%;
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
        }
        .semi-con{
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            line-height: 0%;
        }
        .semi-con h1{
            color: #58AE39;
            font-size: 10rem;
            font-family: 'Segoe UI', Verdana, sans-serif;
            text-shadow: 2px 2px 3px yellowgreen;
        }
        .semi-con h2, .semi-con h3{
            color: gray;
            font-family: sans-serif;
        }
        .semi-con a{
            padding: 1rem;
            color: whitesmoke;
            text-decoration: none;
            font-family: Geneva, Tahoma, sans-serif;
            background-color: #58AE39;
            border-radius: 5px;
            transition: 0.2s;
        }
        .semi-con a:hover {
            box-shadow: 2px 2px 3px yellowgreen, 3px 3px 4px rgb(136, 171, 67);
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="semi-con">
            <h2>Oops! Page Not Found</h2>
            <h1>404</h1>
            <h3>The page you're looking for is not found.</h3>
            <a href="{{url()->previous()}}">Back To Home</a>
        </div>
    </div>
</body>
</html>
