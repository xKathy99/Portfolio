import tensorflow
from tensorflow.keras.models import load_model
from tensorflow.keras.preprocessing import image
import numpy as np 

from PIL import Image

import sys


IMG_SIZE = 300
def _normalize_img(img): # RESIZE IMAGE
    img = tensorflow.cast(img, tensorflow.float32)/255.   # All images will be rescaled by 1./255
    img = tensorflow.image.resize(img,  (IMG_SIZE, IMG_SIZE), method= 'bilinear')
    return (img)


reconstructed_model = load_model("InceptionV3_trained.h5")

img_path = sys.argv[1]

img = Image.open(img_path)

img_array = image.img_to_array(img)
img_batch = np.expand_dims(img_array, axis=0)
img =_normalize_img(img_batch)

test_prediction = reconstructed_model.predict(img)
test_prediction_indices = np.argmax(test_prediction, axis=1)

model_output = test_prediction


