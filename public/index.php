<!doctype html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="/public/css/main.css">
    <title>Мини Учет Склада</title>
</head>
<body>
<div class="container">
    <header>
        <nav>
            <ul class="top-menu">
                <li><a href="#">Файл</a></li>
                <li><a href="#">Вид</a></li>
                <li><a href="#">Склад</a>
                    <ul>
                        <li><a href="#">Категории</a></li>
                        <li><a href="#">Товары</a></li>
                        <li><a href="#">Производители</a></li>
                    </ul>
                </li>
                <li><a href="#">Продажи</a></li>
            </ul>
        </nav>
    </header>
    <main>
        <section>
            <header>
                <h2>Товары</h2>
            </header>
        </section>
        <section class="items">
            <table>
                <thead class="item-head">
                    <tr>
                        <th>№</th>
                        <th width="400">Наименование</th>
                        <th>Категория</th>
                        <th>Производитель</th>
                        <th>Цена покупки руб.</th>
                        <th>Наценка руб.</th>
                        <th>Цена продажи руб.</th>
                        <th>Количество</th>
                        <th>Действия</th>
                    </tr>
                </thead>
                <tbody class="item">
                    <tr id="product_id">
                        <td>1</td>
                        <td>Xperia XZ3</td>
                        <td>Телефоны</td>
                        <td>Sony</td>
                        <td><input type="text" value="150"></td>
                        <td><input type="text" value="50"></td>
                        <td>200.00р</td>
                        <td><input type="text" value="15"></td>
                        <td>
                            <a href="#" class="edit"><img src="/public/images/icon_edit.svg" title="Редактировать"></a>
                            <a href="#" class="delete"><img src="/public/images/icon_delete.svg" title="Удалить"></a>
                        </td>
                    </tr>
                </tbody>
            </table>
        </section>
        <section class="stock">
            <div class="quantity-product">Количество товаров в базе: <span class="quantity">150</span> шт.</div>
            <div class="all-price-total">На сумму: <span class="total">150 000.00</span> руб.</div>
        </section>
        <section class="block-btn">
            <a href="#" class="add-product">Добавить товар</a>
            <a href="#" class="add-category">Добавить категорию</a>
            <a href="#" class="add-manufacturer">Добавить производителя</a>
        </section>
    </main>
</div>
<script src="/public/js/main.js"></script>
</body>
</html>
