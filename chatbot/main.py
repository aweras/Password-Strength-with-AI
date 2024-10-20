from langchain_ollama import OllamaLLM
from langchain_core.prompts import ChatPromptTemplate

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

# template = """
# You are a password strength evaluator.

# Evaluate the following password based on the following criteria:
# 1. Length (should be at least 12 characters)
# 2. Complexity (should include uppercase letters, lowercase letters, numbers, and special characters)
# 3. Check if the password contains the user's information.

# User Information:
# Name: {name}
# Surname: {surname}
# Email: {email}
# Password: {password}

# Based on this evaluation, classify the password as 'Strong', 'Medium', or 'Weak'.
# Provide brief recommendations for improvement, such as:
# - Use a longer password
# - Include different character types (uppercase, lowercase, numbers, symbols)
# - Avoid using personal information like your name or surname in the password.

# Answer:
# Classify the password as 'Strong', 'Medium', or 'Weak'.
# Provide brief recommendations for improvement, and suggest a strong password if password not classified as strong.
# """

model = OllamaLLM(model="llama3.2")
prompt = ChatPromptTemplate.from_template(template)
chain = prompt | model

def handle_conversation():
    context = ""    
    print("Welcome to the Password Strength Evaluator! Type 'exit' to quit.")
    
    while True:
        name = input("Enter your name: ")
        surname = input("Enter your surname: ")
        email = input("Enter your email: ")
        password = input("Enter your password: ")
        
        if name.lower() == "exit" or surname.lower() == "exit" or email.lower() == "exit" or password.lower() == "exit":
            break

        result = chain.invoke({
            "context": context,
            "name": name,
            "surname": surname,
            "email": email,
            "password": password
        })
        
        print("Evaluation Result:", result)
        context += f"\nUser: {name} {surname}, Email: {email}, Password: {password}\nAI: {result}"

if __name__ == "__main__":
    handle_conversation()
