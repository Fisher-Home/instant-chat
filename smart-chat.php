<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="us-ascii" />
		<title>
			Smart Chat
		</title>
		<link href="module/style/main.css" rel="stylesheet" />
		<script src="http://apps.bdimg.com/libs/jquery/2.1.4/jquery.min.js"></script>
		<script src="module/script/main.js"></script>
	</head>
	<body>
		<div id="iPanels">
			<div id="iPanel-nav">
				<div class="cHead cText-middle">
					<table border="0">
						<tbody>
							<tr><td>Channel</td></tr>
						</tbody>
					</table>
				</div>
				<div class="cBody">
				</div>
				<div class="cTail">
					
				</div>
			</div>
			<div id="iPanel-chat">
				<div class="cHead cText-middle">
					<table border="0">
						<tr><td>Contact</td></tr>
					</table>
				</div>
				<div class="cBody">


					<div class="cTime">
						<span>19:21pm</span>
					</div>
					<div class="cChat-message">
						<img class="cImg" src="module/pic/default.png" align="Headphoto" />
						<p class="cAlias">Fisher</p>
						<p class="cContent">Hello, Nice to meet you</p>
					</div>


					
				</div>
				<div class="cTail">
					<table border="0">
						<tr>
							<td class="cEmoji">
								<img src="module/pic/emoji.png" alt="Emoji" />
							</td>
							<td class="cEdit">
								<textarea id="iChat-edit-text" name="text" autocomplete="off" alt="Input messages here"></textarea>
							</td>
							<td class="cSend">
								<input type="button" value="Send" />
							</td>
						</tr>
					</table>
				</div>
			</div>
			<div style="clear: both;"></div>
		</div>
	</body>
</html>