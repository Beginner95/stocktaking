<header>
    <nav>
        <ul class="top-menu">
            <li><a href="/order">Заказаы</a></li>
            <li>
                <?php echo $_SESSION['user']['first_name'] . ' ' . $_SESSION['user']['second_name']; ?>
                <a href="/auth/logout">Выход</a>
            </li>
        </ul>

    </nav>
</header>