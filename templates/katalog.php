<?php
/**
 * @var App\Model\User $user
 * @var App\Model\Pizza[] $pizzas
 */
?>

<!DOCTYPE html>
<head>
    <link href="https://fonts.googleapis.com/css2?family=Irish+Grover&display=swap" rel="stylesheet">   
    <link rel="stylesheet" href="/css/name.css">
    <link rel="stylesheet" href="/css/katalog.css">
    <meta charset="utf-8">
    <title>Pizza-market</title>
</head>
<body>
    <header class="header__background">
        <div class="title">
            <img class="icon__size" src="/uploads/images/pizza.png" alt="Pizza-market">
            <h1 class="title-main__font" >PIZZA MARKET</h1>
        </div>
        <div class="user">
            <div class="user__naming">
                <p>Антышев Е.</p>
                <p>2003antyshev@mail.ru</p>
            </div>
            <img src="/uploads/images/camera.png" alt="camera">
        </div>
    </header>
    <main class="main__display">
        <h2 class="subtitle">Ассортимент</h2>
        <div class="assortiment">
            <div class="card">
                <img class="card__img" src="/uploads/images/chiken-ranch.png" alt="chiken-ranch">
                <p class="card__title">Цыпленок</p>
                <p class="card__subtitle">Цыпленок, ветчина, соус ранч, моцарелла, чеснок</p>
                <div class="card__order">
                    <div class="card__prices">
                        <p class="card__price">461 ₽</p>
                        <p class="card__last-price ">549 ₽</p>
                    </div>
                    <button class="card__buy">Купить</button>
                </div>
            </div>
        </div>
    </main>
    <footer class="footer__background">
        <p class="title-main__font" >PIZZA MARKET</p>
        <p class="footer__copyrite">© CopyRite 555Jeka555 2023</p>
    </footer>
</body>
</html>