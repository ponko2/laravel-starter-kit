import $ from 'jquery';

window.jQuery = $;
window.$      = $;

require('bootstrap-sass');


/**
 * formのinputにてEnterを押した時の送信を無効化する
 * `allow-submit`がclass指定されたものについては無効化を行わない
 *
 * @returns {boolean} Enterが押された場合はfalse
 */
function disableFormSubmitOnEnter() {
  const KEY_CODE_ENTER = 13;

  $('input:not(.allow-submit)').on('keyup keypress', event => {
    const keyCode = event.keyCode || event.which;

    if (keyCode === KEY_CODE_ENTER) {
      event.preventDefault();
      return false;
    }

    return true;
  });
}

/**
 * 二重登録を防止
 *
 * @returns {void}
 */
function preventDuplicateFormSubmissions() {
  $('form :submit').click(function (event) {
    const TIMEOUT = 10000;
    const $form   = $(this).closest('form');
    const $submit = $form.find(':submit');

    // clickしたsubmitの値をhiddenに保存
    const $hidden = $('<input/>', {
      type: 'hidden',
      name: this.name,
      value: this.value
    }).appendTo($form);

    event.preventDefault();
    event.stopPropagation();

    // 全てのsubmitを無効化
    $submit.prop('disabled', true);

    // 時間経過でsubmitの無効化を解除
    setTimeout(() => {
      $hidden.remove();
      $submit.prop('disabled', false);
    }, TIMEOUT);

    $form.submit();
  });
}


$(function () {
  disableFormSubmitOnEnter();
  preventDuplicateFormSubmissions();
}());
