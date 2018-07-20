
  // Or with jQuery

  $(document).ready(function(){
    $('.collapsible').collapsible();
  });

  $(document).ready(function(){
     $('select').formSelect();
   });

   $(document).ready(function(){
    $('.datepicker').datepicker();
  });

  document.addEventListener('DOMContentLoaded', function() {
      var elems = document.querySelectorAll('.fixed-action-btn');
      var instances = M.FloatingActionButton.init(elems, {
        direction: 'up',
        hoverEnabled: false
      });
    });
