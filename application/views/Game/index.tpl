<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
     "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
    <meta http-equiv="content-type" content="text/html; charset=utf-8" />
    <title>i love...</title>
    <link rel="stylesheet" type="text/css" href="/css/game/index.css" media="screen" />
    <link rel="stylesheet" type="text/css" href="/css/game/cards.css" media="screen" />
    <script type="text/javascript" src="/js/jquery/3.1.0/jquery.min.js"></script>
    <script type="text/javascript" src="/js/game/index.js"></script>
</head>
<body>
	<div class="container">
		<div class="wrap">
			<div id="ontopDiv">
				<div id="info_chip">chip&nbsp;&nbsp;<span>0</span></div>
				<div id="info_winlose_total">winlose_total&nbsp;&nbsp;<span>0</span></div>
				<hr>
				<div>bet&nbsp;&nbsp;<span>1</span></div>
				<div>double&nbsp;&nbsp;<span>2</span></div>
				<div id="info_odds">odds&nbsp;&nbsp;<span>1</span></div>
				<div id="info_winlose">winlose&nbsp;&nbsp;<span>0</span></div>
				<div id="info_winner">winner&nbsp;&nbsp;<span></span></div>
				<hr>
				<div id="info_bet_total">bet_total&nbsp;&nbsp;<span>1</span></div>
				<div id="info_double_total">double_total&nbsp;&nbsp;<span>0</span></div>
			</div>
			<div id="leftDiv">
				 <input type="radio" name="game_type" value="1" checked>default<br>
				 <input type="radio" name="game_type" value="2" >have AK<br>
			</div>
			<div class="playingCards fourColours rotateHand">
				<h1>banker</h1>
				<ul class="table banker_card">
					<div class="hand">
						<li>
							<div class="card back" href="#">
								<span class="rank"></span>
								<span class="suit"></span>
							</div>
						</li>
						<li>
							<div class="card back" href="#">
								<span class="rank"></span>
								<span class="suit"></span>
							</div>
						</li>
						<li>
							<div class="card back" href="#">
								<span class="rank"></span>
								<span class="suit"></span>
							</div>
						</li>
						<li>
							<div class="card back" href="#">
								<span class="rank"></span>
								<span class="suit"></span>
							</div>
						</li>
						<li>
							<div class="card open back">
								<span class="rank"></span>
								<span class="suit"></span>
							</div>
						</li>
					</div>
				</ul>
				<div class="clear"></div>
				<h1>player</h1>
				<ul class="table player_card">
					<div class="open hand">
						<li>
							<div class="card open back" href="#">
								<span class="rank"></span>
								<span class="suit"></span>
							</div>
						</li>
						<li>
							<div class="card open back" href="#">
								<span class="rank"></span>
								<span class="suit"></span>
							</div>
						</li>
						<li>
							<div class="card open back" href="#">
								<span class="rank"></span>
								<span class="suit"></span>
							</div>
						</li>
						<li>
							<div class="card open back" href="#">
								<span class="rank"></span>
								<span class="suit"></span>
							</div>
						</li>
						<li>
							<div class="card open back">
								<span class="rank"></span>
								<span class="suit"></span>
							</div>
						</li>
					</div>
				</ul>
				<div class="clear"></div>
			</div>
			<div class="fish blue" id="bet">
				<div>1</div>
			</div>
			<div class="fish orange disabled" id="double" >
				<div>2</div>
			</div>
			<div class="clear"></div>
			<button id="new" class="hidden">new</button>
			<button id="fold" class="hidden" disabled="disabled">Fold</button>
		</div>
	</div>
</body>
</html>
