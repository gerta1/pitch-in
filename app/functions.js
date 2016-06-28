function get(url){
  return new Promise(function(resolve, reject){
      var ajax = new XMLHttpRequest();
      ajax.open("GET", url);
      ajax.onload = function(){
        if(ajax.status !== 200) reject();
        resolve(ajax.responseText);
      }
      ajax.send();
  });
}


function post(url, data){
  return new Promise(function(resolve, reject){
      var ajax = new XMLHttpRequest();
      ajax.open("POST", url);
      ajax.onload = function(){
        if(ajax.status !== 200) reject();
        resolve(ajax.responseText);
      }
      ajax.send(data);
  });
}

/**
* @template is the name of a template inside the template directory
* @data is the name of the json data to pull from the data directory
*/
function loadTemplate(template, data){
data = typeof(data) !== "undefined" ? JSON.parse(data) : null;
//   data = JSON.parse(data);
  var dir = "app/templates/";
  var filetype = ".html";
  
  // $('#main').innerHTML = dir+template+filetype;
  
  //Get template file.
  get(dir+template+filetype).then(function(template){
    //compile html into Handlebars template
    var compile = Handlebars.compile(template);
    //get the data from the data folder
    var html = compile(data);
    $('#main').innerHTML = html;

    //reset links
    setLinks();
  });

}

var getData = function(doc){
  var path = "data/";
  var ajax = new XMLHttpRequest();
  ajax.open("GET", path+doc+".json");
  ajax.onload = function(){
    if(ajax.status !== 200) return false;
    return ajax.responseText;
  };
  ajax.send();
};

function setLinks(){
  //Not a very efficient way of reparsing the DOM but it works enough for the demonstration. Ideally would would isolate the scope of the events
  //and update only the events we need by checking what events we have attached to window, or by storing the IDs of each even listener and
  //destroying its element is no longer in the visible DOM.
  
  //when we click on a div with a data-link attribute, switch to the new data-template using the data-link id
  var links = $$('[data-template]');

  //the "let" keyword is an ECMAScript 6 standard that allows us to create a variable that only lives inside the scope of the for loop.
  for(let i = 0; i < links.length; i++){
    if(links[i].dataset.template === "undefined"){
      console.log("Missing data-template values");
      continue;
    }
    links[i].onclick =  function callback(){
      if(!links[i].dataset.link){
        //no data file
        loadTemplate(links[i].dataset.template);        
      } else {
        get("server/"+links[i].dataset.link+".php").then(function(data){
          loadTemplate(links[i].dataset.template, data);
        });  
      }
    };  
  }
}


//open a popup window with the specified template
//The template must be a file name in the /app/tempplates/ directory for now.
var loadModal = function(template, dataFile){
  var dir = "app/templates/";
  var filetype = ".html";
  
  //get template
  get(dir+template+filetype).then(function(ret){

    if(dataFile){
      get("/server/"+dataFile).then(function(data){
        //compile html into Handlebars template
        var compile = Handlebars.compile(ret);
        //get the data from the data folder
        var html = compile(JSON.parse(data));

        $('#popup').innerHTML = html;
        modal.open('#popup');
      });
    } else {
        var compile = Handlebars.compile(ret);
        $('#popup').innerHTML = compile();
        modal.open('#popup');
    }
  });
}

var clientSubmit = function(form){
  event.preventDefault();

  var data = new FormData(form);
  
  VanillaToasts.create({
      title: 'Success',
      text: 'Client Added Successfully',
      type: 'success', // success, info, warning, error
      timeout: 5000 // hide after 5000ms
  });

  post(HOST+'/server/client.php', data).then(function(data){
    console.log(data);
  });
  
  return false;
}

var newIssue = function(form){
  event.preventDefault();

  var data = new FormData(form);

  post(HOST+'/server/task.php', data).then(function(data){
    console.log(data);

    if(data.error){
      VanillaToasts.create({
          title: 'Error',
          text: 'An Error Occured',
          type: 'error', // success, info, warning, error
          timeout: 5000
      });
    } else {
      VanillaToasts.create({
          title: 'Success',
          text: 'Issue Added Successfully',
          type: 'success', // success, info, warning, error   / optional parameter
          timeout: 5000
      });
    }

    modal.close();
    loadTemplate("tasks", data);
  });
  
  return false;
}