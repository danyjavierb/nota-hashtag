/*
Plugin Name: Nota con HashTag Plugin
Plugin URI: https://github.com/danyjavierb/nota-hashtag
Description: Logica de lado del cliente para el plugin " Nota con HashTag Plugin "
Version: 1.0
Text Domain: nota-hashtag-textdomain
Author: Dany Bautista
Author URI: http://www.danybau.com
License: GPL2
*/






(function($,window){







$(window).load(function(){hashtag.init();});






})(jQuery,window,undefined);





var hashtag = (function($){
  var active = false;
  var hashtag = "";
  var rutaTweets ="";
  var init = function (){


   hashtag=  $("div [data-type='hashtag']").attr("data-rel");
   rutaTweets = $("div [data-type='hashtag']").attr("data-ruta");
   $("div [data-type='hashtag']").click(function(){

     if(active){
       $("#twitter").animate({"height":0},100);
       active=false;
     }
     else {
       $("#twitter").animate({"height":322},100);
       active=true;

     }



   });


   if(hashtag !="#" && hashtag !=""  ) {

     tweets= getData();

   }

  };
  var getData = function (){
    $("div [data-type='hashtag']").html(hashtag+ " (cargando...) ");
  $.get( rutaTweets+ "/getTweets.php", { hashtag: hashtag } ).done(function(tweets){
$("div [data-type='hashtag']").html(hashtag);
  tweets = JSON.parse(tweets);
  $("div [data-type='hashtag']").after("<div id='twitter'></div>");
  var tweetElements = [];

				tweets.statuses.forEach(function(tweetDetail) {

					var tweet = $("<article class= 'tweet'></article>");
					var header = $("<header></header>");
					var image_author;
					var tweet_text;
					var tweet_header_p;
					var tweet_header_a;
					var tweet_header_span;
					var tweet_header_str;
					image_author = $("<img class =tweet_img src= " + tweetDetail.user.profile_image_url + " />");

					tweet_header_p= $('<p class="tweet-header"></p>');
					tweet_header_a=$("<a target='_blank' href='https://twitter.com/account/redirect_by_id?id=" + tweetDetail.user.id + "'>" + tweetDetail.user.name + '</a>');
					tweet_header_span=$("<span>@" + tweetDetail.user.name + "</span></p>");



					tweet_header = $(tweet_header_str);

					tweet_text = $('<p class="tweet-text">' + tweetDetail.text + '</p>');

					tweet_header_p.append(tweet_header_a,tweet_header_span);
					header.append(tweet_header_p);
					header.append(image_author);
					header.append(tweet_header);
					tweet.append(header, tweet_text);
					tweetElements.push(tweet);

				});

if(tweetElements.length===0){
				$("#twitter").append($("<span>No hay tweets con este hashtag...</span>").slideUp("slow"));
				}
$("#twitter").append(tweetElements);

  });




  };


  return {
      init:init


  }


})(jQuery);
