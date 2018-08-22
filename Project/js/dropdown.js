

$(function(){
    //Listen for a click on any of the dropdown items
    $(".ddcat li").click(function(){
        //Get the value
        var value = $(this).attr("value");

          alert(value);
        //Put the retrieved value into the hidden input
        //$("input[name='thenumbers']").val(value);
    });
});

/*
function categoriesDrop(data){
  alert(data.value);
}
https://stackoverflow.com/questions/20770777/submit-selection-from-bootstrap-dropdown-menu-to-post
https://stackoverflow.com/questions/15649001/bootstrap-input-field-and-dropdown-button-submit

$(function(){
    //Listen for a click on any of the dropdown items
    $(".thenumbers li").click(function(){
        //Get the value
        var value = $(this).attr("value");
        //Put the retrieved value into the hidden input
        $("input[name='thenumbers']").val(value);
    });
});
*/
