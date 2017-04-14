$(function() {
	// newGame();
	var bet =1;
	var bet_total =0;
	var fold = 0;
	var game_tpye = 1;
	var double_total =0;
	var zeor_number = 1000000000;
	var odds = 1;
	var winlose = 0;
	var winlose_total = 0;
	var winner ="";
	var chip = 1000;
	var total_bet = 0;
	var total_double = 0;
	var rank_arr = ['0', 'a', '2', '3', '4', '5', '6', '7', '8', '9', '10', 'j', 'q' ,'k'];
	var rank_str_arr = ['0', 'A', '2', '3', '4', '5', '6', '7', '8', '9', '10', 'J', 'Q' ,'K'];
	var suit_json ={'s':'spades' , 'h':'hearts' , 'c':'clubs', 'd':'diams'};
	var suit_img_json ={'s':'♠' , 'h':'♥' , 'c':'♣', 'd':'♦'};
	var banker_card_info ,player_card_info
	var winner_info = {
		"chip" : 0,
		"winlose" : 0,
		"bet" : 0,
		"double" : 0,
		"winner" : '',
	};
	// doBet();
	upinfo();

	$('#new').bind('click', function(e)
	{
		e.preventDefault();
		newGame();
		$('#new').hide();
		$('#double').removeClass("disabled");
		$('#fold').removeAttr("disabled");
	})
	
	$('#bet').bind('click', function(e){
		e.preventDefault();
		if($(this).hasClass("disabled"))
		{
			return false;
		}
		$(this).addClass("disabled");
		$('#fold').removeAttr("disabled").show();
		$('#double').removeClass("disabled");
		newGame();
	})
	
	$('#fold').bind('click', function(e)
	{
		e.preventDefault();
		winlose ='-1';
		$(this).attr("disabled" ,true);
		$('#bet').removeClass("disabled");
		$(this).attr("disabled");
		$(this).hide();
		$('#double').addClass("disabled");

		fold = 1;
		getWinner();
		upinfo();
	})
	
	$('#double').bind('click' , function(e){
		e.preventDefault();
		if($(this).hasClass("disabled"))
		{
			return false;
		}
		$(this).addClass("disabled");
		$('#bet').removeClass("disabled");
		$('#fold').attr("disabled" , true).hide();

		doDouble();
	})
	
	function doDouble()
	{
		bankerOpen();
		getWinner();	
	}
	
	function doBet()
	{
		chip -=1;
	}
	
	function getOdds(point)
	{
		var return_odds = 1;
		if(point >= 9*zeor_number)
		{
			return_odds  =100;//皇家同花順
		}else if(point>=8*zeor_number && point<9*zeor_number){
			return_odds  =50;//同花順
		}else if(point>=7*zeor_number && point<8*zeor_number){
			return_odds  =20;//四條
		}else if(point>=6*zeor_number && point<7*zeor_number){
			return_odds  =7;//葫蘆
		}else if(point>=5*zeor_number && point<6*zeor_number){
			return_odds  =5;//同花
		}else if(point>=4*zeor_number && point<5*zeor_number){
			return_odds  =4;//順子
		}else if(point>=3*zeor_number && point<4*zeor_number){
			return_odds  =3;//三條
		}else if(point>=2*zeor_number&& point<3*zeor_number){
			return_odds  =2;//兩對
		}
		return return_odds;
	}
	
	
	
	function getWinner()
	{
		odds =1;
		var banker_point = parseInt(banker_card_info.point);
		var player_point = parseInt(player_card_info.point);
		if(banker_point>=141304032 && fold == 0)//莊家比牌
		{
			if(player_point > banker_point)
			{
				odds  = getOdds(player_point);
				winlose = bet*2*odds+bet;
				winner ="player";
				chip+=1;
				chip+=winlose;
			}else if(player_point < banker_point)
			{
				winlose = (bet*-2)+(bet*-1);
				winner ="banker";
				chip-=2;
			}else{
				winlose =0;
				chip+=3;
				winner ="tip";
			}
			double_total +=2;
		}else if(fold==1){
			winlose =-1*bet;
			// chip-=1;
			winner ="banker";
		}else
		{
			winlose = bet;
			winner ="player";
			chip+=bet+bet;
			double_total +=2;
			// chip;
		}
		
		winlose_total+=winlose;
		upinfo();
	}
	
	function upinfo()
	{
		
		$('#info_winner span').text(winner);
		$('#info_chip span').text(chip);
		$('#info_bet_total span').text(bet_total);
		$('#info_double_total span').text(double_total);
		$('#info_winlose_total span').text(winlose_total);
		$('#info_winlose span').text(winlose);
		$('#info_odds span').text(odds);
	}
	
	function bankerOpen()
	{
		// console.log(banker_card_info);
		$.each(banker_card_info['handcard'], function( index, value ) {
			if(index <4)
			{
				res = banker_card_info['handcard'][index].split("_");
				suit  = suit_json[res[0]] ;
				suit_img  = suit_img_json[res[0]] ;
				rank  = rank_arr[res[1]] ;
				rank_str  = rank_str_arr[res[1]] ;
				$('.banker_card .card:not(.open)').eq(index).addClass(suit);
				$('.banker_card .card:not(.open)').eq(index).removeClass('back');
				$('.banker_card .card:not(.open)').eq(index).addClass('rank-'+rank);
				$('.banker_card .card:not(.open) .rank').eq(index).text(rank_str);
				$('.banker_card .card:not(.open) .suit').eq(index).text(suit_img);
			}
		})
	}
	
	function  newGame()
	{
		var res ,suit, suit_img, rank, rank_str ;
		winner ='';
		fold = 0;
		game_type = $('input[name=game_type]:checked').val();
		// chip -=1;
		doBet();
		bet_total +=1;
		upinfo();
		$.ajax({
			type: 'POST',
			url: '/GameAPI/start',
			data: '{"player":"tom","game_type":"'+game_type+'"}', // or JSON.stringify ({name: 'jonas'}),
			success: function(data) {
				if(data["body"]["status"] !='100')
				{
					var errormsg = data["body"]["msg"];
					alert(errormsg );
					return false;
				}
				banker_card_info = data["body"]['card']['banker'];
				player_card_info = data["body"]['card']['player'];
				$('.player_card .card').attr('class' ,'card');
				$('.player_card .card').addClass('back');
				$.each(player_card_info['handcard'], function( index, value ) {
					res = value.split("_");
					suit  = suit_json[res[0]] ;
					suit_img  = suit_img_json[res[0]] ;
					rank  = rank_arr[res[1]] ;
					rank_str  = rank_str_arr[res[1]] ;
					$('.player_card .card').eq(index).removeClass('back');
					$('.player_card .card').eq(index).addClass(suit);
					$('.player_card .card').eq(index).addClass('rank-'+rank);
					$('.player_card .card .rank').eq(index).text(rank_str);
					$('.player_card .card .suit').eq(index).text(suit_img);
				});
				
				$('.banker_card .card').attr('class' ,'card');
				$('.banker_card .card').eq(4).addClass('open');
				$('.banker_card .card:not(.open)').addClass('back');
				res = banker_card_info['handcard'][4].split("_");
				suit  = suit_json[res[0]] ;
				suit_img  = suit_img_json[res[0]] ;
				rank  = rank_arr[res[1]] ;
				rank_str  = rank_str_arr[res[1]] ;
				$('.banker_card .card.open').addClass(suit);
				$('.banker_card .card.open').addClass('rank-'+rank);
				$('.banker_card .card.open .rank').text(rank_str);
				$('.banker_card .card.open .suit').text(suit_img);
				
			},
			contentType: "application/json",
			dataType: 'json'
		});
	}
});
