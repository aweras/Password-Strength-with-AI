from flask import Flask, jsonify, request
from user import User

app = Flask(__name__)

# This list will store all the users created
users = []

@app.route("/user", methods=["GET"])
def get_user():
    return jsonify([user.to_dict() for user in users])

@app.route("/user", methods=["POST"])
def create_user():
    data = request.get_json()

    if not data:
        return jsonify({"error": "No data provided"}), 400
    
    name = data.get("name")
    surname = data.get("surname")
    email = data.get("email")
    password = data.get("password")

    if not name or not surname or not email or not password:
        return jsonify({"error": "Invalid data"}), 400
    
    user = User(name, surname, password, email)
    users.append(user)

    return jsonify(user.to_dict()), 201

if __name__ == '__main__':
    app.run(debug=True, port=8080)