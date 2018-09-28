    <!-- js placed at the end of the document so the pages load faster -->
    <script src="<?php echo BASE_PATH?>admin/js/jquery.js"></script>
    <script src="<?php echo BASE_PATH?>admin/js/jquery-1.8.3.min.js"></script>
    <script src="<?php echo BASE_PATH?>admin/js/bootstrap.min.js"></script>
    <script class="include" type="text/javascript" src="<?php echo BASE_PATH?>admin/js/jquery.dcjqaccordion.2.7.js"></script>
    <script src="<?php echo BASE_PATH?>admin/js/jquery.scrollTo.min.js"></script>
    <script src="<?php echo BASE_PATH?>admin/js/jquery.nicescroll.js" type="text/javascript"></script>
    <script src="<?php echo BASE_PATH?>admin/js/jquery.sparkline.js" type="text/javascript"></script>
    <script src="<?php echo BASE_PATH?>admin/assets/jquery-easy-pie-chart/jquery.easy-pie-chart.js"></script>
    <script src="<?php echo BASE_PATH?>admin/js/owl.carousel.js" ></script>
    <script src="<?php echo BASE_PATH?>admin/js/jquery.customSelect.min.js" ></script>
    <script src="<?php echo BASE_PATH?>admin/js/respond.min.js" ></script>

    <script src="<?php echo BASE_PATH?>admin/js/clipboard.min.js" ></script>
    <script src="<?php echo BASE_PATH?>admin/js/jquery-ui-1.9.2.custom.min.js"></script>

    <!--common script for all pages-->
    <script src="<?php echo BASE_PATH?>admin/js/common-scripts.js"></script>

    <!--script for this page-->
    <script src="<?php echo BASE_PATH?>admin/js/easy-pie-chart.js"></script>
    <script src="<?php echo BASE_PATH?>admin/js/count.js"></script>

	<script type="text/javascript" src="<?php echo BASE_PATH?>admin/assets/data-tables/jquery.dataTables.js"></script>
    <script type="text/javascript" src="<?php echo BASE_PATH?>admin/assets/data-tables/DT_bootstrap.js"></script>
	
      <!--script for this page only-->
      <script src="<?php echo BASE_PATH?>admin/js/editable-table.js"></script>
  
      <script>
          jQuery(document).ready(function() {
              EditableTable.init();
          });
      </script>
  <script>

      //owl carousel

      $(document).ready(function() {
          $("#owl-demo").owlCarousel({
              navigation : true,
              slideSpeed : 300,
              paginationSpeed : 400,
              singleItem : true,
			  autoPlay:true

          });
      });

      //custom select box

      $(function(){
          $('select.styled').customSelect();
      });

  </script>
  </body>