<html>

<head>
  <meta charset="UTF-8">
  <title>Login with Qrcode</title>
  <style>
    .sidebar {
      width: 350px;
      margin: auto;
      padding: 10px
    }

    .camera {
      width: 610px;
      margin: auto;
    }
  </style>
  <script
    src="<?= base_url('/'); ?>/js/jquery-3.4.1.min.js">
  </script>
  <!-- scanner -->
  <script
    src="<?= base_url('/'); ?>/scanner/vendor/modernizr/modernizr.js">
  </script>
  <script
    src="<?= base_url('/'); ?>/scanner/vendor/vue/vue.min.js">
  </script>
</head>

<body>

  <!-- scan -->
  <div id="app" class="row box">
    <div class="col-md-4 col-md-offset-4 sidebar">
      <ul>
        <li v-if="cameras.length === 0" class="empty">No cameras found</li>
        <li v-for="camera in cameras">
          <span v-if="camera.id == activeCameraId" :title="formatName(camera.name)" class="active"><input type="radio"
              class="align-middle mr-1" checked> {{ formatName(camera.name) }}</span>
          <span v-if="camera.id != activeCameraId" :title="formatName(camera.name)">
            <a @click.stop="selectCamera(camera)"> <input type="radio" class="align-middle mr-1">@{{
              formatName(camera.name) }}</a>
          </span>
        </li>
      </ul>
      <div class="clearfix"></div>
      <!-- form scan -->
      <form
        action="<?= base_url('/dashboard/result-scanner'); ?>"
        method="POST" id="myForm">
        <fieldset class="scheduler-border">
          <legend class="scheduler-border"> Form Scan </legend>
          <input type="text" name="qrcode" id="code" autofocus>
        </fieldset>
      </form>
    </div>
    <div class="col-xs-12 preview-container camera">
      <video id="preview" class="thumbnail"></video>
    </div>
  </div>
  <?php if (!empty($resultscanner)) : ?>
  <h1><?php echo $resultscanner; ?>
  </h1>
  <?php endif; ?>
  <!-- scanner -->
  <script src="<?= base_url('/'); ?>/scanner/js/app.js">
  </script>
  <script
    src="<?= base_url('/'); ?>/scanner/vendor/instascan/instascan.min.js">
  </script>
  <script src="<?= base_url('/'); ?>/scanner/js/scanner.js">
  </script>
</body>