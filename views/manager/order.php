<?php include __DIR__ . '/../header.php'; ?>

<div class="container">
    <?php include __DIR__ . '/menu.php'; ?>
    <main>
        <section>
            <header>
                <h2>Категории</h2>
            </header>
        </section>
        <section class="items">
            <table id="indextable">
                <thead class="item-head">
                <tr>
                    <th><a href="javascript:SortTable(0,'T');">№</a></th>
                    <th><a href="javascript:SortTable(0,'T');">Заказ</a></th>
                    <th><a href="javascript:SortTable(0,'T');">Менеджер</a></th>
                    <th><a href="javascript:SortTable(2,'N');">Кол-во товаров</a></th>
                    <th><a href="javascript:SortTable(2,'N');">На сумму</a></th>
                    <th><a href="javascript:SortTable(3,'D','mdy');">Дата</a></th>
                    <th>Действия</th>
                </tr>
                </thead>
                <tbody class="item">
                <?php if (!empty($orders)) : ?>
                    <?php $i = 1; foreach ($orders as $order) : ?>
                        <tr id="<?php echo $order->id; ?> ">
                            <td><?php echo $i; ?></td>
                            <td>Заказа №<?php echo $order->id; ?></td>
                            <td><?php echo $order->user->first_name . ' ' . $order->user->second_name; ?></td>
                            <td><?php echo $order->quantity; ?></td>
                            <td><?php echo number_format($order->total_sum, 2, '.', ' '); ?></td>
                            <td><?php echo $order->date_added; ?></td>
                            <td>
                                <a href="#" class="print"><img src="/public/images/icon_print.svg" title="Печать"></a>
                                <a href="#" class="show"><img src="/public/images/icon_eye.svg" title="Показать"></a>
                                <a href="#" class="return"><img src="/public/images/icon_back.svg" title="Вернуть заказ на склад"></a>
                                <a href="#" class="delete"><img src="/public/images/icon_delete.svg" title="Удалить"></a>
                            </td>
                        </tr>
                        <?php $i++; endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="10">Нет заказов!</td>
                    </tr>
                <?php endif; ?>
                </tbody>
            </table>
        </section>
        <section class="block-btn">
            <a href="/">Добавить заказ</a>
        </section>
    </main>
</div>

<div class="modal-form-order-products">
    <div class="modal-form-content">
        <fieldset>
            <legend class="modal-title">Заказ №</legend>
            <table class="table-cart">
                <thead>
                    <tr>
                        <th>№</th>
                        <th>Артикул</th>
                        <th>Наименование</th>
                        <th>Цена</th>
                        <th>Количество</th>
                        <th>Сумма</th>
                    </tr>
                </thead>
                <tbody></tbody>
                <tfoot></tfoot>
            </table>
        </fieldset>
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
<script src="/public/js/order.js"></script>
