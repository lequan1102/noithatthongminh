//Check URL
var protocol = window.location.protocol;
var hostname = window.location.hostname;
var url = protocol+'//'+hostname+'/';


$.ajaxSetup({
  headers: {
      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
  }
});
/******************************
 ************ADD CART**********
 ******************************
 * button id="js_addCart" data-product-id=""
 ******************************/

var exists_button_add_cart = document.getElementById("js_addCart")
if(exists_button_add_cart != null){
  exists_button_add_cart.addEventListener("click", function(e){
    let button = e.target
    let quantity = 1
    let exists_quantity = document.getElementById("number")
    let find_number_total_cart = document.getElementById('js_total_cart')
    if(exists_quantity != null){
      quantity = exists_quantity.value
    }
    $.ajax({
        type: "post",
        url: url+"latumi/"+"cart/addcart",
        data: {
            product_id: button.getAttribute('data-product-id'),
            quantity: quantity
        },
        success: function (response) {
            swal("Tuyệt vời!", response.status, "success");
            find_number_total_cart.innerHTML = response.total_cart
            setTimeout(function(){
                document.querySelector('.swal-overlay--show-modal').classList.remove('swal-overlay--show-modal');
            }, 2000);
        }
    });
  })
}
/******************************
 ******FAVORITE PRODUCT********
 ******************************
 * button id="js_favorite" data-product-id=""
 ******************************/
$(document).ready(function(){
  var button_favorite = document.getElementById("js_favorite");
  if(button_favorite != null){
    button_favorite.addEventListener("click", function(){
      var product_id = this.getAttribute('data-product-id');
      $.ajax({
        type: "post",
        url: url+"latumi/"+"product/favorite",
        data: {
          'product_id': product_id
        },
        success: function (response) {
          if(response.status == 1){
            if(response.favorite == 1){
              document.getElementById("js_favorite").innerHTML = '<svg viewBox="0 0 512 512"><path fill="currentColor" d="M462.3 62.6C407.5 15.9 326 24.3 275.7 76.2L256 96.5l-19.7-20.3C186.1 24.3 104.5 15.9 49.7 62.6c-62.8 53.6-66.1 149.8-9.9 207.9l193.5 199.8c12.5 12.9 32.8 12.9 45.3 0l193.5-199.8c56.3-58.1 53-154.3-9.8-207.9z"></path></svg>';
              swal("Tuyệt vời!", response.message);
            } else {
              document.getElementById("js_favorite").innerHTML = '<svg viewBox="0 0 512 512"><path fill="currentColor" d="M458.4 64.3C400.6 15.7 311.3 23 256 79.3 200.7 23 111.4 15.6 53.6 64.3-21.6 127.6-10.6 230.8 43 285.5l175.4 178.7c10 10.2 23.4 15.9 37.6 15.9 14.3 0 27.6-5.6 37.6-15.8L469 285.6c53.5-54.7 64.7-157.9-10.6-221.3zm-23.6 187.5L259.4 430.5c-2.4 2.4-4.4 2.4-6.8 0L77.2 251.8c-36.5-37.2-43.9-107.6 7.3-150.7 38.9-32.7 98.9-27.8 136.5 10.5l35 35.7 35-35.7c37.8-38.5 97.8-43.2 136.5-10.6 51.1 43.1 43.5 113.9 7.3 150.8z"></path></svg>';
            }
          } else {
            swal("Ooop! " + response.message, {
              icon: "info",
            });
          }
        }
      });
    });
  }
});

/******************************
 ***QUICK VIEW PRODUCT HANLDE**
 ******************************
 * button onclick="quickview()" data-product-id=""
 ******************************/
var timex     = document.querySelector('.wrapper-quickview .fa-times');
if(timex != null){
  var quickview = document.querySelector('.wrapper-quickview');
  timex.addEventListener('click', function(){
    quickview.classList.remove('display');
  });
}
var button_quickview = document.querySelectorAll('button.quickview');
if(button_quickview != null){
  for (var i = 0; i < button_quickview.length; i++){
    button_quickview[i].addEventListener('click', function(){
      quickview.classList.add('display');
    });
  }
}

