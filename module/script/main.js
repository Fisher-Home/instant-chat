var msg = new Message("c496811915","Fisher", "Good evening", 123456789, "c496811915");
/*

API List

A. Quest for new messages
	// Will be quested for many times;

path:
api/

method:
post

body:{
	from:[my id]
}

return
[
  {
  	id:"",
	alias:"Fisher",
	content:"Good Evening",
	time:2323232,
	img:""
  },{...}
]


B. Quest for history message

path:
api/

method:
post

body:{
	from:[my id],
	id=[Chat ID]
}

return
[
  {
  	id:"",
	alias:"Fisher",
	content:"Good Evening",
	time:2323232,
	img:""
  },{...}
]

C. Send new Message

path:
api/

method:
post

body:{
	from:[my id],
	id=[Chat ID],
	content=[string],
	alias=[string]
}

return
{
	errCode:0,
	msg:[succeeded|failed]
}


The default url of user's head photo is "module/pic/[User ID].png"

*/


var bIsDebugging = true;
var SmartChat = {};

function Message(id, alias, content, time, img) {
	// Need alias, content and img in String
	// Need time in Long Integer
	if (id && alias && content && time && img) {
		this.id=id;
		this.alias = alias;
		this.content = content;
		this.time = time;
		this.img = "module/pic/" + img + ".png";
	}
	return this;
}


$(function() {
	SmartChat = init();
//	SmartChat.fnAddMessage(msg);
	if (bIsDebugging)
		SmartChat.test = setInterval('SmartChat.fnTest()', 8000);
	// Listen the 'send' button;
	$('#iPanel-chat .cTail .cSend').click(function(event) {
		var content = $('#iChat-edit-text').val();
		var time = new Date();
		time = time.getHours() + ":" + time.getMinutes();
		if (!content)
			return;
		var msg = new Message("c496811915", "Pluto", content, time, "c496811915");
		
		SmartChat.fnAddMessage(msg);
		$('#iChat-edit-text').val("");
	});
});

/* Init an object and all things will be done inside the object */
function init() {
	var Obj = {};
	Obj.msgs = {}; // will save all the msgs here, the key is id, vaule is msg array

	// The following is Options Data
	Obj.panelID = "#iPanel-chat .cBody"; // Constant chat panel id;
	Obj.curChatID = "c496811915"; // Current chat id, c for chat, g for group chat
	Obj.lastTime = 0; // last time send message time;


	Obj.fnAddMessage = function(msg) {
		this.msgs[this.curChatID].push(msg);

		$(this.panelID).append(this.fnGenerateHTML(msg));
	}

	// After clicked the member of left panel, then called this function;
	Obj.fnCheckTo = function(id) {
		this.curChatID = id;
		this.lastTime = 0;

		if (this.msgs[id]) {
			this.fnShowMessages();
		} else {
			this.fnGetHistory(id);
		}
	}
	Obj.fnShowMessages = function() {
		var msgs = this.msgs[this.curChatID];
		for (i = 0; i < msgs.length; i++) {
			$(this.panelID).append(this.fnGenerateHTML(msgs[i]));
		}
	}
		// Request the server for history message;
	Obj.fnGetHistory = function(id) {
		$.post("api.php", {
				from: "",
				id: this.curChatID
			}, function(data, code) {
				Obj.msgs[id]=[];
//				info(data);
//
//				Obj.msgs[id] = data;
//				Obj.fnShowMessages();
			},
			"json");
	}
	Obj.fnCheckNewMessages=function(){
		$.post("api.php", {
				target: "check"
				, from: "pluto"
			}, function(data, code) {
				info(data.errcode+"  --  "+data.msg);
				info(data.data);
			},
			"json");
	}


	Obj.fnScrollToEnd = function() {
		//		$('#iPanel-chat .cBody')
	}
	Obj.fnScrollToStart = function() {

	}


	// convert the msg object to html
	Obj.fnGenerateHTML = function(msg) {
			var curTime = new Date().getTime();
			var time = '';

			//		if(( curTime- this.data.lastTime)>15000 ) // if the interval time is a bit long, then show the time bar;
			time = '<div class="cTime"><span>' + msg.time + '</span></div>';
			this.lastTime = curTime;

			var html = '<div class="cChat-message">' + '<img class="cImg" src="' + msg.img + '" align="' + msg.img + '" />' + '<p class="cAlias">' + msg.alias + '</p>' + '<p class="cContent">' + msg.content + '</p>' + '</div>';
			return time + html;
		}
		// to recover from the data
	Obj.fnRefresh = function() {

	}


	// Init 
	Obj.fnCheckTo("c496811915");

	Obj.fnTest = function() {
		if (bIsDebugging)
			this.fnAddMessage(msg);
		else
			clearInterval(this.test);
	}
	return Obj;
}






function info(msg) {
	console.log(msg);
}