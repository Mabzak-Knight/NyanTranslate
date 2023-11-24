<!DOCTYPE html>
<html lang="en">
  <head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Penerjemah Ballon Manga</title>
    <!-- Google Fonts -->
    <link
      href="https://fonts.googleapis.com/css2?family=Rubik&display=swap"
      rel="stylesheet"
    />
    <!-- Cropper -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.5.13/cropper.min.js"></script>
    <link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.5.13/cropper.min.css"
    />
    <!-- Stylesheet -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <!--<link rel="stylesheet" href="style.css" />-->
    <link rel="stylesheet" href="./style.css" />
  </head>
  <body>

      <div class="navku fixed-top" id="navbar">
        <nav class="navbar navbar-expand-lg navbar-dark ">
          <a class="navbar-brand" href="#" style="color:white;"><b>Penerjemah Ballon Manga</b></a>
          <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>
          <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav">
              <li class="nav-item">
                <a class="nav-link" href="https://ruangilmudigital.com">Situs <span class="sr-only">(current)</span></a>
              </li>
              <li class="nav-item dropdown active">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                  Penerjemah
                </a>
                <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                  <a class="dropdown-item" href="index.php">Penerjemah Satu Text</a>
                  <a class="dropdown-item" href="mit.php">Penerjemah Satu Lembar (alfa)</a>
                  <div class="dropdown-divider"></div>
                  <a class="dropdown-item" href="final.php">Satu Halaman + Editor</a>
                </div>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="#">Dokumentasi</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="https://www.youtube.com/@ruangilmudigital7593">Youtube</a>
              </li>
            </ul>
          </div>
        </nav>
      </div>

    <div class="wrapper">

      <div class="row">
      <div class="container col-10">
        
        <div class="rounded border" style="min-height: 600px;">
          <div id="hint" class="text-info"  align="center"><br>Silahkan<br>Upload Gambar</div>
        <div class="image-container" align="center">
          <img id="image" />
        </div>
        </div>

         <div class="preview-container">
        <div class="rounded border" align="center" style="min-height: 700px;">
          <div id="hint2" class="text-info"  align="center"><br>Hasil<br>Terjemahan</div>
          <img id="preview-image2" />   
            <div id="result-container"></div> <!-- Wadah untuk menampilkan hasil dari server -->
        </div>  
          <!--<div class="rounded border mt-3 card-header" style="min-height: 50px;">
            <div id="result-container"></div>
          </div>
          -->     
        </div>

      </div>
      <div class="col-2">

    
        
        <input type="file" id="file" accept="image/*" />
      <label for="file">Upload Gambar</label>
      <div class="btns">

        <button style="padding: 12.5px; margin-bottom: 20px;" id="preview" class="hide">Ambil Gambar</button>
        <a class="btn btn-success" href="" id="download" class="hide">Download</a>
      </div>
      <hr>
      <div class="btns" >
        <form id="my-form">
         <select id='bhs' style="border-radius: 5px; padding: 8px; margin-bottom: 10px;" name="bahasa">
            <option selected value="id">Bahasa Indonesia</option>
            <option value="en">Bahasa Inggris</option>
            <!-- Tambahkan opsi bahasa lain sesuai kebutuhan -->
        </select>
          <button type="submit" id="tls" style="width:100%;">Terjemahkan Kalimat</button>
        <form id="my-form" enctype="multipart/form-data">
      </div>

      </div>
      </div>
      


      
    </div>
    <div style="color: white; margin-top: 880px; color: #ccc;" align="center"> Dibuat oleh Al Khoir, Di dukung @ruangilmuditial.com</div>
    <!-- Script -->
    <script type="text/javascript">

document.getElementById('tls').style.display = 'none';
document.getElementById('bhs').style.display = 'none';
document.getElementById('download').style.display = 'none';
document.getElementById('hint').style.display = 'block';
let fileInput = document.getElementById("file");
let image = document.getElementById("image");
let downloadButton = document.getElementById("download");
let aspectRatio = document.querySelectorAll(".aspect-ratio-button");
const previewButton = document.getElementById("preview");
const previewImage = document.getElementById("preview-image2");
const options = document.querySelector(".options");
const widthInput = document.getElementById("width-input");
const heightInput = document.getElementById("height-input");
let cropper = "";
let fileName = "";

fileInput.onchange = () => {
  previewImage.src = "";
document.getElementById('download').style.display = 'none';
  document.getElementById('tls').style.display = 'none';
document.getElementById('bhs').style.display = 'none';
document.getElementById('hint').style.display = 'none';

  //The FileReader object helps to read contents of file stored on the computer
  let reader = new FileReader();
  //readAsDataURL reads the content of input file
  reader.readAsDataURL(fileInput.files[0]);

  reader.onload = () => {
    image.setAttribute("src", reader.result);
    if (cropper) {
      cropper.destroy();
    }
document.getElementById('download').style.display = 'block';

    let imgElement2 = document.getElementById('image');
    let imgSrc2 = imgElement2.src;

     // Buat Blob dari Data URL
    const blob2 = dataURItoBlob(imgSrc2);

    // Buat URL untuk Blob
    const blobUrl2 = URL.createObjectURL(blob2);

    downloadButton.download = `cropped_${fileName}.png`;
    downloadButton.setAttribute("href", blobUrl2);
  };
  fileName = fileInput.files[0].name.split(".")[0];

  document.getElementById('tls').style.display = 'block';
  document.getElementById('bhs').style.display = 'block';
 

};



function dataURItoBlob(dataUrl) {
  const arr = dataUrl.split(',');
  const mime = arr[0].match(/:(.*?);/)[1];
  const bstr = atob(arr[1]);
  let n = bstr.length;
  const u8arr = new Uint8Array(n);

  while(n--) {
    u8arr[n] = bstr.charCodeAt(n);
  }

  return new Blob([u8arr], { type: mime });
}

window.onload = () => {
  options.classList.add("hide");
  previewButton.classList.add("hide");
  document.getElementById('tls').style.display = 'none';
document.getElementById('bhs').style.display = 'none';
document.getElementById('hint').style.display = 'block';
};

document.getElementById('my-form').addEventListener('submit', function(event) {
            event.preventDefault(); // Mencegah formulir dikirimkan secara default
            sendData();
 });

function sendData() {
    const formData = new FormData(document.getElementById('my-form'));
     // Mendapatkan tombol
    const button = document.getElementById('tls');
    document.getElementById('hint2').style.display = 'block';

    // Menonaktifkan tombol
    button.disabled = true;
    button.innerText = 'Sedang Proses...';

    let imgElement = document.getElementById('image');
    let imgSrc = imgElement.src;
     // Buat Blob dari Data URL
    const blob = dataURItoBlob(imgSrc);

    // Tambahkan hasil pemotongan sebagai file ke FormData
    formData.append('data', blob, 'cropped_image.png');

    fetch('/process_page', {
        method: 'POST',
        body: formData
    })
    .then(response => response.text())
    .then(data => {
        console.log(data);  // Hasil dari Colab
        imgElement.src = 'data:image/png;base64,' + data;  // Menggunakan base64 string sebagai src
        var previewImage = document.getElementById('preview-image2');
        previewImage.src = 'data:image/png;base64,' + data;
        image.src=imgSrc;
        var dn = document.getElementById('download');
        dn.href='data:image/png;base64,' + data;


        document.getElementById('hint2').style.display = 'none';

        // Mengaktifkan tombol kembali setelah respons diterima
        button.disabled = false;
        button.innerText = 'Terjemahkan Kalimat';
    });
}

    </script>
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
  </body>
</html>