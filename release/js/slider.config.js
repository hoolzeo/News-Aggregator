  hs.graphicsDir = '/images/highslide/graphics/';
  hs.align = 'center';
  hs.transitions = ['expand', 'crossfade'];
  hs.fadeInOut = true;
  hs.dimmingOpacity = 0.8;
  hs.outlineType = 'rounded-white';
  hs.captionEval = 'this.thumb.alt';
  hs.marginBottom = 105; // make room for the thumbstrip and the controls
  hs.numberPosition = 'caption';

  // Add the slideshow providing the controlbar and the thumbstrip
  hs.addSlideshow({
    //slideshowGroup: 'group1',
    interval: 5000,
    repeat: false,
    useControls: true,
    overlayOptions: {
      className: 'text-controls',
      position: 'bottom center',
      relativeTo: 'viewport',
      offsetY: -60
    },
    thumbstrip: {
      position: 'bottom center',
      mode: 'horizontal',
      relativeTo: 'viewport'
    }
  });

  var gallery1 = new Gallery('gallery', {
      // включаем постраничную навигацию
      dots: true,
      // включаем управление с клавиатуры клавишами навигации "вправо / влево"
      keyControl: true,
      // включаем адаптивность
      responsive: true,
      // настройки галереи в зависимости от разрешения
      adaptive: {
        // настройка работает в диапазоне разрешений 320-560px
        320: {
          // одновременно выводится 1 элемент
          visibleItems: 1,
          // расстояние между изображениями 5px
          margin: 5,
          // запрещаем постраничную навигацию
          dots: false
        },
        // настройка работает в диапазоне разрешений 560-768px
        560: {
          // одновременно выводится 1 элемент
          visibleItems: 2,
          // расстояние между изображениями 5px
          margin: 5,
          // запрещаем постраничную навигацию
          dots: false
        },
        // настройка работает в диапазоне разрешений 768-1024px
        768: {
          // одновременно выводятся 2 элемента
          visibleItems: 3,
        },
        // настройка работает в диапазоне разрешений 1024 и выше
        1024: {
          // одновременно выводятся 3 элемента
          visibleItems: 4
        }
      }
    });
 
