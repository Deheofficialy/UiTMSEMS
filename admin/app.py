# Flask app (app.py)
from flask import Flask, request, jsonify
import subprocess

app = Flask(__name)

@app.route('/recognize', methods=['POST'])
def recognize_object():
    # Handle the image data received from the client (you may need to process it)
    image_data = request.form['image']

    # Call the object recognition script
    script_path = '../yolov8-silva/yolov8_n_opencv.py'
    result = subprocess.run(['python', script_path, image_data], capture_output=True, text=True)

    # Extract the recognition result from the script output
    recognition_result = result.stdout

    return jsonify({"result": recognition_result})

if __name__ == '__main__':
    app.run()
