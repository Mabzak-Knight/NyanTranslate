from penerjemah_manga.assets.ctd import model2annotations, model2annotation
from ocr.ocr import MangaOcr
from PIL import Image
from tqdm import tqdm

import os
import cv2
import PIL.Image
import json
import numpy as np

mocr = MangaOcr()

# Pengganti cv2_imshow di colab, klo mengunakan colab di hapus saja def ini
def cv2_imshow(img_file):

    # Tampilkan gambar menggunakan cv2.imshow
    cv2.imshow('Gambar', img_file)

    # Tunggu tombol keyboard ditekan dan tutup jendela setelah itu
    cv2.waitKey(0)
    cv2.destroyAllWindows()
    
# Definisikan fungsi untuk menggambar kotak pembatas
def draw_bounding_boxes(image, lines):
    cropped_images = []

    for line in lines:
        values = line.split(' ')
        x, y, width, height = map(float, values[1:])

        width_pixel = int(width * (image.shape[1])) + 20
        height_pixel = int(height * image.shape[0]) + 10
        x_pixel = int(x * (image.shape[1])) - int((width_pixel - 20) / 2) - 5
        y_pixel = int(y * image.shape[0]) - int((height_pixel - 10) / 2) - 10

        cv2.rectangle(image, (x_pixel, y_pixel), (x_pixel + width_pixel, y_pixel + height_pixel), (0, 255, 0), 2)

        cropped_image = image[y_pixel:y_pixel + height_pixel, x_pixel:x_pixel + width_pixel]
        cropped_images.append(cropped_image)

    return cropped_images

def draw_white_boxes(image, lines):
    for line in lines:
        values = line.split(' ')
        x, y, width, height = map(float, values[1:])

        width_pixel = int(width * (image.shape[1])) + 5
        height_pixel = int(height * image.shape[0])
        x_pixel = int(x * (image.shape[1])) - int(width_pixel / 2)
        y_pixel = int(y * image.shape[0]) - int(height_pixel / 2)

        cv2.rectangle(image, (x_pixel, y_pixel), (x_pixel + width_pixel, y_pixel + height_pixel), (255, 255, 255), -1)
        
def process_image(lokasi_image, lines):
    image_polos = cv2.imread(lokasi_image)
    draw_white_boxes(image_polos, lines)
    return image_polos

# Fungsi untuk menambahkan teks dengan memecah baris jika terlalu panjang
def add_text_multiline(image, text, x, y, max_width, max_height):
    font = cv2.FONT_HERSHEY_SIMPLEX
    font_scale = 1
    font_thickness = 2
    font_color = (0, 0, 0)  # Warna teks (hitam)
    spas = 4

     # Fungsi untuk menentukan ukuran font yang sesuai
    def get_font_scale(text, max_width, max_height, font=cv2.FONT_HERSHEY_SIMPLEX, font_thickness=1):
      font_scale = 1
      while True:
          (text_w, text_h), _ = cv2.getTextSize(text, font, font_scale, font_thickness)
          if text_w <= max_width and text_h <= max_height:
              break
          font_scale -= 0.1
      return font_scale

    # Membagi teks menjadi baris-baris yang sesuai dengan lebar maksimum
    words = text.split()
    tlines = ['']
    current_line = 0
    for word in words:
        test_line = tlines[current_line] + ' ' + word if tlines[current_line] else word
        (text_w, text_h), _ = cv2.getTextSize(test_line, font, font_scale, font_thickness)

        if text_w <= max_width:
            tlines[current_line] = test_line
        else:
            current_line += 1
            tlines.append(word)

    # Hitung tinggi total teks
    total_text_height = len(tlines) * (text_h + 4)  # Spasi antar baris: 2 piksel

    if total_text_height>max_height:
      font_scale -= 0.5
      font_thickness = 1
      spas=-1
    else:
      font_scale = 1
      font_thickness = 2
      spas=4

    # Tentukan posisi vertikal tengah
    y_centered = y + int((max_height - total_text_height) / 2) + int(text_h/2) +1

    # Menambahkan teks ke gambar
    for i, line in enumerate(tlines):
        text_size = cv2.getTextSize(line, font, font_scale, font_thickness)[0]
        text_x = int(x + (max_width - text_size[0]) / 2)
        text_y = y_centered + i * (text_h + spas)  # Spasi antar baris: 2 piksel

        cv2.putText(image, line, (text_x, text_y), font, font_scale, font_color, font_thickness, lineType=cv2.LINE_AA)
        
