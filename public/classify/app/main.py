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
    predicted_class = class_names[np.argmax(predictions[0])]
    confidence = round(100 * np.max(predictions[0]), 2)

    return predicted_class, confidence

# Memuat model yang sudah disimpan
model = tf.keras.models.load_model('public/classify/app/model_20.keras')


# Daftar nama kelas
class_names = ['miner', 'nodisease', 'phoma', 'rust']

# Membuat instance FastAPI
app = FastAPI()

# Route untuk upload gambar dan mendapatkan prediksi
@app.post("/predict/")
async def predict_image(file: UploadFile = File(...)):
    img_data = await file.read()  # Membaca gambar yang diupload
    predicted_class, confidence = predict(model, img_data, class_names)

    # Mengembalikan hasil prediksi
    return JSONResponse(content={
        "predicted_class": predicted_class,
        "confidence": f"{confidence}%"
    })
