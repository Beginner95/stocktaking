<?php include __DIR__ . '/header.php'; ?>

<div class="container">
    <?php include __DIR__ . '/menu.php'; ?>
    <main>
        <section>
            <header>
                <h2>Производители</h2>
            </header>
        </section>
        <section class="items">
            <table>
                <thead class="item-head">
                <tr>
                    <th>№</th>
                    <th width="400">Наименование</th>
                    <th>Описание</th>
                    <th>Дата добавления</th>
                    <th>Действия</th>
                </tr>
                </thead>
                <tbody class="item">
                <?php if (!empty($manufacturers)) : ?>
                    <?php $i = 1; foreach ($manufacturers as $manufac) : ?>
                        <tr id="<?php echo $manufac->id; ?> ">
                            <td><?php echo $i; ?></td>
                            <td><?php echo $manufac->title; ?></td>
                            <td><?php echo $manufac->description; ?></td>
                            <td><?php echo $manufac->date_added; ?></td>
                            <td>
                                <a href="#" class="edit"><img src="/public/images/icon_edit.svg" title="Редактировать"></a>
                                <a href="#" class="delete"><img src="/public/images/icon_delete.svg" title="Удалить"></a>
                            </td>
                        </tr>
                        <?php $i++; endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="10">Нет производителей!</td>
                    </tr>
                <?php endif; ?>
                </tbody>
            </table>
        </section>
        <section class="block-btn">
            <a href="#" class="add-category">Добавить производителя</a>
        </section>
    </main>
</div>
<div class="modal-form-category">
    <div class="modal-form-content">
        <form id="manufacturer_form">
            <fieldset>
                <legend class="modal-title"></legend>
                <input type="hidden" name="id" value="<?php echo $manufacturer->id; ?>">
                <label for="title">Наименование <span>*</span></label><input type="text" name="title" id="title" value="<?php echo $manufacturer->title; ?>"><br>
                <label for="description">Описание</label><input type="text" name="description" id="description" value="<?php echo $manufacturer->description; ?>"><br>
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


<?php include __DIR__ . '/footer.php'; ?>
<script src="/public/js/manufacturer.js"></script>
