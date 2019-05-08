alert("Hello");

/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i);
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default));

Vue.component('example-component', require('./components/ExampleComponent.vue').default);

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

const app = new Vue({
    el: '#app'
});
$(".like").on('click',function()
{
 alert("post_id");
 /*$.ajax({

   type: 'POST',
   url: url,
   data:{like_s:like_s,article_id:article_id,_token:token},
   success: function(data){
	if(data.is_like == 1)
    {
    $('*[article_id="'+ article_id +'_l"]').removeClass('btn-secondry').addClass('btn-success');
    $('*[article_id="'+ article_id +'_d"]').removeClass('btn-danger').addClass('btn-secondry');

    var cu_like = $('*[article_id="'+ article_id +'_l"]').find('.like_count').text();
    var new_like= parseInt(cu_like) +1 ; 
    $('*[article_id="'+ article_id +'_l"]').find('.like_count').text(new_like);

     if(data.change_like == 1)
     {
    var cu_like = $('*[article_id="'+ article_id +'_d"]').find('.dislike_count').text();
    var new_like= parseInt(cu_like) - 1 ; 
    $('*[article_id="'+ article_id +'_d"]').find('.dislike_count').text(new_like);

     }
    }
   

	if(data.is_like == 0)
    {
    $('*[article_id="'+ article_id + '_l"]').removeClass('btn-success').addClass('btn-secondry');
	var cu_like = $('*[article_id="'+ article_id +'_l"]').find('.like_count').text();
    var new_like= parseInt(cu_like) - 1 ; 
    $('*[article_id="'+ article_id +'_l"]').find('.like_count').text(new_like);
   }} 
  

 });*/
});




