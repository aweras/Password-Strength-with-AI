from flask import Flask, request, jsonify
from langchain_ollama import OllamaLLM
from langchain_core.prompts import ChatPromptTemplate

app = Flask(__name__)

model = OllamaLLM(model="llama3.2")
template = """
You are a password strength evaluator.

Evaluate the following password based on the following criteria:
1. Length (should be at least 12 characters)
2. Complexity (should include uppercase letters, lowercase letters, numbers, and special characters)
3. Check if the password contains the user's name or surname.

User Information:
Name: {name}
Surname: {surname}
Email: {email}
Password: {password}

Answer:
Classify the password as 'Strong', 'Medium', or 'Weak'.
Provide brief recommendations for improvement, and suggest a strong password.
Only return this information without additional explanations.
"""
prompt = ChatPromptTemplate.from_template(template)
chain = prompt | model

@app.route('/evaluate-password', methods=['POST'])
def evaluate_password():
    data = request.json
    
    name = data.get('name')
    surname = data.get('surname')
    email = data.get('email')
    password = data.get('password')

    result = chain.invoke({
        "name": name,
        "surname": surname,
        "email": email,
        "password": password
    })
    
    return jsonify({"result": result})

if __name__ == '__main__':
    app.run(debug=True)
