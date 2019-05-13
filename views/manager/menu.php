<header>
    <nav>
        <ul class="top-menu">
            <?php if ($_SESSION['user']['role'] === 'Administrator') : ?>
                <li><a href="/admin">Раздел администратора</a></li>
            <?php endif; ?>
            <li><a href="/order">Заказаы</a></li>
            <li>
                <?php echo $_SESSION['user']['first_name'] . ' ' . $_SESSION['user']['last_name']; ?>
                <a href="/auth/logout">Выход</a>
            </li>
        </ul>

    </nav>
</header>