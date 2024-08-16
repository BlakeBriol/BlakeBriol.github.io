from flask import Flask, render_template, request, redirect, url_for
import csv

app = Flask(__name__)

# Define the path for the CSV file
CSV_FILE = 'contact_data.csv'

@app.route('/')
def index():
    return render_template("index.html")

@app.route('/resume')
def resume():
    return render_template("resume.html")

@app.route('/projects')
def projects():
    return render_template("projects.html")

@app.route('/contact', methods=['GET', 'POST'])
def contact():
    if request.method == 'POST':
        # Retrieve form data
        name = request.form['name']
        email = request.form['email']
        message = request.form['message']

        # Validate data
        if name and email and message:
            # Open or create CSV file
            with open(CSV_FILE, 'a', newline='') as file:
                writer = csv.writer(file)
                writer.writerow([name, email, message])

            # Redirect to thank you page
            return redirect(url_for('thank_you'))
        else:
            return "All fields are required.", 400

    return render_template("contact.html")

@app.route('/thank_you')
def thank_you():
    return render_template("thank_you.html")

@app.route('/test')
def test():
    return render_template("test.html")

if __name__ == "__main__":
    app.run(host="0.0.0.0", port=80, debug=True)
