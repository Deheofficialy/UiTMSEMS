import tensorflow as tf
from tensorflow.keras.applications.mobilenet_v2 import MobileNetV2, preprocess_input, decode_predictions
from tensorflow.keras.preprocessing import image
import numpy as np
import os

# Load the pre-trained MobileNetV2 model
model = MobileNetV2(weights='imagenet')

# Directory where your images are stored
base_dir = 'models/dataset'
sports = os.listdir(base_dir)

# Map ImageNet labels to sports equipment categories
sports_equipment_categories = {
    'n03790512': 'badminton racket',
    'n03794056': 'hockey stick',
    'n04254680': 'soccer ball',
    'n04540053': 'volleyball',
    'n04027447': 'tennis ball',  # Corrected the ImageNet label for tennis ball
}

for sport in sports:
    sport_dir = os.path.join(base_dir, sport)
    if not os.path.isdir(sport_dir):
        continue

    for image_file in os.listdir(sport_dir):
        image_path = os.path.join(sport_dir, image_file)

        # Load and preprocess the image
        img = image.load_img(image_path, target_size=(224, 224))
        img = image.img_to_array(img)
        img = np.expand_dims(img, axis=0)
        img = preprocess_input(img)

        # Make predictions
        predictions = model.predict(img)
        decoded_predictions = decode_predictions(predictions, top=5)[0]

        recognized_categories = []

        # Print top 5 recognized categories and their probabilities
        for _, label, probability in decoded_predictions:
            if label in sports_equipment_categories:
                recognized_categories.append((sports_equipment_categories[label], probability))

        if recognized_categories:
            recognized_categories.sort(key=lambda x: x[1], reverse=True)
            recognized_equipment = recognized_categories[0][0]
        else:
            recognized_equipment = "Equipment not recognized"

        print(f"Sport: {sport}, Image: {image_file}, Recognized Equipment: {recognized_equipment}")
