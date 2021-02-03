<html>
<head>
  <title>Instascan &ndash; QR Code Scanner</title>
  <link href="css/material.min.css" rel="stylesheet">
  <link href="css/style.css" rel="stylesheet">
  <link rel="icon" type="image/png" href="img/favicon.png">
  <script type="text/javascript" src="<?= base_url('/') ?>/instascan/app/public/js/jquery-3.0.0.min.js"></script>
  <script type="text/javascript" src="<?= base_url('/') ?>/instascan/app/public/js/zxing.js"></script>
  <script type="text/javascript" src="<?= base_url('/') ?>/instascan/app/public/js/camera.js"></script>
  <script type="text/javascript" src="<?= base_url('/') ?>/instascan/app/public/js/qr.js"></script>
  <script type="text/javascript" src="<?= base_url('/') ?>/instascan/app/public/js/material.min.js"></script>
  <script type="text/javascript" src="<?= base_url('/') ?>/instascan/app/public/js/clipboard.min.js"></script>
  <script type="text/javascript" src="<?= base_url('/') ?>/instascan/app/public/js/store.min.js"></script>
  <script type="text/javascript" src="<?= base_url('/') ?>/instascan/app/public/js/visibility.min.js"></script>
  <script type="text/javascript" src="<?= base_url('/') ?>/instascan/app/public/js/FileSaver.min.js"></script>
  <script type="text/javascript" src="<?= base_url('/') ?>/instascan/app/public/js/vue.min.js"></script>
