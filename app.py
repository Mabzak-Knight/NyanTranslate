from flask import Flask, request, Response, send_from_directory,jsonify
from flask_cors import CORS
from penerjemah import save_and_translate,plance_text
from gogtrans import translate_japanese

import subprocess
import json
import unicodedata
import matplotlib.pyplot as plt
import matplotlib.image as mpimg

app = Flask(__name__)
CORS(app)

# Menentukan folder tempat file statis disimpan
app.static_folder = 'web'

@app.route("/process_data", methods=["POST"])
def process_data():
    data = request.files['data']  # Ambil data dari permintaan POST untuk text data = request.form['data']    
    bahasa = request.form['bahasa']  
    asal = request.form['asal']
    
     # Periksa apakah file memiliki nama
    if data.filename == '':
        return 'No selected file'
    
    print(f'project/{data.filename}')
    
    data.save(f'project/{data.filename}')
    img=f'project/{data.filename}'
    bjepang,lines = save_and_translate(img)  
    
    print(bjepang)
    #penerjemah disini
    if bahasa=='no':
     translated_text = bjepang
    else:
        print("Menerjemahkan..:")
        translated_text = translate_japanese(bjepang,bahasa,asal)
    
    
    terjemahan=str(translated_text)
    print(translated_text)
    
    # Proses data di sini
    keterangan ="Terjemahkan json ini ke bahasa indonesia, tanpa tanda petik di bagian nomor:"
    processed_data = {key: value.replace('［', '').replace('[', '').replace(']', '') for key, value in bjepang.items()}
    return jsonify({"processed_data": str(processed_data), "keterangan": keterangan,"lines": lines, "terjemahan": terjemahan})

#@app.route("/process_page", methods=["POST"])
#def process_page():
   # page = request.files['data']  # Ambil data dari permintaan POST untuk text data = request.form['data']
    #bahasa = request.form['bahasa']
     # Periksa apakah file memiliki nama
    #if page.filename == '':
        #return 'No selected file'

    #img = PIL.Image.open(page)
    #img.save('gambar.png')
    ##!python -m manga_translator -v --use-cuda --translator=google -l VIN -i gambar.png

    # Buka gambar
    ##imgku = PIL.Image.open('/content/manga-image-translator/result/final.png')

    # Konversi gambar ke format BytesIO
    #img_io = io.BytesIO()
    #imgku.save(img_io, format='PNG')
    #img_io.seek(0)
    #img_data = img_io.read()

    # Konversi gambar ke base64
    #base64_img = base64.b64encode(img_data).decode()

    # Kirim base64_img ke klien web

    #return Response(base64_img, mimetype='text/plain')

@app.route('/style.css')
def style():
    # Menjalankan PHP dan menangkap outputnya
    result = subprocess.run(['php', './web/style.php'], capture_output=True, text=True)

    # Mengembalikan output PHP sebagai respons dengan tipe konten "text/css"
    return Response(result.stdout, content_type='text/css')

@app.route('/')
def final():
     # Menjalankan PHP dan menangkap outputnya
    result = subprocess.run(['php', './web/final.php'], capture_output=True, text=True)

    # Mengembalikan output PHP sebagai respons
    return result.stdout

@app.route('/font/<path:filename>')
def font(filename):
    # Ganti 'web/font' dengan path sesuai dengan struktur folder Anda
    return send_from_directory('web/font/', filename)

if __name__ == "__main__":
    app.run(debug=True, use_reloader=False)
