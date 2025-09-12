<!DOCTYPE html>
<html lang="en">
  <head>
    <meta name="viewport" content="width=1200, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
    <link rel="icon" href="font/logo.png" type="image/png">
    <title>NyanTranslate - Penerjemah Manga</title>
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
    <style>
      @font-face {
            font-family: 'SuperComic';
            src: url('font/Super Comic.ttf') format('truetype');
            /* Ganti path/to/your/custom-font.ttf dengan lokasi file font yang sebenarnya */
        }
      
      @font-face {
            font-family: 'NextSunday';
            src: url('font/Next Sunday.ttf') format('truetype');
            /* Ganti path/to/your/custom-font.ttf dengan lokasi file font yang sebenarnya */
        }
        body { min-width:1200px; overflow-x:auto; }
        /* Keep desktop layout on narrow screens */
        @media (max-width: 1199.98px) {
          .navbar .collapse { display:block !important; }
          .navbar-toggler { display:none !important; }
          .wrapper { min-width:1200px; }
        }
      @font-face {
            font-family: 'BaksoSapi';
            src: url('font/BaksoSapi.otf') format('truetype');
            /* Ganti path/to/your/custom-font.ttf dengan lokasi file font yang sebenarnya */
        }
        @font-face {
            font-family: 'crimes';
            src: url('font/crimes.ttf') format('truetype');
            /* Ganti path/to/your/custom-font.ttf dengan lokasi file font yang sebenarnya */
        }
        @font-face {
            font-family: 'Roboto';
            src: url('font/Roboto-Bold.ttf') format('truetype');
            /* Ganti path/to/your/custom-font.ttf dengan lokasi file font yang sebenarnya */
        }
        @font-face {
            font-family: 'zombie';
            src: url('font/zombie.ttf') format('truetype');
            /* Ganti path/to/your/custom-font.ttf dengan lokasi file font yang sebenarnya */
        }
        canvas #boxCanvas {
            position: absolute;
        }
        /* Right panel (sidebar) polish */
        .sidebar.card {
          border: 1px solid #e5e7eb;
          box-shadow: 0 1px 2px rgba(0,0,0,0.04);
        }
        .sidebar .card-body {
          padding: 16px;
        }
        .sidebar .form-label {
          font-size: 12px;
          color: #6b7280;
          margin-bottom: 6px;
        }
        .sidebar .form-control,
        .sidebar select {
          font-size: 14px;
        }
        .sidebar .btn {
          width: 100%;
        }
        .sidebar .btn + .btn { margin-top: 8px; }
        .sidebar .divider { margin: 12px 0; }
        .sticky-top { top: 76px; }
        /* Line item styling for clearer visualization */
        .line-item { background: #ffffff; border: 1px solid #e5e7eb; border-radius: 6px; }
        .line-item:hover { box-shadow: 0 2px 8px rgba(0,0,0,0.06); }
        .badge-key { background-color: #2563eb; }
        .mini-toolbar .btn { padding: .15rem .4rem; }
        .mini-toolbar select, .mini-toolbar input[type=number] { height: 30px; }
        .dialog-item { background: #f9fafb; border: 1px solid #e5e7eb; border-left: 4px solid #3b82f6; border-radius: 8px; }
        .dialog-item .header { display:flex; align-items:center; justify-content:space-between; margin-bottom:6px; }
        .num-badge { display:inline-flex; align-items:center; justify-content:center; width:22px; height:22px; border-radius:9999px; background:#3b82f6; color:#fff; font-size:12px; font-weight:700; }
        .src-text { color:#6b7280; font-size:12px; margin-left:8px; }
        
    </style>
  </head>
  <body>

  <div class="navku fixed-top" id="navbar">
    <nav class="navbar navbar-expand-lg navbar-dark ">
      <img src="font/logo.png" width="30" height="30" class="d-inline-block align-top mr-1  " alt="">  
      <a class="navbar-brand" href="#" style="color:white;"><b>NyanTranslate</b></a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav">
          <li class="nav-item">
            <a class="nav-link" href="https://ruangilmudigital.com">Situs <span class="sr-only">(current)</span></a>
          </li>
          <li class="nav-item active">
            <a class="nav-link" href="/">
              Penerjemah
            </a>
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
  
  <div class="wrapper" style="min-width:1200px;">
    <div class="row">
      <div class="container col-10">        
        <div class="rounded border" style="min-height: 600px;">

          <div id="hint" class="text-info"  align="center"><br>Silahkan<br>Upload Gambar</div>
            <div style="position: relative; min-width: 500px" class="image-container" align="center">
              <img  id="image" style="position:absolute; top: 0px; right: 20px; " />
              <canvas align="center" id="boxCanvas" style="position:absolute; top: 0px; right: 20px;"></canvas>
            </div>
          </div>

          <div class="preview-container">
            <div class="rounded border" style="min-height: 700px; max-height: 700px; "">
              <div id="accordion">
                <div class="card">
                  <div class="card-header" id="headingOne">
                    <h5 class="mb-0">
                      <button class="btn btn-link" data-toggle="collapse" style="text-decoration: none;" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                        Form Input <small style="text-decoration: none; color: silver;"> Edit text dialog menggunakan input text </small>
                      </button>
                    </h5>
                  </div>

                  <div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent="#accordion">
                    <div class="card-body" style="height:570px; overflow-y: scroll;">
                      <div id="form-container" style=""></div>
                    </div>
                  </div>  
                </div>

                <div class="card">
                  <div class="card-header" id="headingTwo">
                    <h5 class="mb-0">
                      <button class="btn btn-link collapsed" data-toggle="collapse" style="text-decoration: none;" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                        Json <small style="text-decoration: none; color: silver;"> Edit text dialog menggunakan format json </small>
                      </button>
                    </h5>
                  </div>
                  <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordion">
                    <div class="card-body" style="height:569px;overflow-y: scroll;">
                    <pre style=" background-color:silver; border-raduis:5px; padding:5px;"><code style="text-align:left;" id="result-container">Belum ada dialog</code></pre>
                    <button class="btn btn-primary" id="copy" onclick="copyCode()">Copy</button>
                    <textarea id="form-json" style="min-height: 200px;" class="form-control mt-4 mb-3" aria-label="With textarea" placeholder="Masukan terjemahan json di sini"></textarea>
                    <button id="activateListenerButton" class="btn btn-primary" onclick="kirimjson()">Kirim Json</button>
                    </div>
                  </div>
                </div>

              </div>

              <div>
                <img id="preview-image2" />  
              </div>          
              <!--<img id="preview-image2" /> -->  
            </div>     
          </div>
        </div>

        <div class="col-2">
          <div class="card sidebar sticky-top">
            <div class="card-body">
              <div class="form-group">
                <label class="form-label">Unggah Gambar</label>
                <input type="file" id="file" accept="image/*" class="form-control-file" />
                <label for="file" id="upg" class="btn btn-primary btn-block mt-2">Upload Gambar</label>
                <button id="preview" class="btn btn-outline-secondary btn-block hide">Ambil Gambar</button>
              </div>
              <hr class="divider">
              <div id="hide">
                <form id="my-form" enctype="multipart/form-data">
                  <div class="form-group mb-2">
                    <label id="hidej" for="bhsj" class="form-label">Pilih Bahasa</label>
                    <select id='bhsj' name="asal" class="form-control">
                      <option value="ja">Jepang</option>
                      <option value="zh-CN">Cina Mandarin</option>
                      <option value="zh-TW">Cina Tradisional</option>
                    </select>
                  </div>
                  <div class="form-group mb-2">
                    <label for="bhs" class="form-label">Terjemahkan ke</label>
                    <select id='bhs' name="bahasa" class="form-control">
                      <option value="no">Tidak ada</option>
                      <option value="ar">Arab</option>
                      <option value="cs">Ceska (Ceko)</option>
                      <option value="de">Jerman</option>
                      <option value="el">Yunani</option>
                      <option value="en">Bahasa Inggris</option>
                      <option value="es">Spanyol</option>
                      <option value="fr">Prancis</option>
                      <option value="he">Ibrani</option>
                      <option value="hi">Hindi</option>
                      <option value="hu">Hungaria</option>
                      <option value="id" selected>Bahasa Indonesia</option>
                      <option value="it">Italia</option>
                      <option value="ko">Korea</option>
                      <option value="ms">Malaysia</option>
                      <option value="nl">Belanda</option>
                      <option value="pl">Polandia</option>
                      <option value="pt">Portugis</option>
                      <option value="ro">Rumania</option>
                      <option value="ru">Rusia</option>
                      <option value="sv">Swedia</option>
                      <option value="th">Thailand</option>
                      <option value="tr">Turki</option>
                      <option value="vi">Vietnam</option>
                    </select>
                  </div>
                  <button class="btn btn-outline-primary" type="submit" id="tls">Terjemahkan</button>
                </form>
              </div>
              <div id="hide2" class="mt-3">
                <hr class="divider">
                <div class="form-group mb-2">
                  <label for="fontSelect" class="form-label">Pilih Font</label>
                  <select id="fontSelect" class="form-control">
                    <option style="font-family: Arial;" value="Arial">Arial</option>
                    <option style="font-family: Helvetica;" value="Helvetica">Helvetica</option>
                    <option style="font-family: Times New Roman;" value="Times New Roman">Times New Roman</option>
                    <option style="font-family: Courier New;" value="Courier New">Courier New</option>
                    <option style="font-family: Georgia;" value="Georgia">Georgia</option>
                    <option style="font-family: Verdana;" value="Verdana">Verdana</option>
                    <option style="font-family: Impact;" value="Impact">Impact</option>
                    <option style="font-family: SuperComic;" value="SuperComic">Super Comic</option>
                    <option style="font-family: NextSunday;" value="NextSunday">Next Sunday</option>
                    <option style="font-family: BaksoSapi;" value="BaksoSapi">Bakso Sapi</option>
                    <option style="font-family: Roboto;" value="Roboto">Roboto Bold</option>
                    <option style="font-family: crimes;" value="Crimes">Crimes</option>
                    <option style="font-family: zombie;" value="zombie">Zombie</option>
                  </select>
                </div>
                <div class="custom-control custom-switch mb-2">
                  <input checked type="checkbox" class="custom-control-input" id="toggleCheckbox" />
                  <label class="custom-control-label" for="toggleCheckbox">Show Label</label>
                </div>
                <hr class="divider">
                <label class="form-label">Unduh Gambar</label>
                <a class="btn btn-primary" href="" id="download">Download <small>(Low)</small></a>
                <a class="btn btn-success" href="" id="download2">Download <small>(Normal)</small></a>
              </div>
              <div class="mt-3">
                <a href="https://info.flagcounter.com/st5B"><img src="https://s11.flagcounter.com/count2/st5B/bg_FFFFFF/txt_000000/border_CCCCCC/columns_3/maxflags_6/viewers_0/labels_0/pageviews_1/flags_0/percent_0/" alt="Flag Counter" border="0"></a>
              </div>
              <button hidden type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModalCenter">Launch demo modal</button>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div style="color: white; margin-top: 880px; color: #ccc;" align="center"> Dibuat oleh @Al Khoir | <a href="https://github.com/Mabzak-Knight/NyanTranslate">Github</a> | <a target="_blank"  href="https://saweria.co/NyanTranslator">Donasi</a></div>
    <!-- Modal -->
    <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered"  role="document"  style="max-width: 1200px;">
        <div class="modal-content " style="width: 100%;">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLongTitle">Tampilan Penuh</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
              <canvas align="center" id="boxCanvas2" style=" top: 0px; right: 20px; border: 1px solid black; "></canvas>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="button" class="btn btn-primary">Save changes</button>
          </div>
        </div>
      </div>
    </div>

    <!-- Button trigger modal -->


<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Sedang memproses gambar..</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="row">
          <div class="col-3">
          <img src="font/logo.png" width="100" height="100" class="d-inline-block align-top mr-1  " alt="">
          </div>
          <div class="col-9">
            Jangan lupa <a target="_blank" href="https://saweria.co/NyanTranslator">DONASI</a> untuk developer supaya semangat update aplikasinya. informasi update aplikasi terbaru ada di <a href="https://github.com/Mabzak-Knight/NyanTranslate">Github</a>, lapor error juga bisa lewat Github
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

  </div>
    <!-- Script -->
    <script type="text/javascript">

document.getElementById('tls').style.display = 'none';
document.getElementById('hide').style.display = 'none';
document.getElementById('hide2').style.display = 'none';
document.getElementById('bhs').style.display = 'none';
document.getElementById('download').style.display = 'none';
document.getElementById('download2').style.display = 'none';
document.getElementById('hint').style.display = 'block';
let fileInput = document.getElementById("file");
let image = document.getElementById("image");
let downloadButton = document.getElementById("download");
let downloadButton2 = document.getElementById("download2");
let aspectRatio = document.querySelectorAll(".aspect-ratio-button");
let showLabel = true; // Default: Menampilkan label
const previewButton = document.getElementById("preview");
const previewImage = document.getElementById("preview-image2");
const options = document.querySelector(".options");
const widthInput = document.getElementById("width-input");
const heightInput = document.getElementById("height-input");
// Mendapatkan referensi elemen checkbox
const checkbox = document.getElementById('toggleCheckbox');
const fontSelect = document.getElementById('fontSelect');
// Mengubah status disabled menjadi true (disabled)
checkbox.disabled = true;
checkbox.checked =false;


function copyCode() {
        var resultContainer = document.getElementById('result-container');
        var range = document.createRange();
        range.selectNode(resultContainer);
        window.getSelection().removeAllRanges();
        window.getSelection().addRange(range);
        document.execCommand('copy');
        window.getSelection().removeAllRanges();
        var copyButtton = document.getElementById('copy');
        copyButtton.innerText ="Sudah di Copy";
    }

    function kirimjson(){
  var formTerjemahan = document.querySelector('.form-terjemahan');
  var textareaElement = document.getElementById('form-json');
  var codeElement = document.getElementById('result-container');  
  const boxCanvas = document.getElementById('boxCanvas');
  const boxCanvas2 = document.getElementById('boxCanvas2');


  // Memeriksa apakah elemen textarea ditemukan
  if (textareaElement) {
            // Mengambil nilai (data) dari textarea
            var jsonTextarea = textareaElement.value;
            var dataCode = codeElement.innerText;

            // Melakukan sesuatu dengan nilai textarea (misalnya menampilkannya di konsol)
            console.log("json:", dataCode);
            console.log("json input:", jsonTextarea);

            const jsonString3 = jsonTextarea;
            const validJsonString3 = jsonString3
              .replace(/([0-9]+)/g, '"$1"')
              .replace(/'/g, '')
              .replace(/"(\d+)"/g, '$1')
              .replace(/'([^']+)'/g, '"$1"')
              .replace(/(\w+)(?=:)/g, '"$1"');

        console.log("json edit:", validJsonString3);
              
        // Mengonversi string menjadi objek JSON
        const jsonObject2 = JSON.parse(validJsonString3);
        const jsonObject = JSON.parse(dataCode);

        


              // Membuat formulir HTML
        const form = document.createElement('form');        
        form.style.textAlign = 'left';
        form.className = 'form-group form-terjemahan m-3'; // Menambahkan kelas Bootstrap

        // Iterasi melalui elemen-elemen di dalam data.processed_data
        for (const key in jsonObject) {
          if (jsonObject.hasOwnProperty(key)) {
            const inputValue = jsonObject[key];
            const inputValue2 = jsonObject2[key];
            
            // input
            const inputElement = document.querySelector(`input[name="input_${key}"]`);

            // Menetapkan atribut dan nilai formulir
            //alert(inputValue2);
            inputElement.value = inputValue2;            

          }
        }
       
        }
        
}

function drawBoxes(boxCoordinates) {
    const imageElement = document.getElementById('image');
    const boxCanvas = document.getElementById('boxCanvas');
    const boxCanvas2 = document.getElementById('boxCanvas2');
    const ctx = boxCanvas.getContext('2d');
    const ctx2 = boxCanvas2.getContext('2d');
    const boxes = [];
    const boxes2 = [];

    
  const naturalWidth = imageElement.width*2;//naturalWidth;
  const naturalHeight = imageElement.height*2;//naturalHeight;
    

    const paddingX = 230; // Sesuaikan dengan nilai yang sesuai
    const paddingY = 340; // Sesuaikan dengan nilai yang sesuai
    const paddingX2 = 460; // Sesuaikan dengan nilai yang sesuai
    const paddingY2 = 680; // Sesuaikan dengan nilai yang sesuai
    
    console.log(naturalWidth+'x'+naturalHeight);

    // Set ukuran canvas besar sesuai dengan ukuran gambar
    boxCanvas2.width = naturalWidth;
    boxCanvas2.height = naturalHeight;

    
    // Gambar gambar ke kanvas dengan proporsi yang diubah
    ctx2.drawImage(imageElement, 0, 0, boxCanvas2.width, boxCanvas2.height);

    // Set ukuran canvas sesuai dengan ukuran gambar
    boxCanvas.width = imageElement.width;
    boxCanvas.height = imageElement.height;

    // Set ukuran gambar sesuai dengan ukuran canvas
    imageElement.width = boxCanvas.width;
    imageElement.height = boxCanvas.height;

          // Gambar gambar ke kanvas dengan proporsi yang diubah
     ctx.drawImage(imageElement, 0, 0, boxCanvas.width, boxCanvas.height);
       

    // Fungsi untuk mengecek apakah titik berada di dalam kotak
    function isPointInsideBox(x, y, box) {
        return x >= box.x && x <= box.x + box.width && y >= box.y && y <= box.y + box.height;
    }

    

    // Fungsi untuk menggambar kotak pada canvas
function drawBox(box) {
         
    ctx.strokeStyle = 'white';
    ctx.lineWidth = 2;
    ctx.fillStyle = 'white'; // Warna isi kotak putih
    ctx.strokeRect(box.x, box.y, box.width, box.height);
    ctx.fillRect(box.x, box.y, box.width, box.height);

    ctx.textAlign = 'center';

    // Mendapatkan nilai dari elemen input sesuai nama input
    const inputElement = document.querySelector(`input[name="input_${box.label}"]`);

    // default style
    let fontFamily = 'Arial';
    let fontSize = 12;
    let fontColor = '#000000';
    let isBold = false;
    let isItalic = false;
    let underline = false;
    let align = 'center';

    if (inputElement) {
        const inputValue = inputElement.value;

        // Ambil gaya per-baris jika ada
        const fontSel = document.getElementById(`style_font_${box.label}`) || document.getElementById('fontSelect');
        const sizeSel = document.getElementById(`style_size_${box.label}`);
        const colorSel = document.getElementById(`style_color_${box.label}`);
        const boldSel = document.getElementById(`style_b_${box.label}`);
        const italicSel = document.getElementById(`style_i_${box.label}`);
        const underlineSel = document.getElementById(`style_u_${box.label}`);
        const alignL = document.getElementById(`align_l_${box.label}`);
        const alignC = document.getElementById(`align_c_${box.label}`);
        const alignR = document.getElementById(`align_r_${box.label}`);

        fontFamily = fontSel && fontSel.value ? fontSel.value : fontFamily;
        fontSize = sizeSel && !isNaN(parseInt(sizeSel.value)) ? parseInt(sizeSel.value) : fontSize;
        fontColor = colorSel && colorSel.value ? colorSel.value : fontColor;
        isBold = !!(boldSel && boldSel.classList.contains('active'));
        isItalic = !!(italicSel && italicSel.classList.contains('active'));
        underline = !!(underlineSel && underlineSel.classList.contains('active'));
        if (alignL && alignL.classList.contains('active')) align = 'left';
        if (alignC && alignC.classList.contains('active')) align = 'center';
        if (alignR && alignR.classList.contains('active')) align = 'right';

        // Menetapkan gaya teks
        ctx.fillStyle = fontColor;
        ctx.font = `${isItalic ? 'italic ' : ''}${isBold ? 'bold ' : ''}${fontSize}px ${fontFamily}`;
        ctx.textBaseline = 'middle';
        ctx.textAlign = align;

        // Mengukur lebar teks (gunakan font yang sudah di-set)
        const textWidth = ctx.measureText(inputValue).width || 0;

        // Menghitung posisi teks di tengah-tengah kotak
        let textX = box.x + box.width / 2;
        if (align === 'left') textX = box.x + 4;
        if (align === 'right') textX = box.x + box.width - 4;
        let textY = box.y + Math.ceil(fontSize/2); // offset sesuai ukuran font

        // Memeriksa apakah teks terlalu panjang
        if (textWidth > box.width) {
            // Memecah teks menjadi beberapa baris
            const words = inputValue.split(' ');
            let line = '';
            const lineHeight = fontSize; // tinggi baris berdasar ukuran font

            for (let i = 0; i < words.length; i++) {
                const testLine = line + words[i] + ' ';
                const testWidth = ctx.measureText(testLine).width;

                if (testWidth > box.width && i > 0) {
                    ctx.fillText(line, textX, textY);
                    line = words[i] + ' ';
                    textY += lineHeight;
                } else {
                    line = testLine;
                }
            }

            // Gambar baris terakhir (jika ada)
            ctx.fillText(line, textX, textY);
            if (underline) {
                const width = ctx.measureText(line).width;
                let startX = textX - (align === 'center' ? width/2 : (align === 'right' ? width : 0));
                ctx.beginPath();
                ctx.moveTo(startX, textY + Math.ceil(fontSize/3));
                ctx.lineTo(startX + width, textY + Math.ceil(fontSize/3));
                ctx.lineWidth = Math.max(1, Math.floor(fontSize/12));
                ctx.strokeStyle = fontColor;
                ctx.stroke();
            }
        } else {
            // Gambar teks pada posisi yang dihitung jika tidak terlalu panjang
            ctx.fillText(inputValue, textX, textY);
            if (underline) {
                const width = ctx.measureText(inputValue).width;
                let startX = textX - (align === 'center' ? width/2 : (align === 'right' ? width : 0));
                ctx.beginPath();
                ctx.moveTo(startX, textY + Math.ceil(fontSize/3));
                ctx.lineTo(startX + width, textY + Math.ceil(fontSize/3));
                ctx.lineWidth = Math.max(1, Math.floor(fontSize/12));
                ctx.strokeStyle = fontColor;
                ctx.stroke();
            }
        }
    }

    showLabel= document.getElementById('toggleCheckbox').checked;

    if (showLabel) {      
        ctx.font = '12px Arial';
        ctx.fillStyle = 'red';
        ctx.fillText(box.label, box.x + box.width / 2, box.y - 6);
    }

     //------------------------------------------------------------------------------ ctx2

  ctx2.strokeStyle = 'white';
    ctx2.lineWidth = 4;
    ctx2.fillStyle = 'white'; // Warna isi kotak putih
    ctx2.strokeRect(box.x2, box.y2, box.width2, box.height2);
    ctx2.fillRect(box.x2, box.y2, box.width2, box.height2);
    
    // Terapkan gaya yang sama untuk kanvas ukuran besar
    ctx2.font = `${isItalic ? 'italic ' : ''}${isBold ? 'bold ' : ''}${fontSize*2}px ${fontFamily}`;

    ctx2.textAlign = 'center';

    if (inputElement) {
        const inputValue = inputElement.value;

        // Mengukur lebar teks setelah set font
        const textWidth = ctx2.measureText(inputValue).width || 0;


        //console.log(selectedFont.value);

         // Menetapkan gaya teks
        ctx2.fillStyle = fontColor;
        ctx2.textBaseline = 'middle';
        ctx2.textAlign = align;

        // Menghitung posisi teks di tengah-tengah kotak
        let textX = box.x2 + box.width2 / 2;
        if (align === 'left') textX = box.x2 + 8;
        if (align === 'right') textX = box.x2 + box.width2 - 8;
        let textY = box.y2 + Math.ceil((fontSize*2)/2);

        // Memeriksa apakah teks terlalu panjang
        if (textWidth > box.width2) {
            // Memecah teks menjadi beberapa baris
            const words = inputValue.split(' ');
            let line = '';
            const lineHeight = fontSize*2; // tinggi baris berdasar ukuran font

            for (let i = 0; i < words.length; i++) {
                const testLine = line + words[i] + ' ';
                const testWidth = ctx2.measureText(testLine).width;

                if (testWidth > box.width2 && i > 0) {
                    ctx2.fillText(line, textX, textY);
                    line = words[i] + ' ';
                    textY += lineHeight;
                } else {
                    line = testLine;
                }
            }

            // Gambar baris terakhir (jika ada)
            ctx2.fillText(line, textX, textY);
            if (underline) {
                const width = ctx2.measureText(line).width;
                let startX = textX - (align === 'center' ? width/2 : (align === 'right' ? width : 0));
                ctx2.beginPath();
                ctx2.moveTo(startX, textY + Math.ceil((fontSize*2)/3));
                ctx2.lineTo(startX + width, textY + Math.ceil((fontSize*2)/3));
                ctx2.lineWidth = Math.max(1, Math.floor((fontSize*2)/12));
                ctx2.strokeStyle = fontColor;
                ctx2.stroke();
            }
        } else {
            // Gambar teks pada posisi yang dihitung jika tidak terlalu panjang
            ctx2.fillText(inputValue, textX, textY);
            if (underline) {
                const width = ctx2.measureText(inputValue).width;
                let startX = textX - (align === 'center' ? width/2 : (align === 'right' ? width : 0));
                ctx2.beginPath();
                ctx2.moveTo(startX, textY + Math.ceil((fontSize*2)/3));
                ctx2.lineTo(startX + width, textY + Math.ceil((fontSize*2)/3));
                ctx2.lineWidth = Math.max(1, Math.floor((fontSize*2)/12));
                ctx2.strokeStyle = fontColor;
                ctx2.stroke();
            }
        }
    }
    
}

function drawBox2(box){
 
}


    // Membuat objek kotak dari koordinat
    boxCoordinates.forEach(coord => {
        const [label, x, y, width, height] = coord.split(' ').map(parseFloat);
        const initialX = (x * imageElement.width) - (paddingX * width);
        const initialY = (y * imageElement.height) - (paddingY * height);
        const initialX2 = (x * naturalWidth) - (paddingX2 * width);
        const initialY2 = (y * naturalHeight) - (paddingY2 * height);
        const box = { label, x: initialX, y: initialY, width: width * imageElement.width, height: height * imageElement.height, initialX, initialY,x2: initialX2, y2: initialY2, width2: width * naturalWidth, height2: height * naturalHeight, initialX2, initialY2  };
        boxes.push(box);
        drawBox(box);
        console.log(box);
        console.log(imageElement.width);
        console.log(naturalWidth);
    });

    let isDragging = false;
    let selectedBox = null;
    let offsetX, offsetY;

    // Menanggapi acara mousedown
    boxCanvas.addEventListener('mousedown', e => {
        const mouseX = e.clientX - boxCanvas.getBoundingClientRect().left;
        const mouseY = e.clientY - boxCanvas.getBoundingClientRect().top;

        // Mengecek apakah mousedown terjadi di dalam suatu kotak
        for (const box of boxes) {
            if (isPointInsideBox(mouseX, mouseY, box)) {
                isDragging = true;
                selectedBox = box;
                offsetX = mouseX - box.x;
                offsetY = mouseY - box.y;
                break;
            }
        }
    });

    // Menanggapi acara mousemove
    boxCanvas.addEventListener('mousemove', e => {
        if (isDragging) {
            const mouseX = e.clientX - boxCanvas.getBoundingClientRect().left;
            const mouseY = e.clientY - boxCanvas.getBoundingClientRect().top;

            // Memperbarui posisi kotak yang sedang di-drag
            selectedBox.x = mouseX - offsetX;
            selectedBox.y = mouseY - offsetY;
            // Memperbarui posisi kotak yang sedang di-drag
            selectedBox.x2 = (mouseX - offsetX) *2;
            selectedBox.y2 = (mouseY - offsetY) *2;

            // Bersihkan canvas
            ctx.clearRect(0, 0, boxCanvas.width, boxCanvas.height);
             // Gambar gambar ke kanvas dengan proporsi yang diubah
            ctx.drawImage(imageElement, 0, 0, boxCanvas.width, boxCanvas.height);

            
            // Bersihkan canvas ----------------------- canvas2
            ctx2.clearRect(0, 0, boxCanvas2.width, boxCanvas2.height);
             // Gambar gambar ke kanvas dengan proporsi yang diubah
            ctx2.drawImage(imageElement, 0, 0, naturalWidth, naturalHeight);

            // Gambar ulang semua kotak
            boxes.forEach(drawBox);
        }
    });

    // Menanggapi acara mouseup
    boxCanvas.addEventListener('mouseup', () => {
        isDragging = false;
        selectedBox = null;
    });

    function activateEventListener() {

      
            // Bersihkan canvas ----------------------- canvas2
            ctx2.clearRect(0, 0, boxCanvas2.width, boxCanvas2.height);
             // Gambar gambar ke kanvas dengan proporsi yang diubah
            ctx2.drawImage(imageElement, 0, 0, naturalWidth, naturalHeight);
        // Sembunyikan label
        ctx.clearRect(0, 0, boxCanvas.width, boxCanvas.height);
         // Gambar gambar ke kanvas dengan proporsi yang diubah
         ctx.drawImage(imageElement, 0, 0, boxCanvas.width, boxCanvas.height);
          // Gambar ulang semua kotak tanpa label
        boxes.forEach(drawBox);
}

    // Menambahkan event listener untuk setiap elemen input
    const inputElements = document.querySelectorAll('input[name^="input_"]');
    inputElements.forEach((inputElement) => {
        inputElement.addEventListener('input', handleInputChange);
    });

    

    // Mendapatkan referensi ke tombol
const activateButton = document.getElementById('activateListenerButton');
const fontSelect = document.getElementById('fontSelect');

// Menambahkan event listener ke tombol
activateButton.addEventListener('click', activateEventListener);

  // Menambahkan event listener untuk mendeteksi perubahan status checkbox
  checkbox.addEventListener('change', function () {
      // Mendapatkan status checkbox
      const isChecked = checkbox.checked;
      showLabel = isChecked;
      
            // Bersihkan canvas ----------------------- canvas2
            ctx2.clearRect(0, 0, boxCanvas2.width, boxCanvas2.height);
             // Gambar gambar ke kanvas dengan proporsi yang diubah
            ctx2.drawImage(imageElement, 0, 0, naturalWidth, naturalHeight);
        // Sembunyikan label
        ctx.clearRect(0, 0, boxCanvas.width, boxCanvas.height);
         // Gambar gambar ke kanvas dengan proporsi yang diubah
         ctx.drawImage(imageElement, 0, 0, boxCanvas.width, boxCanvas.height);
          // Gambar ulang semua kotak tanpa label
        boxes.forEach(drawBox);
  });

   // Menambahkan event listener untuk mendeteksi perubahan status checkbox
   fontSelect.addEventListener('change', function () {
      const newFont = fontSelect.value;
      // Sinkronkan ke semua select font per-baris agar mengikuti global
      document.querySelectorAll('select[id^="style_font_"]').forEach(function(sel){
          sel.value = newFont;
          try { sel.dispatchEvent(new Event('change')); } catch(e){
            var ev = document.createEvent('Event'); ev.initEvent('change', true, true); sel.dispatchEvent(ev);
          }
      });

      // Re-render canvas dengan font global
      ctx2.clearRect(0, 0, boxCanvas2.width, boxCanvas2.height);
      ctx2.drawImage(imageElement, 0, 0, naturalWidth, naturalHeight);
      ctx.clearRect(0, 0, boxCanvas.width, boxCanvas.height);
      ctx.drawImage(imageElement, 0, 0, boxCanvas.width, boxCanvas.height);
      boxes.forEach(drawBox);
  });

   // Fungsi untuk menangani perubahan pada input
   function handleInputChange() {
      
            // Bersihkan canvas ----------------------- canvas2
            ctx2.clearRect(0, 0, boxCanvas2.width, boxCanvas2.height);
             // Gambar gambar ke kanvas dengan proporsi yang diubah
            ctx2.drawImage(imageElement, 0, 0, naturalWidth, naturalHeight);
        // Bersihkan canvas
        ctx.clearRect(0, 0, boxCanvas.width, boxCanvas.height);
         // Gambar gambar ke kanvas dengan proporsi yang diubah
         ctx.drawImage(imageElement, 0, 0, boxCanvas.width, boxCanvas.height);

        // Gambar ulang semua kotak
        boxes.forEach(drawBox);
    }
    

   

    // Mengubah status disabled menjadi false (tidak disabled)
    checkbox.disabled = false;
}

function downloadMergedImage() {
    // Dapatkan elemen kanvas
    var canvas = document.getElementById('boxCanvas');

    // Dapatkan konteks kanvas
    var ctx = canvas.getContext('2d');

    // Buat kanvas baru dengan ukuran dua kali lipat
    var enlargedCanvas = document.createElement('canvas');
    enlargedCanvas.width = canvas.width * 2;
    enlargedCanvas.height = canvas.height * 2;
    var enlargedCtx = enlargedCanvas.getContext('2d');

    // Gambar gambar ke kanvas baru dengan ukuran dua kali lipat
    enlargedCtx.drawImage(canvas, 0, 0, canvas.width * 2, canvas.height * 2);

    // Dapatkan tautan gambar hasil gabungan dari kanvas baru
    var canvasDataURL = enlargedCanvas.toDataURL('image/png', 1.0);

    // Buat elemen tautan untuk mengunduh gambar
    var downloadLink = document.createElement('a');
    downloadLink.href = canvasDataURL;
    downloadLink.download = `${fileName}.png`;

    // Simulasikan klik pada tautan unduh
    downloadLink.click();
}

function downloadMergedImage2() {
  //alert("downlaod");
    // Dapatkan elemen kanvas
    var canvas2 = document.getElementById('boxCanvas2');
    // Dapatkan konteks kanvas
    var ctx2 = canvas2.getContext('2d');

    // Buat kanvas baru dengan ukuran dua kali lipat
    var enlargedCanvas = document.createElement('canvas');
    enlargedCanvas.width = canvas2.width;
    enlargedCanvas.height = canvas2.height;
    var enlargedCtx = enlargedCanvas.getContext('2d');

    // Gambar gambar ke kanvas baru dengan ukuran dua kali lipat
    enlargedCtx.drawImage(canvas2, 0, 0, canvas2.width, canvas2.height);

    // Dapatkan tautan gambar hasil gabungan dari kanvas baru
    var canvasDataURL = enlargedCanvas.toDataURL('image/png', 1.0);

    // Buat elemen tautan untuk mengunduh gambar
    var downloadLink = document.createElement('a');
    downloadLink.href = canvasDataURL;
    downloadLink.download = `${fileName}.png`;

    // Simulasikan klik pada tautan unduh
    downloadLink.click();
}


// Fungsi untuk menggambar teks pada canvas untuk setiap kotak
function drawBoxText(box) {

    //console.log(selectedFont).value;

    ctx.fillStyle = 'black';    
    var selectedFont = document.getElementById('fontSelect');
    ctx.font = '12px ' + selectedFont.value;
    ctx.textBaseline = 'middle';
    
    // Mendapatkan nilai dari elemen input sesuai nama input
    const inputElement = document.querySelector(`input[name="input_${box.label}"]`);

    if (inputElement) {
        const inputValue = inputElement.value;
        const textX = box.x + box.width / 2;
        let textY = box.y + 6; // Sesuaikan offset teks sesuai kebutuhan

        // Gambar teks pada posisi yang dihitung
        ctx.fillText(inputValue, textX, textY);
    }
}


let cropper = "";
let fileName = "";

fileInput.onchange = () => {
  previewImage.src = "";
document.getElementById('download').style.display = 'none';
document.getElementById('download2').style.display = 'none';
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
document.getElementById('download2').style.display = 'block';
document.getElementById('hide').style.display = 'block';
document.getElementById('hide2').style.display = 'block';
var st2 = document.getElementById('style-toolbar');
if (st2) { st2.style.display = 'none'; }

    let imgElement2 = document.getElementById('image');
    let imgSrc2 = imgElement2.src;
    
     // Buat Blob dari Data URL
    const blob2 = dataURItoBlob(imgSrc2);

    // Buat URL untuk Blob
    const blobUrl2 = URL.createObjectURL(blob2);

    //downloadButton.download = `terjemah_${fileName}.png`;
    downloadButton.setAttribute("href", '#');
    downloadButton2.setAttribute("href", '#');
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
var st = document.getElementById('style-toolbar');
if (st) { st.style.display = 'none'; }
};

document.getElementById('my-form').addEventListener('submit', function(event) {
            event.preventDefault(); // Mencegah formulir dikirimkan secara default
            $('#exampleModal').modal('show');
            sendData();
 });



function sendData() {
    const formData = new FormData(document.getElementById('my-form'));
     // Mendapatkan tombol
    const button = document.getElementById('tls');
    //document.getElementById('hint2').style.display = 'block';
    

    // Menonaktifkan tombol
    button.disabled = true;
    button.innerText = 'Sedang Proses...';

    let imgElement = document.getElementById('image');
    let imgSrc = imgElement.src;
     // Buat Blob dari Data URL
    const blob = dataURItoBlob(imgSrc);

    // Tambahkan hasil pemotongan sebagai file ke FormData
    formData.append('data', blob, `${fileName}.png`);

    fetch('/process_data', {
        method: 'POST',
        body: formData
    })
    .then(response => response.json())
    .then(data => {
        document.getElementById('upg').style.display = 'none';
        console.log(data.keterangan);
        console.log(data.processed_data);  // Hasil dari Colab
        console.log(data.lines);
        console.log(data.terjemahan);
        //imgElement.src = 'data:image/png;base64,' + data;  // Menggunakan base64 string sebagai src
        //var previewImage = document.getElementById('preview-image2');
        //previewImage.src = 'data:image/png;base64,' + data;
        //image.src=imgSrc;
        var dn = document.getElementById('download');
        var dn2 = document.getElementById('download2');
        dn.href='#';
        dn2.href='#';
        // Tambahkan atribut onclick
        dn.onclick = function() {
            // Panggil fungsi atau kode yang ingin Anda jalankan saat tombol diklik
            downloadMergedImage(); // Gantilah dengan fungsi atau kode yang sesuai
        };
        dn2.onclick = function() {
            // Panggil fungsi atau kode yang ingin Anda jalankan saat tombol diklik
            downloadMergedImage2(); // Gantilah dengan fungsi atau kode yang sesuai
        };
        

        // untuk bahasa jepang ---------------------
        const jsonString = data.processed_data;
        // Mengganti notasi kunci
        const validJsonString = jsonString
          .replace(/([0-9]+)/g, '"$1"')
          .replace(/'/g, '"');

        // Mengonversi string menjadi objek JSON
        const jsonObject = JSON.parse(validJsonString);

        
        document.getElementById('result-container').innerText = JSON.stringify(jsonObject, null, 2);

        // untuk terjemahannya ----------------
        const jsonString2 = data.terjemahan;
        // Mengganti notasi kunci
        const validJsonString2 = jsonString2
          .replace(/([0-9]+)/g, '"$1"') 
          .replace(/'/g, '"')  // Mengganti tanda kutip tunggal dengan tanda kutip ganda
          .replace(/"(\d+)"/g, '$1') 
          .replace(/'([^']+)'/g, '"$1"')
          .replace(/(\w+)(?=:)/g, '"$1"');

          //alert(validJsonString2);
          console.log("json edit:", validJsonString2);

        // Mengonversi string menjadi objek JSON
        const jsonObject2 = JSON.parse(validJsonString2);

        const formContainer = document.getElementById('form-container');

        var formTerjemahan = document.querySelector('.form-terjemahan');

        // Memeriksa apakah elemen "form-terjemahan" ada
        if (formTerjemahan) {
            formTerjemahan.remove();
        }

         // Membuat formulir HTML
        const form = document.createElement('form');        
        form.style.textAlign = 'left';
        form.className = 'form-group form-terjemahan m-3'; // Menambahkan kelas Bootstrap

        // Iterasi melalui elemen-elemen di dalam data.processed_data
        for (const key in jsonObject) {
          if (jsonObject.hasOwnProperty(key)) {
            const inputValue = jsonObject[key];
            const inputValue2 = jsonObject2[key];

            //label
            const labelElement = document.createElement('small');

            labelElement.for = `input_${key}`;
            labelElement.textContent = `${key}.${inputValue}`; // Ganti teks label sesuai kebutuhan Anda
            
            // Menambahkan label ke dalam elemen formulir
            const block = document.createElement('div');
            block.className = 'p-2 mb-2 dialog-item';
            const head = document.createElement('div');
            head.className = 'header';
            const num = document.createElement('span');
            num.className = 'num-badge';
            num.innerText = key;
            const src = document.createElement('span');
            src.className = 'src-text';
            src.innerText = inputValue;
            head.appendChild(num);
            head.appendChild(src);
            block.appendChild(head);
            
            // input
            const inputElement = document.createElement('input');

            // Menetapkan atribut dan nilai formulir
            inputElement.type = 'text';
            inputElement.name = `input_${key}`;
            inputElement.value = inputValue2;            
            inputElement.className = 'form-control mb-2 line-item';
            block.appendChild(inputElement);

            // Menambahkan inputElement ke dalam formulir
            form.appendChild(inputElement);

            // Toolbar kecil per-input (UI saja, belum ada fungsi)
            const perInputToolbar = document.createElement('div');
            perInputToolbar.className = 'd-flex align-items-center flex-wrap mini-toolbar';
            perInputToolbar.innerHTML = `
              <select id="style_font_${key}" class="form-control form-control-sm mr-2" style="max-width:180px;">
                <option style="font-family: Arial;" value="Arial">Arial</option>
                <option style="font-family: Helvetica;" value="Helvetica">Helvetica</option>
                <option style="font-family: 'Times New Roman';" value="Times New Roman">Times New Roman</option>
                <option style="font-family: 'Courier New';" value="Courier New">Courier New</option>
                <option style="font-family: Georgia;" value="Georgia">Georgia</option>
                <option style="font-family: Verdana;" value="Verdana">Verdana</option>
                <option style="font-family: Impact;" value="Impact">Impact</option>
                <option style="font-family: SuperComic;" value="SuperComic">Super Comic</option>
                <option style="font-family: NextSunday;" value="NextSunday">Next Sunday</option>
                <option style="font-family: BaksoSapi;" value="BaksoSapi">Bakso Sapi</option>
                <option style="font-family: Roboto;" value="Roboto">Roboto Bold</option>
                <option style="font-family: crimes;" value="Crimes">Crimes</option>
                <option style="font-family: zombie;" value="zombie">Zombie</option>
              </select>
              <input id="style_size_${key}" type="number" class="form-control form-control-sm mr-2" style="width:80px;" min="8" max="64" value="12" placeholder="Size">
              <input id="style_color_${key}" type="color" class="mr-2" value="#000000" style="width:40px;height:32px;">
              <div class="btn-group btn-group-sm mr-2" role="group" aria-label="Gaya teks">
                <button id="style_b_${key}" type="button" class="btn btn-light"><strong>B</strong></button>
                <button id="style_i_${key}" type="button" class="btn btn-light"><em>I</em></button>
                <button id="style_u_${key}" type="button" class="btn btn-light"><u>U</u></button>
              </div>
              <div class="btn-group btn-group-sm" role="group" aria-label="Perataan">
                <button id="align_l_${key}" type="button" class="btn btn-light" title="Rata Kiri">L</button>
                <button id="align_c_${key}" type="button" class="btn btn-light" title="Rata Tengah">C</button>
                <button id="align_r_${key}" type="button" class="btn btn-light" title="Rata Kanan">R</button>
              </div>`;
            block.appendChild(perInputToolbar);

            // Aktifkan kontrol untuk mempengaruhi textbox
            const fontSel = perInputToolbar.querySelector(`#style_font_${key}`);
            const sizeInp = perInputToolbar.querySelector(`#style_size_${key}`);
            const colorInp = perInputToolbar.querySelector(`#style_color_${key}`);
            const btnB = perInputToolbar.querySelector(`#style_b_${key}`);
            const btnI = perInputToolbar.querySelector(`#style_i_${key}`);
            const btnU = perInputToolbar.querySelector(`#style_u_${key}`);
            const btnL = perInputToolbar.querySelector(`#align_l_${key}`);
            const btnC = perInputToolbar.querySelector(`#align_c_${key}`);
            const btnR = perInputToolbar.querySelector(`#align_r_${key}`);

            const applyStylesToInput = () => {
              inputElement.style.fontFamily = fontSel.value;
              inputElement.style.fontSize = (parseInt(sizeInp.value) || 12) + 'px';
              inputElement.style.color = colorInp.value || '#000000';
              inputElement.style.fontWeight = btnB.classList.contains('active') ? '700' : '400';
              inputElement.style.fontStyle = btnI.classList.contains('active') ? 'italic' : 'normal';
              inputElement.style.textDecoration = btnU.classList.contains('active') ? 'underline' : 'none';
              if (btnL.classList.contains('active')) inputElement.style.textAlign = 'left';
              if (btnC.classList.contains('active')) inputElement.style.textAlign = 'center';
              if (btnR.classList.contains('active')) inputElement.style.textAlign = 'right';
              // Trigger re-render canvas: dispatch input event yang sudah di-listen oleh drawBoxes
              try {
                inputElement.dispatchEvent(new Event('input'));
              } catch (e) {
                // fallback untuk browser lama
                var evt = document.createEvent('Event');
                evt.initEvent('input', true, true);
                inputElement.dispatchEvent(evt);
              }
            };

            const toggleButton = (btn, groupExclusive=false) => {
              if (groupExclusive) {
                btn.parentElement.querySelectorAll('button').forEach(b=>{
                  b.classList.remove('active','btn-primary');
                  b.classList.add('btn-light');
                });
                btn.classList.add('active','btn-primary');
                btn.classList.remove('btn-light');
              } else {
                btn.classList.toggle('active');
                btn.classList.toggle('btn-primary');
                btn.classList.toggle('btn-light');
              }
              applyStylesToInput();
            };

            // Listeners
            fontSel.addEventListener('change', applyStylesToInput);
            sizeInp.addEventListener('input', applyStylesToInput);
            colorInp.addEventListener('input', applyStylesToInput);
            btnB.addEventListener('click', ()=>toggleButton(btnB));
            btnI.addEventListener('click', ()=>toggleButton(btnI));
            btnU.addEventListener('click', ()=>toggleButton(btnU));
            btnL.addEventListener('click', ()=>toggleButton(btnL, true));
            btnC.addEventListener('click', ()=>toggleButton(btnC, true));
            btnR.addEventListener('click', ()=>toggleButton(btnR, true));

            // Default align center active
            btnC.classList.add('active','btn-primary');
            btnC.classList.remove('btn-light');
            applyStylesToInput();

            form.appendChild(block);
          }
        }

       // Menambahkan formulir ke dalam elemen formContainer
        formContainer.appendChild(form);

        // Tampilkan toolbar gaya global setelah form input tersedia
        var st3 = document.getElementById('style-toolbar');
        if (st3) { st3.style.display = 'block'; }

        $('#exampleModal').modal('hide')
        
        drawBoxes(data.lines);

        //document.getElementById('hint2').style.display = 'none';

        // Mengaktifkan tombol kembali setelah respons diterima
        button.disabled = false;
        button.innerText = 'Terjemahkan';
    });
}

    </script>
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
  </body>
</html>