def process_and_add_text(image, lines, tjepang):
    # Di dalam loop:
    for idx, line in enumerate(lines):
        values = line.split(' ')
        x, y, width, height = map(float, values[1:])
        width_pixel = int(width * (image.shape[1])) + 5
        height_pixel = int(height * image.shape[0]) + 10
        x_pixel = int(x * (image.shape[1])) - int(width_pixel / 2)
        y_pixel = int(y * image.shape[0]) - int(height_pixel / 2)
        
        text = tjepang[idx]
        if text!="":
            cv2.rectangle(image, (x_pixel, y_pixel), (x_pixel + width_pixel, y_pixel + height_pixel), (255, 255, 255), -1)
            add_text_multiline(image, text, x_pixel, y_pixel, width_pixel, height_pixel)
        
    return image

def save_and_translate(img_file, save_dir='hasil', tl_dir='terjemahan'):
    if not os.path.exists(save_dir):
        os.makedirs(save_dir)

    # Mulai Menerjemahkan
    model_path = r'penerjemah_manga/assets/comictextdetector.pt'
    kordinat = model2annotation(model_path, img_file, save_dir, save_json=False)
    if kordinat != ['']:
        lines = kordinat[0].split('\n')

        #kordinat = kordinat[::-1]

        # memotong gambar
        image_kotakin = cv2.imread(img_file)
        cropped_images = draw_bounding_boxes(image_kotakin, lines)

        # Mengambil teks Jepang dari potongan gambar
        tjepang = {}
        for i, cropped_image in enumerate(tqdm(cropped_images, desc='Processing images')):
            cropped_image2 = np.array(cropped_image, dtype=np.uint8)
            if cropped_image2 is not None and cropped_image2.any():
                img = Image.fromarray(cropped_image2)
                text = mocr(img)
            else:
                text = ""
            tjepang[i] = text
            #print(f"{i}. '{text}'")

        return tjepang,lines
    else:
        tjepang=""
        lines=""
        return tjepang,lines

def plance_input_text(img_file, tjepang, lines, save_dir='hasil', tl_dir='terjemahan'):
    if tjepang!="":
        print("--------------------------------")
        print("Terjemahkan json berikut ini:")
        print(tjepang)        
        j1=len(tjepang)
        print(f"------------------------------")
        tjepang_input = input()
        tjepang = eval(tjepang_input)
        j2=len(tjepang)
        file_name = os.path.basename(img_file)
        #print(f"j1={j1} dan j2={j2}")
        if (j1==j2):
            image = cv2.imread(img_file)
            image = process_and_add_text(image, lines, tjepang)
            cv2.imwrite(os.path.join(tl_dir, file_name), image)
            print(f"---disimpan ke {file_name}")
        else:
            print(f"Jumlah array kurang! untuk {file_name}")
            
def plance_text(img_file, tjepang_input, lines, save_dir='hasil', tl_dir='terjemahan'):        
        file_name = os.path.basename(img_file)
        if tjepang_input!="":         
            tjepang = eval(tjepang_input)
            if len(tjepang) == len(lines):
                image = cv2.imread(img_file)
                image = process_and_add_text(image, lines, tjepang)
                cv2.imwrite(os.path.join(tl_dir, file_name), image)
                print(f"---disimpan ke {file_name}")
            else:
                print(f"---Jumlah kalimat tidak sesuai untuk {file_name}")
        else:
            print(f"Input kosong! atau jumlah text kurang untuk {file_name}")
