from googletrans import Translator
import re

def translate_japanese(text_dict,bahasa,asal):
    translator = Translator()
    
     # Menghapus karakter "[" atau "]" dari setiap nilai dalam kamus
    cleaned_text_dict2 = {key: value.replace('［', '').replace('[', '').replace(']', '').replace('「', '').replace('」', '').replace('「', '') for key, value in text_dict.items()}
    cleaned_text_dict = {key: value if value else '・' for key, value in cleaned_text_dict2.items()}
    
    print(cleaned_text_dict)
    
    # Pisahkan teks menjadi kalimat-kalimat
    sentences = [value for key, value in cleaned_text_dict.items()]

    # Terjemahkan setiap kalimat
    translated_sentences = [translator.translate(sentence, src=asal, dest=bahasa).text for sentence in sentences]

    # Gabungkan kembali hasil terjemahan ke dalam bentuk awal
    translated_text_dict = {key: translated_sentences[i] for i, key in enumerate(cleaned_text_dict.keys())}
    
    hasil_terjemah = {key: value.replace("\'", '’') for key, value in translated_text_dict.items()}

    return hasil_terjemah
