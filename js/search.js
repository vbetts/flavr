//populate recipe title listbox from database
$(document).ready(function () {
  var addPlaceholder = 'Recipe Titles';
  $.getJSON('../backend/listboxes.php?getlist=titles', {}, function (data) {
    populateSelect(data, $('select#recipeTitles').get(0), addPlaceholder);
  });
});

//populate key ingredient listbox from database
$(document).ready(function () {
  var addPlaceholder = 'Existing Key Ingredients';
  $.getJSON('../backend/listboxes.php?getlist=ingredients', {}, function (data) {
    populateSelect(data, $('select#keyIngredSearch').get(0), addPlaceholder);
  });
});


//***********************************************************************************************

//Search by title
$( "#searchTitleForm" ).submit(function( event ) {

  // Stop form from submitting normally
  event.preventDefault();

  // Get some values from elements on the page:
  var $form = $( this ),
  titleId = $form.find( "#recipeTitles" ).val();
  $.getJSON('../backend/searchTitle.php?title='+titleId, {}, function (data) {
    showRecipes(data);
  });
  //});
});


//Search by Ingredient
$( "#searchIngForm" ).submit(function( event ) {

  // Stop form from submitting normally
  event.preventDefault();

  // Get some values from elements on the page:
  var $form = $( this ),
  ingredId = $form.find( "#keyIngredSearch" ).val();

  $.getJSON('../backend/searchIngredient.php?ingred='+ingredId, {}, function (data) {
    showRecipes(data);
  });
});

//Search by Category
$( "#searchCat" ).submit(function( event ) {
  // Stop form from submitting normally
  event.preventDefault();
  // Get values from elements on the page:
  var $form = $( this ),
  categories = [];
  $form.find('#checkCategories input:checked').each(function() {
    categories.push(this.name);
  });
  $.getJSON('../backend/searchCategories.php?categories='+categories, {}, function (data) {
    showRecipes(data);
  });
});

$("#clear").submit(function(event){
    // Stop form from submitting normally
  event.preventDefault();
  clearRecipes();
})

//Function to output recipe text
function clearRecipes(){
  $('#searchResult').html("");
};

function formatRecipe(recipe){
  var title = $('<h4>').text(recipe.name);
  var content = $('<pre>').text(recipe.rText);
  var container = $('<div>');
  container.append(title);
  container.append(content);

  return container;

};

function showRecipes(recipes){
  clearRecipes();
  console.log(recipes);

  for (var i = 0; i < recipes.length; i++) {
    $('#searchResult').append(formatRecipe(recipes[i]));
    console.log(recipes[i]);

  };

};


