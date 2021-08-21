<div class="popup" id="popup-recall-me">
    <div class="popup-title">Перезвоните мне</div>
    <form action="#" class="flex">
        @csrf
        <div class="form-group">
            <input type="text" placeholder="Ваше имя*"/>
        </div>
        <div class="form-group">
            <input type="text" placeholder="Телефон*"/>
        </div>
        <div class="popup-btn-box">
            <button type="submit" class="btn btn-submit">Отправить</button>
        </div>
        <div class="form-group personal-data-agree">
            <input type="checkbox" id="popup-personal-data-agree" checked/>
            <label for="popup-personal-data-agree">Соглашаюсь на обработку персональных данных и с <a href="#">Политикой
                    конфиденциальности</a></label>
        </div>
    </form>
    <div class="popup-close">
        {{ svg('close') }}
    </div>
</div>
