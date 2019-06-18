<script defer src="/js/up.js"></script>
<script defer src="/js/city-news.js"></script>
<script defer src="/js/auth-modal.js"></script>
<script defer src="/js/smooth-hover.js"></script>
<script defer src="/js/bootstrap.js"></script>

<footer>
  <div class="container">
    <div class="copyright">Developed by Potemkin Ivan</div>
  </div>
</footer>

<div id="scroller" class="b-top" style="display: none;"><span class="b-top-but">наверх</span></div>

<script type="text/javascript">
var isFirstClick = true;

var slideout = new Slideout({
  'panel': document.querySelector('main'),
  'menu': document.getElementById('menu'),
  'padding': 256,
  'tolerance': 70
});

document.querySelector('.js-slideout-toggle').addEventListener('click', function() {
  slideout.toggle();
});

slideout.on('translate', function () {
document.getElementById('menu').style.display = 'block';
});

slideout.on('beforeopen', function () {
  if (isFirstClick) {
    var newLi = '<li class="settings_kostil">' + $(".settings").html() + '</li>';
    $("#menu ul").append(newLi);
    isFirstClick = false;
  }

  document.getElementById('menu').style.display = 'block';
});

slideout.on('close', function () {
document.getElementById('menu').style.display = 'none';
});
</script>
