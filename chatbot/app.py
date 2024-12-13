from langchain_ollama import OllamaLLM
from langchain_core.prompts import ChatPromptTemplate

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
classification: Classify the password as 'Strong', 'Medium', or 'Weak'.
recommendations: Provide brief recommendations for improvement.
strong_password: Suggest a strong password.
Only return this information without additional explanations with json formatting.
"""
prompt = ChatPromptTemplate.from_template(template)
chain = prompt | model

def evaluate_password(data):

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

    return  result