</head>
<body id="app">
  <nav class="menu" id="history-menu">
    <div class="menu-scroll">
      <div class="menu-content">
        <div class="menu-logo">
          <div class="title">History</div>
          <div class="fbtn-inner">
            <a class="fbtn fbtn-md waves-attach waves-circle" data-toggle="dropdown">
              <span class="icon icon-lg">more_horiz</span>
            </a>
            <div class="fbtn-dropdown">
              <a @click="downloadHistory()" class="fbtn fbtn-brand waves-attach waves-circle">
                <span class="fbtn-text fbtn-text-left">Download as JSON</span>
                <span class="icon icon-lg">file_download</span>
              </a>
              <a @click="clearHistory()" class="fbtn fbtn-red waves-attach waves-circle">
                <span class="fbtn-text fbtn-text-left">Clear History</span>
                <span class="icon icon-lg">delete</span>
              </a>
            </div>
          </div>
        </div>
        <div class="container" v-if="!scans.length">
          <p>No scan history</p>
        </div>
        <div class="tile-wrap">
          <div v-for="scan in scans | orderBy 'date' -1" class="tile">
            <div class="tile-action">
              <ul class="nav nav-list margin-no pull-right">
                <li>
                  <a class="text-black-sec waves-attach waves-effect clipboard-copy" data-clipboard="{{ scan.content }}">
                    <span class="icon icon-md">content_copy</span>
                  </a>
                </li>
                <li>
                  <a class="text-black-sec waves-attach waves-effect" @click="deleteScan(scan)">
                    <span class="icon icon-md">clear</span>
                  </a>
                </li>
              </ul>
            </div>
            <div class="tile-inner">
              <a v-if="isHttpUrl(scan.content)" href="{{scan.content}}" target="_blank" class="text-overflow">
                {{ scan.content }}
              </a>
              <span v-else class="text-overflow">{{ scan.content }}</span>
            </div>
          </div>
        </div>
      </div>
    </div>
  </nav>
  <nav class="menu menu-right menu-lg" id="settings-menu">
    <div class="menu-scroll">
      <div class="menu-content">
        <span class="menu-logo">Settings</span>
        <div class="container">
          <h4>Camera</h4>
          <form>
            <fieldset>
              <div class="form-group">
                <div v-for="camera in cameras" class="radiobtn radiobtn-adv">
                  <label for="camera-{{$index}}">
                    <input class="access-hide" id="camera-{{$index}}" name="activeCamera" type="radio" :value="camera" v-model="activeCamera">
                    {{ camera.name }}
                    <span class="radiobtn-circle"></span><span class="radiobtn-circle-check"></span>
                  </label>
                </div>
              </div>
            </fieldset>
          </form>
          <h4>After scanning</h4>
          <form>
            <fieldset>
              <div class="form-group">
                <div class="checkbox switch">
                  <label for="play-audio">
                    <input class="access-hide" id="play-audio" name="play-audio" type="checkbox" v-model="playAudio"><span class="switch-toggle"></span>
                    Play a sound
                  </label>
                </div>
                <div class="checkbox switch">
                  <label for="http-action">
                    <input class="access-hide" id="http-action" name="http-action" type="checkbox" v-model="httpAction.enabled"><span class="switch-toggle"></span>
                    POST to a URL
                  </label>
                  <span v-if="httpAction.enabled">&ndash; <a @click="editHttpAction()">Edit</a></span>
                </div>
              </div>
            </fieldset>
          </form>
          <h4>After scanning a link</h4>
          <form>
            <fieldset>
              <div class="form-group">
                <div class="radiobtn radiobtn-adv">
                  <label for="link-none">
                    <input class="access-hide" id="link-none" name="link" type="radio" value="none" v-model="linkAction">
                    Do nothing
                    <span class="radiobtn-circle"></span><span class="radiobtn-circle-check"></span>
                  </label>
                </div>
                <div class="radiobtn radiobtn-adv">
                  <label for="link-new-tab">
                    <input class="access-hide" id="link-new-tab" name="link" type="radio" value="new-tab" v-model="linkAction">
                    Open in new tab
                    <span class="radiobtn-circle"></span><span class="radiobtn-circle-check"></span>
                  </label>
                </div>
                <div class="radiobtn radiobtn-adv">
                  <label for="link-current-tab">
                    <input class="access-hide" id="link-current-tab" name="link" type="radio" value="current-tab" v-model="linkAction">
                    Open in current tab
                    <span class="radiobtn-circle"></span><span class="radiobtn-circle-check"></span>
                  </label>
                </div>
              </div>
            </fieldset>
          </form>
          <h4>Advanced</h4>
          <form>
            <fieldset>
              <div class="form-group">
                <div class="checkbox switch">
                  <label for="background-scan">
                    <input class="access-hide" id="background-scan" name="background-scan" type="checkbox" v-model="allowBackgroundScan"><span class="switch-toggle"></span>
                    Scan even when tab is not focused
                  </label>
                </div>
              </div>
            </fieldset>
          </form>
          <h4>Transforms</h4>
          <form>
            <fieldset>
              <div class="tile-wrap">
                <div class="tile">
                  <div class="tile-inner">
                    <a data-backdrop="static" data-toggle="modal" href="#transform-dialog" @click="showTransformDialog('', '')">
                      Add a transform
                    </a>
                  </div>
                </div>
                <div v-if="!transforms.length" class="tile">
                  <div class="tile-inner">
                    No transforms defined
                  </div>
                </div>
                <div v-for="transform in transforms" class="tile transform-tile">
                  <div class="tile-action">
                    <ul class="nav nav-list margin-no pull-right">
                      <li>
                        <a data-backdrop="static" data-toggle="modal" href="#transform-dialog" class="text-black-sec waves-attach waves-effect" @click="showTransformDialog(transform.pattern, transform.output)">
                          <span class="icon icon-md">mode_edit</span>
                        </a>
                      </li>
                      <li>
                        <a class="text-black-sec waves-attach waves-effect" @click="deleteTransform($index)">
                          <span class="icon icon-md">clear</span>
                        </a>
                      </li>
                    </ul>
                  </div>
                  <div class="tile-inner">
                    <div class="checkbox checkbox-adv">
                      <label for="transform-{{$index}}">
                        <input class="access-hide" id="transform-{{$index}}" name="transform-{{$index}}" type="checkbox" v-model="transform.enabled"><span class="text-overflow">
                          /{{ transform.pattern }}/ → {{ transform.output }}
                        </span>
                        <span class="checkbox-circle"></span><span class="checkbox-circle-check"></span><span class="checkbox-circle-icon icon">done</span>
                      </label>
                    </div>
                  </div>
                </div>
              </div>
            </fieldset>
          </form>
        </div>
      </div>
    </div>
  </nav>
  <div aria-hidden="true" class="modal modal-va-middle fade" id="transform-dialog" role="dialog" tabindex="-1">
    <div class="modal-dialog modal-xs">
      <div class="modal-content">
        <div class="modal-heading">
          <p class="modal-title">Add a Transform</p>
        </div>
        <div class="modal-inner">
          <form>
            <fieldset>
              <p>Transforms allow you to change the content of the scan before further processing by using JavaScript's <a href="https://developer.mozilla.org/en-US/docs/Web/JavaScript/Reference/Global_Objects/String/replace" target="_blank">String.replace</a>.</p>
              <p>The input pattern is any valid <a href="https://developer.mozilla.org/en-US/docs/Web/JavaScript/Guide/Regular_Expressions" target="_blank">JavaScript regular expression</a>. Delimiters, i.e. leading and trailing <span class="code">/</span>, are not needed.</p>
              <p>The output can use <span class="code">$&amp;</span> for the entire matched expression, <span class="code">$1</span> for the first capture group, <span class="code">$2</span> for the second capture group, etc.</p>
              <div class="form-group form-group-label">
                <label class="floating-label" for="pattern">Input pattern (regular expression)</label>
                <input class="form-control" id="pattern" type="text" v-model="currentTransform.pattern">
              </div>
              <div class="form-group form-group-label">
                <label class="floating-label" for="output">Output transformation</label>
                <input class="form-control" id="output" type="text" v-model="currentTransform.output">
              </div>
            </fieldset>
          </form>
        </div>
        <div class="modal-footer">
          <p class="text-right">
            <a class="btn btn-flat btn-brand-accent waves-attach" data-dismiss="modal">Cancel</a>
            <a @click="addTransform()" class="btn btn-flat btn-brand-accent waves-attach" data-dismiss="modal">OK</a>
          </p>
        </div>
      </div>
    </div>
  </div>
  <div aria-hidden="true" class="modal modal-va-middle fade" id="http-action-dialog" role="dialog" tabindex="-1">
    <div class="modal-dialog modal-xs">
      <div class="modal-content">
        <div class="modal-heading">
          <p class="modal-title">POST Scanned Content to a URL</p>
        </div>
        <div class="modal-inner">
          <form>
            <fieldset>
              <p>Scanned content and image data (<span class="code">image/webp</span> data URI) will be sent to the URL specified below.</p>
              <p>If the URL is on another domain, it needs to have <a href="https://developer.mozilla.org/en-US/docs/Web/HTTP/Access_control_CORS" target="_blank">CORS enabled</a> to POST from the current domain.</p>
              <div class="form-group form-group-label">
                <label class="floating-label" for="url">URL Endpoint</label>
                <input class="form-control" id="url" type="text" v-model="currentHttpAction.url">
              </div>
              <div class="row">
                <div class="col-xs-6">
                  <div class="form-group form-group-label">
                    <label class="floating-label" for="headerName">Optional header name</label>
                    <input class="form-control" id="headerName" type="text" v-model="currentHttpAction.headers[0].name">
                  </div>
                </div>
                <div class="col-xs-6">
                  <div class="form-group form-group-label">
                    <label class="floating-label" for="headerValue">Optional header value</label>
                    <input class="form-control" id="headerValue" type="text" v-model="currentHttpAction.headers[0].value">
                  </div>
                </div>
              </div>
              <div class="form-group">
                <div class="checkbox checkbox-adv">
                  <label for="post-image">
                    <input class="access-hide" id="post-image" name="post-image" type="checkbox" v-model="currentHttpAction.captureImage">
                    Include scanned image in payload
                    <span class="checkbox-circle"></span><span class="checkbox-circle-check"></span><span class="checkbox-circle-icon icon">done</span>
                  </label>
                </div>
              </div>
            </fieldset>
          </form>
        </div>
        <div class="modal-footer">
          <p class="text-right">
            <a class="btn btn-flat btn-brand-accent waves-attach" @click="cancelHttpActionDialog()">Cancel</a>
            <a class="btn btn-flat btn-brand-accent waves-attach" @click="acceptHttpActionDialog()">OK</a>
          </p>
        </div>
      </div>
    </div>
  </div>
  <div class="overlay">
    <a id="menu-button" class="fbtn fbtn-brand fbtn-lg waves-attach waves-circle" data-toggle="menu" href="#history-menu">
      <span class="icon icon-lg">history</span>
    </a>
    <a id="settings-button" class="fbtn fbtn-brand-accent fbtn-lg waves-attach waves-circle" data-toggle="menu" href="#settings-menu">
      <span class="icon icon-lg">settings</span>
    </a>
    <div id="camera"/>
  </div>
  <script type="text/javascript" src="<?= base_url('/') ?>/instascan/app/public/js/app.js"></script>
</body>
</html>
