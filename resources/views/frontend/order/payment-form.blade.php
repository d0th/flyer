<form action="{!! $form['link'] !!}" method="post" id='sv-pform'>
    <input type="hidden" name="*scart">
    @foreach($form['form'] as $namePP => $paymentParam)
        <input type="hidden" name="{!! $namePP !!}" value="{!! $paymentParam !!}">
    @endforeach
</form>