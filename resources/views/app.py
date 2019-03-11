from flask import Flask

app = Flask(__name__)

@app.route('/', methods = ['GET', 'POST'])
def authorization():
	return '<h3>Hello world </h3>'