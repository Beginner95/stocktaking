<?php include __DIR__ . '/header.php'; ?>

<div class="container">
    <header>
        <nav>
            <ul class="top-menu">
                <li><a href="#">Файл</a></li>
                <li><a href="#">Вид</a></li>
                <li><a href="#">Склад</a>
                    <ul>
                        <li><a href="#">Категории</a></li>
                        <li><a href="/index">Товары</a></li>
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
                    <th>Артикул</th>
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
                <?php if (!empty($products)) : ?>
                    <?php $i = 1; foreach ($products as $product) : ?>
                    <tr id="<?php echo $product->id; ?> ">
                        <td><?php echo $i; ?></td>
                        <td><?php echo $product->code; ?></td>
                        <td><?php echo $product->name; ?></td>
                        <td><?php echo $product->category_id; ?></td>
                        <td><?php echo $product->manufacturer_id; ?></td>
                        <td><input type="text" name="purchase-price" value="<?php echo $product->purchase_price; ?>"></td>
                        <td><input type="text" name="markup" value="<?php echo $product->markup; ?>"></td>
                        <td><span class="price"><?php echo $product->price; ?></span></td>
                        <td><input type="text" name="quantity" value="<?php echo $product->quantity; ?>"></td>
                        <td>
                            <a href="#" class="edit"><img src="/public/images/icon_edit.svg" title="Редактировать"></a>
                            <a href="#" class="delete"><img src="/public/images/icon_delete.svg" title="Удалить"></a>
                        </td>
                    </tr>
                    <?php $i++; endforeach; ?>
                <?php endif; ?>
                </tbody>
            </table>
        </section>
        <section class="stock">
            <div class="quantity-product">Количество товаров в базе: <span class="quantity">150</span> шт.</div>
            <div class="all-price-total">На сумму: <span class="total">150 000.00</span> руб.</div>
        </section>
        <section class="block-btn">
            <a href="#" class="add-product" id="add_product">Добавить товар</a>
            <a href="#" class="add-category">Добавить категорию</a>
            <a href="#" class="add-manufacturer">Добавить производителя</a>
        </section>
    </main>
</div>
<div class="modal-form">
    <div class="modal-form-content">
        <fieldset>
            <legend>Редактирование товара</legend>
            <input type="hidden" name="id" value="<?php echo $product->id; ?>">
            <label for="code">Артикул</label><input type="text" name="code" id="code" value="<?php echo $product->code; ?>"><br>
            <label for="name">Имя товара <span>*</span></label><input type="text" name="name" id="name" value="<?php echo $product->name; ?>" required><br>
            <label for="category">Категория</label><input type="text" name="category-id" id="category" value="<?php echo $product->category_id ;?>"><br>
            <label for="manufacturer">Производитель</label><input type="text" name="manufacturer-id" id="manufacturer" value="<?php echo $product->manufacturer_id ;?>"><br>
            <label for="purchase_price">Цена покупки <span>*</span></label><input type="text" name="purchase-price" id="purchase_price" value="<?php echo $product->purchase_price ;?>" required><br>
            <label for="markup">Наценка <span>*</span></label><input type="text" name="markup" id="markup" value="<?php echo $product->markup ;?>" required><br>
            <label for="price">Цена продажи</label><input type="text" name="price" id="price" disabled value="<?php echo $product->price; ?>"><br>
            <label for="quantity">Количество <span>*</span></label><input type="text" name="quantity" id="quantity" value="<?php echo $product->quantity ;?>" required><br>
        </fieldset>
        <a href="#" id="save">Сохранить</a>
    </div>
</div>


<?php include __DIR__ . '/footer.php'; ?>
