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
                <p class="user__naming_overflow"><?= htmlentities($user->getSecondName() . " " . htmlentities($user->getFirstName())) ?></p>
                <p class="user__naming_overflow"><?= htmlentities($user->getEmail()) ?></p>
            </div>
            <?php if ($user->getAvatarPath() !== null) : ?>
                <img class="user__avatar_size" src="/uploads/avatars/<?= htmlentities($user->getAvatarPath()) ?>" alt="<?= htmlentities($user->getAvatarPath()) ?>">
            <?php else : ?>
                <img class="user__avatar_size" src="/uploads/images/camera.png" alt="camera">
            <?php endif; ?>
        </div>
    </header>
    <main class="main__display">
        <h2 class="subtitle">Ассортимент</h2>
        <div class="assortiment">
            <?php foreach ($pizzas as $pizza) : ?>
                <div class="card">
                    <div>
                        <img class="card__img" src="/uploads/images/<?= htmlentities($pizza->getPizzaImgPath()) ?>" alt="<?= htmlentities($pizza->getPizzaImgPath()) ?>">
                        <p class="card__title"><?= htmlentities($pizza->getTitle()) ?></p>
                        <p class="card__subtitle"><?= htmlentities($pizza->getSubTitle()) ?></p>
                    </div>
                    <div class="card__order">
                        <div class="card__prices">
                            <p class="card__price"><?= htmlentities($pizza->getPrice() . " ₽") ?></p>
                            <?php if ($pizza->getLastPrice() !== null) : ?>
                                <p class="card__last-price "><?= htmlentities($pizza->getLastPrice() . " ₽") ?></p>
                            <?php endif; ?>
                        </div>
                        <button class="card__buy">Купить</button>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </main>
    <footer class="footer__background">
        <p class="title-main__font" >PIZZA MARKET</p>
        <p class="footer__copyrite">© CopyRite 555Jeka555 2023</p>
    </footer>
</body>
</html>