@push('cssVue')
    <script src='https://www.google.com/recaptcha/api.js' async defer></script>
@endpush

<div class="container main__form is-active">
    <form id="form" class="form corporate__form sended-form">
        {{ csrf_field() }}
        <div class="wrap__btnClose">
            @if(Session::get('locale') == 'en')
                <h2 class="title">Leave a request</h2>
            @else
                <h2 class="title">Оставьте заявку</h2>
            @endif
        </div>
        <div class="formWrap">
            <div class="form__top">
                <div class="mainform__group group-01">
                    <input type="text" placeholder=" " class="mainform__control required" name="name" id="name" placeholder="" required>

                    @if(Session::get('locale') == 'en')
                        <label for="name"  class="mainform__label">Name<span class="required-star">*</span><span class="help-text-wrap"><span class="help-text">Required field</span></span></label>
                    @else
                        <label for="name"  class="mainform__label">Название компании<span class="required-star">*</span><span class="help-text-wrap none"><span class="help-text">Обязательное поле</span></span></label>
                    @endif

                </div>
                <div class="mainform__group group-01">
                    <input type="email" placeholder=" " class="mainform__control" name="email" id="email" required>
                    <label for="email" class="mainform__label">Email<span class="required-star">*</span><span class="help-text-wrap none"><span class="help-text">Обязательное поле</span></span></label>
                </div>
                <div class="mainform__group group-01">
                    <input type="tel" placeholder=" " class="mainform__control validate-numeric required" name="tel" id="tel" placeholder="" required>

                    @if(Session::get('locale') == 'en')
                        <label for="tel" class="mainform__label">Phone number<span class="required-star">*</span><span class="help-text-wrap"><span class="help-text">Required field</span></span></label>
                    @else
                        <label for="tel" class="mainform__label">Телефон<span class="required-star">*</span><span class="help-text-wrap none"><span class="help-text">Обязательное поле</span></span></label>
                    @endif

                </div>
                <div class="mainform__group group-01">
                    <input type="number" placeholder=" " value="0" class="mainform__control" name="guest" id="guest" placeholder="">

                    @if(Session::get('locale') == 'en')
                        <label for="guest" class="mainform__label">The guests<span class="required-star">*</span><span class="help-text-wrap"><span class="help-text">Required field</span></span></label>
                    @else
                        <label for="guest" class="mainform__label">Количество гостей</label>
                    @endif

                </div>

                <div class="mainform__group group-01">
                    <input type="date" placeholder=" "  class="mainform__control" name="date" id="date" placeholder="" required>

                    @if(Session::get('locale') == 'en')
                        <label style="top: -18px" for="date" class="mainform__label">Date<span class="required-star">*</span><span class="help-text-wrap none"><span class="help-text">Required field</span></span></label>
                    @else
                        <label style="top: -18px" for="date" class="mainform__label">Дата<span class="required-star">*</span><span class="help-text-wrap none"><span class="help-text">Обязательное поле</span></span></label>
                    @endif

                </div>

                <div class="mainform__group group-01">
                    <input type="time" placeholder=" " class="mainform__control" name="time" id="time" placeholder="">

                    @if(Session::get('locale') == 'en')
                        <label for="time" class="mainform__label">Time<span class="required-star">*</span><span class="help-text-wrap"><span class="help-text">Required field</span></span></label>
                    @else
                        <label for="time" class="mainform__label">Время</label>
                    @endif

                </div>
            </div>

            <div class="footer__bottom">
                <div class="mainform__group form-check">

                    <input class="form__check-input required" placeholder="" required type="checkbox" id="check1">
                    @if(Session::get('locale') == 'en')
                        <label class="form__check-label" for="check1">By filling out the form, I consent to the processing and storage of personal data</label>
                    @else
                        <label class="form__check-label" for="check1">Заполняя форму, я даю согласие на обработку и хранение персональных данных</label>
                    @endif

                </div>
                <div class="form__box">

                    @if(Session::get('locale') == 'en')
                        <input id="btn" type="button" class="btn submit btn-hover" value="SEND"/>
                    @else
                        <input type="button" class="btn submit corporate__submit btn-hover" value="ОТПРАВИТЬ"/>
                @endif

                <!-- <button id="btn" class="btn submit">
                        ОТПРАВИТЬ
                    </button> -->
                    <button type="submit" class="g-recaptcha btn_captcha" data-sitekey="{{env('INVISIBLE_RECAPTCHA_SITEKEY')}}" data-callback="callbackFormInstructors" data-size="invisible">Отправить заявку</button>
                </div>
            </div>
            <div class="errors_message mess-wran">
                @if(Session::get('locale') == 'en')
                    <span id="errors_checkbox">Fill in the required fields</span>
                @else
                    <span id="errors_checkbox">Заполните необходимые поля</span>
                @endif

            </div>

            <div class="errors_message">
                @if(Session::get('locale') == 'en')
                    <span id="errors_checkbox">Check the box</span>
                @else
                    <span id="errors_checkbox">Поставте галочку</span>
                @endif

            </div>
        </div>
    </form>
    <div class="none sended-request">
        <h2>Заявка отправлена</h2>
    </div>
