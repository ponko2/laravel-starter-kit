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

  $('input:not(.allow-submit)').on('keyup keypress', (event) => {
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
  $('form :submit').click(function () {
    const $form = $(this).closest('form');

    // 全てのsubmitを無効化
    $form.find(':submit').prop('disabled', true);

    // clickしたsubmitの値をhiddenに保存してsubmit
    $form.append($('<input/>', {
      type: 'hidden',
      name: this.name,
      value: this.value
    })).submit();
  });
}


$(function () {
  disableFormSubmitOnEnter();
  preventDuplicateFormSubmissions();
}());
