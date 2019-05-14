<header>
    <nav>
        <ul class="top-menu">
            <li><a href="#">Склад</a>
                <ul>
                    <li><a href="/admin/category">Категории</a></li>
                    <li><a href="/admin/index">Товары</a></li>
                    <li><a href="/admin/manufacturer">Производители</a></li>
                </ul>
            </li>
            <li><a href="/order">Продажи</a></li>
            <li><a href="/">Добавить заказ</a></li>
            <li><a href="/admin/user">Менеджеры</a></li>
            <li>
                <?php echo $_SESSION['user']['first_name'] . ' ' . $_SESSION['user']['last_name']; ?>
                <a href="/auth/logout">Выход</a>
            </li>
        </ul>
    </nav>
</header>