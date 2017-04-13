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
				<div id="winner">chip&nbsp;&nbsp;<span>0</span></div>
				<div id="winner">winlose&nbsp;&nbsp;<span>0</span></div>
				<div id="winner">bet&nbsp;&nbsp;<span>1</span></div>
				<div id="winner">double&nbsp;&nbsp;<span>0</span></div>
				<div id="winner">winner&nbsp;&nbsp;<span></span></div>
			</div>
			<div class="playingCards fourColours rotateHand">
				<h1>banker</h1>
				<ul class="table banker_card">
					<div class="hand">
						<li>
							<div class="card" href="#">
								<span class="rank"></span>
								<span class="suit"></span>
							</div>
						</li>
						<li>
							<div class="card" href="#">
								<span class="rank"></span>
								<span class="suit"></span>
							</div>
						</li>
						<li>
							<div class="card" href="#">
								<span class="rank"></span>
								<span class="suit"></span>
							</div>
						</li>
						<li>
							<div class="card" href="#">
								<span class="rank"></span>
								<span class="suit"></span>
							</div>
						</li>
						<li>
							<div class="card open">
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
							<div class="card rank-q hearts open" href="#">
								<span class="rank"></span>
								<span class="suit"></span>
							</div>
						</li>
						<li>
							<div class="card open" href="#">
								<span class="rank">2</span>
								<span class="suit"></span>
							</div>
						</li>
						<li>
							<div class="card open" href="#">
								<span class="rank"></span>
								<span class="suit"></span>
							</div>
						</li>
						<li>
							<div class="card open" href="#">
								<span class="rank"></span>
								<span class="suit"></span>
							</div>
						</li>
						<li>
							<div class="card open">
								<span class="rank"></span>
								<span class="suit"></span>
							</div>
						</li>
					</div>
				</ul>
				<div class="clear"></div>
			</div>
			<div class="fish black disabled">
				<div>1</div>
			</div>
			<div class="fish orange" id="double" >
				<div>2</div>
			</div>
			<div class="clear"></div>
			<button id="new" class="hidden">new</button>
			<button id="fold">Fold</button>
		</div>
	</div>
</body>
</html>
