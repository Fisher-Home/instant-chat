var msg = {};
msg.alias = "Fisher";
msg.content = "Nice to meet you!";
msg.time = '20:25pm';
msg.img = 'Head photo';

var SmartChat = {};


$(function() {
	SmartChat = init();
	setInterval('SmartChat.fnSendMessage(msg)', 8000);
	$('#iPanel-chat .cTail .cSend').click(function(event) {
		var content=$('#iChat-edit-text').val();
		if(!content)
			return;
		var msg = {};
		var time = new Date();
		msg.time = time.getHours() + ":" + time.getMinutes();
		msg.alias = "Fisher";
		msg.content = content;
		msg.img = "Headphoto";
		SmartChat.fnSendMessage(msg);
		$('#iChat-edit-text').val("");
	});
});

/* Init an object and all things will be done inside the object */
function init() {
	var Obj = {};
	Obj.msgs=[]; // will save all the msgs here
	Obj.data={
		lastTime:0 // last time send message time;
	}; // save some data

	Obj.fnSendMessage = function(msg) {
		this.fnAddNewMessage(msg);
	}
	Obj.fnAddNewMessage = function(msg) {
		$('#iPanel-chat .cBody').append( this.fnGetHTML(msg) );
	}
	Obj.fnScrollToEnd = function() {
		//		$('#iPanel-chat .cBody')
	}
	Obj.fnScrollToStart = function() {

	}
	// convert the msg object to html
	Obj.fnGetHTML = function(msg) {
		var curTime=new Date().getTime();
		var time='';

//		if(( curTime- this.data.lastTime)>15000 ) // if the interval time is a bit long, then show the time bar;
			time = '<div class="cTime"><span>' + msg.time + '</span></div>';
		this.data.lastTime=curTime;

		var html = '<div class="cChat-message">' + '<img class="cImg" src="" align="' + msg.img + '" />' + '<p class="cAlias">' + msg.alias + '</p>' + '<p class="cContent">' + msg.content + '</p>' + '</div>';
		return time + html;
	}
	// to recover from the data
	Obj.fnRefresh = function() {
		
	}
	return Obj;
}