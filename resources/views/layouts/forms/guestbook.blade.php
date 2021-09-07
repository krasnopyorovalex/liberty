<div class="popup" id="popup-guestbook">
    <div class="popup-title">Оставить отзыв</div>
    <form action="{{ route('form.guestbook') }}" class="flex form-recall-me">
        @csrf
        <div class="form-group">
            <input type="text" name="name" placeholder="Ваше имя*"/>
        </div>
        <div class="form-group">
            <textarea name="text" placeholder="Текст отзыва" rows="6"></textarea>
        </div>
        <div class="popup-btn-box">
            <button type="submit" class="btn btn-submit">Отправить</button>
        </div>
        <div class="form-group personal-data-agree">
            <input type="checkbox" id="popup-personal-data-agree3" name="agree" checked />
            <label for="popup-personal-data-agree3">Соглашаюсь на обработку персональных данных и с <a href="#">Политикой
                    конфиденциальности</a></label>
        </div>
    </form>
    <div class="popup-close">
        {{ svg('close') }}
    </div>
</div>
