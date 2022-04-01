$(function () {
  $('#accordion-arrow').click(function () { //ハンバーガーボタン(.menu-trigger)をクリック
    $(this).toggleClass('active'); //ハンバーガーボタンに(.active)を追加・削除
    if ($(this).hasClass('active')) { //もしハンバーガーボタンに(.active)があれば
      $('#accordion-menu').addClass('active'); //(.g-navi)にも(.active)を追加
    } else { //それ以外の場合は、
      $('#accordion-menu').removeClass('active'); //(.g-navi)にある(.active)を削除
    }
  });
  $('#accordion-menu ul li a').click(function () { //各メニュー(.nav-wrapper ul li a)をタップする
    $('#accordion-arrow').removeClass('active'); //ハンバーガーボタンにある(.active)を削除
    $('#accordion-menu').removeClass('active'); //(.g-navi)にある(.active)も削除
  });
});
