<?php include __DIR__ . '/../header.php'; ?>

<div class="container">
    <?php include __DIR__ . '/menu.php'; ?>
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
                    <?php $i = 1; foreach ($products as $prod) : ?>
                    <tr id="<?php echo $prod->id; ?> ">
                        <td><?php echo $i; ?></td>
                        <td><?php echo $prod->code; ?></td>
                        <td><?php echo $prod->name; ?></td>
                        <td><?php echo $prod->category->title; ?></td>
                        <td><?php echo $prod->manufacturer->title; ?></td>
                        <td><input type="text" name="prod-purchase-price" value="<?php echo number_format($prod->purchase_price, 2, '.', ' '); ?>"></td>
                        <td><input type="text" name="prod-markup" value="<?php echo number_format($prod->markup, 2, '.', ' '); ?>"></td>
                        <td><span class="prod-price"><?php echo number_format($prod->price, 2, '.', ' '); ?></span></td>
                        <td><input type="text" name="prod-quantity" value="<?php echo $prod->quantity; ?>"></td>
                        <td>
                            <a href="#" class="edit"><img src="/public/images/icon_edit.svg" title="Редактировать"></a>
                            <a href="#" class="delete"><img src="/public/images/icon_delete.svg" title="Удалить"></a>
                        </td>
                    </tr>
                    <?php $i++; endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="10">Нет товаров!</td>
                    </tr>
                <?php endif; ?>
                </tbody>
            </table>
        </section>
        <section class="stock">
            <div class="quantity-product">Количество товаров в базе: <span class="quantity"></span> шт.</div>
            <div class="all-price-total">На сумму: <span class="total-sum"></span> руб.</div>
            <div class="all-price-total">Прибыль: <span class="total-sum-profit"></span> руб.</div>
        </section>
        <section class="block-btn">
            <a href="#" class="add-product" id="add_product">Добавить товар</a>
        </section>
    </main>
</div>
<div class="modal-form-product">
    <div class="modal-form-content">
        <form id="product_form">
            <fieldset>
                <legend class="modal-title"></legend>
                <input type="hidden" name="id" value="<?php echo $product->id; ?>">
                <label for="code">Артикул</label><input type="text" name="code" id="code" value="<?php echo $product->code; ?>"><br>
                <label for="name">Имя товара <span>*</span></label><input type="text" name="name" id="name" value="<?php echo $product->name; ?>" required><br>
                <label for="category">Категория</label>
                <select name="category-id" class="select-category"></select>
                <label for="manufacturer">Производитель</label>
                <select name="manufacturer-id" class="select-manufacturer"></select>
                <label for="purchase_price">Цена покупки <span>*</span></label><input type="text" name="purchase-price" id="purchase_price" value="<?php echo $product->purchase_price ;?>" required><br>
                <label for="markup">Наценка <span>*</span></label><input type="text" name="markup" id="markup" value="<?php echo $product->markup ;?>" required><br>
                <label for="price">Цена продажи</label><input type="text" name="price" id="price" disabled value="<?php echo $product->price; ?>"><br>
                <label for="quantity">Количество <span>*</span></label><input type="text" name="quantity" id="quantity" value="<?php echo $product->quantity ;?>" required><br>
            </fieldset>
        </form>
        <a href="#" id="save">Сохранить</a>
    </div>
    <div class="btn-close">x</div>
</div>

<div id="prompt-form-container">
    <div id="prompt-form">
        <div id="prompt-message"></div>
        <button id="yes">ОК</button>
    </div>
</div>


<?php include __DIR__ . '/../footer.php'; ?>
<script src="/public/js/products.js"></script>