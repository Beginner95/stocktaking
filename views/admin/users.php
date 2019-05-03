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
                    <th>Логин</th>
                    <th>Ф.И.О</th>
                    <th>Действия</th>
                </tr>
                </thead>
                <tbody class="item">
                <?php if (!empty($users)) : ?>
                    <?php $i = 1; foreach ($users as $u) : ?>
                        <tr id="<?php echo $u->id; ?> ">
                            <td><?php echo $i; ?></td>
                            <td><?php echo $u->login; ?></td>
                            <td>
                                <?php echo $u->first_name; ?> 
                                <?php echo $u->last_name; ?> 
                                <?php echo $u->second_name; ?>                                
                            </td>
                            <td><?php echo $u->role; ?></td>
                            <td>
                                <a href="#" class="edit"><img src="/public/images/icon_edit.svg" title="Редактировать"></a>
                                <a href="#" class="delete"><img src="/public/images/icon_delete.svg" title="Удалить"></a>
                            </td>
                        </tr>
                        <?php $i++; endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="10">Нет категорий!</td>
                    </tr>
                <?php endif; ?>
                </tbody>
            </table>
        </section>
        <section class="block-btn">
            <a href="#" class="add-user">Добавить пользователя</a>
        </section>
    </main>
</div>
<div class="modal-form-user">
    <div class="modal-form-content">
        <form id="user_form">
            <fieldset>
                <legend class="modal-title"></legend>
                <input type="hidden" name="id" value="<?php echo $user->id; ?>">
                <label for="login">Логин <span>*</span></label>
                <input type="text" name="login" id="login" value="<?php echo $user->login; ?>"><br>
                <label for="password">Пароль <span>*</span></label>
                <input type="text" name="password" id="password" value="<?php echo $user->password; ?>"><br>
                <label for="first_name">Фамилия <span>*</span></label>
                <input type="text" name="first-name" id="first_name" value="<?php echo $user->first_name; ?>"><br>
                <label for="last_name">Имя <span>*</span></label>
                <input type="text" name="last-name" id="last_name" value="<?php echo $user->last_name; ?>">
                <label for="second_name">Очество</label>
                <input type="text" name="second-name" id="second_name" value="<?php echo $user->second_name; ?>">
                <label for="second_name">Роль <span>*</span></label>
                <select name="role"></select>
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
<script src="/public/js/user.js"></script>
