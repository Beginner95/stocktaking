<header>
    <nav>
        <ul class="top-menu">
            <li><a href="#">Файл</a></li>
            <li><a href="#">Вид</a></li>
            <li><a href="#">Склад</a>
                <ul>
                    <li><a href="/admin/category">Категории</a></li>
                    <li><a href="/admin/index">Товары</a></li>
                    <li><a href="/admin/manufacturer">Производители</a></li>
                </ul>
            </li>
            <li><a href="/admin/sales">Продажи</a></li>
            <li>
                <?php echo $_SESSION['user']['first_name'] . ' ' . $_SESSION['user']['second_name']; ?>
                <a href="/auth/logout">Выход</a>
            </li>
        </ul>

    </nav>
</header>