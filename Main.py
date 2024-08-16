from flask import Flask, render_template

app = Flask(__name__)

@app.route('/')
def index():
    return render_template("index.html")

@app.route('/resume')
def resume():
    return render_template("resume.html")

@app.route('/projects')
def projects():
    return render_template("projects.html")

@app.route('/contact')
def contact():
    return render_template("contact.html")

@app.route('/test')
def test():
    return render_template("test.html")

@app.route('/thank_you')
def test():
    return render_template("thank_you.html")

if __name__ == "__main__":
    app.run(host="0.0.0.0", port=80, debug=True)

    #$env:FLASK_APP = "Main.py"
    #$flask run
    