</div>

@push('scripts')
    <script>
        $(document).ready(function() {
            let $form = $('form.corporate__form');

            $form.find('input[name="guest"]').change(function(event) {
                if (event.target.value < 0) {
                    this.value = 0;
                }
            })

            $('.corporate__submit').click(function (event) {
                event.preventDefault();
                let $form = $('form.corporate__form');

                if($form.find('input[name="name"]').val() == '') {
                    $form.find('input[name="name"]').siblings().children().removeClass('none')
                    return false;
                    //$('.mess-wran span').addClass('block')
                } if ($form.find('input[name="tel"]').val() == '') {
                    $form.find('input[name="tel"]').siblings().children().removeClass('none')
                    return false;
                    //$('.mess-wran span').addClass('block')
                } if ($form.find('input[name="email"]').val() == '') {
                    $form.find('input[name="email"]').siblings().children().removeClass('none')
                    return false;
                    //$('.mess-wran span').addClass('block')
                } if ($form.find('input[name="date"]').val() == '') {
                    $form.find('input[name="date"]').siblings().children().removeClass('none')
                    return false;
                    //$('.mess-wran span').addClass('block')
                } else if ($('.form__check-input')[0].checked === false) {
                    $('.mess-wran span').removeClass('block')
                    $('.mess-wran span').addClass('none')
                    $('.errors_message span').addClass('block')
                } else {
                    $('.mess-wran span').removeClass('block')
                    $('.errors_message span').removeClass('block')

                    let request = {
                        "_token": "{{ csrf_token() }}",
                        'name': $form.find('input[name="name"]').val(),
                        'email': $form.find('input[name="email"]').val(),
                        'tel': $form.find('input[name="tel"]').val(),
                        'guest': $form.find('input[name="guest"]').val(),
                        'date': $form.find('input[name="date"]').val(),
                        'time': $form.find('input[name="time"]').val(),
                    };

                    $.ajax({
                        type: "POST",
                        url: "/request_business",
                        data: request
                    })
                        .done(function(response) {
                            // Есть успешный ответ сервера и данные

                            if (response === 'sended') {
                                $('.sended-request').removeClass('none');
                                $('.sended-request').addClass('block');
                                $('.sended-form').addClass('none');
                            }

                        })
                        .fail(function() {

                            setTimeout(function() {
                                target.fadeOut();
                            }, 3000);
                        });
                }
            })
        })

        function callbackFormInstructors() {
            return new Promise(function(resolve, reject) {

                if (grecaptcha.getResponse() == ""){
                    console.log(grecaptcha.getResponse());
                    return reject();
                } else {

                    console.log(23);

                    var formP = document.getElementById('form');

                    var inputsF = formP.getElementsByTagName('input');
                    var textP = formP.getElementsByTagName('textarea');
                    var captchaP = grecaptcha.getResponse();

                    let dataObjP = {};

                    for (var i = 0; i < inputsF.length; i++) {
                        dataObjP[inputsF[i].name] = inputsF[i].value;
                    }
                    if(textP.length) {
                        dataObjP['text'] = textP[0].value;
                    }

                    // if(listP.length) {
                    //   dataObjP['list'] = listP[0].options[listP[0].selectedIndex].text;
                    // }

                    // if(captchaP) {
                    //   dataObjP['captcha'] = captchaP;
                    // }

                    // console.log(dataObjP);

                    $.ajax({
                        "_token": "{{ csrf_token() }}",
                        type: "POST",
                        url: "/request_athlete",
                        data: dataObjP,
                        success: function(data) {
                            if(data) {
                                setTimeout(function () {
                                    $(".overlay").removeClass("is-active");
                                    $(".main__form").removeClass("is-active");
                                }, 1000); // время в мс
                            }
                            resolve();
                        },
                        error: function(data) {}
                    });
                }
                grecaptcha.reset();
            }); //end promise
        }
    </script>
@endpush
