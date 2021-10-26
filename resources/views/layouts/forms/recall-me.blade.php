<div class="popup" id="popup-recall-me">
    <div class="popup-title">Обратный звонок</div>
    <form action="{{ route('form.recall') }}" class="flex form-recall-me">
        @csrf
        <div class="form-group">
            <input type="text" name="name" placeholder="Ваше имя*"/>
        </div>
        <div class="form-group">
            <input type="text" name="phone" placeholder="Телефон*"/>
        </div>
        <div class="popup-btn-box">
            <button type="submit" class="btn btn-submit">Отправить</button>
        </div>
        <div class="form-group personal-data-agree">
            <input type="checkbox" id="popup-personal-data-agree" name="agree" checked />
            <label for="popup-personal-data-agree">Соглашаюсь на обработку персональных данных и с <a href="#">Политикой
                    конфиденциальности</a></label>
        </div>
    </form>
    <div class="popup-close">
        {{ svg('close') }}
    </div>
</div>
