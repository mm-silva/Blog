jQuery(document).ready(function($) {

  var tags = $('#tags').inputTags({
    tags: tags_here,
    autocomplete: {
      values: dados
    },
    init: function(elem) {
      $('span', '#events').text('init');
      $('<p class="results">').html('<strong>Tags:</p></strong> ' +  + elem.tags.join(' - ')).insertAfter(elem.$list);
    },
    create: function() {
      $('span', '#events').text('create');
    },
    update: function() {
      $('span', '#events').text('update');
    },
    destroy: function() {
      $('span', '#events').text('destroy');
    },
    selected: function() {
      $('span', '#events').text('selected');
    },
    unselected: function() {
      $('span', '#events').text('unselected');
    },
    change: function(elem) {
      $('.results').empty().html('<p>press Enter after writing a new tag <strong>- Tags:</strong> </p>' + elem.tags.join(' - '));
    },
    autocompleteTagSelect: function(elem) {
      console.info('autocompleteTagSelect');
    }
  });

  $('#tags').inputTags('tags', function(tags) {
    $('.results').empty().html('<p>press Enter after writing a new tag <strong>- Tags:</strong></p> '  + tags.join(' - '));
  });

  var autocomplete = $('#tags').inputTags('options', 'autocomplete');
  $('span', '#autocomplete').text(autocomplete.values.join(', '));
});
