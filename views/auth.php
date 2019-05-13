<?php include __DIR__ . '/header.php'; ?>
<div class="container">
    <main>
        <div class="modal-form-auth">
            <div class="modal-form-content">
                <form id="auth_form">
                    <fieldset>
                        <legend class="modal-title">Авторизация</legend>
                        <label for="login">Логин <span>*</span></label>
                        <input type="text" name="login" id="login" value=""><br>
                        <label for="password">Пароль <span>*</span></label>
                        <input type="password" name="password" id="password" value="">
                    </fieldset>
                </form>
                <a href="#" id="sign_in">Войти</a>
            </div>
        </div>
    </main>
</div>
<div id="prompt-form-container">
    <div id="prompt-form">
        <div id="prompt-message"></div>
        <button id="yes">ОК</button>
    </div>
</div>
<?php include __DIR__ . '/footer.php'; ?>
<script src="/public/js/auth.js"></script>
