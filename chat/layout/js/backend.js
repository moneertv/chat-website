var newplace = '';
$(function(){

    $('[placeholder]').focus(function(){

        newplace = $(this).attr('placeholder');
        $(this).attr('placeholder','');

    }).blur(function(){

        $(this).attr('placeholder',newplace);

    });

});
/*function myFunction(element) {    
    var liArray = document.getElementById("friends").getElementsByTagName("li");      
     for (var i = 0; i < liArray.length; i++)
         liArray[i].classList.remove("current");  
     element.classList.add("current");
 }*/

 /*const currentTab = document.getElementById('friend');
currentTab.addEventListener('click',()=>{
    currentTab.classList.add("current");
});*/
$("#scrollDownBtn").on("click", function () {
    // 1
    $(this).preventDefault();
    // 2
    const href = $(this).attr("onclick");
    // 3
    $("#space").animate({ scrollTop: $(href).offset().top }, 1000);
  });

const signUpButton = document.getElementById('signUp');
const signInButton = document.getElementById('signIn');
const container = document.getElementById('container');
signUpButton.addEventListener('click', () => {
	container.classList.add("right-panel-active");
});
signInButton.addEventListener('click', () => {
	container.classList.remove("right-panel-active");
});



