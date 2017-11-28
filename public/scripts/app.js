App = function()
{
	this.profile = '#app-profile';
	this.popup   = {
		element  : '#app-popup',
		container: '#app-popup-container'
	};
};

/* App */

App.prototype.isset = function(v)
{
  try
  {
    return !(v == null ||  v == undefined || typeof v == 'undefined');
  }
  catch(e)
  {
    return false;
  }
};

/* Numbers */

Number.prototype.toCurrency = function(dollar = true)
{
  var input = this;
  
  if(isNaN(input)) 
  {
    return '$0.00';
  }

  var sign = dollar ? '$' : '';

  if(input < 0 && dollar) 
  {
      sign = '-' + sign;
      input = input * -1;
  }

  var string = sign + input.toFixed(2).replace(/(\d)(?=(\d\d\d)+(?!\d))/g, "$1,");

  if(string === "-$0.00")
  {
     return "$0.00";
  }
  else
  {
    return string;
  }
};

/* Strings */

String.prototype.trim = function(c = ' ')
{
	return this.replace(new RegExp("^\\" + c + "+|\\" + c + "+$", "g") , '');
};

String.prototype.jQuerify = function(string = false, c = '.')
{
	e = this;
	j = c+e.trim('.');
	
	return string ? j : $(j);
};

String.prototype.toCurrency = function(dollar)
{
  
  return Number(this).toCurrency(dollar);
};

/* Initiate */

var app = new App();

/* Listeners */

$(app.profile)
	.popup({
		html: $(app.popup.container).html(),
		position: "bottom center",
		on: 'click'
	})
;

$(app.popup.container)
  .remove()
;