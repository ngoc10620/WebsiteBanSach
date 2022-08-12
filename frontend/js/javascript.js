function check(){
    var text = document.forms["search"]["txtsearch"].value;
    if(text == null || text == ""){
        alert("Hãy nhập từ khóa tìm kiếm");
    }
    else{
        window.location ="search.php"+text;
    }
}