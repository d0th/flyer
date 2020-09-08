@push('cssVue')
<script src='https://www.google.com/recaptcha/api.js' async defer></script>
@endpush

<div class="container main__form">
    <form id="form" class="form">
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
            <div class="form__top">
                <div class="mainform__group group-01">
                    <input type="text" placeholder=" " class="mainform__control required" name="name" id="name" placeholder="" required>

                    @if(Session::get('locale') == 'en')
                    <label for="name"  class="mainform__label">Name<span class="required-star">*</span><span class="help-text-wrap"><span class="help-text">Required field</span></span></label>
                    @else
                    <label for="name"  class="mainform__label">Имя<span class="required-star">*</span><span class="help-text-wrap"><span class="help-text">Обязательное поле</span></span></label>
                    @endif

                </div>
                <div class="mainform__group group-01">
                    <input type="text" placeholder=" " class="mainform__control required" name="fname" id="fname" placeholder="" required>

                    @if(Session::get('locale') == 'en')
                    <label for="fname" class="mainform__label">Surname<span class="required-star">*</span><span class="help-text-wrap"><span class="help-text">Required field</span></span></label>
                    @else
                    <label for="fname" class="mainform__label">Фамилия<span class="required-star">*</span><span class="help-text-wrap"><span class="help-text">Обязательное поле</span></span></label>
                    @endif

                </div>
                <div class="mainform__group group-01">
                    <input type="tel" placeholder=" " class="mainform__control validate-numeric required" name="tel" id="tel" placeholder="" required>

                    @if(Session::get('locale') == 'en')
                    <label for="tel" class="mainform__label">Phone number<span class="required-star">*</span><span class="help-text-wrap"><span class="help-text">Required field</span></span></label>
                    @else
                    <label for="tel" class="mainform__label">Телефон<span class="required-star">*</span><span class="help-text-wrap"><span class="help-text">Обязательное поле</span></span></label>
                    @endif

                </div>
                <div class="mainform__group group-01">
                    <input type="email" placeholder=" " class="mainform__control" name="email" id="email" placeholder="">
                    <label for="email" class="mainform__label">Email</label>
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
                <input id="btn" type="button" class="btn submit btn-hover" value="SEND"/>
                @else
                <input id="btn" type="button" class="btn submit btn-hover" value="ОТПРАВИТЬ"/>
                @endif

                    <!-- <button id="btn" class="btn submit">
                        ОТПРАВИТЬ
                    </button> -->
                    <button type="submit" class="g-recaptcha btn_captcha" data-sitekey="{{env('INVISIBLE_RECAPTCHA_SITEKEY')}}" data-callback="callbackFormInstructors" data-size="invisible">Отправить заявку</button>
                </div>
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
</div>
<div class="overlay"></div>

@push('scripts')
<script>
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
