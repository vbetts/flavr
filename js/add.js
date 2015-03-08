//Populate dropboxes with values from the database
$(document).ready(function () {
	var addPlaceholder = 'Key Ingredients';
	$.getJSON('../backend/listboxes.php?getlist=ingredients', {}, function (data) {
		populateSelect(data, $('select#ingredSelect1').get(0), addPlaceholder);
		populateSelect(data, $('select#ingredSelect2').get(0), addPlaceholder);
		populateSelect(data, $('select#ingredSelect3').get(0), addPlaceholder);
		populateSelect(data, $('select#ingredSelect4').get(0), addPlaceholder);
	});
});

$( "#addNewRecipe" ).submit(function( event ) {
	event.preventDefault();
	var $form = $( this );
	var categories = [];
	$("#addCategories input:checked").each(function() {
		categories.push($(this).attr('id'));
	});
	var request = { 
		name: $form.find( "#recipeTitle" ).val(),
		description: $form.find( "#recipeText" ).val(),
		ingred1: $form.find("#ingredSelect1").val(),
		ingred2: $form.find("#ingredSelect2").val(),
		ingred3: $form.find("#ingredSelect3").val(),
		ingred4: $form.find("#ingredSelect4").val(),
		categories: categories
		};
		$.post("../backend/add.php", request, function(response){}, "json");
	});

$( "#addNewIngred" ).submit(function( event ) {
	event.preventDefault();
	var $form = $( this );
	var request = { 
		ingredient: $form.find( "#recipeIngred" ).val()
		};
		$.post("../backend/addNewIngredient.php", request, function(response){}, "json");
	});

