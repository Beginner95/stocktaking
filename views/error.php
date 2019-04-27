<?php include __DIR__ . '/header.php'; ?>
    <div class="container">
        <h1>Возникла ошибка!</h1>
        <article>
            <p class="error"><?php echo $error; ?></p>
        </article>
        <a href="/Index">Вернуться на главную</a>
    </div>
<?php include __DIR__ . '/footer.php'; ?>