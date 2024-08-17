from flask import Flask, render_template, request, redirect, url_for
import csv

app = Flask(__name__)

# Define the path for the CSV file
CSV_FILE = 'contact_data.csv'

@app.route('/')
def index():
    return render_template("index.html")

@app.route('/')
def google():
    return render_template("google1535de97be53bc0a.html")

@app.route('/resume')
def resume():
    return render_template("resume.html")

@app.route('/projects')
def projects():
    return render_template("projects.html")

@app.route('/contact')
def contact():
    return render_template("contact.html")

@app.route('/thank_you')
def thank_you():
    return render_template("thank_you.html")

@app.route('/test')
def test():
    return render_template("test.html")

if __name__ == "__main__":
    app.run(host="0.0.0.0", port=80, debug=True)
