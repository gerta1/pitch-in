var HOST = window.location.protocol + '//' + window.location.host;
//globals
//create some nice shorthand so we don't have to keep typing document.blah().blah['etc'];
var $ = document.querySelector.bind(document);
// $.prototype.on = function(event, handler){
//   console.log(this);
// }
// $('#main').on("click");
var $$ = document.querySelectorAll.bind(document);


var View = {
	template: "home",
	link: "",
	label: "",
	data: null
}