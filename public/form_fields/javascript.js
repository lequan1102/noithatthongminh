document.addEventListener('DOMContentLoaded', function(){
    //Xử lý dấu chấm của giá và giá đã giảm
    var price =  document.getElementById('price');
    if (price != null){
        $('#discount_price input, #price input').maskNumber({
            integer:true,
            thousands:'.'
        });
    }

    //Xử lý trình soạn thảo ckeditor
    var ckeditor = document.getElementById('ckeditor');
    if (ckeditor != null){
        CKEDITOR.replace( 'ckeditor', {} );
    }
})