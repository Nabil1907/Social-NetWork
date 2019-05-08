
$(".pageslikes").on('click',function(){
var like_s= $(this).attr('data-like');
var page_id= $(this).attr('data-Page');
var owner_id=$(this).attr('data-owner');
var token=$(this).attr('data-token');
/* alert(like_s.concat(" ",page_id," ",owner_id,"   ",token)); */
$.ajax({
    method: 'POST',
    url: "/pagelikes",
    data:{ like_s: like_s,page_id: page_id,owner_id: owner_id, _token: token},
    
    success:function(data)
    {  
     if(data.is_like == 1){
        $('*[ data-Page="'+ page_id +'"]').removeClass('btn btn-secondary').addClass('btn btn-primary');
        var cu_like = $('*[ data-Page="'+ page_id +'"]').find('.like_count').text();
        var new_like= parseInt(cu_like) + 1 ;
        $('*[ data-Page="'+ page_id +'"]').find('.like_count').text(new_like);
      }
      else if(data.is_like == 0){
        $('*[ data-Page="'+ page_id +'"]').removeClass('btn btn-primary').addClass('btn btn-secondary');
        var cu_like = $('*[ data-Page="'+ page_id +'"]').find('.like_count').text();
        var new_like= parseInt(cu_like)- 1 ;
        $('*[ data-Page="'+ page_id +'"]').find('.like_count').text(new_like);
      }
    }
    
})


});