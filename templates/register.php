<!DOCTYPE html>
<head>
    <link href="https://fonts.googleapis.com/css2?family=Irish+Grover&display=swap" rel="stylesheet">   
    <link rel="stylesheet" href="/css/name.css">
    <link rel="stylesheet" href="/css/register.css">
    <meta charset="utf-8">
    <title>Pizza-market</title>
</head>
<body class="body__center">
    <div class="main-form">
        <div class="title">
            <img src="/uploads/images/pizza.png" class="icon__size" alt="Pizza-market">
            <h1 class="title-main__font" >PIZZA MARKET</h1>
        </div>
        <h2 class="subtitle"> Регистрация </h2>
        <form class="form-register" enctype="multipart/form-data" action="/user/publish" method="POST">
            <p class="labels">Фамилия</p>
            <input class="input__size" type="text" name="second_name" required/>
            <p class="labels">Имя</p>
            <input class="input__size" type="text" name="first_name" required/>
            <p class="labels">Email </p>
            <input class="input__size" type="text" name="email" required/>
            <p class="labels">Телефон </p>
            <input class="input__size" type="text" name="phone" required/>
            <p class="labels">Аватар</p>
            <input type="file" name="avatar_path" accept="image/jpeg, image/png"/>
            <input class="submit" type="submit" value="Продолжить">
        </form>
    </div>  
</body>
</html>