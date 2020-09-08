@push('cssVue')
<script src='https://www.google.com/recaptcha/api.js' async defer></script>
@endpush

<div class="container corporate__form main__form form__modal">
    <form id="form" class="form form__wrap">
    {{ csrf_field() }}
        <div class="wrap__btnClose">
            @if(Session::get('locale') == 'en')
            <h2 class="title">Leave a request</h2>
            @else
            <h2 class="title">Оставьте заявку</h2>
            @endif
            <div class="form__btnClose">
                <span class="form__line"></span>
            </div>
        </div>
        <div class="formWrap">
            <div class="form__body">
                <div class="bloc-50 form__top">
                    <div class="mainform__group">
                        <input type="text" placeholder=" " class="mainform__control required" name="name" id="name" placeholder="" required>

                        @if(Session::get('locale') == 'en')
                            <label for="name"  class="mainform__label">Name<span class="required-star">*</span><span class="help-text-wrap"><span class="help-text">Required field</span></span></label>
                        @else
                            <label for="name"  class="mainform__label">Имя<span class="required-star">*</span><span class="help-text-wrap none"><span class="help-text">Обязательное поле</span></span></label>
                        @endif

                    </div>

                    <div class="mainform__group">
                        <input type="tel" placeholder=" " class="mainform__control validate-numeric required" name="tel" id="tel" placeholder="" required>

                        @if(Session::get('locale') == 'en')
                            <label for="tel" class="mainform__label">Phone number<span class="required-star">*</span><span class="help-text-wrap"><span class="help-text">Required field</span></span></label>
                        @else
                            <label for="tel" class="mainform__label">Телефон<span class="required-star">*</span><span class="help-text-wrap none"><span class="help-text">Обязательное поле</span></span></label>
                        @endif

                    </div>
                </div>

                <div class="bloc-50 form__top">
                    <div class="mainform__group">
                        <input type="text" placeholder=" " class="mainform__control required" name="fname" id="fname" placeholder="" required>

                        @if(Session::get('locale') == 'en')
                            <label for="fname" class="mainform__label">Surname<span class="required-star">*</span><span class="help-text-wrap"><span class="help-text">Required field</span></span></label>
                        @else
                            <label for="fname" class="mainform__label">Фамилия<span class="required-star">*</span><span class="help-text-wrap none"><span class="help-text">Обязательное поле</span></span></label>
                        @endif

                    </div>

                    <div class="mainform__group">
                        <input type="email" placeholder=" " class="mainform__control" name="email" id="email" required>
                        <label for="email" class="mainform__label">Email<span class="required-star">*</span><span class="help-text-wrap none"><span class="help-text">Обязательное поле</span></span></label>
                    </div>
                </div>
            </div>
            <div class="form__center">
                <div class="mainform__group comment">
                    <textarea
                        data-autoresize rows="1"
                        name="comment"
                        id="comment"
                        coll="5"
                        rows="3"
                        class="mainform__control"
                        placeholder=" "
                        >
                    </textarea>

                    @if(Session::get('locale') == 'en')
                    <label for="comment" class="mainform__label">A comment</label>
                    @else
                   <label for="comment" class="mainform__label">Комментарий</label>
                    @endif

                </div>
                <!-- <div class="mainform__group file">
                    <label for="uploaded-file" class="mainform__label">Прикрепить резюме</label>
                    <input id="uploaded-file" onchange="getFileName ();" placeholder="" accept="application/pdf,application/msword" class="mainform__control" type="file" name="file" multiple>
                    <span>Допустимый формат: pdf, doc</span>
                </div> -->
            </div>
            <!-- <div id="file-name"></div> -->

            <!-- <input type="hidden" name="culturecode">
            <input type="hidden" name="url"> -->
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
                <input id="btn" type="button" class="btn submit form__submit btn-hover" value="SEND"/>
                @else
                <input id="btn" type="button" class="btn submit form__submit btn-hover" value="ОТПРАВИТЬ"/>
                @endif

                    <!-- <button id="btn" class="btn submit">
                        ОТПРАВИТЬ
                    </button> -->
                    <button type="submit" class="g-recaptcha btn_captcha" data-sitekey="{{env('INVISIBLE_RECAPTCHA_SITEKEY')}}" data-callback="callbackFormInstructors" data-size="invisible">Отправить заявку</button>
                </div>
            </div>

            <div class="errors_message mess-wran">
                {{--@if(Session::get('locale') == 'en')
                    <span id="errors_checkbox">Fill in the required fields</span>
                @else
                    <span id="errors_checkbox">Заполните необходимые поля</span>
                @endif--}}

            </div>

            <div class="errors_message">

                @if(Session::get('locale') == 'en')
                <span id="errors_checkbox">Check the box</span>
                @else
                <span id="errors_checkbox">Просьба согласиться на обработку и хранение персональных данных.</span>
                @endif

            </div>
        </div>
    </form>
</div>

<div class="overlay"></div>

@push('scripts')
<script>

    $(document).ready(function() {
        $('.form__submit').click(function (event) {
            event.preventDefault();
            let $form = $('form.form__wrap');

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
                    'tel': $form.find('input[name="tel"]').val()
                };

                $.ajax({
                    type: "POST",
                    url: "/request_birthday",
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

        function callbackFormInstructors() {
            return new Promise(function(resolve, reject) {

                if (grecaptcha.getResponse() == ""){
                    console.log(grecaptcha.getResponse());
                    return reject();
                } else {

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
                        type: "POST",
                        url: "/request_parties",
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
    })
</script>
@endpush
