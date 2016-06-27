//Wait for the page to finish loading so we don't fire any JS too early.
window.addEventListener("load", function(){
 	//we will put some bootstrap code in here later.
  
 	//click the title to take us back home
 	$('header .title').addEventListener('click', function(){
   		loadTemplate('home');
 	});
  
 	//load the home template in once the page has loaded.
 	loadTemplate('home');

});


//set the event listeners for data-links and data-template
setLinks();


const modal = new VanillaModal();