function quick_view(event){
  let product_id = event.getAttribute("data-product-id")
  $.ajax({
    type: "post",
    url: url+"latumi/"+"product/quickview",
    data: {
      'product_id': product_id
    },
    success: function (response) {
      document.querySelector(".wrapper-quickview .row").innerHTML = response
    }
  });
}

/**************************************
 * Cart Handle
 * - Cart Order
 * - Handles basket numbers, totals and prices
 **************************************/
//-Cart Order
var buttonCartOrder = document.getElementById('js_cart_order');
if(buttonCartOrder != null){
  buttonCartOrder.addEventListener('click',Order);
}
function Order(){
  var email         = document.getElementById('input_email').value;
  var full_name     = document.getElementById('input_full_name').value;
  var number_phone  = document.getElementById('input_number_phone').value;
  var location      = document.getElementById('input_location').value;
  var province      = document.getElementById('province').value;
  var district      = document.getElementById('district').value;
  var ward          = document.getElementById('ward').value;
  var note          = document.getElementById('input_note').value;
  //if error validate input
  var status_message          = document.getElementById('status_message');
  $.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
  });
  //just take user location
  $.ajax({
      type: "post",
      url: "cart/order",
      data: {
          'email': email,
          'full_name':  full_name,
          'number_phone': number_phone,
          'location': location,
          'province': province,
          'district': district,
          'ward': ward,
          'note': note
      },
      success: function (response) {
        status_message.innerHTML = response.status;
        console.log(response.status);
      },
      error: function(response) {
        console.log(response.status);
      }
  });
}
//-Handles basket numbers, totals and prices
if (document.readyState == 'loading') {
  document.addEventListener('DOMContentLoaded', Cartready)
} else {
  Cartready()
}
//CART READY
function Cartready() {
  var quantityInputs = document.getElementsByClassName('cart-quantity-input')
  for (var i = 0; i < quantityInputs.length; i++) {
      var input = quantityInputs[i]
      input.addEventListener('change', quantityChanged)
  }
  var quantityInputsMB = document.getElementsByClassName('cart-quantity-input-mb')
  for (var i = 0; i < quantityInputsMB.length; i++) {
    var inputMB = quantityInputsMB[i]
    inputMB.addEventListener('change', quantityChangedMB)
  }
}

//Tips: class mobie va pc khac nhau nen phai them 2 function khac nhau de xu ly
//UPDATE CART PC
function updateCartTotal() {
  var cartItemContainer = document.getElementsByClassName('cart-items')[0]
  var cartRows = cartItemContainer.getElementsByClassName('cart-row')
  var total = 0
  var quantityN = 0
  for (var i = 0; i < cartRows.length; i++) {
      var cartRow = cartRows[i]
      var priceElement = cartRow.getElementsByClassName('cart-price')[0]
      var cartPriceItem = cartRow.getElementsByClassName('cart-price-item')[0]
      var quantityElement = cartRow.getElementsByClassName('cart-quantity-input')[0]

      var price = priceElement.innerText.replace(' đ', '')
      var replaceAllPrice = price.replaceAll('.','')

      var quantity = quantityElement.value
      total = total + (replaceAllPrice * quantity)
      quantityN = parseFloat(quantityN + Number(quantity))
      //Format price item
      cartPriceItemFormat = replaceAllPrice * Number(quantity)
      cartPriceItem.innerText = new Intl.NumberFormat('vi').format(cartPriceItemFormat)
  }
  total = Math.round(total)
  document.getElementsByClassName('cart-total-price')[0].innerText = new Intl.NumberFormat('vi').format(total)
  document.getElementsByClassName('cart-total-quantity')[0].innerText = quantityN
}
//UPDATE CART MB
function updateCartTotalMB() {
  var cartItemContainerMB = document.getElementById('cart-mobie')
  var cartRowsMB = cartItemContainerMB.getElementsByClassName('cart-mobie-item')
  var totalMB = 0
  var quantityN = 0
  for (var i = 0; i < cartRowsMB.length; i++) {
      var cartRow = cartRowsMB[i]
      var priceElementMB = cartRow.getElementsByClassName('cart-price-mb')[0]
      // var cartPriceItemMB = cartRow.getElementsByClassName('cart-price-item-mb')[0]
      var quantityElementMB = cartRow.getElementsByClassName('cart-quantity-input-mb')[0]

      var price = priceElementMB.innerText.replace(' đ', '')
      var replaceAllPrice = price.replaceAll('.','')

      var quantity = quantityElementMB.value
      totalMB = totalMB + (replaceAllPrice * quantity)
      quantityN = parseFloat(quantityN + Number(quantity))
      //Format price item
      cartPriceItemFormatMB = replaceAllPrice * Number(quantity)
      // cartPriceItemMB.innerText = new Intl.NumberFormat('vi').format(cartPriceItemFormatMB)
  }
  totalMB = Math.round(totalMB)
  document.getElementsByClassName('cart-total-price')[0].innerText = new Intl.NumberFormat('vi').format(totalMB)
  document.getElementsByClassName('cart-total-quantity')[0].innerText = quantityN
}

