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
            <table>
                <thead class="item-head">
                <tr>
                    <th>№</th>
                    <th>Заказ</th>
                    <th>Менеджер</th>
                    <th>Кол-во товаров</th>
                    <th>На сумму</th>
                    <th>Дата</th>
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
                                <a href="#" class="edit"><img src="/public/images/icon_eye.svg" title="Показать"></a>
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
<div id="prompt-form-container">
    <div id="prompt-form">
        <div id="prompt-message"></div>
        <button id="yes">ОК</button>
    </div>
</div>
<?php include __DIR__ . '/../footer.php'; ?>
<script src="/public/js/order.js"></script>
