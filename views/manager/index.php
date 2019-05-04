<?php include __DIR__ . '/../header.php'; ?>

<div class="container">
    <?php include __DIR__ . '/menu.php'; ?>
    <main>
        <section>
            <header>
                <h2>Корзина</h2>
            </header>
        </section>
        <div class="search-block">
            <input type="text" name="search" id="search" autocomplete="off">
            <button id="reset">x</button>
        </div>
        <div id="list"></div>
        <section class="items">
            <table>
                <thead class="item-head">
                <tr>
                    <th width="100">Артикул</th>
                    <th>Наименование</th>
                    <th width="200">Цена</th>
                    <th width="200">Количество</th>
                    <th width="200">Сумма</th>
                    <th width="200">Действия</th>
                </tr>
                </thead>
                <tbody class="item"></tbody>
            </table>
        </section>
        <section class="stock">
            <div class="quantity-product">Количество товаров в корзине: <span class="quantity">0</span> шт.</div>
            <div class="all-price-total">На сумму: <span class="total-sum">0.00</span> руб.</div>
        </section>
        <section class="block-btn">
            <a href="#" id="checkout">Оформить заказ</a>
            <a href="#" id="print_order">Печать</a>
        </section>
    </main>
</div>


<div id="prompt-form-container">
    <div id="prompt-form">
        <div id="prompt-message"></div>
        <button id="yes">ОК</button>
    </div>
</div>


<?php include __DIR__ . '/../footer.php'; ?>
<script src="/public/js/cart.js"></script>
