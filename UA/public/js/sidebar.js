$(document).ready(function() {

    $('#sidebar-toggle-btn').click(function() {

      $('#sidebar').css('left', $('#sidebar').css('left') === '0px' || $('#sidebar').css('left') === 'auto' ? '-280px' : '0px');
      $('#main').css('margin-left', $('#sidebar').css('left') === '0px' ? '0' : '280px');
      $('#sidebar-toggle-btn').html($('#sidebar').css('left') === '0px' ? '<i class="fa-solid fa-chevron-right"></i>' : '<i class="fa-solid fa-chevron-left"></i>');
    });

});