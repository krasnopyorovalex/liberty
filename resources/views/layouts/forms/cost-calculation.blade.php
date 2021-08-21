<div class="popup as-cost-calculation" id="popup-cost-calculation">
    <div class="popup-title">Расчет проекта</div>
    <form action="#" method="post" class="form-cost-calculation" enctype="multipart/form-data">
        @csrf
        <div class="form-group two-elements flex">
            <input type="text" placeholder="Ваше имя"/>
            <input type="email" placeholder="E-mail"/>
        </div>
        <div class="form-group two-elements flex">
            <input type="text" placeholder="Телефон"/>

            <div class="as-input">
                <input type="file" class="hidden" accept="application/pdf"/>
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
                <input type="checkbox" id="popup-personal-data-agree-2" checked/>
                <label for="popup-personal-data-agree-2">Соглашаюсь на обработку персональных данных и с <a href="#">Политикой
                        конфиденциальности</a></label>
            </div>
        </div>
        <div class="popup-btn-box">
            <button type="submit" class="btn btn-submit">Отправить</button>
        </div>
    </form>

    <div class="popup-close">
        {{ svg('close') }}
    </div>
</div>
