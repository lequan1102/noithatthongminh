document.addEventListener('DOMContentLoaded', function(){
  //In or outside Box Search
  window.addEventListener('click', function(e){   
    if (document.querySelector('.pc-search').contains(e.target)){
        document.querySelector('.search-preview').classList.add('perspective-s');
    } else{
        document.querySelector('.search-preview').classList.remove('perspective-s');
    }
  });
  /******Dropdown list******
  Structure HTML
  <ul class="list-category">
    <li class="tree falling">
      <span class="sub-title" data-show="list_1">Sản phẩm</span>
      <ul class="sub-list open" id="list_1">

      </ul>
    </li>
    <li class="tree">
      <span class="sub-title" data-show="list_2">Dự án</span>
      <ul class="sub-list" id="list_2">

      </ul>
    </li>
  </ul>
  */
  //  var sub_title = document.getElementsByClassName('sub-title'),
  //  sub_list = document.getElementsByClassName('sub-list');
  //  for (var i = 0; i < sub_title.length; i++) {
  //    sub_title[i].onclick = function (){
  //      if (this.parentElement.classList[1] == 'falling') {
  //        var content = this.getAttribute('data-show');
  //        var section_show = document.getElementById(content);
  //        section_show.classList.toggle('open');
  //      } else {
  //        for(var k = 0; k < sub_title.length; k++){
  //            sub_title[k].parentElement.classList.remove('falling');
  //        }
  //        this.parentElement.classList.toggle('falling');
  //        var content = this.getAttribute('data-show');
  //        var section_show = document.getElementById(content);
  //        for(var i = 0; i < sub_list.length; i++){
  //            sub_list[i].classList.remove('open');
  //        }
  //        section_show.classList.toggle('open');
  //      }
  //    }
  //  }
  /****** END DROPLIST ******/



  // var search = document.querySelector('.menu .store ul li form');
  // var searchbutton = document.querySelector('.menu .store ul li:first-child a');
  // searchbutton.addEventListener('click', function(){
  //   search.classList.toggle('fromshow');
  // })


  /*Dropdown*/
  // var dropdown_detail = document.querySelectorAll('.dropdown');
  // if (dropdown_detail == null){} else {
  //   var dropdown_menu = document.querySelectorAll('.dropdown-menu');
  //   var i = 0;
  //   for (i = 0; i < dropdown_detail.length; i++){
  //     dropdown_detail[i].addEventListener('click', function(){
  //       for (var i = 0; i < dropdown_detail.length; i++){
  //         dropdown_detail[i].classList.remove('show');
  //       }
  //       this.classList.add('show');
  //     });
  //   }
  // }
/******Scroll Menu******/
var menu = document.querySelector('.menu'),
body = document.querySelector('body'),
current_menu = 'true';
window.addEventListener('scroll',function(){
  if(window.pageYOffset > 85){
    if(current_menu == 'true'){
      current_menu = 'false';
      menu.classList.add('fixed');
      body.style.marginTop = '42px';
    }
  }
  else if (window.pageYOffset < 85){
    if(current_menu == 'false'){
      current_menu = 'true';
      menu.classList.remove('fixed');
      body.style.marginTop = '0px';
    }
  }
})

  /******Scroll top******/
  var up = document.getElementById('up'),
  trangthai = 'true';
  window.addEventListener('scroll',function(){
    if(window.pageYOffset > 800){
      if(trangthai == 'true'){
        trangthai = 'false';
        up.classList.add('show');
      }
    }
    else if (window.pageYOffset < 800){
      if(trangthai == 'false'){
      trangthai = 'true';
      up.classList.remove('show');
      }
    }
  })
  /******END SCROLL TOP******/
  $("a[href='#up']").click(function() {
    $("html, body").animate({ scrollTop: 0 }, "slow");
    return false;
  });

  /******Menu mobie******/
  //nút click bar mở menu
  var js_open_menumb = document.getElementById('js_open_menumobie');
  if (js_open_menumb != null){
    //nút thoát khỏi mobie trượt
    var close = document.querySelector('.mb-close');
    //Bao bọc nội dung
    var wrapper = document.querySelector('.wrapper');
    var body = document.querySelector('body');
    //nút bars hiện menu
    js_open_menumb.addEventListener('click', function(){
      wrapper.classList.add('open-mb');
      body.style.overflow = 'hidden';
    });
    close.addEventListener('click', function(){
      wrapper.classList.remove('open-mb');
      body.style = '';
    });
  }
  /******END MENU MOBIE******/

  //OWL.CAROUSEL 2 JS
  // $('.owl-slider').owlCarousel({
  //   loop: true,
  //   nav: false,
  //   dots: true,
  //   margin: 30,
  //   autoplay:true,
  //   autoplayTimeout:5000,
  //   autoplayHoverPause:true,
  //   responsive : {
  //     0 : {
  //       items: 1,
  //     },
  //     480 : {
  //       items: 2,
  //     },
  //     768 : {
  //       items: 2,
  //     }
  //   }
  // });
  $('.slick-banner').slick({
    dots: true,
    infinite: false,
    speed: 300,
    slidesToShow: 1,
    slidesToScroll: 1,
    arrows: false,
  });
  $('.slick-category-products').slick({
    arrows: true,
    infinite: false,
    speed: 300,
    slidesToShow: 6,
    slidesToScroll: 1,
    responsive: [
      {
        breakpoint: 540,
        settings: {
          slidesToShow: 3
        }
      },
    ]
  });
  //Slick Products
  $('.slick-product-1').slick({
    dots: false,
    infinite: false,
    speed: 300,
    slidesToShow: 4,
    slidesToScroll: 1,
    prevArrow: '.ar.p1',
    nextArrow: '.ar.p2',
    responsive: [
      {
        breakpoint: 540,
        settings: {
          slidesToShow: 2
        }
      },
    ]
  });
  $('.slick-product-2').slick({
    dots: false,
    infinite: false,
    speed: 300,
    slidesToShow: 4,
    slidesToScroll: 1,
    prevArrow: '.ar.p3',
    nextArrow: '.ar.p4',
    responsive: [
      {
        breakpoint: 540,
        settings: {
          slidesToShow: 2
        }
      },
    ]
  });
  $('.slick-product-3').slick({
    dots: false,
    infinite: false,
    speed: 300,
    slidesToShow: 4,
    slidesToScroll: 1,
    prevArrow: '.ar.p5',
    nextArrow: '.ar.p6',
    responsive: [
      {
        breakpoint: 540,
        settings: {
          slidesToShow: 2
        }
      },
    ]
  });
  $('.slick-news').slick({
    dots: false,
    arrows: true,
    infinite: false,
    speed: 300,
    slidesToShow: 2,
    slidesToScroll: 1,
    prevArrow: '.arrows-news .arrow-previous',
    nextArrow: '.arrows-news .arrow-next',
    responsive: [
      {
        breakpoint: 540,
        settings: {
          slidesToShow: 1
        }
      }
    ]
  });
  $('.slick-talkaboutus').slick({
    dots: false,
    arrows: true,
    infinite: false,
    speed: 300,
    slidesToShow: 1,
    slidesToScroll: 1,
    prevArrow: '.talkaboutus-arrow.left',
    nextArrow: '.talkaboutus-arrow.right',
  });
}, false);
