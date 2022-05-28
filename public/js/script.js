// ハンバーガーメニュー
$(function () {
  $('#accordion-arrow').click(function () {
    console.log(1);
    $(this).toggleClass('active');
    if ($(this).hasClass('active')) {
      $('#accordion-menu').addClass('active');
    } else {
      $('#accordion-menu').removeClass('active');
    }
  });
  $('#accordion-menu ul li a').click(function () {
    $('#accordion-arrow').removeClass('active');
    $('#accordion-menu').removeClass('active');
  });
});

// 投稿編集用モーダル
$(function () {
  $('.modal-open').each(function () {
    $(this).on('click', function () {
      var target = $(this).data('posted');
      var modal = document.getElementById(target);
      console.log(modal);
      $(modal).fadeIn();
      return false;
    });
  });
  // モーダル外の箇所クリックでモーダル閉じる
  $('.modal-main').click(function () {
    $('.modal-main').fadeOut();
    $('.modal-inner').click(function (e) {
      e.stopPropagation();
    });
  });
});
