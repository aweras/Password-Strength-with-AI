from flask import Flask, jsonify, request
from user import User
from werkzeug.security import generate_password_hash, check_password_hash

app = Flask(__name__)

# This list will store all the users created
users = []

@app.route("/user", methods=["GET"])
def get_user():
    return jsonify([user.to_dict() for user in users])

@app.route("/register", methods=["POST"])
def register_user():
    data = request.get_json()
    
    if not data or not all(key in data for key in ("name", "surname", "password", "email")):
        return jsonify({"error": "Missing fields"}), 400

    existing_user = next((u for u in users if u.email == data["email"]), None)
    if existing_user:
        return jsonify({"error": "User already exists"}), 409

    new_user = User(data["name"], data["surname"], data["password"], data["email"])
    users.append(new_user)

    return jsonify(new_user.to_dict()), 201

@app.route("/login", methods=["POST"])
def login():
    data = request.get_json()
    
    if not data or not all(key in data for key in ("email", "password")):
        return jsonify({"error": "Missing fields"}), 400

    email = data["email"]
    password = data["password"]

    user = next((u for u in users if u.email == email), None)

    if user is None:
        return jsonify({"error": "User not found"}), 404

    if user.password == password:  # This assumes the password is stored as plain text
        return jsonify({"message": "Login successful", "user": user.to_dict()}), 200
    else:
        return jsonify({"error": "Invalid password"}), 401

if __name__ == '__main__':
    app.run(debug=True, port=8080)