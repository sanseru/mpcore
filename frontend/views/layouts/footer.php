<footer class="main-footer">
    <strong>Copyright &copy; 2019-2020 <a href="http://medikaplaza.com">Medikaplaza</a>.</strong>
    All rights reserved.
    <div class="float-right d-none d-sm-inline-block">
      <b>Version</b> 1.0.0
    </div>
  </footer>
<?php
$this->registerJs("
        
$('ul.pagination li').addClass('page-item');
$('ul.pagination li a').addClass('page-link');
$('ul.pagination li span').addClass('page-link');
  
");
?>