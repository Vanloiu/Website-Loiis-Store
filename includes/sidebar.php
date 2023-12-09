<div class="panel panel-default sidebar-menu"> <!-- panel panel-default sidebar-menu Begin -->
  <div class="panel-heading"> <!-- panel-heading Begin -->
    <h3 class="panel-title">Lọc sản phẩm
    </h3>
    <h3 class="panel-title">+ Theo Danh mục 
    </h3>
  </div> <!-- panel-heading Finish -->

  <div class="panel-body"> <!-- panel-body Begin -->

    <ul class="nav nav-pills nav-stacked category-menu">
      
      <?php 
      
        getPCategories();

      ?>

    </ul>

  </div> <!-- panel-body Finish -->
</div> <!-- panel panel-default sidebar-menu Finish -->

<div class="panel panel-default sidebar-menu"> <!-- panel panel-default sidebar-menu Begin -->
  <div class="panel-heading"> <!-- panel-heading Negin -->
    <h3 class="panel-title">+ Theo Giới tính</h3>
  </div> <!-- panel-heading Finish -->

  <div class="panel-body"> <!-- panel-body Begin -->

    <ul class="nav nav-pills nav-stacked category-menu">

      <?php 

        getCategories();
      
      ?>

    </ul>

  </div> <!-- panel-body Finish -->
</div> <!-- panel panel-default sidebar-menu Finish -->