$(document).ready(function() {
	function resize() {
		var h = $(window).height();
		var l = $(window).width();
		var actions = $('.recherche').width() + $('.resultat').width();
		var footer = $('.footer').height();
		var liste_header = $('.liste_header').height();
		var formulaire_header = $('.formulaire_header').height();
		var lchoix = $('.choix').width();
		$('.bouton').css({'width':lchoix});
		$('#map-canvas').css({'width':l - actions, 'margin-left':actions});
		$('.actions').css({'height':h});
		$('.recherche').css({'height':h});
		$('.resultat').css({'height':h});
		$('.resultat .liste').css({'height':h - (liste_header + footer)});
		$('#formulaire').css({'height':h - (formulaire_header + footer + 30)});
	}

	resize();

	$(window).resize(function() {
		resize();
	});

	function panneauActif(panneau) {
		if(panneau.find('ui-state-active')) {
			panneau.addClass('on');
		}
		else {
			panneau.removeClass('on');
		}
	}
	$('.remove').remove();

	$('.liste').accordion({
		header: ".header",
		collapsible: true,
		heightStyle: "content",
		active: false
	});
	$('.accordion').accordion({
		header: ".titre_asso",
		collapsible: true,
		heightStyle: "content",
		active: false
	});
	$('.accordion_2').accordion({
		header: ".titre_etab",
		collapsible: true,
		heightStyle: "content",
		active: false
	});
	$('.accordion_3').accordion({
		header: ".activite",
		collapsible: true,
		heightStyle: "content",
		active: false
	});
	$('.liste_etab').accordion({
		header: ".etablissements",
		collapsible: true,
		heightStyle: "content",
		active: false
	});

	$('.selection').accordion({
		header: "h3",
		collapsible: true,
		heightStyle: "content",
		active: false
	});

	$(".geo").click(function() {
		var url = $(this).attr('href');
		window.open(url, '_blank');
	});

	var departements_selection = $(".departements_selection");
	var departements_drop = $(".departements_drop");
	var regions_selection = $(".regions_selection");
	var regions_drop = $(".regions_drop");
	var typeAsso_selection = $(".typeAsso_selection");
	var typeAsso_drop = $(".typeAsso_drop");
	var typeEtab_selection = $(".typeEtab_selection");
	var typeEtab_drop = $(".typeEtab_drop");
	var typeActivite_selection = $(".typeActivite_selection");
	var typeActivite_drop = $(".typeActivite_drop");
	var typeAge_selection = $(".typeAge_selection");
	var typeAge_drop = $(".typeAge_drop");

	function checkSelection() {
		departements_drop.find("li").each(function() {
			$(this).find("input").attr('type','hidden');
			departements_drop.css('margin-top',15);
		});
		departements_selection.find("li").each(function() {
			$(this).find("input").attr('type','checkbox').css('visibility','hidden');
		});
		regions_drop.find("li").each(function() {
			$(this).find("input").attr('type','hidden');
			regions_drop.css('margin-top',15);
		});
		regions_selection.find("li").each(function() {
			$(this).find("input").attr('type','checkbox').css('visibility','hidden');
		});
		typeAsso_drop.find("li").each(function() {
			$(this).find("input").attr('type','hidden');
			typeAsso_drop.css('margin-top',15);
		});
		typeAsso_selection.find("li").each(function() {
			$(this).find("input").attr('type','checkbox').css('visibility','hidden');
		});
		typeEtab_drop.find("li").each(function() {
			$(this).find("input").attr('type','hidden');
			typeEtab_drop.css('margin-top',15);
		});
		typeEtab_selection.find("li").each(function() {
			$(this).find("input").attr('type','checkbox').css('visibility','hidden');
		});
		typeActivite_drop.find("li").each(function() {
			$(this).find("input").attr('type','hidden');
			typeActivite_drop.css('margin-top',15);
		});
		typeActivite_selection.find("li").each(function() {
			$(this).find("input").attr('type','checkbox').css('visibility','hidden');
		});
		typeAge_drop.find("li").each(function() {
			$(this).find("input").attr('type','hidden');
			typeAge_drop.css('margin-top',15);
		});
		typeAge_selection.find("li").each(function() {
			$(this).find("input").attr('type','checkbox').css('visibility','hidden');
		});
	}

	checkSelection();

	/*
	$('#departement_etendu').hide();
	$('#departement_simple .etendu').click(function(){
		$('#departement_simple').hide();
		$('#departement_etendu').show();
	});
	$('#departement_etendu .etendu').click(function(){
		$('#departement_etendu').hide();
		$('#departement_simple').show();
	});
	$('#region_etendu').hide();
	$('#region_simple .etendu').click(function(){
		$('#region_simple').hide();
		$('#region_etendu').show();
	});
	$('#region_etendu .etendu').click(function(){
		$('#region_etendu').hide();
		$('#region_simple').show();
	});
	*/

	$(document).tooltip({
		position: {
			track: true,
			using: function(position, feedback) {
				$(this).css(position);
				$("<div>")
				.addClass( "arrow" )
				.addClass(feedback.vertical)
				.addClass(feedback.horizontal)
				.appendTo(this);
			}
		}
	});

	$('.resultat h2').tooltip({
		items: "[data-name]",
		content: function() {
			var element = $(this);
			if (element.is("[data-name]")) {
				var text = element.text();
				return "<div class='data'>" + $(this).attr('data-name') + "</div>";
			}
		},
		position: {
			my: "right-190 top+16",
			at: "right center"
		}
	});



	// Sélection départements
	function deleteSelection_DPT($item) {
		$item.fadeOut(function() {
			$item
			.appendTo(departements_drop)
			.fadeIn()
			.css('display','inline-block');
			checkSelection();
		});
	}

	function recycleSelection_DPT($item) {
		$item.fadeOut(function() {
			$item
			.appendTo(departements_selection)
			.fadeIn();
			checkSelection();
		});
	}

	departements_drop.droppable({
		accept: "departements_selection > li",
		drop: function( event, ui ) {
			deleteSelection_DPT(ui.draggable);
		}
	});

	departements_selection.droppable({
		accept: ".departements_drop > li",
		drop: function(event, ui) {
			recycleSelection_DPT(ui.draggable);
		}
	});

	// Sélection régions
	function deleteSelection_REG($item) {
		$item.fadeOut(function() {
			$item
			.appendTo(regions_drop)
			.fadeIn()
			.css('display','inline');
			checkSelection();
		});
	}

	function recycleSelection_REG($item) {
		$item.fadeOut(function() {
			$item
			.appendTo(regions_selection)
			.fadeIn();
			checkSelection();
		});
	}

	regions_drop.droppable({
		accept: "regions_selection > li",
		drop: function( event, ui ) {
			deleteSelection_REG(ui.draggable);
		}
	});

	regions_selection.droppable({
		accept: ".regions_drop > li",
		drop: function(event, ui) {
			recycleSelection_REG(ui.draggable);
		}
	});

	// Filtre associations
	function deleteSelection_typeAsso($item) {
		$item.fadeOut(function() {
			$item
			.appendTo(typeAsso_drop)
			.fadeIn()
			.css('display','inline-block');
			checkSelection();
		});
	}

	function recycleSelection_typeAsso($item) {
		$item.fadeOut(function() {
			$item
			.appendTo(typeAsso_selection)
			.fadeIn();
			checkSelection();
		});
	}

	typeAsso_drop.droppable({
		accept: "typeAsso_selection > li",
		drop: function(event, ui) {
			deleteSelection_typeAsso(ui.draggable);
		}
	});

	typeAsso_selection.droppable({
		accept: ".typeAsso_drop > li",
		drop: function(event, ui) {
			recycleSelection_typeAsso(ui.draggable);
		}
	});

	// Filtre établissements
	function deleteSelection_typeEtab($item) {
		$item.fadeOut(function() {
			$item
			.appendTo(typeEtab_drop)
			.fadeIn()
			.css('display','inline-block');
			checkSelection();
		});
	}

	function recycleSelection_typeEtab($item) {
		$item.fadeOut(function() {
			$item
			.appendTo(typeEtab_selection)
			.fadeIn();
			checkSelection();
		});
	}

	typeEtab_drop.droppable({
		accept: "typeEtab_selection > li",
		drop: function(event, ui) {
			deleteSelection_typeEtab(ui.draggable);
		}
	});

	typeEtab_selection.droppable({
		accept: ".typeEtab_drop > li",
		drop: function(event, ui) {
			recycleSelection_typeEtab(ui.draggable);
		}
	});

	// Filtre activités
	function deleteSelection_typeActivite($item) {
		$item.fadeOut(function() {
			$item
			.appendTo(typeActivite_drop)
			.fadeIn()
			.css('display','inline-block');
			checkSelection();
		});
	}

	function recycleSelection_typeActivite($item) {
		$item.fadeOut(function() {
			$item
			.appendTo(typeActivite_selection)
			.fadeIn();
			checkSelection();
		});
	}

	typeActivite_drop.droppable({
		accept: "typeActivite_selection > li",
		drop: function(event, ui) {
			deleteSelection(ui.draggable);
		}
	});

	typeActivite_selection.droppable({
		accept: ".typeActivite_drop > li",
		drop: function(event, ui) {
			recycleSelection(ui.draggable);
		}
	});

	// Filtre age
	function deleteSelection_typeAge($item) {
		$item.fadeOut(function() {
			$item
			.appendTo(typeAge_drop)
			.fadeIn()
			.css('display','inline-block');
			checkSelection();
		});
	}

	function recycleSelection_typeAge($item) {
		$item.fadeOut(function() {
			$item
			.appendTo(typeAge_selection)
			.fadeIn();
			checkSelection();
		});
	}

	typeAge_drop.droppable({
		accept: "typeAge_selection > li",
		drop: function(event, ui) {
			deleteSelection(ui.draggable);
		}
	});

	typeAge_selection.droppable({
		accept: ".typeAge_drop > li",
		drop: function(event, ui) {
			recycleSelection(ui.draggable);
		}
	});

	$(".recherche_avancee li").click(function(event) {
		var $item = $(this);
		$target = $(event.target);
		if ($target.is(".departements_selection li")) {
			deleteSelection_DPT($item);
		} else if ($target.is(".departements_drop li")) {
			recycleSelection_DPT($item);
		} else if ($target.is(".regions_selection li")) {
			deleteSelection_REG($item);
		} else if ($target.is(".regions_drop li")) {
			recycleSelection_REG($item);
		} else if ($target.is(".typeAsso_selection li")) {
			deleteSelection_typeAsso($item);
		} else if ($target.is(".typeAsso_drop li")) {
			recycleSelection_typeAsso($item);
		} else if ($target.is(".typeEtab_selection li")) {
			deleteSelection_typeEtab($item);
		} else if ($target.is(".typeEtab_drop li")) {
			recycleSelection_typeEtab($item);
		} else if ($target.is(".typeActivite_selection li")) {
			deleteSelection_typeActivite($item);
		} else if ($target.is(".typeActivite_drop li")) {
			recycleSelection_typeActivite($item);
		} else if ($target.is(".typeAge_selection li")) {
			deleteSelection_typeAge($item);
		} else if ($target.is(".typeAge_drop li")) {
			recycleSelection_typeAge($item);
		}
		return false;
	});

	$(".popincarte").fancybox({
		fitToView:false,
		width:'100%',
		height:'100%',
		autoSize:false,
		closeClick:false,
		padding:0,
		openEffect:'none'
	});

	$(".permalien").fancybox({
		fitToView:false,
		width:'50%',
		height:'auto',
		autoSize:false,
		closeClick:false,
		padding:0,
		openEffect:'none'
	});

	function maPosition(position) {
  		var infopos = position.coords.latitude + ", " + position.coords.longitude;
  		$('#champ_localisation, #champ_localisation_etendu').val(infopos);
  		$('#champ_localisation').prev('label').hide();
	}

	$('.header').click(function() {
		$('.choix').removeClass('on');
		$(this).parents('.choix').addClass('on');
  	});

	if(navigator.geolocation) {
		$('.localisation .header, .recherche_avancee').click(function() {
			navigator.geolocation.getCurrentPosition(maPosition);
  		});
  	}
  	else {
  		$('.localisation').hide();
  	}

  	var loadingIndicator = $('<img/>')
  		.attr({'src':'./assets/images/loading.gif','alt':'Chargement en cours. Veuillez patienter.'})
  		.addClass('wait')
  		.appendTo('body');

  	$('.wait').css({'top':($(window).height()/2)-20, 'left':($(window).width()/2)-20});

  	loadingIndicator.remove();
});