//UPDATE Quantity Cart handmade PC
function quantityChanged(event) {
  var input = event.target
  if (isNaN(input.value) || input.value <= 0) {
      input.value = 1
  }
  var quantity = input.value
  var product_id = input.getAttribute('data-productid')
  ajaxUpdateItemCart(product_id,quantity)
  updateCartTotal()
}

//UPDATE Quantity Cart handmade MB
function quantityChangedMB(event) {
  var input = event.target
  if (isNaN(input.value) || input.value <= 0) {
      input.value = 1
  }
  var quantity = input.value
  var product_id = input.getAttribute('data-productid')
  ajaxUpdateItemCart(product_id,quantity)
  updateCartTotalMB()
}
//UPDATE Quantity Cart
function ajaxUpdateItemCart(productId,quantity){
  $.ajax({
      type: "post",
      url: "cart/update-ajx-cart",
      data: {
          'product_id': productId,
          'quantity':  quantity
      },
      success: function (response) {
          console.log(response.status)
      }
  });
}
//Xóa sản phẩm khỏi giỏ hàng
function remove_cart(){
  var check = confirm("Bạn có muốn xóa sản phẩm này khỏi giỏ hàng của bạn?");
  if (check == true) {}
  else {
      return false;
  }
}
/**************************************
 * SELECT Handle cart location
 **************************************/
$('.location').change(function (e) {
    e.preventDefault();
    let currentId = $(this).attr('id');
    let typeId = $(this).val();
    $.ajax({
        type: "POST",
        url: "cart/loadlocation",
        data: {
            'typeId' : typeId,
            'type': currentId
        },
        success: function (response) {
            let html = '';
            let element = '';
            if (currentId == 'province'){
                html = '<option value="">Vui lòng chọn quận/huyện</option>';
                element = '#district';
                $.each(response.data, function (index, item) { 
                    html += '<option value="'+ item._name +'">'+ item._prefix + ' ' + item._name +'</option>';
                });
                $('#ward').html('').append('<option value="">Vui lòng chọn phường/xã</option>');
            } else if (currentId == 'district') {
                html = '<option value="">Vui lòng chọn phường/xã</option>';
                element = '#ward';
                $.each(response.data, function (index, item) {
                    html += '<option value="'+ item._name +'">'+ item._prefix + ' ' + item._name +'</option>';
                });
            }
            $(element).html('').append(html);
        }
    });
});

/**************************************
 * Search Automatic on toolbar
 **************************************/
document.querySelector('.pc-search input').addEventListener('keyup', searchKeywords);
document.querySelector('.preview-category').addEventListener('change', searchKeywords);
function searchKeywords(){
    var inputCategory  = $('.search-preview input[name="category_id"]:checked').val();
    var keywords = $('.pc-search input[name="keywords"]').val();
    var price = $('.search-preview input[name="price"]:checked').val();
    $.ajax({
        type: "post",
        url: url+"latumi"+"/product/filter-search",
        data: {
            keywords: keywords,
            category_id: inputCategory,
            price: price
        },
        
        success: function (response) {
            $('.preview-products').html(response);
        },
        beforeSend: function(response){
            $('.preview-products').html('<div class="loader">Loading...</div>');
        }
    });
}
/**************************************
 ***********FILTER PRODUCT*************
 **************************************/
var filter = document.getElementById("filter");
if(filter != null){
  filter.addEventListener("change", filter_product);
}
function filter_product(){
  filter.submit()
}