from fastapi import FastAPI, File, UploadFile
from fastapi.responses import JSONResponse
import tensorflow as tf
import numpy as np
from io import BytesIO
from PIL import Image

# Fungsi prediksi
def predict(model, img_data, class_names):
    img = Image.open(BytesIO(img_data))
    img = img.resize((256, 256))  # Mengubah ukuran gambar
    img_array = np.array(img)
    img_array = np.expand_dims(img_array, axis=0)  # Membuat batch ukuran 1

    # Prediksi kelas gambar
    predictions = model.predict(img_array)
    max_confidence = np.max(predictions[0])
    confidence = round(100 * max_confidence, 2)

    # Tentukan kelas berdasarkan confidence
    if confidence < 55:  # Jika confidence < 55%
        predicted_class = "NotFound"
        confidence = 100.0  # Set confidence menjadi 100%
    else:
        predicted_class = class_names[np.argmax(predictions[0])]

    return predicted_class, confidence

# Memuat model yang sudah disimpan
model = tf.keras.models.load_model('public/classify/app/model_90.keras')

# Daftar nama kelas
class_names = ['miner', 'nodisease', 'phoma', 'rust']

# Membuat instance FastAPI
app = FastAPI()

# Route untuk upload gambar dan mendapatkan prediksi
@app.post("/predict/")
async def predict_image(file: UploadFile = File(...)):
    try:
        # Membaca data gambar yang diupload
        img_data = await file.read()

        # Memanggil fungsi prediksi
        predicted_class, confidence = predict(model, img_data, class_names)

        # Mengembalikan hasil prediksi dalam format JSON
        return JSONResponse(content={
            "predicted_class": predicted_class,
            "confidence": f"{confidence:.2f}%"  # Format dua angka di belakang koma
        })

    except Exception as e:
        return JSONResponse(content={
            "error": "Failed to process image",
            "details": str(e)
        }, status_code=500)
