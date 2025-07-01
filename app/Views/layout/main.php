<?php include('header.php'); ?>
<?php include('sidebar.php'); ?>

<!-- Content Wrapper -->
<div class="content-wrapper">
  <!-- Content Header -->
  <div class="content-header">
    <div class="container-fluid">
      <h1 class="m-0"><?= $pageTitle ?? 'Dashboard' ?></h1>
    </div>
  </div>

  <!-- Main content -->
  <div class="content">
    <div class="container-fluid">
      <?= $this->renderSection('content') ?>
    </div>
  </div>
</div>

<?php include('footer.php'); ?>
