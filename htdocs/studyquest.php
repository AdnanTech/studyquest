<!DOCTYPE html>

<!-- Navbar
============================================= -->	
<?php
  include 'navbar.php';
?>

<html lang="en-us">
<head>
<meta charset="utf-8">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>Unity WebGL Player | EAJT Sussex - Showcode</title>
<link rel="shortcut icon" href="TemplateData/favicon.ico">
<link rel="stylesheet" href="TemplateData/style.css">
<link rel="stylesheet" href="style/normalize.css">
<link rel="stylesheet" href="style/main.css">
<link rel="stylesheet" href="style/upgrade.css">
</head>
  <body>
  <div id="unity-fullscreen-button"></div>
    <div id="wrapper">
    <div class="unity-desktop">
      <canvas id="unity-canvas"></canvas>
      <div id="unity-loading-bar">
        <div id="unity-logo"></div>
        <div id="unity-progress-bar-empty">
          <div id="unity-progress-bar-full"></div>
        </div>
      </div>
    </div>
  </div>
    <script>
      var buildUrl = "Build";
      var loaderUrl = buildUrl + "/Development Build.loader.js";
      var config = {
        dataUrl: buildUrl + "/Development Build.data",
        frameworkUrl: buildUrl + "/Development Build.framework.js",
        codeUrl: buildUrl + "/Development Build.wasm",
        streamingAssetsUrl: "StreamingAssets",
        companyName: "DefaultCompany",
        productName: "EAJT Sussex - Showcode",
        productVersion: "1.0",
      };

      var container = document.querySelector("#unity-container");
      var canvas = document.querySelector("#unity-canvas");
      var loadingBar = document.querySelector("#unity-loading-bar");
      var progressBarFull = document.querySelector("#unity-progress-bar-full");
      var fullscreenButton = document.querySelector("#unity-fullscreen-button");
      var mobileWarning = document.querySelector("#unity-mobile-warning");

      if (/iPhone|iPad|iPod|Android/i.test(navigator.userAgent)) {
        container.className = "unity-mobile";
        config.devicePixelRatio = 1;
        mobileWarning.style.display = "block";
        setTimeout(() => {
          mobileWarning.style.display = "none";
        }, 5000);
      } else {
        canvas.style.width = "960px";
        canvas.style.height = "600px";
      }
      loadingBar.style.display = "block";

      var script = document.createElement("script");
      script.src = loaderUrl;
      script.onload = () => {
        createUnityInstance(canvas, config, (progress) => {
          progressBarFull.style.width = 100 * progress + "%";
        }).then((unityInstance) => {
          loadingBar.style.display = "none";
          fullscreenButton.onclick = () => {
            unityInstance.SetFullscreen(1);
          };
        }).catch((message) => {
          alert(message);
        });
      };
      document.body.appendChild(script);
    </script>
    
  </body>
</html>
