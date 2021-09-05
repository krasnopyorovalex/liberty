<form action="{{ route('form.calculate') }}" method="post" class="form-cost-calculation" enctype="multipart/form-data">
    @csrf
    <div class="form-group two-elements flex">
        <input type="text" placeholder="Ваше имя" name="name" required autocomplete="off"/>
        <input type="email" placeholder="E-mail" name="email" required autocomplete="off"/>
    </div>
    <div class="form-group two-elements flex">
        <input type="text" placeholder="Телефон" name="phone" required autocomplete="off"/>

        <div class="as-input">
            <input type="file" class="hidden" accept="application/pdf" name="file" required />
            <div class="label-file">
                {{ svg('paper-clip') }}
                Прикрепить файл
            </div>
        </div>

        <textarea name="comment" placeholder="Комментарий"></textarea>
    </div>
    <div class="form-group two-elements flex personal-data-agree with-captcha">
        <div>
            <img src="img/captcha-img-example.jpg" alt="sca"/>
        </div>
        <div class="flex">
            <input type="checkbox" id="popup-personal-data-agree-2" name="agree" checked />
            <label for="popup-personal-data-agree-2">Соглашаюсь на обработку персональных данных и с <a href="#">Политикой конфиденциальности</a></label>
        </div>
    </div>
    <div class="popup-btn-box">
        <button type="submit" class="btn btn-submit">Отправить</button>
    </div>
</form>
